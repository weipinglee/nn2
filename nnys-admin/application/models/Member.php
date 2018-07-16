<?php
/**
 * @date 2016-3-21
 * 后台会员管理
 *
 */
use \Library\M;
use \Library\Query;
use \Library\tool;
use \Library\safe;
class MemberModel extends baseModel{


	/**
	 *获取用户列表
     */
	public function getList(){
		$model = new \nainai\user\User();
		$Q = new \Library\searchQuery('user as u');
		$bar = '';
		if(!safe::filterGet('down') && !safe::filterGet('company_name') && !safe::filterGet('true_name') && !safe::filterGet('like') ){//没有其它查询条件
			$Q1 = new \Library\Query('user as u');
			$Q1->fields = 'u.id';
			$Q1->order = 'u.id asc';
			$Q1->where = ' FIND_IN_SET(u.status, :s)';
			$Q1->bind = array('s' => $model::NOMAL . ',' . $model::LOCK);
			$Q1->page = safe::filterGet('page','int',1);
			$data = $Q1->find();
			$bar = $Q1->getPageBar();//此处的bar替换下面联表查询获得的bar
			$ids = '';
			foreach($data as $val){
				$ids .= $ids=='' ? $val['id'] : ','.$val['id'];
			}
			$Q->where = 'u.id in ('.$ids.')';

		}
		else{
			$Q->where = ' FIND_IN_SET(u.status, :s)';
			$Q->bind = array('s' => $model::NOMAL . ',' . $model::LOCK);
		}
		$Q->join = 'left join agent as a on u.agent = a.id left join admin_yewu as ye on u.yewu = ye.admin_id LEFT JOIN company_info as c ON u.id=c.user_id LEFT JOIN person_info as p ON u.id=p.user_id';
		$Q->fields = 'u.*,a.username as agent_name,ye.ser_name, c.company_name, p.true_name';
		$Q->order = 'u.id asc';

		$data = $Q->find($this->getYewuList());
		$member = new \nainai\member();
		foreach ($data['list'] as $key => $value) {
			$data['list'][$key]['user_rank'] = $member->getUserGroup($value['id']);
		}
		if($bar!='')$data['bar'] = $bar;

		$Q->downExcel($data['list'],'user', '会员列表');
		return $data;


	}

    /**
     * 获取通知用户列表
     * @param int $page
     * @param int $pagesize
     * @return array
     */
	public function getNoticeList($page=1,$pagesize=20){
        $Q1 = new \Library\Query('user_rec as ur');
        $Q1->join = 'left join user as u on ur.user_id = u.id';
        $Q1->fields = 'ur.*,u.username,u.true_name';
        $Q1->page = $page;
        $Q1->pagesize=$pagesize;
        $data = $Q1->find();
        $bar = $Q1->getPageBar();
        return array('list'=>$data,'bar'=>$bar);
    }

    public function addNoticeUser($data){
	    $data['subject'] = 'jingjia';
	    if($data['user_id']==0)
	        return tool::getSuccInfo(0,'用户不存在');
	    $m = new M('user_rec');
	    $has = $m->where($data)->getObj();
	    if(!empty($has)){
	        return tool::getSuccInfo(0,'不能重复添加');
        }
	    $res = $m->data($data)->add();
	    if($res)
	        return tool::getSuccInfo();
	    return tool::getSuccInfo(0,'添加失败');
    }

    public function delNoticeUser($id){
        $m = new M('user_rec');
        $res = $m->where(array('id'=>$id))->delete();
        if($res)
            return tool::getSuccInfo();
        return tool::getSuccInfo(0,'删除失败');
    }

    public function seachUser($name){
	    $user = new M('user');
	    $data = $user->where('username="'.$name.'" OR mobile="'.$name.'"')->fields('id,username,mobile,true_name')->getObj();
	    return $data;
    }

	/**
	 *
	 * @param $offer_id
	 * @param $kefu_id
	 */
	public function addYewu($offer_id,$kefu_id){
		if($offer_id && $kefu_id){
			$mem = new M('user');
			$mem->beginTrans();
			$mem->where(array('id'=>$offer_id))->data(array('yewu'=>$kefu_id))->update();
			$log  = new \Library\log();
			$log->addLog(array('content'=>'为用户'.$offer_id.'绑定业务员'.$kefu_id));
			$res = $mem->commit();
			if($res===true){
				return tool::getSuccInfo();
			}
			return tool::getSuccInfo(0,'绑定失败');
		}
		else{
			return tool::getSuccInfo(0,'操作错误');
		}
	}

	public function getOnLine($page=1){
		$queryObj=new \Library\searchQuery('user as u');
		$queryObj->join=' left join user_session as s on s.session_id=u.session_id left join company_info as c on u.id=c.user_id left join person_info as p on p.user_id=u.id';
		$queryObj->fields='u.*,c.company_name,p.true_name';
		$queryObj->where='s.session_expire>:time';
		$queryObj->bind=array('time'=>time());
		$queryObj->page=$page;
		$OnLineList=$queryObj->find();
		$OnLineList['search']['down'] = null;
		$OnLineList['search']['likes'] = null;
		$OnLineList['search']['select'] = null;
		return $OnLineList;
	}

	public function getYewuList(){
		$return = array();
		$mem = new M('admin_yewu');
		$list = $mem->fields('admin_id, ser_name')->select();
		if (!empty($list)) {
			foreach ($list as $key => $value) {
				$return[$value['admin_id']] = $value['ser_name'];
			}
		}

		return $return;
	}

}
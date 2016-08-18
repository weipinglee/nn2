<?php 

/**
 * 找货列表管理
 * author: zyn
 * Date: 2016/8/15
 */
 use \Library\M;
use \Library\Query;
use \Library\Safe;
class FoundController extends InitController{
    public function foundListAction()
    {
        $page = Safe::filterGet('page', 'int', 0);
        $begin = Safe::filterGet('begin');
        $end = Safe::filterGet('end');
        $area = Safe::filterGet('area');
        $username = Safe::filterGet('username');
        $product_name = Safe::filterGet('product_name');
        $where = 1;
        if (!empty($begin)) {
            $where .= ' AND f.create_time>="'.$begin.'"';
            $this->getView()->assign('begin', $begin);
        }
        if (!empty($end)) {
            $where .= ' AND f.create_time<="'.$end.'"';
            $this->getView()->assign('end', $end);
        }
        if (!empty($area)) {
            $where .= ' AND area = '.$area;
            $this->getView()->assign('area', $area);
        }
        if (!empty($username)) {
            $where .= ' AND u.username = "'.$username.'"';
            $this->getView()->assign('username', $username);
        }
        if (!empty($product_name)) {
            $where .= ' AND product_name = '.$product_name;
            $this->getView()->assign('product_name', $product_name);
        }
        $query = new Query('found as f');
        $query->fields = 'f.*, u.username';
        $query->join = 'LEFT JOIN user as u ON f.user_id=u.id';
        $query->where = $where;
        $query->order = 'create_time desc';
        $query->page = $page;
        $lists = $query->find();
        $pageHtml = $query->getPageBar();

        $this->getView()->assign('foundList', $lists);
        $this->getView()->assign('pageHtml', $pageHtml);
    }
    
    public function detailAction()
    {
        $id = $this->getRequest()->getParam('id');
        $id = Safe::filter($id, 'int', 0);
        if (intval($id) > 0) {
            $query = new Query('found as f');
            $query->fields = 'f.*, u.username';
            $query->join = 'LEFT JOIN user as u ON f.user_id=u.id';
            $query->where = 'f.id='.$id;
            $foundDetail = $query->find();
            $this->getView()->assign('detail', $foundDetail ? $foundDetail[0] : array());
        }else{
            $this->redirect('foundList');
        }
    }
}
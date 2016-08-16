<?php 

/**
 * 找货列表管理
 * author: zyn
 * Date: 2016/8/15
 */
 use \Library\M;
use \Library\Query;
use \Library\safe;
class FoundController extends InitController{
    public function foundListAction()
    {
        $page = Safe::filterGet('page', 'int', 0);
        $begin = Safe::filterPost('begin');
        $end = Safe::filterPost('end');
        $area = Safe::filterPost('area');
        $username = Safe::filterPost('username');
        $product_name = Safe::filterPost('product_name');
        $where = 1;
        if (!empty($begin)) {
            $where .= ' AND create_time>'.$begin;
            $this->getView()->assign('begin', $begin);
        }
        if (!empty($end)) {
            $where .= ' AND create_time<'.$end;
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

        if (!empty($condition)) {
            $query->where = $condition['where'];
            $query->bind = $condition['bind'];
        }

        $query->page = $page;
        $query->pagesize = 10;

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
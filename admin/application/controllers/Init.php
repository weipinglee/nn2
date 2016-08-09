<?php 
use Library\Safe;

class InitController extends Yaf\Controller_Abstract{

	protected $pagesize = 1;

	public function init(){
		$this->getView()->setLayout('admin');
		
	}

     public function downExcel($list=array(), $condition=array()){
          if (is_array($list) && !empty($list)) {
               $begin = Safe::filterGet('begin');
               $end = Safe::filterGet('end');

               $excel = array();
               $excel[0] = \admintool\Downconfig::getConfig($condition['type']);
               if (empty($excel[0])) {
                   exit();
               }
               $keys = array_keys($excel[0]);
               $count = count($keys);
               foreach ($list as $key => $value) {
                    $item = array();
                    for ($i=0; $i < $count; $i++) {
                     $item[$keys[$i]] = $value[$keys[$i]];
                    }
                    array_push($excel, $item);
               }
               $str = '';
               if (!empty($begin)) {
                    $str .= $begin;
               }
               if (!empty($end)) {
                    $str .=  '至' . $end;
               }
               $obj = new \Library\Excel\ExcelHtml();
               $obj->createExecl($excel, $count, $str . "{$condition['name']}信息报表");
               exit();
          }

          return false;
     }



}
?>


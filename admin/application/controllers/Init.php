<?php 
use Library\Safe;

class InitController extends Yaf\Controller_Abstract{

	protected $pagesize = 1;

	public function init(){
		$this->getView()->setLayout('admin');
		
	}





}
?>


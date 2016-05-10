<?php 

class InitController extends Yaf\Controller_Abstract{

	protected $pagesize = 10;

	public function init(){
		$this->getView()->setLayout('admin');
		
	}

}
?>


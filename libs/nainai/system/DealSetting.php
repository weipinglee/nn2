<?php

namespace nainai\system;

use \Library\M;
use \Library\searchQuery;
use \Library\Tool;

class DealSetting extends \nainai\Abstruct\ModelAbstract{
	protected $Rules = array(
	        array('weeks','require','必须选择周期'),
	        array('start_time','require','必须选择开市时间'),
	        array('end_time','require','必须选择闭市时间'),
	);
}
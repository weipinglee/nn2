<?php
namespace nainai;

use \Library\M;
use \Library\Query;
use \Library\Tool;

/**
 * 信誉
 */
class CreditConfig{

	/**
	 * 根据对应的操作改变用户的信誉值
	 * @param  [Int]  $userId      [用户id]
	 * @param  [String]  $operateName [操作的名称]
	 * @param  integer $value       [根据百分比计算的信誉值]
	 * @return [Boolean] 
	 */
	public function changeUserCredit($userId, $operateName, $value=0){
		if (intval($userId) > 0 && is_string($operateName)) {
			$userModel = new M('user');

			$userData = $userModel->fields('id, credit')->where('id=:id')->bind(array('id' => $userId))->getObj();
			$configData = $userModel->table('configs_credit')->fields('name, type, sign, value')->where('name=:name')->bind(array('name' => $operateName))->getObj();
			
			if (!empty($configData) && !empty($userData)) {
				if ($configData['type'] == 1) {//百分比，乘于value
					$configData['value'] = bcmul($configData['value'],  $value, 5); 
				}

				switch (intval($configData['sign'])) {
					case 0:
						$userData['credit'] = bcadd($userData['credit'], $configData['value'], 5);
						break;

					case 1:
						$userData['credit'] = bcsub($userData['credit'], $configData['value'], 5);
						break;
				}

				return (bool)$userModel->table('user')->data(array('credit' => $userData['credit']))->where('id=:id')->bind(array('id' => $userId))->update();
			}
		}

		return FALSE;
	}

}
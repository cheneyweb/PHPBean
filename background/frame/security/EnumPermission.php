<?php
class EnumPermission{
	const ROOT = '1';
	const SYSTEM = '2';
		const ACCOUNT = '21';
			const ACCOUNT_QUERY = '211';
			const ACCOUNT_ADD = '212';
			const ACCOUNT_EDIT = '213';
			const ACCOUNT_DELETE = '214';
		const ROLE = '22';
			const ROLE_QUERY = '221';
			const ROLE_ADD = '222';
			const ROLE_EDIT = '223';
			const ROLE_DELETE = '224';

	public static function getMap(){
		$valuemap = array(
				'ROOT' => '1',
				'SYSTEM' => '2',
					'ACCOUNT' => '21',
						'ACCOUNT_QUERY' => '211',
						'ACCOUNT_ADD' => '212',
						'ACCOUNT_EDIT' => '213',
						'ACCOUNT_DELETE' => '214',
					'ROLE' => '22',
						'ROLE_QUERY' => '221',
						'ROLE_ADD' => '222',
						'ROLE_EDIT' => '223',
						'ROLE_DELETE' => '224'
		);
		return $valuemap;
	}
}
?>
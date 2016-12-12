<?php
class EnumPermission{	
	const SYSTEM = '1';
		const ACCOUNT = '11';
			const ACCOUNT_QUERY = '111';
			const ACCOUNT_ADD = '112';
			const ACCOUNT_EDIT = '113';
			const ACCOUNT_DELETE = '114';
		const ROLE = '12';
			const ROLE_QUERY = '121';
			const ROLE_ADD = '122';
			const ROLE_EDIT = '123';
			const ROLE_DELETE = '124';
	
	public static function getMap(){
		$valuemap = array(
				'SYSTEM' => '1',
					'ACCOUNT' => '11',
						'ACCOUNT_QUERY' => '111',
						'ACCOUNT_ADD' => '112',
						'ACCOUNT_EDIT' => '113',
						'ACCOUNT_DELETE' => '114',
					'ROLE' => '12',
						'ROLE_QUERY' => '121',
						'ROLE_ADD' => '122',
						'ROLE_EDIT' => '123',
						'ROLE_DELETE' => '124'
		);
		return $valuemap;
	}
}
?>
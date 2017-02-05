<?php
	/**
	 * 文件夹完全复制
	 * @param 原文件夹 $src
	 * @param 新文件夹 $dst
	 */
	function recurse_copy($src,$dst) {
		$dir = opendir($src);
		@mkdir($dst);
		while(false !== ( $file = readdir($dir)) ) {
			if (( $file != '.' ) && ( $file != '..' )) {
				if ( is_dir($src . '/' . $file) ) {
					recurse_copy($src . '/' . $file,$dst . '/' . $file);
				}
				else {
					copy($src . '/' . $file,$dst . '/' . $file);
				}
			}
		}
		closedir($dir);
	}

	/**
	 * 文件夹完全删除
	 * @param 文件夹路径 $dir
	 */
	function recurse_delete($dir) {
		//先删除目录下的文件：
		$dh=opendir($dir);
		while ($file=readdir($dh)) {
			if($file!="." && $file!="..") {
				$fullpath=$dir."/".$file;
				if(!is_dir($fullpath)) {
					unlink($fullpath);
				} else {
					deldir($fullpath);
				}
			}
		}
		closedir($dh);
		//删除当前文件夹：
		if(rmdir($dir)) {
			return true;
		} else {
			return false;
		}
	}
	// 删除文件夹及其文件夹下所有文件
	function deldir($dir) {
		$dh = opendir ( $dir );
		while ( $file = readdir ( $dh ) ) {
			if ($file != "." && $file != "..") {
				$fullpath = $dir . "/" . $file;
				if (! is_dir ( $fullpath )) {
					unlink ( $fullpath );
				} else {
					deldir ( $fullpath );
				}
			}
		}
		closedir ( $dh );
		if (rmdir ( $dir )) {
			return true;
		} else {
			return false;
		}
	}
	/**
	 * 创建文件夹
	 * @param 路径 $path
	 * @param 文件夹名称 $dir
	 */
	function createDir($path,$dir){
		if( !(file_exists($path.$dir) && is_dir($path.$dir)) ){
			if(!mkdir($path.$dir,0777)){
				return 0;
			}
			else{
				return 1;
			}
		}
	}
	/**
	 * 创建文件
	 * @param 路径 $path
	 * @param 文件名称 $fileName
	 */
	function createFile($path,$fileName){
		if(!file_exists($path.$fileName)){
			$fp=fopen($path.$fileName,'w+');
		}
	}
?>

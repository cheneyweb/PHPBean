<?php
/**
 * 文件文件夹操作类
 *
 * @author CheneyXu
 *
 */
class FileDir {
	/**
	 * 文件夹完全复制
	 * @param 原文件夹 $src
	 * @param 新文件夹 $dst
	 */
	public static function recurseCopy($src,$dst) {
		$dir = opendir($src);
		@mkdir($dst);
		while(false !== ( $file = readdir($dir)) ) {
			if (( $file != '.' ) && ( $file != '..' )) {
				if ( is_dir($src . '/' . $file) ) {
					self::recurseCopy($src . '/' . $file,$dst . '/' . $file);
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
	public static function recurseDelete($dir) {
		//先删除目录下的文件：
		$dh=opendir($dir);
		while ($file=readdir($dh)) {
			if($file!="." && $file!="..") {
				$fullpath=$dir."/".$file;
				if(!is_dir($fullpath)) {
					unlink($fullpath);
				} else {
					self::deldir($fullpath);
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
	// 私有方法：删除文件夹及其文件夹下所有文件
	private static function deldir($dir) {
		$dh = opendir ( $dir );
		while ( $file = readdir ( $dh ) ) {
			if ($file != "." && $file != "..") {
				$fullpath = $dir . "/" . $file;
				if (! is_dir ( $fullpath )) {
					unlink ( $fullpath );
				} else {
					self::deldir ( $fullpath );
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
	 * 私有方法：创建文件夹
	 * @param 路径 $path
	 * @param 文件夹名称 $dir
	 */
	private static function createDir($path,$dir){
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
	 * 私有方法：创建文件
	 * @param 路径 $path
	 * @param 文件名称 $fileName
	 */
	private static function createFile($path,$fileName){
		if(!file_exists($path.$fileName)){
			$fp=fopen($path.$fileName,'w+');
		}
	}
}
?>

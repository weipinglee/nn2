<?php
/**
 * @brief 动态生成缩略图类
 */
namespace Library;

class Thumb
{
	//缩略图路径
	public static $thumbDir = "_thumb";

	/**
	 * @brief 获取缩略图物理路径
	 */
	public static function getThumbDir()
	{

		return self::$thumbDir;
	}

	/**
	 * @brief 生成缩略图
	 * @param string $imgSrc 图片路径
	 * @param int $width 图片宽度
	 * @param int $height 图片高度
	 * @return string WEB图片路径名称
	 */
    public static function get($imgSrc,$width=100,$height=100)
    {
    	if($imgSrc == '')
    	{
    		return '';
    	}

		//商品物理实际路径
		$imgArr = explode('@',$imgSrc);
		$preThumb      = "{$width}_{$height}_";
		if(count($imgArr)>1){
			$sourcePath = tool::getGlobalConfig(array('rootDir',$imgArr[1])).'/'.trim($imgArr[0],'/');
			$thumbFileName = $preThumb.basename($imgArr[0]);//缩略图文件名
		}else{
			$sourcePath = trim($imgSrc,'/');
			$thumbFileName = $preThumb.basename($imgSrc);
		}

		//缩略图目录
		$thumbDir    = self::getThumbDir().'/';
		$webThumbDir = self::$thumbDir.'/';

		if(is_file($thumbDir.$thumbFileName) == false && is_file($sourcePath))
		{
			Image::thumb($sourcePath,$width,$height,$preThumb,$thumbDir);
		}

		return url::getBaseUrl().'/'.$webThumbDir.$thumbFileName;
    }

}
?>
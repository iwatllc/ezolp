<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class AssetJs
{
	const ASSET_TYPE = 'js';
	
	public $files = array();
	public $name;
	
	public function __construct($name = 'default')	
	{
		$this->setAssetName($name);
	}
	
	public function addAssetFile($file)
	{
		array_push($this->files, $file);
	}
	
	public function getAssetFiles()
	{
		return $this->files;
	}
	
	public function getAssetType()
	{
		return self::ASSET_TYPE;
	}
	
	public function setAssetName($name)
	{
		$this->name = strtolower(trim($name));
	}
	
	public function getAssetName()
	{
		$this->name;
	}
}
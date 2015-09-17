<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php

/** 
	* Author: Dan McCleary
	* Name: Asset Create Controller
	* Date: 09/14/2015
	* Time: 8:56pm
	* Version: 1.0
	* Notes: Controller class for Asset configurations to Combine and minify per page.
			 Allows for caching of created files.
*/

class AssetCreate extends MX_Controller
{
	const ASSET_CSS = 'AssetCss';
	const ASSET_JS = 'AssetJs';
	const EXT_LESS = 'less';
	const EXT_SCSS = 'scss';
	
	function __construct()
    {
        parent::__construct();
		
		$this->load->helper('file');
		$this->load->library('robofile');
    }

	public function index($asset = NULL) 
	{ 
		$obj = $asset;
		$name = get_class($obj);
		
		if (trim($name) == constant('self::ASSET_CSS'))
		{
			// Generate CSS href
			$asset_href = $this->generate_css($asset);
		}
		else if (trim($name) == constant('self::ASSET_JS'))
		{
			// Generate JS href
			$asset_href = 'TO BE DONE!!!!';
		}

		return $asset_href;
	}
	
	private function _generate_checksum($files)
	{
		$checksum = '';
		foreach ($files as $file) 
		{
			$file_ext = pathinfo($file, PATHINFO_EXTENSION);
			$file_dir = pathinfo($file, PATHINFO_DIRNAME) . '/';
			$file_name = pathinfo($file, PATHINFO_BASENAME);
			
			if (trim(strtolower($file_ext)) == constant('self::EXT_LESS') || trim(strtolower($file_ext)) == constant('self::EXT_SCSS'))
			{
				$folder = scandir($file_dir);
				
				foreach ($folder as $f) 
				{
					if (pathinfo($f, PATHINFO_BASENAME) != '.' && pathinfo($f, PATHINFO_BASENAME) != '..')
					{
						if (filemtime($file_dir . pathinfo($f, PATHINFO_BASENAME)) != FALSE)
						{
							$checksum .= date('YmdHis', filemtime($file_dir . pathinfo($f, PATHINFO_BASENAME))) . pathinfo($f, PATHINFO_BASENAME);
						}
					}
				}
			}
			else 
			{
				log_message('debug', 'POOP ' . $file_dir . $file_name);
				if (filemtime($file_dir . $file_name) != FALSE)
				{
					$checksum .= date('YmdHis', filemtime($file_dir . $file_name)) . $file_name;
				}
			}
		}
		
		return md5($checksum);
	}
	
	public function generate_css($asset)
	{
		$files = array();
		$files = array_merge($files, $asset->get_assets());
		$checksum = $this->_generate_checksum($files);
		
		$css_file = $this->config->item('dir_public_css') . $asset->get_file_name() . '_' . $checksum . '.css';
		
		if ( ! read_file($css_file))
		{
			$tmp_dir = $this->config->item('dir_tmp_assets') . $checksum;
			
			mkdir($tmp_dir);
			
			$combine_array = array();
			
			foreach ($files as $file) 
			{
				$file_ext = pathinfo($file, PATHINFO_EXTENSION);
			    $file_dir = pathinfo($file, PATHINFO_DIRNAME) . '/';
				$file_name = pathinfo($file, PATHINFO_BASENAME);
				
				if (trim(strtolower($file_ext)) == constant('self::EXT_LESS') || trim(strtolower($file_ext)) == constant('self::EXT_SCSS'))
				{
					$scss_parse = $this->robofile->_parse_scss([$file_dir . $file_name => $tmp_dir . '/' . $file_name . '.css']);
					if ($scss_parse === TRUE) 
					{
						array_push($combine_array, $tmp_dir . '/' . $file_name . '.css');
					}
				}
				else
				{
					array_push($combine_array, $file);
				}
			}
			
			if (sizeof($combine_array) > 0)
			{
				$final_array = array();
				
				foreach ($combine_array as $combine_file) 
				{
					$minify_res = $this->robofile->_minify_file($combine_file, $tmp_dir . '/' . pathinfo($combine_file, PATHINFO_BASENAME));
					if ($minify_res != FALSE)
					{
						array_push($final_array, $tmp_dir . '/' . pathinfo($combine_file, PATHINFO_BASENAME));
					}
				}
				
				if (sizeof($final_array > 0))
				{
					$concat_res = $this->robofile->_combine_files($final_array, $this->config->item('dir_public_css') . $asset->get_file_name(). '_' . $checksum . '.css');
					
					if ($concat_res === TRUE)
					{
						$this->robofile->_delete_dir($tmp_dir . '/');
						
						$delete_status = $this->_delete_old_files($this->config->item('dir_public_css'), $asset->get_file_name(), $asset->get_file_name(). '_' . $checksum . '.css');
						
						return base_url() . $this->config->item('url_dir_public_css') . $asset->get_file_name(). '_' . $checksum . '.css'; 
					}
				}
			}
			
			return '';
		}
		else
		{
			return base_url() . $this->config->item('url_dir_public_css') . $asset->get_file_name(). '_' . $checksum . '.css';
		}
	}
	
	private function _delete_old_files($directory, $file_name_prefix, $current_file_name)
	{
		try
		{
			$names = get_filenames($directory);
			$old_files = array();
			
			foreach ($names as $value) 
			{
				if (strpos($value, $file_name_prefix . '_') !== FALSE && $value !== $current_file_name)
				{
					array_push($old_files, $value);
				}
			}
			
			foreach ($old_files as $file_name) {
				unlink($directory . $file_name);
			}
			
			return TRUE;
		}
		catch (Exception $ex)
		{
			log_message('error', $ex);

			return FALSE;
		}
	}
}
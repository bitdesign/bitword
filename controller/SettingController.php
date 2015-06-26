<?
require_once('Controller.php');
require_once('AdminController.php');
require_once('lib/ArrayUtil.php');
require_once('lib/BitTimer.php');
require_once('model/Siteparas.php');
require_once('model/Slider.php');

class SettingController extends Controller{
	
	private  $siteparas = null;
	public $logger = null;
	
	function __construct(){
		parent::__construct();
		$this->siteparas = new Siteparas(); 
	}
	
	public function save(){
	    
	    include "config/config.php";
	   // $_POST['logo']= "$webroot/upload/".$_POST['logo'];
		$this->siteparas->save();
		$this->getParasFile();
		
		$adminController = new AdminController();
		$adminController->publishStaticIndex();
	}
	
	public function saveImg(){
		$this->siteparas->saveImg();
		$this->getParasFile();
		echo "true";
	}
	public function saveTpl(){
		$this->siteparas->saveTpl();
		$this->getParasFile();
		$adminController = new AdminController();
		$adminController->publishStaticIndex();
	}
	
	public function saveLan(){
		$this->siteparas->saveLan();
		$this->getParasFile();
		echo "true";
	}

	public function saveSlider(){
		$slider = new Slider();
		$slider->save();
	}
	
	public function startMemCache(){
		
		$timer = new BitTimer();
		$timer->updateMemcache();
		echo "true";
	}
	
	function settingPage(){
		$paras = $this->siteparas->getParas();
		require('view/admin/setting.php');
	}
	function persSettingPage(){
		$paras = $this->siteparas->getParas();
		require('view/admin/pers_setting.php');
	}
	function getParas(){
		$paras = $this->siteparas->getParas();
	}
	
	function getParasFile(){
		$this->siteparas->writeParas2File();
	}
	
	
}
/*end*/
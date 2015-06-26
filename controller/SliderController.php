<?
require_once('Controller.php');
require_once('model/Slider.php');

//class SliderController{
class SliderController extends Controller{
	
	public  $slider = null;
	
	function __construct(){
		parent::__construct();
		$this->slider = new Slider();
	}

	public function save(){
		$this->slider->save();
		$this->slider();
	}
	
	public function del(){
		$this->slider->del($_POST['img_order']);
		echo "true";
	}
	
	function slider(){
		
		$sliderList = $this->slider->getArrayList("slider","order by img_order");
		require('view/admin/slider.php');
	}
}

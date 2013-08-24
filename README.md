bitcms
======

A very simple cms



![Image text](https://github.com/bitdesign/bitcms/raw/master/imgs/slider.jpg)


<h1>How to use it</h1>

step 1. Include the jquery lib (jquery-1.7.2.min.js or later version) and bitslider.js

step 2. Define your divs to slide
	
	<body>	
		<div class="main" id="main">
			<div><span>Simple</span></div>
			<div><span>Art</span></div>
			<div><span>Product</span></div>
		</div>
	</body>
step 3. Init your divs like this:

	$(document).ready(function(){	
		$("#main").bitSlider({
			delay: 500,
			space: 25,
			showNum: true,
			prenext: false
		});
	});
	
	Then the divs in main div will slide one each time.

Or you can download the example to test it.
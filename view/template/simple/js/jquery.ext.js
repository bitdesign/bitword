$(document).ready(
	function() {
		
		jQuery.validator.addMethod("equalTo", function(value,
				element, param) {
			return value == $(param).val();
		}, $.validator.format("Two inputs are not the same!"));
		
		
		jQuery.validator.addMethod("isnum", function(value,
				element, param) {
			return this.optional(element)|| /^[0-9]+$/.test(value);
		}, $.validator.format("You can only enter numbers!"));
		

	}
);

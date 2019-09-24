// Wait for the DOM to be ready
$(function() {
  $("form[name='reportProblem']").validate({
    // Specify validation rules
    rules: {
		problem: "required"
    },
    // Specify validation error messages
    messages: {
		problem: "<br/>Please describe the problem you experienced."
    },
    // Make sure the form is submitted to the destination defined
    // in the "action" attribute of the form when valid
    submitHandler: function(form) {
		form.submit();
    }
  });
}); 


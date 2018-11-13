$(document).ready(function(){
	var highlighted = document.getElementById("trigger-highlight");
	var yPos = highlighted.offsetTop - 150;
	window.scrollTo(0, yPos);

	$("#trigger-highlight").addClass("trigger-highlight");
});
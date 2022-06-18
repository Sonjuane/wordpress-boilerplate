
//document.addEventListener('DOMContentLoaded', (event) => {
//the event occurred
//document.querySelectorAll("[data-foo='1']")
$ = jQuery;

$(document).ready(function () {
    
    console.log("ready!");
    
	$('.error *').parent().remove() // removes all errors and warning divs
// 	$('#menu-plugins .update-plugins').remove() // removes Plugins > Update Plugin Count (admin side menu)
// 	$('#menu-dashboard .update-plugins').remove() // removes Dashboard > Update Plugin Count (admin side menu)
	

});
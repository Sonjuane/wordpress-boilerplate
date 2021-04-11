
//document.addEventListener('DOMContentLoaded', (event) => {
//the event occurred
//document.querySelectorAll("[data-foo='1']")
$ = jQuery;

$(document).ready(function () {
    
    console.log("ready!");
    
	$('.error *').parent().remove() // removes all errors and warning divs

});
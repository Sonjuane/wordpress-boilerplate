console.log('pages', pages);

//document.addEventListener('DOMContentLoaded', (event) => {
//the event occurred
//document.querySelectorAll("[data-foo='1']")
$ = jQuery;

$(document).ready(function () {
    console.log("ready!");
    let divs = document.querySelectorAll('.error *')

    divs.forEach((item) => {
        let content = item.innerHTML
        let regex = /CleanTalk/im
        if (regex.test(content)) {
            item.remove();
        }
    })

    $('[href="update-core.php"] span').remove() // remove (under Dashboard) 'Update' badge
    $('[href="plugins.php"] span').remove() // removes 'Plugins' update badge

});
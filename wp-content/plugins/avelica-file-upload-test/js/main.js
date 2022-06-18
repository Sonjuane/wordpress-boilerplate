
function initForm(form) {
    jQuery(form).on('submit', function (e) {
        e.preventDefault();
        console.log('this', this, jQuery(this))
        var form_data = jQuery(this).serializeArray();
        // VERIFY REQUEST IS VALID - ADD NONCE
        form_data.push({ "name": "security", "value": ajax_object.ajax_nonce });
        form_data.push({ 'name': "fileUpload", "value": jQuery('[name="fileUpload"]')[0] })

        // console.log('ajax_url', ajax_object.ajax_url)
        console.log('form_data', form_data)
        // Here is the ajax petition.
        jQuery.ajax({
            url: ajax_object.ajax_url, // Here goes our WordPress AJAX endpoint.
            type: 'post',
            data: form_data,
            success: function (response) {
                // You can craft something here to handle the message return
                alert(response);
                resetForm(form)
            },
            fail: function (err) {
                // You can craft something here to handle an error if something goes wrong when doing the AJAX request.
                alert("There was an error: " + err);
            }
        });
        // This return prevents the submit event to refresh the page.
        return false;
    });
}
function resetForm(form) {
    jQuery(form)[0].reset();
}

initForm('form[name="contact-me"]');
initForm('form[name="file-upload"]');
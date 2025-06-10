$ = jQuery;

$(function () {
    // List Student Table
    let table = new DataTable('#tbl-student');

    $("#btn-upload-profile").on("click", function (e) {
        e.preventDefault();

        // Create media instance (Object)
        let mediaUploader = wp.media({
            title: 'Select Profile Image',
            multiple: false
        });

        // Select Image Handle Function
        mediaUploader.on("select", function () {
            let attachment = mediaUploader.state().get("selection").first().toJSON();
            //console.log(attachment);

            // set image URL to input field
            $("#profile_url").val(attachment.url);
        });

        // Open media modal
        mediaUploader.open();
    });
});

jQuery(document).ready(function($) {
    $('.mmp-media-upload').on('click', function(e) {
        e.preventDefault();
        let button = $(this);
        let targetInput = $('#' + button.data('target'));

        let frame = wp.media({
            title: 'Select or Upload Media',
            button: {
                text: 'Use this image'
            },
            multiple: false
        });

        frame.on('select', function() {
            let attachment = frame.state().get('selection').first().toJSON();
            targetInput.val(attachment.url);
        });

        frame.open();
    });
});

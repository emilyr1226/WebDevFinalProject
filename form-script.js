jQuery(document).ready(function($) {
    // Handle form submission
    $('form').on('submit', function(event) {
        event.preventDefault();
        var formData = $(this).serialize();
        $.ajax({
            type: 'POST',
            url: ajaxurl,
            data: formData + '&action=submit_mushroom_data',
            success: function(response) {
                // Handle success response
                console.log('Form submitted successfully.');
            },
            error: function(xhr, status, error) {
                // Handle error response
                console.error('Error occurred while submitting form.');
            }
        });
    });

    // Your JavaScript code for handling form interactions goes here
});

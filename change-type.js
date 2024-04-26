jQuery(document).ready(function($) {
    $('#sample-information-container').empty(); // Ensure container is initially empty
    
    $('#sample-type-select').change(function() {
        var selectedType = $(this).val();
        console.log("Selected sample type: " + selectedType); // Debug statement
        
        $.ajax({
            url: ajax_object.ajax_url,
            type: 'POST',
            data: {
                action: 'get_sample_information',
                sample_type: selectedType
            },
            success: function(response) {
                console.log("AJAX success. Response: ", response); // Debug statement
                $('#sample-information-container').html(response);
            },
            error: function(xhr, status, error) {
                console.error("AJAX error: ", error); // Debug statement
            }
        });
    });
});

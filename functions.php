<?php
/**
 * retrieves and sanitizes text form values
 *
 * @param string $name The name of the html field
 * @return string The string value of the field
 */
function process_text_field($name) {
    // if text box is empty return null, else return the contents
    $value = $_POST[$name] === '' ? null : sanitize_text_field($_POST[$name]);
    return $value;
}

/**
 * retrieves and sanitizes date form values and converts to y-m-d
 *
 * @param string $name The name of the html field
 * @return string Formatted date
 */
function process_date_field($name) {
    $mm_dd_yyyy = $_POST[$name];
    $yyyy_mm_dd = date('Y-m-d', strtotime($mm_dd_yyyy)); // convert date to year-month-day format
    $date = sanitize_text_field($yyyy_mm_dd);
    return $date;
}

/**
 * converts boolean (true/false) to 1/0 for mySQL
 *
 * @param string $name The name of the html field
 * @return int true: 1, false: 0
 */
function process_bool_field($name) {
    $value = process_text_field($name);
    if ($value === 'True') {
        return 1;
    }
    elseif ($value === 'False') {
        return 0;
    }
    // if null
    return $value;
}

/**
 * retrieves and sanitizes number form values
 *
 * @param string $name The name of the html field
 * @param string $type 'int' if the field contains integers,
 *                     'float' if the field contains decimals
 * @return int|float number value of field
 */
function process_num_field($name, $type) {
    $value = process_text_field($name);
    // if value is not null
    if (!is_null($value)) {
        if ($type === 'int') {
            return intval($value);
        }
        elseif ($type === 'float') {
            error_log( print_r( floatval($value), true ) );
            return floatval($value);
        }
        else { // if type is not int or float
            error_log( print_r( 'Invalid Number Format', true ) );
        }
    }
    return $value;
}

/**
 * inserts specimen info into database
 *
 * 
 * @return void
 */
function insert_specimen() {
    global $wpdb; // access wordpress database

    // retrieve values for fields that are always shown
    $name = process_text_field('specimen-field1');
    $specimen_name = process_text_field('specimen-name');
    $collector = process_text_field('specimen-collector');
    $print = process_bool_field('specimen-print');
    $specimen = process_bool_field('specimen-specimen');
    $hymenophore = process_text_field('hymenophore-dropdown');
    $veil = process_bool_field('specimen-veil');
    $wild = process_text_field('specimen-wild-cultivated');  
    $fungarium = process_text_field('specimen-fungarium');
    $notes = process_text_field('notes-specimen');
    $date = process_date_field('specimen-date');
    $fungarium_date = process_date_field('fungarium-date');
    $float_float = process_num_field('specimen-float-float', 'int');
    $float_sink = process_num_field('specimen-float-sink', 'int');

    // create array of sql field names and values to be inserted
    $data = array(
        'name' => $name,
        'specimen_name' => $specimen_name,
        'specimen_collector' => $collector,
        'print' => $print,
        'specimen' => $specimen,
        'hymenophore' => $hymenophore,
        'veil' => $veil,
        'specimen_fungarium' => $fungarium,
        'notes_specimen' => $notes,
        'specimen_date' => $date,
        'fungarium_date' => $fungarium_date,
        'float_float' => $float_float,
        'float_sink' => $float_sink,
    );
    
    // create array of format for each field. %s is string, %d is numerical
    $data_formats = array('%s', '%s', '%s', '%d', '%d', '%s', '%d', '%s', '%s', '%s', '%s', '%d', '%d');

    if ($wild == 'cultivated') { // handle values that are only used if cultivated
        $source_culture = process_text_field('specimen-source-culture');
        $substrate = process_text_field('specimen-substrate');

        $cultivated_data = array(
            'source_culture' => $source_culture,
            'substrate' => $substrate,
        );
        $cultivated_data_formats = array('%s','%s');
        
        // add new info to data arrays
        $data = array_merge($data, $cultivated_data);
        $data_formats = array_merge($data_formats, $cultivated_data_formats);
    }
                    
    $wpdb->insert('specimens', $data, $data_formats); // insert in specimens table
}

/**
 * inserts culture info into database
 *
 * 
 * @return void
 */
function insert_culture() {
    global $wpdb; // access wordpress database

    // retrieve values for fields that are always shown
    $name = process_text_field('name');
    $culture_name = process_text_field('culture-name');
    $culture_collector = process_text_field('culture-collector');
    $culture_date = process_date_field('culture-date');
    $culture_media = process_text_field('culture-media');
    $culture_location = process_text_field('culture-location');
    $culture_location_date = process_date_field('culture-location-date');
    $notes_culture = process_text_field('notes-culture');
    $culture_transfer_from = process_text_field('culture-transfer-from');

    // create array of sql field names and values to be inserted

    $data = array(
        'name' => $name,
        'culture_name' => $culture_name,
        'culture_collector' => $culture_collector, 
        'culture_date' => $culture_date,
        'media' => $culture_media,
        'culture_location' => $culture_location,
        'culture_location_date' => $culture_location_date,
        'notes_culture' => $notes_culture,
        'transfer_from' => $culture_transfer_from
    );

    // create array of format for each field. %s is string, %d is numerical
    $data_formats = array('%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s');

    $wpdb->insert('cultures', $data, $data_formats); // insert in cultures table

}

/**
 * inserts record info into database
 *
 * 
 * @return void
 */
function insert_record() {
    global $wpdb; // access wordpress database

    // retrieve values for fields that are always shown
    $species = process_text_field('record-species');
    $name = process_text_field('record-name');
    $received_date = process_date_field('record-received-date');
    $link = process_text_field('record-link');
    $selected_type = process_text_field('record-type');
    $notes = process_text_field('record-notes');
    $projects = process_text_field('record-projects');
    $selected_nuclear = process_text_field('nuclear');
    $allele1 = process_text_field('allele-1');

    // create array of sql field names and values to be inserted
    $data = array(
        'species' => $species,
        'name' => $name,
        'received_date' => $received_date,
        'link' => $link,
        'type' => $selected_type, 
        'notes' => $notes, 
        'projects' => $projects,
        'nuclear' => $selected_nuclear,
        'allele_1' => $allele1,
    );

    // create array of format for each field. %s is string, %d is numerical
    $data_formats = array('%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s');

    if ($selected_type =='wild') { // handle values that are only for wild
        $provider = process_text_field('record-provider');
        $lat = process_num_field('record-lat', 'float');
        $long = process_num_field('record-long', 'float');
        $accuracy = process_num_field('record-accuracy', 'int');
        $locality = process_text_field('record-locality');
        $location = process_text_field('record-location');
        $stream = process_text_field('record-stream');
        $host_species = process_text_field('record-host-species');
        $host_descr = process_text_field('record-host-descr');

        $new_data = array(
            'provider' => $provider,
            'lat' => $lat,
            'long' => $long,
            'accuracy' => $accuracy,
            'locality' => $locality,
            'location' => $location,
            'stream' => $stream, 
            'host_species' => $host_species,
            'host_descr' => $host_descr,
        );
        $new_formats = array('%s', '%f', '%f', '%f', '%s', '%s', '%s', '%s', '%s');

        // add new values to data arrays
        $data = array_merge($data, $new_data);
        $data_formats = array_merge($data_formats, $new_formats);
    }
    elseif ($selected_type != 'wild') { // handle values that are only for wild
        $parent1 = process_text_field('record-parent-1');
        $new_data = array('parent_1' => $parent1);

        // add new values to data arrays
        $data = array_merge($data, $new_data);
        array_push($data_formats, '%s');

        // handle values that are only for cross or test cross
        if ($selected_type == 'cross' || $selected_type == 'test-cross') {
            $parent2 = process_text_field('record-parent-2');
            $new_data = array('parent_2' => $parent2);

            // add new values to data arrays
            $data = array_merge($data, $new_data);
            array_push($data_formats, '%s');
        }
    }

    if ($selected_nuclear == 'dikaryon' && isset($_POST['record-allele-2'])) {  
        $allele2 = process_text_field('record-allele-2');
        $new_data = array('allele_2' => $allele2);

        // add new values to data arrays
        $data = array_merge($data, $new_data);
        array_push($data_formats, '%s');
    }

    $wpdb->insert('records', $data, $data_formats); // insert in records database
}

/**
 * retrieves submitted form and inserts the information in the appropriate table
 * in the database
 * 
 * @return void
 */
function form_submission() {
    if (isset($_POST['Submit'])) {
        global $wpdb;
        
        $sample_type = sanitize_text_field($_POST['sample-type']);

        switch ($sample_type) {
            case 'specimen':
                insert_specimen();
                break;

            case 'culture':
                insert_culture();
                break;
            
            case 'record':
                insert_record();
                break;
            default:
                break;
        }
		$thank_you_page_url = home_url('/submitted-successfully/'); 
    	wp_redirect($thank_you_page_url);
    	exit();

    }

}
add_action('init', 'form_submission');

// Add this code to your theme's functions.php file

// Add this code to your theme's functions.php file

function display_sample_information( $atts ) {
    // Shortcode attributes (if any)
    $atts = shortcode_atts( array(
        'sample_type' => '', // Default sample type
    ), $atts );

    // If sample_type is empty, return empty string
    if (empty($atts['sample_type'])) {
        return '';
    }

    // Define arrays to store headers and fields based on sample type
    $headers = array();
    $fields = array();

    // Determine headers and fields based on the selected sample type
    $sample_type = sanitize_text_field( $atts['sample_type'] );
    if ( $sample_type === 'specimens' ) {
        $headers = array( 'Name', 'Specimen Name', 'Specimen Collector', 'Print', 'Specimen', 
        'Hymenophore', 'Veil'  ); //'Source Culture', 'Substrate', 'Specimen Fungarium', 'Notes', 'Flags', 'Source', 'Date', 'Fungarium Date', 'Floating', 'Sinking'
        $fields = array( 'name', 'specimen_name', 'specimen_collector', 'print', 'specimen',
        'hymenophore', 'veil' ); //, 'source_culture', 'substrate', 'specimen_fungarium', 'notes_specimen', 'flags_specimen', 'source', 'specimen_date', 'fungarium_date', 'float_float', 'float_sink'
    } elseif ( $sample_type === 'cultures' ) {
        $headers = array( 'Name', 'Culture Name', 'Collector', 'Date', 'Media', 'Location', 'Location Date' );
        $fields = array( 'name', 'culture_name', 'culture_collector', 'culture_date', 'media', 'culture_location',
        'culture_location_date' );
    } elseif ( $sample_type === 'records' ) {
        $headers = array( 'Species', 'Name', 'Type', 'Provider', 'Received Date', 'Link', 'Latitude' );
        $fields = array( 'species', 'name', 'type', 'provider', 'received_date', 'link', 'lat' );
    }

    // Retrieve data from the database based on the selected sample type
    global $wpdb;
    $table_name = $sample_type; // Replace 'your_table_prefix_' with your actual table prefix
    $results = $wpdb->get_results( "SELECT * FROM $table_name", ARRAY_A );

    // Generate HTML markup for displaying the data
    ob_start();
    ?>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width">
        <link href="style.css" rel="stylesheet" type="text/css">
    </head>
    <table>
        <tr>
            <!-- Generate table headers -->
            <?php foreach ( $headers as $header ) : ?>
                <th><?php echo esc_html( $header ); ?></th>
            <?php endforeach; ?>
        </tr>
        <?php foreach ( $results as $result ) : ?>
            <tr>
                <!-- Generate table data cells -->
                <?php foreach ( $fields as $field ) : ?>
                    <td><?php echo esc_html( $result[ $field ] ); ?></td>
                <?php endforeach; ?>
            </tr>
        <?php endforeach; ?>
    </table>
    <?php
    return ob_get_clean();
}

add_shortcode( 'sample_information', 'display_sample_information' );

add_action('wp_ajax_get_sample_information', 'get_sample_information');
add_action('wp_ajax_nopriv_get_sample_information', 'get_sample_information');

function get_sample_information() {
    if (isset($_POST['sample_type'])) {
        $sample_type = sanitize_text_field($_POST['sample_type']);
        ob_start();
        echo do_shortcode('[sample_information sample_type="' . $sample_type . '"]');
        $output = ob_get_clean();
        echo $output;
    }
    wp_die();
}


function enqueue_child_scripts() {
    wp_enqueue_script('child-change-type', get_stylesheet_directory_uri() . '/change-type.js', array('jquery'), '1.0', true);
    wp_localize_script('child-change-type', 'ajax_object', array('ajax_url' => admin_url('admin-ajax.php')));
}
add_action('wp_enqueue_scripts', 'enqueue_child_scripts');



?>


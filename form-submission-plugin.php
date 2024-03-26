<?php
/*
Plugin Name: Mushroom Data Plugin
*/

// Enqueue JavaScript file
function mushroom_data_enqueue_scripts() {
    wp_enqueue_script('form-script', plugin_dir_url(__FILE__) . 'form-script.js', array('jquery'), '1.0', true);
}
add_action('wp_enqueue_scripts', 'mushroom_data_enqueue_scripts');

// Handle form submission
function form_submission() {
    if (isset($_POST['Submit'])) {
        global $wpdb;
        
        // Sanitize and validate form data
        $sample_type = sanitize_text_field($_POST['sample-type']);

        // Insert data into the MySQL database based on sample type
        switch ($sample_type) {
            case 'specimen':
                // Handle specimen form data insertion
                $name = sanitize_text_field($_POST['specimen-field1']);
                $specimen_name = sanitize_text_field($_POST['specimen-name']);
                $collector = sanitize_text_field($_POST['specimen-collector']);
                $print = sanitize_text_field($_POST['specimen-print']);
                $specimen = sanitize_text_field($_POST['specimen-specimen']);
                $hymenophore = sanitize_text_field($_POST['hymenophore-dropdown']);
                $veil = sanitize_text_field($_POST['specimen-veil']);
                $wild = sanitize_text_field($_POST['specimen-type']);
                $source_culture = sanitize_text_field($_POST['specimen-source-culture']);
                $substrate = sanitize_text_field($_POST['specimen-substrate']);
                $fungarium = sanitize_text_field($_POST['specimen-fungarium']);
                $print_fungarium = sanitize_text_field($_POST['specimen-print-fungarium']);
                $notes = sanitize_text_field($_POST['notes-specimen']);
                $date = sanitize_text_field($_POST['specimen-date'])
                $fungarium_date = sanitize_text_field($_POST['fungarium-date'])
                $float_float = sanitize_text_field($_POST['specimen-float-float'])
                $float_sink = sanitize_text_field($_POST['specimen-float-sink'])
                                
                // Implement insertion logic for specimens table
                $wpdb->insert(
                    'specimens',
                    array(
                        'name' => $name,
                        'specimen_name' => $specimen_name,
                        'specimen_collector' => $collector,
                        'print' => $print,
                        'specimen' => $specimen,
                        'hymenophore' => $hymenophore,
                        'veil' => $veil,
                        'source_culture' => $source_culture,
                        'substrate' => $substrate,
                        'specimen_fungarium' => $fungarium,
                        'notes_specimen' => $notes,
                        'fungarium_date' => $fungarium_date,
                        'float_float' => $float_float,
                        'float_sink' => $float_sink,
                        // Add more fields and values as needed
                    )
                );
                break;
            $flags_culture = '';
            case 'culture':
                // Handle culture form data insertion
                $name = sanitize_text_field($_POST['name']);
                $culture_name = sanitize_text_field($_POST['culture-name']);
                $culture_collector = sanitize_text_field($_POST['culture-collector']);
                $culture_date = sanitize_text_field($_POST['culture-date']);
                $culture_media = sanitize_text_field($_POST['culture-media']);
                $culture_location = sanitize_text_field($_POST['culture-location']);
                $culture_location_date = sanitize_text_field($_POST['culture-location-date']);
                $notes_culture = sanitize_text_field($_POST['notes-culture']);
                $culture_transfer_from = sanitize_text_field($_POST['culture-transfer-from']);
                // Implement insertion logic for cultures table
                $wpdb->insert(
                    'cultures',
                    array(
                        'name' => $name,
                        'culture_name' => $culture_name,
                        'culture_collector' => $culture_collector, 
                        'culture_date' => $culture_date,
                        'media' => $culture_media,
                        'culture_location' => $culture_location,
                        'culture_location_date' => $culture_location_date,
                        'notes_culture' => $notes_culture,
                        'transfer_from' => $culture_transfer_from
                    )
                );
                break;
            case 'record':
                // Handle record form data insertion
                $species = sanitize_text_field($_POST['record_species']);
                $name = sanitize_text_field($_POST['record_name']);
                // Implement insertion logic for records table
                $wpdb->insert(
                    'records',
                    array(
                        'species' => $species,
                        'name' => $name,
                        // Add more fields and values as needed
                    )
                );
                break;
            default:
                // Handle default case
                break;
        }
    }
}
add_action('init', 'form_submission');

?>

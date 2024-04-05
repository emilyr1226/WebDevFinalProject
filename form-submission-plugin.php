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
                $fungarium = sanitize_text_field($_POST['specimen-fungarium']);
                $print_fungarium = sanitize_text_field($_POST['specimen-print-fungarium']);
                $notes = sanitize_text_field($_POST['notes-specimen']);
                $date_mm_dd_yyyy = $_POST['specimen-date'];
                $date_yyyy_mm_dd = date('Y-m-d', strtotime($date_mm_dd_yyyy));
                $date = sanitize_text_field($date_yyyy_mm_dd);
                $fung_date_mm_dd_yyyy = $_POST['fungarium-date'];
                $fung_date_yyyy_mm_dd = date('Y-m-d', strtotime($fung_date_mm_dd_yyyy));
                $fungarium_date = sanitize_text_field($fung_date_yyyy_mm_dd);
                $float_float = sanitize_text_field($_POST['specimen-float-float']);
                $float_sink = sanitize_text_field($_POST['specimen-float-sink']);

                if ($wild == 'cultivated') {
                    $source_culture = sanitize_text_field($_POST['specimen-source-culture']);
                    $substrate = sanitize_text_field($_POST['specimen-substrate']);

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
                        )
                    );
                    break;
                }
                                
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
                        'specimen_fungarium' => $fungarium,
                        'notes_specimen' => $notes,
                        'fungarium_date' => $fungarium_date,
                        'float_float' => $float_float,
                        'float_sink' => $float_sink,
                    )
                );
                break;
            case 'culture':
                // Handle culture form data insertion
                $name = sanitize_text_field($_POST['name']);
                $culture_name = sanitize_text_field($_POST['culture-name']);
                $culture_collector = sanitize_text_field($_POST['culture-collector']);
                $cul_date_mm_dd_yyyy = $_POST['culture-date'];
                $cul_date_yyyy_mm_dd = date('Y-m-d', strtotime($cul_date_mm_dd_yyyy));
                $culture_date = sanitize_text_field($cul_date_yyyy_mm_dd);
                $culture_media = sanitize_text_field($_POST['culture-media']);
                $culture_location = sanitize_text_field($_POST['culture-location']);
                $culture_location_date = sanitize_text_field($_POST['culture-location-date']);
                $loc_date_mm_dd_yyyy = $_POST['culture-location-date'];
                $loc_date_yyyy_mm_dd = date('Y-m-d', strtotime($loc_date_mm_dd_yyyy));
                $culture_location_date = sanitize_text_field($loc_date_yyyy_mm_dd);
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
                $species = sanitize_text_field($_POST['record-species']);
                $name = sanitize_text_field($_POST['record-name']);
                $received_date = sanitize_text_field($_POST['record-received-date']);
                $link = sanitize_text_field($_POST['record-link']);
                $selected_type = sanitize_text_field($_POST['record_type']);
                 // Only shows up when type is wild
                else if ($selected_type =='wild' && isset($_POST['record-provider'])) {
                    $provider = sanitize_text_field($_POST['record-provider']);
                    $lat = sanitize_text_field($_POST['record-lat']);
                    $long = sanitize_text_field($_POST['record-long']);
                    $accuracy = sanitize_text_field($_POST['record-accuracy']);
                    $locality = sanitize_text_field($_POST['record-locality']);
                    $location = sanitize_text_field($_POST['record-location']);
                    $stream = sanitize_text_field($_POST['record-stream']);
                    $host_species = sanitize_text_field($_POST['record-host-species']);
                    $host_descr = sanitize_text_field($_POST['record-host-descr']);
                    if ($selected_nuclear == 'dikaryon' && isset($_POST['record-allele-2'])) {
                        $allele2 = sanitize_text_field($_POST['record-allele-2']);
                        $wpdb->insert(
                            'records',
                            array(
                                'species' => $species,
                                'name' => $name,
                                'received_date' => $received_date,
                                'link' => $link,
                                'type' => $selected_type, 
                                'provider' => $provider,
                                'lat' => $lat,
                                'long' => $long,
                                'accuracy' => $accuracy,
                                'locality' => $locality,
                                'location' => $location,
                                'stream' => $stream, 
                                'host_species' => $host_species,
                                'host_descr' => $host_descr,
                                'selected_nuclear' => $selected_nuclear,
                                'allele1' => $allele1,
                                'allele2' => $allele2,
                                'parent1' => $parent1,
                                'parent2' => $parent2,
                                'notes' => $notes, 
                                'projects' => $projects,
                            )
                        );
                        break;
                    }
                    $wpdb->insert(
                            'records',
                            array(
                                'species' => $species,
                                'name' => $name,
                                'received_date' => $received_date,
                                'link' => $link,
                                'type' => $selected_type, 
                                'provider' => $provider,
                                'lat' => $lat,
                                'long' => $long,
                                'accuracy' => $accuracy,
                                'locality' => $locality,
                                'location' => $location,
                                'stream' => $stream, 
                                'host_species' => $host_species,
                                'host_descr' => $host_descr,
                                'selected_nuclear' => $selected_nuclear,
                                'allele1' => $allele1,
                                'allele2' => $allele2,
                                'parent1' => $parent1,
                                'parent2' => $parent2,
                                'notes' => $notes, 
                                'projects' => $projects,
                            )
                        );
                        break;
                }
            
                $selected_nuclear = sanitize_text_field($_POST['nuclear']);
                $allele1 = sanitize_text_field($_POST['allele-1']);
            
                if ($selected_nuclear == 'dikaryon' && isset($_POST['record-allele-2'])) {
                    $allele2 = sanitize_text_field($_POST['record-allele-2']);
                }
                if ($selected_type != 'wild' && isset($_POST['record-parent-1'])) {
                    $parent1 = sanitize_text_field($_POST['record-parent-1']);
                }
                if ($selected_type === 'cross' || $selected_type === 'test-cross' && isset($_POST['record-parent-2'])) {
                    $parent2 = sanitize_text_field($_POST['record-parent-2']);
                }
                $notes = sanitize_text_field($_POST['record-notes']);
                $projects = sanitize_text_field($_POST['record-projects']);

            
                // Implement insertion logic for records table
                $wpdb->insert(
                    'records',
                    array(
                        'species' => $species,
                        'name' => $name,
                        'received_date' => $received_date,
                        'link' => $link,
                        'type' => $selected_type, 
                        'provider' => $provider,
                        'lat' => $lat,
                        'long' => $long,
                        'accuracy' => $accuracy,
                        'locality' => $locality,
                        'location' => $location,
                        'stream' => $stream, 
                        'host_species' => $host_species,
                        'host_descr' => $host_descr,
                        'selected_nuclear' => $selected_nuclear,
                        'allele1' => $allele1,
                        'allele2' => $allele2,
                        'parent1' => $parent1,
                        'parent2' => $parent2,
                        'notes' => $notes, 
                        'projects' => $projects,
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

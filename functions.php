<?php
/**
 * Twenty Twenty-Four functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Twenty Twenty-Four
 * @since Twenty Twenty-Four 1.0
 */

/**
 * Register block styles.
 */

if ( ! function_exists( 'twentytwentyfour_block_styles' ) ) :
	/**
	 * Register custom block styles
	 *
	 * @since Twenty Twenty-Four 1.0
	 * @return void
	 */
	function twentytwentyfour_block_styles() {

		register_block_style(
			'core/details',
			array(
				'name'         => 'arrow-icon-details',
				'label'        => __( 'Arrow icon', 'twentytwentyfour' ),
				/*
				 * Styles for the custom Arrow icon style of the Details block
				 */
				'inline_style' => '
				.is-style-arrow-icon-details {
					padding-top: var(--wp--preset--spacing--10);
					padding-bottom: var(--wp--preset--spacing--10);
				}

				.is-style-arrow-icon-details summary {
					list-style-type: "\2193\00a0\00a0\00a0";
				}

				.is-style-arrow-icon-details[open]>summary {
					list-style-type: "\2192\00a0\00a0\00a0";
				}',
			)
		);
		register_block_style(
			'core/post-terms',
			array(
				'name'         => 'pill',
				'label'        => __( 'Pill', 'twentytwentyfour' ),
				/*
				 * Styles variation for post terms
				 * https://github.com/WordPress/gutenberg/issues/24956
				 */
				'inline_style' => '
				.is-style-pill a,
				.is-style-pill span:not([class], [data-rich-text-placeholder]) {
					display: inline-block;
					background-color: var(--wp--preset--color--base-2);
					padding: 0.375rem 0.875rem;
					border-radius: var(--wp--preset--spacing--20);
				}

				.is-style-pill a:hover {
					background-color: var(--wp--preset--color--contrast-3);
				}',
			)
		);
		register_block_style(
			'core/list',
			array(
				'name'         => 'checkmark-list',
				'label'        => __( 'Checkmark', 'twentytwentyfour' ),
				/*
				 * Styles for the custom checkmark list block style
				 * https://github.com/WordPress/gutenberg/issues/51480
				 */
				'inline_style' => '
				ul.is-style-checkmark-list {
					list-style-type: "\2713";
				}

				ul.is-style-checkmark-list li {
					padding-inline-start: 1ch;
				}',
			)
		);
		register_block_style(
			'core/navigation-link',
			array(
				'name'         => 'arrow-link',
				'label'        => __( 'With arrow', 'twentytwentyfour' ),
				/*
				 * Styles for the custom arrow nav link block style
				 */
				'inline_style' => '
				.is-style-arrow-link .wp-block-navigation-item__label:after {
					content: "\2197";
					padding-inline-start: 0.25rem;
					vertical-align: middle;
					text-decoration: none;
					display: inline-block;
				}',
			)
		);
		register_block_style(
			'core/heading',
			array(
				'name'         => 'asterisk',
				'label'        => __( 'With asterisk', 'twentytwentyfour' ),
				'inline_style' => "
				.is-style-asterisk:before {
					content: '';
					width: 1.5rem;
					height: 3rem;
					background: var(--wp--preset--color--contrast-2, currentColor);
					clip-path: path('M11.93.684v8.039l5.633-5.633 1.216 1.23-5.66 5.66h8.04v1.737H13.2l5.701 5.701-1.23 1.23-5.742-5.742V21h-1.737v-8.094l-5.77 5.77-1.23-1.217 5.743-5.742H.842V9.98h8.162l-5.701-5.7 1.23-1.231 5.66 5.66V.684h1.737Z');
					display: block;
				}

				/* Hide the asterisk if the heading has no content, to avoid using empty headings to display the asterisk only, which is an A11Y issue */
				.is-style-asterisk:empty:before {
					content: none;
				}

				.is-style-asterisk:-moz-only-whitespace:before {
					content: none;
				}

				.is-style-asterisk.has-text-align-center:before {
					margin: 0 auto;
				}

				.is-style-asterisk.has-text-align-right:before {
					margin-left: auto;
				}

				.rtl .is-style-asterisk.has-text-align-left:before {
					margin-right: auto;
				}",
			)
		);
	}
endif;

add_action( 'init', 'twentytwentyfour_block_styles' );

/**
 * Enqueue block stylesheets.
 */

if ( ! function_exists( 'twentytwentyfour_block_stylesheets' ) ) :
	/**
	 * Enqueue custom block stylesheets
	 *
	 * @since Twenty Twenty-Four 1.0
	 * @return void
	 */
	function twentytwentyfour_block_stylesheets() {
		/**
		 * The wp_enqueue_block_style() function allows us to enqueue a stylesheet
		 * for a specific block. These will only get loaded when the block is rendered
		 * (both in the editor and on the front end), improving performance
		 * and reducing the amount of data requested by visitors.
		 *
		 * See https://make.wordpress.org/core/2021/12/15/using-multiple-stylesheets-per-block/ for more info.
		 */
		wp_enqueue_block_style(
			'core/button',
			array(
				'handle' => 'twentytwentyfour-button-style-outline',
				'src'    => get_parent_theme_file_uri( 'assets/css/button-outline.css' ),
				'ver'    => wp_get_theme( get_template() )->get( 'Version' ),
				'path'   => get_parent_theme_file_path( 'assets/css/button-outline.css' ),
			)
		);
	}
endif;

add_action( 'init', 'twentytwentyfour_block_stylesheets' );

/**
 * Register pattern categories.
 */

if ( ! function_exists( 'twentytwentyfour_pattern_categories' ) ) :
	/**
	 * Register pattern categories
	 *
	 * @since Twenty Twenty-Four 1.0
	 * @return void
	 */
	function twentytwentyfour_pattern_categories() {

		register_block_pattern_category(
			'page',
			array(
				'label'       => _x( 'Pages', 'Block pattern category', 'twentytwentyfour' ),
				'description' => __( 'A collection of full page layouts.', 'twentytwentyfour' ),
			)
		);
	}
endif;

add_action( 'init', 'twentytwentyfour_pattern_categories' );

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
                $selected_nuclear = sanitize_text_field($_POST['nuclear']);
                $allele1 = sanitize_text_field($_POST['allele-1']);

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
               if ($selected_type =='wild' && isset($_POST['record-provider'])) {
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
                    else {
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
                }
                elseif ($selected_type != 'wild' && isset($_POST['record-parent-1'])) {
                    $parent1 = sanitize_text_field($_POST['record-parent-1']);

                    if ($selected_type == 'cross' || $selected_type == 'test-cross' && isset($_POST['record-parent-2'])) {
                        $parent2 = sanitize_text_field($_POST['record-parent-2']);
    
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
                        else{
                            $wpdb->insert(
                                'records',
                                array(
                                    'species' => $species,
                                    'name' => $name,
                                    'received_date' => $received_date,
                                    'link' => $link,
                                    'type' => $selected_type, 
                                    'selected_nuclear' => $selected_nuclear,
                                    'allele1' => $allele1,
                                    'parent1' => $parent1,
                                    'parent2' => $parent2,                                    
                                    'notes' => $notes, 
                                    'projects' => $projects,
                                )
                            );
                            break;
                        }
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
                                'selected_nuclear' => $selected_nuclear,
                                'allele1' => $allele1,
                                'allele2' => $allele2,
                                'parent1' => $parent1,
                                'notes' => $notes, 
                                'projects' => $projects,
                            )
                        );
                        break;
                    }
                    else{
                        $wpdb->insert(
                            'records',
                            array(
                                'species' => $species,
                                'name' => $name,
                                'received_date' => $received_date,
                                'link' => $link,
                                'type' => $selected_type, 
                                'selected_nuclear' => $selected_nuclear,
                                'allele1' => $allele1,
                                'parent1' => $parent1,
                                'notes' => $notes, 
                                'projects' => $projects,
                            )
                        );
                        break;
                    }
                    }
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
                        'selected_nuclear' => $selected_nuclear,
                        'allele1' => $allele1,
                        'parent1' => $parent1,
                        'notes' => $notes, 
                        'projects' => $projects,
                    )
                );
                break;
            default:
                // Handle default case
				
                break;
        }
		$thank_you_page_url = home_url('/submitted-successfully/'); // Change '/thank-you' to the actual URL or slug of your thank you page
    	wp_redirect($thank_you_page_url);
    	exit();

    }

}
add_action('init', 'form_submission');

?>

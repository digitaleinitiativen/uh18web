<?php
    // $field_group_json = get_acf_json_by_name('home');
    // $field_group_file = get_stylesheet_directory() . '/acf-json/' . $field_group_json;


    // if (file_exists($field_group_file)) {
    //     $config = json_decode( file_get_contents( $field_group_file ), true );
    // }
?>


<?php
    $field_group_json = get_acf_json_by_name('home');
    $field_group_file = get_stylesheet_directory() . "/acf-json/{$field_group_json}";
    if (file_exists($field_group_file)) {
        $field_group_array = json_decode( file_get_contents( $field_group_file ), true );
        $config = $field_group_array;
    }
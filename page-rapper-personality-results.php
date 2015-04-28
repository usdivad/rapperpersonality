<?php
// get_header();

// echo 'hello';
// echo $_POST['rapper'];

global $wpdb;

// echo "hello";

$rapper = $_POST["rapper"];
// $rapper = "Lil' Kim";
// echo $rapper;

$artist_ids = $wpdb->get_results("
    SELECT ID FROM wp_posts
    WHERE post_type='artists'
    AND post_title=\"".$rapper."\"
    ");

// echo var_dump($artist_ids);
if (is_array($artist_ids) && count($artist_ids) > 0) {
    // echo "yes";
    $artist_id = $artist_ids[0]->{"ID"};
    // echo $artist_id;
    echo get_the_post_thumbnail($artist_id, "medium");
}

?>
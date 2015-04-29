<?php
// get_header();

// echo 'hello';
// echo $_POST['rapper'];

global $wpdb;

// echo "hello";
$img_url = "http://zumic.com/wp-content/uploads/2014/01/jayz_small.png";

if (isset($_POST["rapper"])) {
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
        
        // To get the thumbnail as an <img>
        // echo get_the_post_thumbnail($artist_id, "medium");

        // To get thumbnail URL only
        // echo wp_get_attachment_url(get_post_thumbnail_id($artist_id));
        $img_url_arr = wp_get_attachment_image_src(get_post_thumbnail_id($artist_id), 'medium');
        if (is_array($img_url_arr) && count($img_url_arr) > 0) {
            $img_url = $img_url_arr[0];
        }
    }
}

echo $img_url;

?>
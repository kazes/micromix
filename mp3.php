<?php
// to work, you need to edit the .htaccess file with this line:
// RewriteRule \.(mp3)$ /wp-content/themes/micromix-theme-1/mp3.php?file=%{REQUEST_URI}
$filename = '';
if (isset($_GET) && isset($_GET['file'])) {
    $filename = '' . substr($_GET['file'], 1);

    $args = array(
        'posts_per_page' => -1,
        'offset' => 0,
        'post_type' => 'post',
        'post_status' => 'publish',
        'suppress_filters' => true
    );

    function getpostidfrommp3($post_name)
    {
        global $args;
        $id = 0;
        $_posts = get_posts($args);
        foreach ($_posts as $post) {
            if (mb_strtolower(convertAccentsAndSpecialToNormal(trim(str_ireplace("'", " ", $post->post_title)))) == $post_name) {
                $id = $post->ID;
                break;

            }
        }

        return $id;
    }

    $post_name = urldecode(substr($_GET['file'], 8));
    $stringToReplace = array(" ", ",");
    $post_name = mb_strtolower(preg_replace("/Micromix [0-9]{3} - (.*)\.mp3/", "$1", $post_name));
    $postid = getpostidfrommp3($post_name);

    //todo update database to have a download_count and stream_count
    if (isset($_SERVER["HTTP_REFERER"])) {
        if ($postid) {
            incrementVisit($postid);
        }
        //if we have a referer, that means play from the player
    } else {
        // if no referer, that means that the file has been downloaded
        if ($postid) {
            incrementVisit($postid);
        }
    }
}

if (file_exists($filename)) {
    header("HTTP/1.0 200 OK");
    header('Content-Type: audio/mpeg');
    header('Accept-Ranges:bytes');
    if (!isset($_SERVER["HTTP_REFERER"])) {
        header('Content-Disposition: attachment; filename="' . str_replace("upload/", "", $filename) . '"');
    }
    header('Content-length: ' . filesize($filename));
    header('Cache-Control: max-age=29030400');
    header("Content-Transfer-Encoding: chunked");
    if (!isset($_SERVER["HTTP_REFERER"])) {
        header('HTTP_REFERER: ' . $_SERVER["HTTP_REFERER"] . '');
    }
    readfile($filename);
} else {
    header("HTTP/1.0 404 Not Found");
}
?>

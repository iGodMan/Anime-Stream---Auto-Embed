<?php
    include('../config.php');
    if(isset($_POST['episode_number']))
    {
        $views = mysqli_escape_string($conn, $_POST['views']);
        $anime_id = mysqli_escape_string($conn, $_POST['anime_id']);
        $episode_number = mysqli_escape_string($conn, $_POST['episode_number']);
        $anime_title = mysqli_escape_string($conn, $_POST['anime_title']);


        $sql = mysqli_query($conn, "SELECT id, anime_id, episode_number FROM episode_views_data WHERE anime_id = '$anime_id' AND episode_number = '$episode_number'");
        if($view = mysqli_fetch_assoc($sql))
        {
            mysqli_query($conn, "UPDATE episode_views_data SET `views`='$views'+1 WHERE anime_id = '$anime_id' AND episode_number = '$episode_number'");
        }
        else
        {
            mysqli_query($conn, "INSERT INTO `episode_views_data`(`anime_id`, `anime_title`, `views`, `dateTime`, `episode_number`) VALUES ('$anime_id','$anime_title','1','$dateTime', '$episode_number')");

        }

        
    }
    else
    {
        $views = mysqli_escape_string($conn, $_POST['views']);
        $anime_id = mysqli_escape_string($conn, $_POST['anime_id']);
        $anime_title = mysqli_escape_string($conn, $_POST['anime_title']);
        $sql = mysqli_query($conn, "SELECT `id`, `anime_id` FROM `anime_views_data` WHERE anime_id = $anime_id");
        if($view = mysqli_fetch_assoc($sql))
        {
            // $view[]
            mysqli_query($conn, "UPDATE anime_views_data SET `views`='$views'+1 WHERE anime_id = '$anime_id'");
        }
        else
        {
            // mysqli_query($conn, "INSERT INTO `anime_views_data`(`anime_id`, `anime_title`, `views`, `dateTime`) VALUES ('$anime_id','$anime_title','1','$dateTime')");

        }

    }
?>
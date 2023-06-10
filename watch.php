<?php
    $type = 'anime';
    $anime_id = '238';
    $episode = '1';
    $numEpisodes = '1';
    $anime_title = 'TSI';

    if(isset($_GET['id']))
    {
        $anime_id = $_GET['id'];
        $episode = $_GET['episode'];
        $numEpisodes = $_GET['tot_eps'];
        $anime_title = $_GET['title'];

    }
    include('config.php');
    
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="iGodMan">
    <meta name="authorUrl" content="#">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/app.css">
    <link rel="icon" type="image/x-icon" href="assets/img/icon.png">

    <title>Watch Online <?php echo $anime_title.' Episode '.$episode; ?> in English Japanes For Free | TSIAnime | Toonsouthindia.com</title>
</head>
<style>
    #summary{
        max-height:200px;
        overflow: auto;
    }
    .episode-btn.active{
        background-color: #1c1b1b;
    }
    .more-episodes-list{
        max-height: 400px;
        overflow:auto;
    }
</style>
<body>
    <div class="bg-opacity">
        <div class="my-5 container">
        <?php include('header.php');?>
            <div class="test"></div>
            <div class="col-12 py-3 text-center">
                <div class="header-title py-3">
                    <h2>
                        Watch <span class="title"><?php echo $anime_title; ?></span> Episode <?php echo $episode;?>
                    </h2>
                </div>
                <div class="video-frame">
                    <iframe src="https:\/\/database.gdriveplayer.us\/player.php?type=anime&id=<?php echo $anime_id;?>&episode=<?php echo $episode;?>" allowFullScreen="true" frameborder="0" width="100%" height="320" id="tsianime_video"></iframe>
                </div>
                <div class="tag-msg pt-2 row">
                        <div class="col-3 text-start">
                            <?php
                                if($episode != '1')
                                {
                                    $prevEp = $episode-1;
                                    echo '<a href="watch.php?id='.$anime_id.'&episode='.$prevEp.'&tot_eps='.$numEpisodes.'" class="btn btn-danger btn-sm"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-left-fill" viewBox="0 0 16 16">
                                    <path d="m3.86 8.753 5.482 4.796c.646.566 1.658.106 1.658-.753V3.204a1 1 0 0 0-1.659-.753l-5.48 4.796a1 1 0 0 0 0 1.506z"/>
                                  </svg></a>';
                                }
                            ?>
                        </div>
                        <div class="col-6 text-center">
                            <p class="text-warning">You're Watching Episode <?php echo $episode;?></p>

                        </div>
                        <div class="col-3 text-end">
                            <?php
                                if($episode != $numEpisodes)
                                {
                                    $nxtEp = $episode+1;
                                    echo '<a href="watch.php?id='.$anime_id.'&episode='.$nxtEp.'&tot_eps='.$numEpisodes.'" class="btn btn-danger btn-sm"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-right-fill" viewBox="0 0 16 16">
                                    <path d="m12.14 8.753-5.482 4.796c-.646.566-1.658.106-1.658-.753V3.204a1 1 0 0 1 1.659-.753l5.48 4.796a1 1 0 0 1 0 1.506z"/>
                                  </svg></a>';
                                }
                            ?>
                        </div>
                </div>
            </div>
            <div class="row pt-3">
                <div class="col-lg-4 text-center">
                    <div class="poster" id="poster">
                        <div class="img" height="200"></div>
                    </div>
                    <!-- <div class="watch-btn pt-2">
                        <input type="btn" name="" id="watch" class="btn btn-danger" value="Watch Episode">
                    </div> -->
                </div>
                <div class="col-lg-8">
                    <table class="table table-borderless text-white mt-3">
                        <tbody>
                            <tr>
                                <th>Series Title</th>
                                <td>:</td>
                                <td class="title" id="title"></td>
                            </tr>
                            <tr>
                                <th>Genre</th>
                                <td>:</td>

                                <td id="genre"></td>
                            </tr>
                            <tr>
                                <th>Total Episode</th>
                                <td>:</td>

                                <td id="total_episode">
                                </td>
                                <input type="text" name="" id="tot_eps" hidden>

                            </tr>
                            <tr>
                                <th>Status</th>
                                <td>:</td>

                                <td id="status"></td>
                            </tr>
                            <tr>
                                <th>Type</th>
                                <td>:</td>

                                <td id="type"></td>
                            </tr>
                            <tr>
                                <th>Summary</th>
                                <td>:</td>
                                <td id="summary"></td>
                            </tr>
                            <tr>
                                <th>Sub</th>
                                <td>:</td>

                                <td id="sub"></td>
                            </tr>
                            <tr>
                                <th>Views</th>
                                <td>:</td>
                                <td id="views">
                                    <?php
                                        $sql = mysqli_query($conn, "SELECT * FROM episode_views_data WHERE anime_id = '$anime_id' AND episode_number = '$episode'");
                                        if($view = mysqli_fetch_assoc($sql))
                                        {
                                            echo $view['views'];
                                        }
                                        else{echo '1';}
                                    ?>
                                </td>

                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-12">
                    <div class="more-episodes-list">
                        <?php
                            for ($i = 1; $i <= $numEpisodes; $i++) {
                                $episodeNumber = str_pad($i, 2, "0", STR_PAD_LEFT); // Pad single-digit numbers with leading zero
                                $activeClass = ($i == $episode) ? "active" : ""; 
                                $episodeButton = '<a href="watch.php?id='.$anime_id.'&episode='.$i.'&tot_eps='.$numEpisodes.'" class="m-1 episode-btn btn btn-danger '.$activeClass.'">E'.$episodeNumber.'</a>';
                                echo $episodeButton;
                            }
                        ?>
                    
                    </div>
                </div>
            </div>
            
            <?php include('footer.php');?>
            <input type="text" name="" id="title_input" hidden>

        </div>
    </div>

    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/jquery.min.js"></script>

    <script>
        $(document).ready(function () {
            

            var anime_id = '<?php echo $anime_id; ?>';
            $.getJSON('https://api.gdriveplayer.us/v1/animes/id/' + anime_id,
                        function (data) {
                            var title = data[0].title;
                            $("#poster").html('<img src="'+ data[0].poster +'" width="200" class="Tamilanime_poster">');
                            $(".title").html(data[0].title);
                            $("#genre").html(data[0].genre);
                            $("#total_episode").html(data[0].total_episode);
                            $("#status").html(data[0].status);
                            $("#type").html(data[0].type);
                            $("#summary").html('<p style="max-height:80px; overflow:auto;">'+data[0].summary+'</p>');
                            $("#sub").html(data[0].sub);
                            $("#tot_eps").val(data[0].total_episode);
                            $("#title_input").val(data[0].title);
                            
                            window.title_in = title;
                        }).then(function(){
                            var anime_title = window.title_in;
                            
                            var views = $("#views").html();
                            var episode_number = '<?php echo $episode;?>';

                            var fd = new FormData();

                            fd.append('anime_id', anime_id);
                            fd.append('anime_title', anime_title);
                            fd.append('episode_number', episode_number);
                            fd.append('views', views);

                            $.ajax({
                                url: 'ajax/views.php',
                                data: fd,
                                type:'post',
                                contentType: false,
                                processData: false,
                                success: function (response) 
                                {
                                    console.log(response);
                                }
                            });
                        })
                        // .then(function(){
                        //     var numEpisodes = $("#tot_eps").val();
                        // var activeEpisode = '<?php echo $episode;?>'; // Specify the episode number for which you want to add the "active" class
                        
                        // for (var i = 1; i <= numEpisodes; i++) {
                        //     var episodeNumber = ("0" + i).slice(-2); // Pad single-digit numbers with leading zero
                            
                        //     var activeClass = (i === activeEpisode) ? "active" : ""; // Check if the current episode is the active one
                            
                        //     var episodeButton = $('<a>', {
                        //     href: "#",
                        //     class: "m-1 episode-btn btn btn-danger " + activeClass,
                        //     text: "E" + episodeNumber
                        //     });
                            
                        //     $('.more-episodes-list').append(episodeButton);
                        // }
                        // })
                        
                    //     const element = document.getElementsByClassName('jw-icon-fullscreen');

                    // element.addEventListener('click', () => {
                    //   if (element.requestFullscreen) {
                    //     element.requestFullscreen();
                    //   } else if (element.mozRequestFullScreen) {
                    //     element.mozRequestFullScreen();
                    //   } else if (element.webkitRequestFullscreen) {
                    //     element.webkitRequestFullscreen();
                    //   } else if (element.msRequestFullscreen) {
                    //     element.msRequestFullscreen();
                    //   }
                    // });
                    // var test_get_gogo = $('#show-server .list-server-items').html();
                    // tsianime_video
                    // console.log(test_get_gogo);

                    // Assuming you have an iframe with the ID "my-iframe"
                    var iframe = $('#tsianime_video')[0];
                    var iframeContent = iframe.contentDocument || iframe.contentWindow.document;

                    // Select an element with a specific ID within the iframe
                    var elementInIframe = $(iframeContent).find('#show-server .list-server-items');

                    // Check if the element exists and perform further actions
                    if (elementInIframe.length > 0) {
                    // Access the properties or manipulate the element as needed
                        elementInIframe.css('color', 'red');
                        console.log(elementInIframe);
                    } else {
                    console.log('Element not found within the iframe.');
                    }

        });
    </script>
</body>

</html>
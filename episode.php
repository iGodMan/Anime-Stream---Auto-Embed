<?php
    $anime_id = '238';
    $anime_title = "TSI";
    if(isset($_GET['id']))
    {
        $anime_id = $_GET['id'];
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

    <title>Watch Online <?php echo $anime_title; ?> Full Season Episodes in English For Free | TSIAnime | Toonsouthindia.com</title>
</head>
<style>
    #summary{
        max-height:200px;
        overflow: auto;
    }
</style>
<body>
    <div class="bg-opacity">
        <div class="my-5 container">
        <?php include('header.php');?>

            <div class="row pt-5 mt-5">
                <div class="col-lg-4 text-center">
                    <div class="poster" id="poster">
                        <div class="img" height="200"></div>
                    </div>
                    <div class="watch-btn pt-2">
                        <a href="watch.php?type=anime&id=<?php echo $anime_id;?>&episode=1&title=<?php echo $anime_title;?>">
                            <button type="button" name="" id="watch" class="btn btn-danger">Watch Episode</button>
                        </a>
                    </div>
                </div>
                <div class="col-lg-8">
                    <table class="table table-borderless text-white mt-3">
                        <tbody>
                            <tr>
                                <th>Series Title</th>
                                <td>:</td>
                                <td id="title"></td>
                            </tr>
                            <tr>
                                <th>Genre</th>
                                <td>:</td>

                                <td id="genre"></td>
                            </tr>
                            <tr>
                                <th>Total Episode</th>
                                <td>:</td>

                                <td id="total_episode"></td>
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
                                <td id="views"><?php
                                        $sql = mysqli_query($conn, "SELECT * FROM anime_views_data WHERE anime_id = $anime_id");
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
            </div>
            <input type="text" name="" id="title_input" hidden>
            <?php include('footer.php');?>

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
                            $("#title").html(data[0].title);
                            $("#genre").html(data[0].genre);
                            $("#total_episode").html(data[0].total_episode);
                            $("#status").html(data[0].status);
                            $("#type").html(data[0].type);
                            $("#summary").html('<p style="max-height:80px; overflow:auto;">'+data[0].summary+'</p>');
                            $("#sub").html(data[0].sub);
                            $("#title_input").val(title);

                            $(".watch-btn").html(`<a href="watch.php?type=anime&id=<?php echo $anime_id;?>&episode=1&tot_eps=`+ data[0].total_episode +`">
                                <input type="btn" name="" id="watch" class="btn btn-danger" value="Watch Episode">
                            </a>`);

                           window.title_in = title;
                        }).then(function(){
                            var anime_title = window.title_in;
                            var views = $("#views").html();
                            var fd = new FormData();

                        fd.append('anime_id', anime_id);
                        fd.append('anime_title', anime_title);
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
                        
        });
    </script>
</body>

</html>
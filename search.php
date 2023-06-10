<?php
    $query = '';

    if(isset($_GET['query']))
    {
        $query = $_GET['query'];
    }
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

    <title>Search Query <?php echo $query; ?> TSIAnime Anime by iGodMan @ TSI Team</title>
</head>
<style>
    .Tamilanime_poster{
        height: 250px;
        object-fit: cover;
    }
    @media(max-width: 480px)
    {
        .Tamilanime_poster{
        height: 230px;
        width: 150px;
        object-fit: cover;
    }
    }
</style>
<body>
    <div class="bg-opacity">
        <div class="my-5 container">
            <?php include('header.php');?>

           <div class="search-keyword pt-4">
                <h4>Search Keyword "<?php echo $query;?>"</h4>
           </div>
           <div class="row search-result pt-4" id="search-result">
              
           </div>
           <?php include('footer.php');?>

        </div>
    </div>

    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/jquery.min.js"></script>

    <script>
        $(document).ready(function () {
            var search_query = '<?php echo $query;?>';
            var replacedStr = search_query.replace(/ /g, "+");

            console.log(replacedStr);
            $.getJSON('https://api.gdriveplayer.us/v1/animes/search?title=' + replacedStr,
                function (data) {
                    console.log(data);
                    data.map((array, index) => {
                        $('#search-result').append(`
                        <div class="col-lg-3 col-sm-4 col-xs-6 col-6 pt-3" style="cursor:pointer;"  onclick="window.location='episode.php?id=${array.id}&title=${array.title}'">
                            <div class="poster">
                                <img src="${array.poster}" alt="" width="200" class="Tamilanime_poster">
                                <!-- <span class="type">Tv Series</span>
                                <span class="status">Completed</span> -->
                            </div>
                            <div class="col-9 title">
                                ${array.title}
                            </div>
                        </div>
                        `);
                    });
                });
        })
    </script>
</body>

</html>
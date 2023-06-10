<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="You can Watch All over Animes In English dubbed and Subbed and Jap Animes in HQ Quality For Free">
    <meta name="keywords" content="TamilAnime, Naruto Watch Online, One Piece Complete, Watch Animes Free, Toonsouthindia, Gogoanime, 9Anime, Zoro.to, Sanji.to, KissAnime">
    <meta name="author" content="iGodMan">
    <meta name="authorUrl" content="#">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/app.css">
    <link rel="icon" type="image/x-icon" href="assets/img/icon.png">
    <title>Watch English Dubbed and Subbed Japanese Animes For Free | TSIAnime | Toonsouthindia</title>
</head>
<style>
    #search-btn{
        width:100%;
        padding: 10px 0px;
        margin-top: -7px;
    }
    @media(max-width:480px){
        #search-btn{
        width:100%;
        padding: 10px 0px;
        border-radius: 0px 0px 10px 10px;
        }
    }
    .keywords a{
        color:#c1c1c1;
        text-decoration:none;
    }
</style>
<body>
    <div class="bg-opacity">
        <div class="my-5 container">
            <?php include('header.php');?>
            <div class="row pt-5 mt-5">
                <div class="col-lg-8 pt-5 mt-2">
                    <div class="tamil-anime-logo">
                        <h1>TSI<span class="text-danger">Anime</span></h1>
                    </div>
                    <div class="search-form pt-3" style="text-align: -webkit-center;">
                        <form action="search.php" method="get" class="form-group row col-12">
                            <div class="col-lg-10 col-12">
                                <input type="search" name="query" id="search" placeholder="Search...">
                            </div>
                            <div class="col-lg-2 text-center col-12 pt-2 w100">
                                <button class="btn btn-danger" id="search-btn">Search</button>
                            </div>   
                            <div class="col-lg-10 col-12">
                                <div class="keywords pt-3" style="color:#c1c1c1; font-family: monospace;font-size: 14px;">
                                <b>Top Search :</b>
                                <a href="https://tamilhd.fun/anime/episode.php?id=3558">One Piece</a>,
                                <a href="https://tamilhd.fun/anime/episode.php?id=3378">Naruto</a>,
                                <a href="https://tamilhd.fun/anime/episode.php?id=3777">Pokemon</a>,
                                <a href="https://tamilhd.fun/anime/episode.php?id=3386">Naruto Shippuden</a>,
                                <a href="https://tamilhd.fun/anime/episode.php?id=124108">Demon Slayer: Kimetsu no Yaiba</a>...
                                </div>
                                <div class="live-search-result d-none" style="height:250px;">
                                
                                    <table class="table text-white">
                                        <tbody id="search_result">
                                            <tr>
                                                <td>
                                                <div class="text-center mt-5"><img src="assets/img/loading.gif"></div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <div class="view-all"></div>
                                </div> 
                            </div>
                        </form>
                        
                    </div>
                </div>
                <div class="col-lg-4 text-center pt-3">
                    <img src="assets/img/luffy.png" alt="" height="400">
                </div>
            </div>
            <?php include('footer.php');?>
        </div>
    </div>

    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/jquery.min.js"></script>

    <script>
        $(document).ready(function () {

            $('#search').keyup(function () {
                $('.live-search-result').removeClass('d-none');
                $('.keywords').addClass('d-none');

                var search_val = $(this).val();

                if (search_val == "") {
                    $('.keywords').removeClass('d-none');
                    $('.live-search-result').addClass('d-none');
                } else {
                    var replacedStr = search_val.replace(/ /g, "+");
                    $("#search_result").html('');

                    $.getJSON('https://api.gdriveplayer.us/v1/animes/search?title=' + replacedStr,
                        function (data) {
                            // console.log(data.length);
                            if (data !== null) {
                                data.map((array, index) => {
                                $('#search_result').append(`
                                    <tr onclick="window.location='episode.php?id=${array.id}&title=${array.title}'" style="cursor:pointer;">
                                        <td class="text-center">
                                        <img src="${array.poster}" alt="" width="50">
                                        </td>
                                        <td>
                                        <div class="title">
                                            <b>${array.title}</b>
                                        </div>
                                        <div class="genre">
                                            <small>${array.genre}</small>
                                        </div>
                                        <div class="type">${array.type}</div>
                                        </td>
                                    </tr>
                                `);
                            });
                            }
                            else
                            {
                                $('#search_result').html('<tr><td colspan="2" class="text-center">Not found</td></tr>');
                            }
                           
                        });

                }
            })
        })
    </script>
</body>

</html>
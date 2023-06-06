<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="iGodMan">
    <meta name="authorUrl" content="https://github.com/iGodMan">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/app.css">
    <title>TamilAnime by iGodMan</title>
</head>

<body>
    <div class="bg-opacity">
        <div class="my-5 container">
            <div class="header text-center">
                <h1>Tamil<span class="text-danger">Anime</span></h1>
            </div>
            <div class="row pt-5 mt-5">
                <div class="col-lg-8 pt-5 mt-2">
                    <div class="tamil-anime-logo">
                        <h1>Tamil<span class="text-danger">Anime</span></h1>

                    </div>
                    <div class="search-form pt-3">
                        <div class="form-group">
                            <input type="search" name="" id="search" placeholder="Search...">
                        </div>
                        <div class="keywords pt-3" style="color:#c1c1c1; font-family: monospace;
    font-size: 14px;">
                            <b>Top Search :</b> <span>One Piece, Demon Slayer: Kimetsu no Yaiba Swordsmith Village
                                ArcVinland Saga: 2nd SeasonNaruto: ShippudenHell's ParadiseDemon Slayer: Kimetsu no
                                YaibaBlack CloverI Got a Cheat Skill in Another World and Became Unrivaled in The Real
                                World, TooNarutoAttack on Titan</span>
                        </div>
                        <div class="live-search-result d-none">
                            <table class="table text-white">
                                <tbody id="search_result">

                                </tbody>
                                <!-- <tfoot>
                                <tr class="bg-dark text-white">
                                    <td colspan="2">
                                        <div class="view-text text-center">
                                            <button class="btn btn-danger">View All</button>
                                        </div>
                                    </td>
                                </tr>
                            </tfoot> -->
                            </table>
                            <div class="view-all"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 text-center">
                    <img src="assets/img/luffy.png" alt="" height="400">
                </div>
            </div>
            <div class="footer py-5 mt-5">
                <div class="copyright text-center">
                    &copy; TamilAnime Made by <a class="text-danger" href="https://github.com/iGodMan">iGodMan</a>
                </div>
            </div>
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
                            console.log(data);
                            data.map((array, index) => {
                                $('#search_result').append(`
                        <tr>
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
                        });

                }
            })
        })
    </script>
</body>

</html>
<?php
    include('config.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/dataTables.min.css">
    <title>TamilAnime Status</title>
</head>
<body>
    <section class="header bg-primary text-center py-4 text-white">
        <h4>TSIAnime Status</h4>
    </section>
    <section class="container pt-3 top-anime">
    <h4 class="py-2">Anime List</h4>

        <div class="top-animes">
            <table class="table table-striped" id="top_anime">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Title</th>
                        <th>Views</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $count = 1;
                        $sql = mysqli_query($conn, "SELECT * FROM anime_views_data ORDER BY dateTime DESC");
                        while($top_anime = mysqli_fetch_assoc($sql)){
                    ?>
                    <tr>
                        <td><?php echo $count++;?></td>
                        <td><?php echo $top_anime['anime_title'];?></td>
                        <td><?php echo $top_anime['views'];?></td>
                        <td><?php echo date('d-m-Y', strtotime($top_anime['dateTime']));?></td>
                    </tr>
                    <?php };?>
                </tbody>
            </table>
        </div>
    </section>
    <section class="container pt-3 top-episode">
        <h4 class="py-2">Episode List</h4>
        <div class="top-animes">
            <table class="table table-striped" id="top_episode">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Title</th>
                        <th>Ep</th>
                        <th>Views</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $count = 1;
                        $query = mysqli_query($conn, "SELECT * FROM episode_views_data ORDER BY dateTime DESC");
                        while($top_anime = mysqli_fetch_assoc($query)){
                    ?>
                    <tr>
                        <td><?php echo $count++;?></td>
                        <td><?php echo $top_anime['anime_title'];?></td>
                        <td><?php echo $top_anime['episode_number'];?></td>
                        <td><?php echo $top_anime['views'];?></td>
                        <td><?php echo date('d-m-Y', strtotime($top_anime['dateTime']));?></td>
                    </tr>
                    <?php };?>
                </tbody>
            </table>
        </div>
    </section>
<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/dataTables.min.js"></script>
<script src="assets/js/moment.min.js"></script>
<script>
    $(document).ready(function(){
        $("#top_anime").DataTable();
        $("#top_episode").DataTable();
    })
</script>
</body>
</html>
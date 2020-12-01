<?php
include "connecyion.php";
echo $con;
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Perosnal-USE</title>
        <link href="https://vjs.zencdn.net/7.10.2/video-js.css" rel="stylesheet" />
        <script src="https://vjs.zencdn.net/ie8/1.1.2/videojs-ie8.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    </head>
    <body>
        <h3>Welsome to Perosnal USE</h3>
        <?php
        if(isset($_POST['link'])){
            $url = $con->real_escape_string($_POST['link']);
            $query = "INSERT INTO store (storeurl) VALUES ('".$url."')";
            if($con->query($query)){
        ?>
        <div style="width:100%;height:500px">
            <video class="video-js" controls preload="auto" style="width:100%;height:500px;" data-setup="{}" autoplay>
                <source src="<?=$_POST['link'];?>" type="video/mp4" />
                <source src="<?=$_POST['link'];?>" type="video/webm" />
                <source src="<?=$_POST['link'];?>" type="video/avi" />
                <source src="<?=$_POST['link'];?>" type="video/mkv" />
                <p class="vjs-no-js">
                    To view this video please enable JavaScript, and consider upgrading to a
                    web browser that
                    <a href="https://videojs.com/html5-video-support/" target="_blank">supports HTML5 video</a></p>
            </video>
        </div>
        <?php
        }
        }

        ?><br><br>
        <form method="post" action="index.php">
            <div class="form-group">
                <label for="exampleInputEmail1">Put Link here</label>
                <input type="text" class="form-control" aria-describedby="emailHelp" placeholder="Put Link here" name="link" autocomplete="off">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
        <script src="https://vjs.zencdn.net/7.10.2/video.js"></script>
    </body>
</html>

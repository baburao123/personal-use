<?php
include "connection.php";


if(isset($_POST['url'])){
    $url = $con -> real_escape_string($_POST['url']);
    while(true){
        $r = rand();
        $query = "SELECT * FROM localuse.videostore where name = ".$r;
        $result = $con->query($query);
        if($result->num_rows==0){
            break;
        }
    }

    if(file_put_contents("videos/".$r.".mp4",file_get_contents($url))) { 

        $query = "insert into localuse.videostore (name,url) values ('".$r."','".$url."')";
        if($con->query($query)){
?>
<div class="card">
    <div class="card-img-top">
        <video class="video-js" controls preload="auto" data-setup="{}" style="width:400px;height:225px">
            <source src="videos/<?=$r.".mp4";?>" type="video/mp4" />
            <source src="videos/<?=$r.".webm";?>" type="video/webm" />
            <source src="videos/<?=$r.".avi";?>" type="video/avi" />
            <source src="videos/<?=$r.".mkv";?>" type="video/mkv" />
        </video>
    </div>                    
</div>
<script src="https://vjs.zencdn.net/7.10.2/video.js"></script>
<?php
                               }else echo 1;
    }else echo 1;
}

?>
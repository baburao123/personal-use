<?php
include "connecyion.php";

?>
<!DOCTYPE html>
<html>
    <head>
        <title>Perosnal-USE</title>
        <link href="https://vjs.zencdn.net/7.10.2/video-js.css" rel="stylesheet" />
        <script src="https://vjs.zencdn.net/ie8/1.1.2/videojs-ie8.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    </head>
    <body>
        <h3>Welsome to Perosnal USE</h3>        
        <div class="form-group">
            <label for="exampleInputEmail1">Put Link here</label>
            <input type="text" class="form-control" aria-describedby="emailHelp" placeholder="Put Link here" name="link" autocomplete="off" id="url-here">
        </div>
        <button type="button" id="uploadbtn" class="btn btn-info">Upload</button>
        <br>
        <br>
        <div id="progress-deatils">
        </div>
        <br>
        <br>

        <div class="container" id="all-video-here">
            <?php
            $query = "SELECT * FROM localuse.videostore ORDER BY id DESC";
            $result = $con->query($query);
            if($result){
                while($rows = mysqli_fetch_assoc($result)){
            ?>
            <div class="card">
                <div class="card-img-top">
                    <video class="video-js" controls preload="auto" data-setup="{}" style="width:400px;height:225px">
                        <source src="videos/<?=$rows['name'].".mp4";?>" type="video/mp4" />
                        <source src="videos/<?=$rows['name'].".webm";?>" type="video/webm" />
                        <source src="videos/<?=$rows['name'].".avi";?>" type="video/avi" />
                        <source src="videos/<?=$rows['name'].".mkv";?>" type="video/mkv" />
                    </video>
                </div>                    
            </div>
            <?php
                }
            }
            ?>                
        </div>

        <script src="https://vjs.zencdn.net/7.10.2/video.js"></script>
        <script>
            var pgid = 1;
            $("#uploadbtn").on("click",function(){
                var data = new FormData();
                data.append("url",$("#url-here").val());
                $("#url-here").val("");                
                var pid = document.createElement("div");
                pid.setAttribute("id","progress-bar-to-delete-"+pgid.toString());
                pid.setAttribute("class","progress");
                pid.setAttribute("style","width:700px;margin:0px auto;");
                var pid2 = document.createElement("div");
                pid2.setAttribute("class","progress-bar progress-bar-striped progress-bar-animated");
                pid2.setAttribute("style","width:0%");
                pid2.setAttribute("id","progress-id-"+pgid.toString());
                pid2.append("0%");
                pid.append(pid2);
                $("#progress-deatils").append(pid);
                $.ajax({
                    xhr: function(){
                        var xhr = new window.XMLHttpRequest();
                        xhr.upload.addEventListener("progress",function(evnt){
                            if(evnt.lengthComputable){
                                //console.log(FlagforPublish);
                                var percentComplete = Math.ceil(((evnt.loaded/evnt.total)*100));
                                var percentComplete_ = percentComplete.toString()+"%";
                                console.log(percentComplete);
                                $("#progress-id-"+pgid.toString()).css("width",percentComplete_);
                                $("#progress-id-"+pgid.toString()).html(percentComplete_);
                                if(percentComplete==100){
                                    $("#progress-bar-to-delete-"+pgid.toString()).remove();
                                }
                            }
                        },false);
                        return xhr;
                    },
                    url:"index-acton.php",
                    type:"POST",
                    enctype: 'multipart/form-data',
                    processData: false,
                    contentType: false,
                    cache: false,
                    data:data,
                    success:function(result){
                        console.log(result);
                        if(result==1){
                            alert("something went wrong");
                        }else{
                            $("#all-video-here").prepend(result);
                        }
                    }
                });
            });

        </script>
    </body>
</html>

<?php
if(isset($_POST['user']) && isset($_POST['password'])){
  $server="localhost";
  $username="root";
  $password="";
  $dbname="pulse_rate";
    
    $con=mysqli_connect($server,$username,$password,$dbname);
    if(!$con){
        echo '<h1 style="display:flex;justify-content:center;align-items:center;padding:10% 10px;">Check Your connection! </h1>';
    }
    $email=$_POST['lemail'];
    $password=$_POST['lpassword'];
    $sqlData="SELECT * FROM `login`  WHERE `email`=`$email` AND `password`=`$password`";
    $result=$con->query($sqlData);
    if($result->num_rows >0){
        $my_email=$row['email'];
        echo 'password match';
    }else{
        echo 'password not match';
    }

    $con->close();
}
        ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DJ PUNJAB</title>
    <link rel="stylesheet" href="music.css">
    <style>
        #searchForm{
margin: 10px;
padding: 10px;
width: 60%;
        }
        #search{
width:100%;
padding: 10px;
        }
        .btn{
            position: fixed;
            top: 20px;
            right: 20px;
            padding: 10px;
        }
    </style>
</head>
<body>
    <img src="music_background.png" id="img">
    <form id="searchForm" method="post">
        <input id="search" list="Song" name="search" placeholder="Search Song here">
        <datalist id="Song">
  <option value="Dawood - Sidhu Moose Wala"></option>
  <option value="Hass_Hass"></option>
  <option value="Born_To_Shine_"></option>
  <option value="G_O_A_T_"></option>
  <option value="5_Taara_"></option>
  <option value="Putt_Jatt_Da_"></option>
  <option value="Lalkara"></option>
  <option value="Case"></option>
  <option value="Mulahjedaariyan"></option>
  <option value="OVER AND OVER"></option>
  <option value="Third Eye"></option>
  <option value="Aaye Haaye"></option>
</datalist>
    </form>
    <button name="login_create_account"  class="btn">Premium</button>
    <div class="music-player">
        <h2>DJ PUNJAB</h2>
        <audio id="audio" src="Dawood - Sidhu Moose Wala.mp3" preload="auto"></audio>

        <div class="controls">
            <button id="prev">Previous</button>
            <button id="play">Play</button>
            <button id="pause">Pause</button>
            <button id="next">Next</button>
            <button id="stop">Stop</button>
        </div>
        <div class="volume-control">
            <label for="volume">Volume:</label>
            <input type="range" id="volume" min="0" max="1" step="0.01" value="1">
            <div class="progress-container">
                <input type="range" id="progress" value="0" min="0" max="100">
            </div>
        </div>
        
        <div class="track-info">
            <p id="track-title">Track Title</p>
        </div>
              <br>
    
    <h4>Next : <b id="trackNext"></b> 
    </h4>

        </div>
    </div>
    <script src="admin.js"></script>
</body>
</html>


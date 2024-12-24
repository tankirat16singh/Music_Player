<?php
$choose=0;
if(isset($_POST['login_btn'])){
    $choose=1;
}
if(isset($_POST['create_btn'])){
    $choose=2;
}
$passwd_length=true;
if(isset($_POST['apassword'])&&$_POST['apassword']==""){
    $passwd_length=false;
    $choose=2;
}
else if(isset($_POST['apassword'])&&isset($_POST['apassword'])){
    $password=$_POST['apassword'];
    if(strlen($password) <8){
        $passwd_length =false;
        $choose=2;
    }
}
$passwd_match=true;
if(isset($_POST['cpassword'])&&$_POST['cpassword']==""){
    $passwd_match=false;
    $choose=2;
}
else if(isset($_POST['cpassword'])&&isset($_POST['cpassword'])){
    $cpassword=$_POST['cpassword'];
    if($cpassword!==$password){
        $passwd_match =false;
        $choose=2;
    }
}

$mail=true;

if(isset($_POST['aemail'])){
    $a=$_POST['aemail'];
    if((str_contains($a,"@gmail.com"))||(str_contains($a,"@outlook.com"))){
        $mail=true;
    }else{
        $mail=false;
        $choose =2;
    }
}
$submit=false;
$aemail="";
$apassword="";
$cpassword="";
if(isset($_POST['cpassword'])||isset($_POST['apassword'])||isset($_POST['aemail'])){
if($passwd_length==true && $passwd_match==true && $mail==true &&  $_POST['aemail']!="" && $_POST['apassword']!="" && $_POST['cpassword']!="" ){
    $submit=true;
    }
    if($submit==true){
        $aemail="";
        $apassword="";
        $cpassword="";
    }else{
        $aemail=$_POST['aemail'];
        $apassword=$_POST['apassword'];
        $cpassword=$_POST['cpassword'];
    }
}
$dbsave=false;
if($submit==true){
    $server="localhost";
    $username="root";
    $password="";
    $dbname="pulse_rate";


    $connection=mysqli_connect($server,$username,$password,$dbname);
    if(!$connection){
        echo '<h1 style="display:flex;justify-content:center;align-items:center;padding:10% 10px;">Check Your connection! </h1>';
    }

$pemail=$_POST['aemail'];
$ppassword=$_POST['apassword'];


$sqlData= "INSERT INTO `login` (`email`, `password`,`time`) VALUES ('$pemail','$ppassword',current_timestamp())";

if($connection->query($sqlData)===true){
    $dbsave=true;
}else{
    echo "ERROR :";
}

$connection->close();
if($dbsave==false){
    $choose=2;
}
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login_create_account</title>
    <style>
        *{
            margin: 0;
            padding: 0;
        }
        body{
            display: flex;
            width: 100%;
            height: 100vh;
            justify-content: center;
            align-items: center;
        }
        form{
            display: flex;
            flex-direction: column;
            width: 40%;
            background-color:rgba(255, 255, 255,0.5);
            height: 400px;
            justify-content: center;
            align-items: center;
        }
        label{
            font-size: 25px;
            font-weight: 600;
            margin: 20px;
        }
        .btn{
            width: 50%;
            padding:10px;
            margin: 10px;
            font-size: <?php if($choose==0){ echo '20px';}else{echo '16px';}?>;
            /* font-size: 20px; */
        }
        #img{
            width:100%;
            height:100vh;
            position: fixed;
            z-index:-1;
            filter: blur(1px);
        }
        input{
            width:70%;
            padding: 15px;
            margin: 10px;
        }
        #login_create_account{
display: <?php if($choose==0){ echo 'flex';}else{echo 'none';}?>;
        }
        #login{
display: <?php if($choose==1){ echo 'flex';}else{echo 'none';}?>;
        }
        #create_account{
display: <?php if($choose==2){ echo 'flex';}else{echo 'none';}?>;
        }
    </style>
</head>
<body>
    <img src="login_create_account.png" id="img">

    <form method="post" id="login_create_account">
        <label>Login/Create Account</label>
<button class="btn" name="login_btn">Login</button>
<button class="btn" name="create_btn">Create Account</button>
<?php if($dbsave==true){echo "<h3 style='color:green'>Account Created</h3>";}?>
    </form>

    <form method="post" id="login" action="admin.php">
        <input type="email" name="lemail" placeholder="Email">
        <input type="password" name="lpassword" placeholder="Password">
        <button class="btn">Login</button>
    </form>

    <form method="post" id="create_account">
        <input type="email" name="aemail"  value="<?php echo $aemail; ?>" placeholder="Email">
        <?php if($mail==false){echo "Enter valid mail ";} ?>
        
      <input  id="apassword" type="<?php if(isset($_POST['showPassword'])){echo "text";}else{ echo 'password';} ?>" name="apassword" value="<?php echo $apassword; ?>"  placeholder="Password">
      <button name="showPassword">See Password</button>
        <?php if($passwd_length==false){echo "Enter 8 digit password ";} ?>
        <input type="password" name="cpassword" value="<?php echo $cpassword; ?>"  placeholder="Password again">
        <?php if($passwd_length==true && $passwd_match==false){echo "Enter Same password ";} ?>
        <button class="btn">Create Account</button>
    </form>
        
</body>
</html>
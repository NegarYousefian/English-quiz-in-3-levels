<?php
echo $_COOKIE["level"];
echo $_COOKIE["correctAnswer"];
if($_POST['option'] == "C"){
    setcookie("correctAnswer", $_COOKIE["correctAnswer"] + 1, time()+60*60*24*7);
}

if($_COOKIE["level"] == 0 && $_COOKIE["correctAnswer"] >= 2){
    setcookie("level", $_COOKIE["level"] + 1, time()+60*60*24*7);
    setcookie("correctAnswer", "0", time()+60*60*24*7);
    $con = mysqli_connect("localhost","root","","my_db");
    if (!$con){
        die("Could not connect.");
    }
    $q = mysqli_query($con,"UPDATE user SET level=level+1 WHERE username='$_COOKIE[username]'");
    mysqli_close($con);
}
else if($_COOKIE["level"] == 1 && $_COOKIE["correctAnswer"] >= 3){
    setcookie("level", $_COOKIE["level"] + 1, time()+60*60*24*7);
    setcookie("correctAnswer", "0", time()+60*60*24*7);
    $con = mysqli_connect("localhost","root","","my_db");
    if (!$con){
        die("Could not connect.");
    }
    $q = mysqli_query($con,"UPDATE user SET level=level+1 WHERE username='$_COOKIE[username]'");
    mysqli_close($con);

}
header('Location: welcome.php');
?>
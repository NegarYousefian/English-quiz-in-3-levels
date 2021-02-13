<html>
    <head>
        <title>SignIn</title>
    </head>
<body>

<?php


if(isset($_COOKIE["signedin"]) && $_COOKIE["signedin"]=='1')
	header('Location: welcome.php');

if(isset($_POST['username']) && isset($_POST['password'])){
    $username=$_POST['username']; $password=$_POST['password'];
    $con = mysqli_connect("localhost","root","","my_db");
    if (!$con){
        die("Could not connect.");
    }
    $success = 0;
    $level = "";
    $q = mysqli_query($con,"SELECT * FROM user");
	if(!empty($username) && !empty($password)){
            while($row = mysqli_fetch_array($q)){
                if($username == $row['username'] && $password == $row['password']){
                    $success = 1;
                    $level = $row['level'];
                    break;
                }
            }
            if($success==1){
                $expire=time()+60*60*24*7;
                setcookie("username", $username, $expire);
                setcookie("level", $level, $expire);
                setcookie("correctAnswer", "0", $expire);
                setcookie("signedin", "1", $expire);
                header('Location: welcome.php');
            }
            else{
                echo "Wrong username or password."."<br/>";
            }

    }
	else{
		echo 'You must enter a username and password.';
    }
    
    mysqli_close($con);
}
?>

<form action="signIn.php" method="POST">
<br>Usrename: <input type="text" name="username">
<br>Password: <input type="password"name="password">
<br><input type="submit" value="Sign In">
</form>

</body>
</html>
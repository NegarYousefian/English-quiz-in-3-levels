<html>
    <head>
    <title>Welcome Page</title>
    </head>
<body>

<?php

if(isset($_COOKIE["signedin"]) && $_COOKIE["signedin"] == '1' && isset($_COOKIE["level"]))
{

    if(isset($_POST['option']) && $_POST['option'] == "C"){
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

    echo "<h5>Welcome " . $_COOKIE["username"] . "</h5>";
    if($_COOKIE["level"] == '0')
        $file = fopen("basic.txt","r") or exit("Unable to open the file!");
    else if($_COOKIE["level"] == '1')
        $file = fopen("intermediate.txt","r") or exit("Unable to open the file!");
    else
        $file = fopen("advanced.txt","r") or exit("Unable to open the file!");
    
    echo "<a href='signout.php'>SignOut</a><br/><br/>";
    $senNo = rand(0, 4);
    $sentence = "";
    for($i = 0; $i <= $senNo; $i=$i + 1){
        $sentence = fgets($file);
    }
    $sentence = str_replace(".", "", $sentence);
    $words = explode(" ", $sentence);
    $wordNo = rand(0, sizeof($words) - 1);
    $word = "";
    $word = $words[$wordNo];
    $sentence = str_replace($word, "...", $sentence);
    echo $sentence;
    echo "<form action='welcome.php' method='POST'>".
    "<input name='option' type='radio' value='A'>Inside<br/>".
    "<input name='option' type='radio' value='B'>Outside<br/>".
    "<input name='option' type='radio' value='C'>".$word."<br/>".
    "<input name='option' type='radio' value='D'>Go<br/>".
    "<input type='submit' value='Submit'>".
    "</form>";

    
}
else 
	header('Location: signIn.php');
?>
</body>
</html>
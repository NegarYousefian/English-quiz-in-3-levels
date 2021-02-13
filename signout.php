<html>
<body>

<?php
$expire=time()-3600;
setcookie("username", $_COOKIE["username"], $expire);
setcookie("signedin", "1", $expire);
header('Location: signIn.php');
?>

</body>
</html>
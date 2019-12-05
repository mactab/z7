<?php
setcookie("user", "", time() - 3600);
setcookie("user_n", "", time() - 3600);
$wyloguj="index.php";
header("Location: $wyloguj");
?>
<?php
$ipadd = $_SERVER["REMOTE_ADDR"];
function ip_details($ip) {
$json = file_get_contents ("http://ipinfo.io/{$ip}/geo");
$details = json_decode ($json);
return $details;
}
$details = ip_details($ipadd);
$ip=$details -> ip;
    $dbhost="serwer1926328.home.pl"; $dbuser="31555444_zad7"; $dbpassword="Linfa09!!"; $dbname="31555444_zad7";
    $polaczenie = mysqli_connect($dbhost, $dbuser, $dbpassword, $dbname);
        if (!$polaczenie) {
            echo "Błąd połączenia z MySQL." . PHP_EOL;
            echo "Errno: " . mysqli_connect_errno() . PHP_EOL;
            echo "Error: " . mysqli_connect_error() . PHP_EOL;
            exit;
        }    
        $idk=$_COOKIE['user'];
        if(IsSet($usr)){
      $query ="SELECT * FROM logs_fail WHERE idu=$idk order by datagodzina desc limit 1";
      $result = mysqli_query($polaczenie, $query); 
      $rekord1 = mysqli_fetch_array($result); 
      }
      ?>
<html>
<head>
   <charset="UTF-8"/>
        <title>Tabisz</title>
</head>

<body>
<center>
   
</center>

<?php
$usr=$_COOKIE['user_n'];
if(IsSet($usr)){
    ?>

<p align="center"><a href="wyloguj.php">Wyloguj</a></p>

<?php
 echo "<center>Zalogowany : <b>",$_COOKIE['user_n'],"</b></center>";
 ?>
<p><b><font color="red">
<?php
    if(!empty($rekord1)){
    echo "Niepoprawne logowanie: ",$rekord1['datagodzina']," <hr>";
   
    }
    
 
?>

</font></b></p>
<?php
 echo "Zasoby użytkownika : <b>",$_COOKIE['user_n'],"</b><br>";
 
?>
<?php

$dir= "/7/users/$usr";
$dir3="/7/users/$usr/dir/$files";
$files = scandir($dir);
$arrlength = count($files);
for($x = 2; $x < $arrlength; $x++) {
    
  if (is_file("/7/users/$usr/$files[$x]")){
    echo "<a href='/7/users/$usr/$files[$x]' download='$files[$x]'>$files[$x]</a><br>";
  }else{ 
      echo $files[$x],"<br>";
      $dir2= "/7/users/$usr/$files[$x]";
      $files2 = scandir($dir2);
      $arrlength2 = count($files2);
        for($y = 2; $y < $arrlength2; $y++) {
        
        if (is_file("/7/users/$usr/$files[$x]/$files2[$y]")){
        echo "&#8658<a href='/7/users/$usr/$files[$x]/$files2[$y]' download='$files2[$y]'>$files2[$y]</a>";
        }else{ 
            echo "&#8658",$files2[$y];
        }
            echo "<br>";
            }
   }
  }
    echo "<br>";

?>

<p>Zapis [pamietaj o wybraniu pliku i ewentualnego katalogu]</p>
<form action="odbierz.php" method="POST" ENCTYPE="multipart/form-data">
<?php
if (is_dir($dir)) {
    if ($dh = opendir($dir)) {
        while (($file = readdir($dh)) !== false) {
            if(is_dir("/7/users/$usr/$file") && $file != '.' && $file != '..'){
            echo "<input type=\"radio\" name=\"folder\" value =$file>$file<br>";
            }
        }
        closedir($dh);
    }
}
?>
 <input type="file" name="plik"/>
 <br>
 <br>
 <input type="submit" value="Wyślij plik"/>
 </form>
 



<br>


<form method="POST" action="tworzenie.php">
        Stwórz katalog o nazwie:<input type="text" name="n_kat">
        <input type="submit" value="Stwórz"/>
    </form>
    <?php
}else{
echo "<center>Musisz się zalogować!</center>";}
?>
</body>
</html>
<?php
$ipadd = $_SERVER["REMOTE_ADDR"];
function ip_details($ip) {
$json = file_get_contents ("http://ipinfo.io/{$ip}/geo");
$details = json_decode ($json);
return $details;
}
$details = ip_details($ipadd);
$ip=$details -> ip;
$info = get_browser(null,true);
$przegladarka = $info['browser'];
$system = $info['platform'];
$godzina = date("Y-m-d H:i:s", time());
$user=strtolower($_POST['login']); // login
 $pass=$_POST['haslo']; // hasło
 $link = mysqli_connect("serwer1926328.home.pl", "31555444_zad7","Linfa09!!", "31555444_zad7"); // połączenie z BD
 if(!$link) { echo"Błąd: ". mysqli_connect_errno()." ".mysqli_connect_error(); } //  błędne połączenia z BD
 mysqli_query($link, "SET NAMES 'utf8'"); // ustawienie polskich znaków
 $query ="SELECT * FROM users WHERE login='$user'";
 $result = mysqli_query($link, $query); // pobranie z BD wiersza login
 $rekord = mysqli_fetch_array($result); 
 $idk=$rekord['id'];
 $query ="SELECT * FROM logs_fail WHERE idu='$idk'";
 $result = mysqli_query($link, $query); 
 $rekord1 = mysqli_fetch_array($result); 
 if(!$rekord) //nie ma użytkownika
{
     echo '<center><span style="color:orange">Brak takiego użytkownika!</center>';
                               sleep(5);
                                echo "<script>location.href='logowanie.php';</script>"; 
 }
else
 { // Jeśli  istnieje
 if($rekord['haslo']==$pass )//hasło zgadza się z BD ?
 {  
     $spr=substr($rekord1['proba'], 0, 2);
     $pr=$rekord1['proba'];
     if($spr=="b-"){
            $blockedTime = substr($pr, 2);
            if(time() < $blockedTime){
            echo "<center><font color=\"red\">Trzyktronie podałeś błędne hasło. Musiz odczekać do: ",date("H:i:s d-m-Y ", $blockedTime),"</font></center>";
            sleep(5);
            echo "<script>location.href='logowanie.php';</script>";
            }else{
 if ((!isset($_COOKIE['user'])) || ($_COOKIE['user']!=$rekord['id'])){
            setcookie("user", $rekord['id'], mktime(23,59,59,date("m"),date("d"),date("Y")));
            setcookie("user_n", $rekord['login'], mktime(23,59,59,date("m"),date("d"),date("Y")));
    }
          $query="INSERT INTO logs_ok VALUES (NULL,$idk,'$ip','$godzina')";
          mysqli_query($link, $query);
          $query="UPDATE logs_fail SET proba='0' WHERE idu='$idk'";
          mysqli_query($link, $query);
          $dalej="pliki.php";
          header("Location: $dalej");
 }}else{
      if ((!isset($_COOKIE['user'])) || ($_COOKIE['user']!=$rekord['id'])){
            setcookie("user", $rekord['id'], mktime(23,59,59,date("m"),date("d"),date("Y")));
            setcookie("user_n", $rekord['login'], mktime(23,59,59,date("m"),date("d"),date("Y")));
    }
          $query="INSERT INTO logs_ok VALUES (NULL,$idk,'$ip','$godzina')";
          mysqli_query($link, $query);
          $query="UPDATE logs_fail SET proba='0' WHERE idu='$idk'";
          mysqli_query($link, $query);
          $dalej="pliki.php";
          header("Location: $dalej");
 }}
 else
 {
      $pr=$rekord1['proba'];
     if ($pr=='2'){
              $pr="b-" . strtotime("+1 minutes", time());
              $query="UPDATE logs_fail SET proba='$pr',datagodzina='$godzina' WHERE idu='$idk'";
              mysqli_query($link, $query);
          }
          if(substr($pr, 0, 2) == "b-"){
            $blockedTime = substr($pr, 2);
            if(time() < $blockedTime){
            echo "<center><font color=\"red\">Trzyktronie podałeś błędne hasło. Musiz odczekać do: ",date("H:i:s d-m-Y ", $blockedTime),"</font></center>";
            }else{
                $query="UPDATE logs_fail SET proba='1',datagodzina='$godzina' WHERE idu='$idk'";
                mysqli_query($link, $query);
                 echo '<center><span style="color:red">Niepoprawne haslo!</center>';
                               sleep(5);
                                echo "<script>location.href='logowanie.php';</script>";
            }}else{  
            if (IsSet($rekord1)){
                $pr=$rekord1['proba']+1;
                $query="UPDATE logs_fail SET proba='$pr',datagodzina='$godzina' WHERE idu='$idk'";
                mysqli_query($link, $query);
                echo '<center><span style="color:red">Niepoprawne haslo!</center>';
                               sleep(5);
                                echo "<script>location.href='logowanie.php';</script>";
            }else{
         $pr=$rekord1['proba']+1;
          $query="INSERT INTO logs_fail VALUES (NULL,$idk,'$ip','$godzina','$pr')";
          mysqli_query($link, $query);
        echo '<center><span style="color:red">Niepoprawne haslo!</center>';
                               sleep(5);
                                echo "<script>location.href='logowanie.php';</script>";
            }
            }
 mysqli_close($link);
 echo $rekord['idk'];

 }
}
?>

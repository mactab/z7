<html>
<head>
               <charset="UTF-8"/>
        <title>Tabisz</title>
    </head>

<body>


<p align="center"><a href="logowanie.php">Zaloguj się</a></p>

<center>

     <form method='POST' >
            <br>
            <b>Prosimy o wypełnienie pól:</b><br>
            <br>
                      Nick:<br>
                      <input type='text' name='nick'><br>
                        Hasło:<br>
                        <input type='password'' name='password2'' maxlength='16'size='10'><br>
                        Powtórz hasło:<br>
                        <input type='password'' name='password3'' maxlength='16'size='10'><br>
            <input type='submit' value='Wyślij'/>
            </form>
            <br>



</center>
<?php
    $dbhost="serwer1926328.home.pl"; $dbuser="31555444_zad7"; $dbpassword="Linfa09!!"; $dbname="31555444_zad7";
    $polaczenie = mysqli_connect($dbhost, $dbuser, $dbpassword, $dbname);
        if (!$polaczenie) {
            echo "Błąd połączenia z MySQL." . PHP_EOL;
            echo "Errno: " . mysqli_connect_errno() . PHP_EOL;
            echo "Error: " . mysqli_connect_error() . PHP_EOL;
            exit;
        }    
if (IsSet($_POST['nick'])) {
    if($_POST['password2'] == $_POST['password3']){
    $n=$_POST['nick'];
    $h=$_POST['password2'];
    $dodaj="INSERT INTO users VALUES (NULL,'$n', '$h')";
    mysqli_query($polaczenie, $dodaj);
    mysqli_close($polaczenie);
    mkdir ("users/$n", 0777);
    echo '<center><span style="color:orange">Poprawnie dodano użytkownika!</center>';
                               sleep(5);
                     echo        "<script>location.href='logowanie.php';</script>";    
  
    }else {
         echo '<center><span style="color:red">Nieprawidłowe hasla!</center>';
                               sleep(5);
                            echo     "<script>location.href='rejestracja.php';</script>";  
        }
        
}
?>

</body>
</html>
</html>





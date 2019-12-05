<?php
$usr=$_COOKIE['user_n'];
$sciez=$_POST['folder'];
if (is_uploaded_file($_FILES['plik']['tmp_name']))
{
    if(IsSet($sciez)){
        move_uploaded_file($_FILES['plik']['tmp_name'],$_SERVER['DOCUMENT_ROOT']."7/users/$usr/$sciez/".$_FILES['plik']['name']);
    }else{
     move_uploaded_file($_FILES['plik']['tmp_name'],$_SERVER['DOCUMENT_ROOT']."7/users/$usr/".$_FILES['plik']['name']);
    }
}
$dalej="pliki.php";
header("Location: $dalej");
?>
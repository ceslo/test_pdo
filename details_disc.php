<?php
try{
    $db = new PDO('mysql:host=localhost;charset=utf8;dbname=record','admin','Afpa1234');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);}
  
catch (Exception $e){
    echo "Erreur: ".$e->getMessage() . "<br>";
    echo "N° : " .$e->getCode();
    die("Fin du script");
 }

 $requete= $db-> prepare("SELECT * FROM disc WHERE disc_id=?");
 $requete-> execute(array($_GET["disc_id"]));
 $disc= $requete-> fetch(PDO::FETCH_OBJ);
?>
<!DOCTYPE html>
<html lang="en"> 
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<html>
<head>
    <meta charset="UTF-8">
    <title>Test PDO</title> 
</head>
<body>
    Disc N°<? = $disc-> disc_id ?>
    Disc name <?= $disc->disc_title ?>
    Disc year <?= $disc->disc_year ?>
</body>
</html> 
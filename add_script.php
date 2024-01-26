<?php

try{
    $db = new PDO('mysql:host=localhost;charset=utf8;dbname=record','admin','Afpa1234');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);}
  
catch (PDOException $e){
    echo "Erreur: ".$e->getMessage() . "<br>";
    echo "N° : " .$e->getCode();
    die("Fin du script");};


$title= $_POST['title'];
$year= $_POST['year'];
$picture= $_POST['picture'];
$label=$_POST['label'];
$genre=$_POST['genre'];
$price=$_POST['price'];
$artist=$_POST['artist'];

$new_vinyle = $db-> prepare(
"INSERT INTO disc (disc_title, disc_year, disc_picture, disc_label, disc_genre, disc_price, artist_id)
VALUES(:title,:year,:picture,:label,:genre,:price,:artist)");
$new_vinyle ->bindParam(':title',$title);
$new_vinyle ->bindParam(':year',$year);
$new_vinyle ->bindParam(':picture',$picture);
$new_vinyle ->bindParam(':label',$label);
$new_vinyle ->bindParam(':genre',$genre);
$new_vinyle ->bindParam(':price',$price);
$new_vinyle ->bindParam(':artist',$artist);

$new_vinyle-> execute();

header("location: index.php");
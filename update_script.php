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
$id= $_GET['id'];

$modif_vinyle= $db-> prepare("UPDATE disc SET disc_title= :title, disc_year= :year, disc_picture= :picture, disc_label= :label, disc_genre= :genre, disc_price= :price, artist_id= :artist) WHERE disc_id=:id");

$modif_vinyle ->bindParam(':title',$title);
$modif_vinyle ->bindParam(':year',$year);
$modif_vinyle ->bindParam(':picture',$picture);
$modif_vinyle ->bindParam(':label',$label);
$modif_vinyle ->bindParam(':genre',$genre);
$modif_vinyle ->bindParam(':price',$price);
$modif_vinyle ->bindParam(':artist',$artist);

$modif_vinyle-> execute();

header("location: index.php");

?>
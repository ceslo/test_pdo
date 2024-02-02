<?php
try{
    $db = new PDO('mysql:host=localhost;charset=utf8;dbname=record','admin','Afpa1234');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);}  
catch (PDOException $e){
    echo "Erreur: ".$e->getMessage() . "<br>";
    echo "N° : " .$e->getCode();
    die("Fin du script");}

$id = $_POST['id'];    
$query = "DELETE FROM disc WHERE disc_id=:id";
$delete_vinyle = $db->prepare($query);
$delete_vinyle-> bindParam(':id',$id);
$delete_vinyle->execute();

header("location: index.php");
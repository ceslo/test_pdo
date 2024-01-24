<?php
try{
    $db = new PDO('mysql:host=localhost;charset=utf8;dbname=record','admin','Afpa1234');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);}
  
catch (PDOException $e){
    echo "Erreur: ".$e->getMessage() . "<br>";
    echo "N° : " .$e->getCode();
    die("Fin du script");};
// $disc= $db-> prepare("SELECT * FROM disc JOIN artist on disc.artist_id = artist.artist_id");
// $disc-> execute();
// $result= $disc-> fetchAll();

function getDetailsById($id,$db)
{
$details = $db-> prepare('SELECT * FROM disc JOIN artist ON disc.artist_id = artist.artist_id WHERE disc_id = :disc_id');
$details-> bindParam(':disc_id',$id, PDO::PARAM_INT);
$details-> execute();
$detailById = $details-> fetch();
return $detailById;
};
?>

<!DOCTYPE html>
<html lang="en"> 
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
    <?php 
    $detailById = getDetailsById($_GET["id"],$db);
       echo'
<h1> Details <h1>
<form action="#" method="get">
<label for="title">Title</label>
<input type="text" name="title" placeholder="'.$detailById["disc_title"].'"/>
<label for="artist">Artist</label>
<input type="text" name="artist" placeholder="'.$detailById["artist_name"].'"/>
<label for="year">Year</label>
<input type="text" name="year" placeholder="'.$detailById["disc_year"].'"/>
<label for="genre">Genre</label>
<input type="text" name="genre" placeholder="'.$detailById["disc_genre"].'"/>
<label for="label">Label</label>
<input type="text" name="label" placeholder="'.$detailById["disc_label"].'"/>
<label for="price">Price</label>
<input type="text" name="price" placeholder="'.$detailById["disc_price"].'"/>
</form>
<img src="" alt="">';
       ?>
       
</body>
</html>
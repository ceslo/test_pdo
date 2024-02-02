<?php
try{
    $db = new PDO('mysql:host=localhost;charset=utf8;dbname=record','admin','Afpa1234');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);}
  
catch (PDOException $e){
    echo "Erreur: ".$e->getMessage() . "<br>";
    echo "N° : " .$e->getCode();
    die("Fin du script");};

// var_dump($_FILES);
function uploaded_files_verif(){
    if ($_FILES["picture"]["error"]>0)
    {
        $code= $_FILES["picture"]["error"];
        switch($code)
        {
            case 1:
                echo "La taille de l'image ne doit pas exceder 2Mo.";
            case 2:
                echo "La taille de l'image ne doit pas exceder 2Mo.";
            case 3:
                echo "L'image n'a pas pu être telechargée entièrement.";
            case 4:
                echo "Aucune image n'a été telechargée.";
            case 6: 
                echo "Le dossier temporaire est manquant.";
            case 7: 
                echo "Echec de l'ecriture de l'image sur le disque.";
            case 8:
                echo "PHP ne permet pas l'envoi de cette image.";
        };
    }
    $aMimeTypes= array("image/gif","image/jpeg", "image/png");
    $picture_type=$_FILES["picture"]["type"];
    
    if(in_array($picture_type, $aMimeTypes))
    {
        $new_path="pictures/".$_FILES['picture']['name'];
        move_uploaded_file($_FILES["picture"]["tmp_name"], $new_path);
    }
    else {
    echo "Type d'image non autorisé";
    };
    };
    
uploaded_files_verif();


$title= $_POST['title'];
$year= $_POST['year'];
$picture= $_FILES['picture']['name'];
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

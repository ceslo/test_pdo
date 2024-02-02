<?php
try{
    $db = new PDO('mysql:host=localhost;charset=utf8;dbname=record','admin','Afpa1234');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);}
  
catch (PDOException $e){
    echo "Erreur: ".$e->getMessage() . "<br>";
    echo "N° : " .$e->getCode();
    die("Fin du script");};

function uploaded_files_verif($db){
   $id= $_POST['id'];
   $query= "SELECT disc_picture FROM disc WHERE disc_id= $id";    
   $keep_same_picture= $db-> prepare($query);
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
                    // echo "Aucune image n'a été telechargée.";
                    $keep_same_picture-> execute();
                    $tab_picture=$keep_same_picture-> fetch();
                    // var_dump($tab_picture);
                     return $picture= $tab_picture['disc_picture'] ;
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
            return $picture= $_FILES['picture']['name'];
        }
        else {
        echo "Type d'image non autorisé";
        };
        };
        
$picture= uploaded_files_verif($db);
var_dump($picture);

$title= $_POST['title'];
$year= $_POST['year'];
$updated_picture= $picture;
$label=$_POST['label'];
$genre=$_POST['genre'];
$price=$_POST['price'];
$artist=$_POST['artist'];
$id= $_POST['id'];

$modif_vinyle= $db-> prepare("UPDATE disc SET disc_title= :title, disc_year= :year, , disc_picture= :picture, disc_label= :labels, disc_genre= :genre, disc_price= :price, artist_id=:artist) WHERE disc_id=:id");

$modif_vinyle ->bindParam(':title',$title);
$modif_vinyle ->bindParam(':years',$year);
$modif_vinyle ->bindParam(':picture', $updated_picture);
$modif_vinyle ->bindParam(':label',$label);
$modif_vinyle ->bindParam(':genre',$genre);
$modif_vinyle ->bindParam(':price',$price);
$modif_vinyle ->bindParam(':artist',$artist);


$modif_vinyle-> execute();

// header("location: index.php");

?>
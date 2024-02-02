<?php
try{
    $db = new PDO('mysql:host=localhost;charset=utf8;dbname=record','admin','Afpa1234');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);}
  
catch (PDOException $e){
    echo "Erreur: ".$e->getMessage() . "<br>";
    echo "N° : " .$e->getCode();
    die("Fin du script");};

    function getDetailsById($id,$db)
{
$details = $db-> prepare('SELECT * FROM disc JOIN artist ON disc.artist_id = artist.artist_id WHERE disc_id = :disc_id');
$details-> bindParam(':disc_id',$id, PDO::PARAM_INT);
$details-> execute();
$detailById = $details-> fetch();
return $detailById;
};

$result= $db-> prepare("SELECT * from artist");
$result-> execute();
$artists= $result-> fetchAll();
// var_dump($artists);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
      crossorigin="anonymous"
    />
    <title>Modifier un vinyle</title>
</head>
<body>
<h1> Modifier un vinyle </h1>
<?php 
$detailById = getDetailsById($_GET["id"],$db)?>

<form action="update_script.php?id=<?=$_GET["id"]?>" method="POST" enctype="multipart/form-data">
<input type="hidden" name="id" value="<?=$_GET["id"]?>"/>
   <div class="row row-cols-auto">
        <div clas="col">
            <label for="title" class="form-label">Title</label>
                <input class="form-control border" type="text" name="title" value="<?=$detailById["disc_title"]?>" placeholder="<?=$detailById["disc_title"]?>"/>
            <label for="artist" class="form-label">Artist</label>
                <select class="form-select" name="artist">
                 <?php foreach($artists as $artist)
                {
                     echo'<option value='.$artist["artist_id"].'>'
                     .$artist["artist_name"].
                    '</option>';
                 }?>
                </select>
            <label for="year" class="form-label">Year</label>
                <input class="form-control" type="text" name="year" value="<?=$detailById["disc_year"]?>" placeholder="<?=$detailById["disc_year"]?>"/>
        </div>
        <div class="col">
            <label for="genre" class="form-label">Genre</label>
                <input class="form-control" type="text" name="genre" value="<?=$detailById["disc_genre"]?>" placeholder="<?=$detailById["disc_genre"]?>"/>
            <label for="label" class="form-label">Label</label>
                <input class="form-control" type="text" name="label" value="<?=$detailById["disc_label"]?>" placeholder="<?=$detailById["disc_label"]?>"/>
            <label for="price" class="form-label">Price</label>
                <input class="form-control" type="text" name="price" value="<?=$detailById["disc_price"]?>" placeholder="<?=$detailById["disc_price"]?>"/>
        </div>
    </div>
            <label for="picture" class="form-label">Image</label>
                <input type="file" class="file-input" name="picture"/>
        <div class="col">
          <button type= "submit" class="btn btn-danger">Modifier</button>
          <a class="btn btn-primary" href="index.php"> Retour</a>
        </div>;
</form>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
      crossorigin="anonymous">
    </script>
</body>
</html>
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
<?php $detailById = getDetailsById($_GET["id"],$db);
echo '<form action="update_script.php?id='.$_GET["id"].'" method="POST">
   <div class="row row-cols-auto">
          <div clas="col">
            <label for="title" class="form-label">Title</label>
                <input class="form-control border" type="text" name="title" placeholder="'.$detailById["disc_title"].'"/>
            <label for="artist" class="form-label">Artist</label>
                <input class="form-control" type="text" name="artist" placeholder="'.$detailById["artist_name"].'"/>
            <label for="year" class="form-label">Year</label>
                <input class="form-control" type="text" name="year" placeholder="'.$detailById["disc_year"].'"/>
          </div>
          <div class="col">
            <label for="genre" class="form-label">Genre</label>
                <input class="form-control" type="text" name="genre" placeholder="'.$detailById["disc_genre"].'"/>
            <label for="label" class="form-label">Label</label>
                <input class="form-control" type="text" name="label" placeholder="'.$detailById["disc_label"].'"/>
            <label for="price" class="form-label">Price</label>
                <input class="form-control" type="text" name="price" placeholder="'.$detailById["disc_price"].'"/>
          </div>
      </div>
      <img  class="img-thumbnail" style="max-width: 300px" src="pictures/'.$detailById["disc_picture"].'" alt="">
      <div class="col">
          <button type= "submit" class="btn btn-danger">Modifier</button>
          <a class="btn btn-primary" href="index.php"> Retour</a>
      </div>;
  </form>'
          ?>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
      crossorigin="anonymous"
    ></script>
</body>
</html>
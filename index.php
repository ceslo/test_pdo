<?php
try{
  $db = new PDO('mysql:host=localhost;charset=utf8;dbname=record','admin','Afpa1234');
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);}

catch (Exception $e){
  echo "Erreur: ".$e->getMessage() . "<br>";
  echo "N° : " .$e->getCode();
  die("Fin du script");
}
$disc= $db-> prepare("SELECT * FROM disc JOIN artist on disc.artist_id = artist.artist_id");
$disc-> execute();
$result= $disc-> fetchAll();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
      crossorigin="anonymous"
    />
    <title>Index Record</title>
    </head>
<body>
 <h1>Liste des disques</h1>
<br>
<div id="zone1" class="row row-cols-3">        
      <!-- // var_dump($album)  -->
  <?php foreach ($result as $album) { ?>
  <div class ="card mb-3">-
    <div class="row"> 
      <div class="col">
          <img style="max-width: 250px;" src="pictures/<?= $album["disc_picture"] ?>"> 
      </div>
      <div class="col">
        <div class="card-body">
          <div class="card-title fw-bold fs-4" >'<?= $album["disc_title"] ?>'
          </div>
          <div class="card-text text-start"> 
          <?= $album["artist_name"]?>
          <br>
          Label: <?= $album["disc_label"] ?>
          <br> 
          Year: <?= $album["disc_year"] ?>
          <br>
          Genre: <?= $album["disc_genre"] ?>
          </div>
          <br>
          <div>
          <a href="details.php?id=<?= $album["disc_id"]?>" class="btn btn-primary">Détails</a>
          </div>
        </div>
      </div>       
    </div> 
  </div>
  <?php } ?>
</div>
<a href="add_form.php" class="btn btn-primary mb-5" c>Ajouter</a>
<script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
      crossorigin="anonymous"
    ></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</body>
</html>
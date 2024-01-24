<?php
require_once 'header.php';
include 'db.php';
$disc= $db-> prepare("SELECT * FROM disc JOIN artist on disc.artist_id = artist.artist_id");
$disc-> execute();
$result= $disc-> fetchAll();
?>

 <h1>Liste des disques</h1>
<br>
      <div id="zone1" class="row row-cols-3">        
      // var_dump($album) 
  <?php foreach ($result as $album) { ?>
<div class ="card mb-3">

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
        <?php } ?>
    </div> 
  
</div>
        </div>
<script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
      crossorigin="anonymous"
    ></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</body>
</html>
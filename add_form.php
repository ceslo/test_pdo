<?php
try{
    $db = new PDO('mysql:host=localhost;charset=utf8;dbname=record','admin','Afpa1234');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);}
  
catch (PDOException $e){
    echo "Erreur: ".$e->getMessage() . "<br>";
    echo "N° : " .$e->getCode();
    die("Fin du script");};


$result= $db-> prepare("SELECT * from artist");
$result-> execute();
$artists= $result-> fetchAll();
// var_dump($artists)

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
    <title>Formulaire d'ajout</title>
</head>
<body>

<H1 class="mb-3">Ajouter un vinyle </H1>

<form action="add_script.php" method="post">
        <div class="row row-cols-auto">
            <div clas="col">
            <label for="title" class="form-label" >Title</label>
                <input class="form-control border" type="text" name="title" placeholder="Enter title">
            <label for="artist" class="form-label">Artist</label>
                <select class="form-select" name="artist">
                   <?php foreach($artists as $artist) 
                   {
                    echo'<option value='.$artist["artist_id"].'>'
                    .$artist["artist_name"].
                    '</option>';
                    }?>
            <label for="year" class="form-label">Year</label>
                <input class="form-control" type="text" name="year" placeholder="Enter year">
            </div>
            <div class="col">
                <label for="genre" class="form-label">Genre</label>
                <input class=" form form-control" type="text" name="genre" placeholder="Enter genre">
            <label for="label" class="form-label">Label</label>
                <input class="form-control" type="text" name="label" placeholder="Enter label">
            <label for="price" class="form-label">Price</label>
                <input class="form-control" type="text" name="price">
            </div>
        </div>
        <div class="col ">
        <label for="picture" class="form-label">Picture</label>
            <input class="file-input" name="picture" type="file"></input>
        </div>
        <button class="btn btn-primary m-2" type="submit">Ajouter</button>
        <a class="btn btn-primary m-2" href="index.php">Retour</a>
</form>

    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
      crossorigin="anonymous"
    ></script>
</body>
</html>
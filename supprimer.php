<?php 
if (isset($_POST['supprimer'])) {
    $pdo = new PDO('mysql:host=localhost;dbname=movies',"root","");
    $id = $_POST['id'];
    $sqlstate = $pdo->prepare("DELETE FROM movie WHERE id_movie=? ");
    $sqlstate->execute([$id]);
    header("location:main.php");


}
?>
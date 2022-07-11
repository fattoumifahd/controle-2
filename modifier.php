<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/connexion.css">
    <title>UPDATE</title>
</head>
<body>
    <?php 
    if (!isset($_POST['id'])) {
        header("location: main.php");
    }
        $id = $_POST['id'];
        $pdo = new PDO("mysql:host=localhost;dbname=movies","root","");
        $sqlstate = $pdo->prepare("SELECT * FROM movie WHERE id_movie=? ");
        $sqlstate->execute([$id]);
        $movie = $sqlstate->fetch(PDO::FETCH_ASSOC);
        if (isset($_POST['update'])) {
            $title = $_POST['title'];
            $term = $_POST['term'];
            $date = $_POST['date'];
            if (!empty($title) && !empty($title) && !empty($title)) {
                if (!empty($_FILES['picture']['name'])) {
                    $picture_tmp = $_FILES['picture']['tmp_name'];
                    $picture_name = $_FILES['picture']['name'];
                    move_uploaded_file($picture_tmp,'C:\xampp\htdocs\index\controle2\upload\\'.$picture_name);
                    $sqlstate = $pdo->prepare("UPDATE movie SET title=?, dure=? , date_de_pibler=? , picture=? WHERE id_movie=?");
                    $sqlstate->execute([$title,$term,$date,$picture_name,$id]);
                } else {
                    $sqlstate = $pdo->prepare("UPDATE movie SET title=? , dure=? , date_de_pibler=? WHERE id_movie=? ");
                    $sqlstate->execute([$title,$term,$date,$id]);
                }
                header("location:main.php");
            }
        }
    ?>

    <div class="container">
        <form method="post" enctype="multipart/form-data">
            <input type="hidden" name="id"  value="<?php echo $movie['id_movie'] ?>">
            <input type="text" name="title" value="<?php echo $movie['title'] ?>" placeholder="Title"><br>
            <input type="number" name="term" value="<?php echo $movie['dure']?>" placeholder="Term"><br>
            <input type="date" name="date" value="<?php echo $movie['date_de_pibler']?>"><br>
            <input type="file" name="picture"  ><br><br>
            <input type="submit" value="MODIFIER" name="update">
        </form>
    </div>
</body>
</html>
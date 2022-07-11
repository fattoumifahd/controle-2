<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/connexion.css">
    <title>Know lege Of MOvies</title>
</head>
<body>

    <?php 
    if (isset($_POST['ajouter'])) {
        $title = $_POST['title'];
        $dure = $_POST['dure'];
        $date = $_POST['date'];
        if (!empty($title) && !empty($dure) && !empty($date)) {
            $picture_tmp = $_FILES['picture']['tmp_name'];
            $picture_name = $_FILES['picture']['name'];
            $picture_type = $_FILES['picture']['type'];
            $picture_size = $_FILES['picture']['size'];
            $pdo = new PDO("mysql:host=localhost;dbname=movies","root","");
            $sqlstqte = $pdo->prepare("INSERT INTO movie VALUES(NULL,?,?,?,?)");
            $sqlstqte->execute([$title,$dure,$date,$picture_name]);
            move_uploaded_file($picture_tmp,'C:\xampp\htdocs\index\controle2\upload\\'.$picture_name);
            header("location:main.php");
            
        } else {
            ?>
            <div class="error">
                <p><b>NOTICE :</b> Touts Les Champs Sont Requis.</p>
            </div>
            <?php
            echo "";
        }
    }
    ?>
<div class="container">
    <form method="post" enctype="multipart/form-data">
        <input type="text" name="title" placeholder="Title"><br>
        <input type="number" placeholder="Term" name="dure"><br>
        <input type="date" name="date"><br>
        <input type="file" name="picture"><br><br>
        <input type="submit" value="Ajouter" name="ajouter">
    </form>
</div>
</body>
</html>
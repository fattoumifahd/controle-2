<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/qq.css">
    <title>Document</title>
    <style>
        
    </style>
</head>
<body>
    <?php include_once "include/nav.php" ?>
    <div class="form"id="div1" >
        <form method="get" id="search1">
            <input type="text" class='searche' name="searche_bar" placeholder="REARCHE">
            <input type="submit"  value="Searche" name="searche">
        </form>
    </div>
    <?php    
    // session_start();
    if (empty($_SESSION['user'])) {
        header("location: connexion.php");
    }
    if (isset($_GET['searche'])) {
        $serache = $_GET['searche_bar'];
        $pdo = new PDO("mysql:host=localhost;dbname=movies","root","");
        $sqlstate = $pdo->prepare("SELECT * FROM movie WHERE title like ? ");
        $sqlstate->execute([$serache]);
        if ($sqlstate->rowCount() >= 1) {
            $results = $sqlstate->fetchAll(PDO::FETCH_ASSOC);
            ?>
            <table>
                <thead>
                    <tr>
                        <th>ID Movie</th>
                        <th>Title</th>
                        <th>Term</th>
                        <th>Date Of Publication</th>
                        <th>Picture</th>
                        <th>Options</tr>
                    </tr>
                </thead>
            <tbody>
                <?php 
                foreach ($results as $result) {
                    ?>
                    <tr>
                        <td><?php echo $result['id_movie']?></td>
                        <td><?php echo $result['title']?></td>
                        <td><?php echo $result['dure']?> MIN</td>
                        <td><?php echo $result['date_de_pibler']?></td>
                        <td><a href="upload/<?php echo $result['picture']?>" target="_blank"><img src="upload/<?php echo $result['picture'] ?>" alt=""></a></td>
                        <td>
                            <form class="option" method="post">
                                <input type="hidden" name="id" value="<?php echo $result['id_movie']?>">
                                <input formaction="modifier.php" class="btn btn-modifier" type="submit" value="MODIFIER" name="modifier">
                                <input formaction="supprimer.php" class="btn btn-supprimer" type="submit" value="SUPPRIMER" name="supprimer" onclick="return confirm('Voulez vous vraimernt supprimer <?php echo $result['title']?>')">
                            </form>
                        </td>
                        
                    </tr>
                    <?php
                } 
                ?>
            </tbody>
            <?php
        } else {
            ?>
                <div class="error">
                        <p><b>NOTICE :</b> NO RESULT.</p>
                    </div>
                <div class="form">
                    <form method="get">
                        <input type="text" class='searche' name="searche_bar" placeholder="REARCHE">
                        <input type="submit"  value="Searche" name="searche">
                    </form>
                </div>
                <script>
                    let searche1 = document.getElementById("search1");
                    let div1 = document.getElementById("div1");
                    searche1.style.display= "none"
                    div1.style.display= "none"
                </script>
            <?php 
            $pdo = new PDO("mysql:host=localhost;dbname=movies","root","");
            $sqlstate = $pdo->prepare("SELECT * FROM movie");
            $sqlstate->execute();
            $movies = $sqlstate->fetchAll(PDO::FETCH_ASSOC);
            ?>
            
            <table>
                <thead>
                    <tr>
                        <th>ID Movie</th>
                        <th>Title</th>
                        <th>Term</th>
                        <th>Date Of Publication</th>
                        <th>Picture</th>
                        <th>Options</tr>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    foreach ($movies as $movie) {
                        ?>
                        <tr>
                            <td><?php echo $movie['id_movie']?></td>
                            <td><?php echo $movie['title']?></td>
                            <td><?php echo $movie['dure']?> MIN</td>
                            <td><?php echo $movie['date_de_pibler']?></td>
                            <td><a href="upload/<?php echo $movie['picture']?>" target="_blank"><img src="upload/<?php echo $movie['picture'] ?>" alt=""></a></td>
                            <td>
                                <form class="option" method="post">
                                    <input type="hidden" name="id" value="<?php echo $movie['id_movie']?>">
                                    <input formaction="modifier.php" class="btn btn-modifier" type="submit" value="MODIFIER" name="modifier">
                                    <input formaction="supprimer.php" class="btn btn-supprimer" type="submit" value="SUPPRIMER" name="supprimer" onclick="return confirm('Voulez vous vraimernt supprimer <?php echo $movie['title']?>')">
                                </form>
                            </td>
                            
                        </tr>
                        <?php 
                    }
        }
    } else {
        $pdo = new PDO("mysql:host=localhost;dbname=movies","root","");
        $sqlstate = $pdo->prepare("SELECT * FROM movie");
        $sqlstate->execute();
        $movies = $sqlstate->fetchAll(PDO::FETCH_ASSOC);
        ?>
        
        <table>
            <thead>
                <tr>
                    <th>ID Movie</th>
                    <th>Title</th>
                    <th>Term</th>
                    <th>Date Of Publication</th>
                    <th>Picture</th>
                    <th>Options</tr>
                </tr>
            </thead>
            <tbody>
                <?php 
                foreach ($movies as $movie) {
                    ?>
                    <tr>
                        <td><?php echo $movie['id_movie']?></td>
                        <td><?php echo $movie['title']?></td>
                        <td><?php echo $movie['dure']?> MIN</td>
                        <td><?php echo $movie['date_de_pibler']?></td>
                        <td><a href="upload/<?php echo $movie['picture']?>" target="_blank"><img src="upload/<?php echo $movie['picture'] ?>" alt=""></a></td>
                        <td>
                            <form class="option" method="post">
                                <input type="hidden" name="id" value="<?php echo $movie['id_movie']?>">
                                <input formaction="modifier.php" class="btn btn-modifier" type="submit" value="MODIFIER" name="modifier">
                                <input formaction="supprimer.php" class="btn btn-supprimer" type="submit" value="SUPPRIMER" name="supprimer" onclick="return confirm('Voulez vous vraimernt supprimer <?php echo $movie['title']?>')">
                            </form>
                        </td>
                        
                    </tr>
                    <?php
                }
                
    }
    ?>
    </tbody>
</table>
</body>
</html>
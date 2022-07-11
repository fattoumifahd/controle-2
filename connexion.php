<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/connexion.css">
    <title>LOGIN</title>
</head>
<body>

    <?php 
    include_once 'include/nav.php' ;
        if(isset($_POST['signin'])) {
            header('location:signin.php');
        } 
        if (isset($_POST['connexion'])) {
            $user_name = $_POST['login'];
            $password = $_POST['password'];
            if (!empty($user_name) && !empty($password)) {
                $pdo = new PDO("mysql:host=localhost;dbname=movies","root","");
                $sqlstate = $pdo->prepare("SELECT * FROM users WHERE user_name=? AND password=?");
                $sqlstate->execute([$user_name,$password]);
                $_SESSION['user'] = $sqlstate->fetch(PDO::FETCH_ASSOC);
                if($sqlstate->rowCount() >= 1){
                    // session_start();
                    header('location:main.php');
                } else {
                    echo "User Name Or Password Incorect";
                }
            } else {
                ?>
                    <div class="error">
                        <p><b>NOTICE :</b> This User Name is Realy Exist.</p>
                    </div>
                <?php
            }
        }
    ?>
    <div class="container">
        <h3>LOG IN</h3>
            <form method="post">
                <input type="text" name="login" placeholder="User Name"><br>
                <input type="password" name="password" placeholder="Password"><br>
                <input type="submit" value="connexion" class="btn btn-connexion" name="connexion">
            </form>
        </div>
    </div>
    <?php include_once "include/footer.php"?>
</body>
</html>
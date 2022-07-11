<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/signin.css">
    <title>SIGN IN</title>
</head>
<body>
    <?php 
        if (isset($_POST['signin'])) {
            $user_name = $_POST['login'];
            $password1 = $_POST['password1'];
            $password2 = $_POST['password2'];
            if (!empty($user_name)&& !empty($password1)&& !empty($password2)) {
                if ($password1 == $password2) {
                    $pdo = new PDO("mysql:host=localhost;dbname=movies","root","");
                    $sqlstate =  $pdo->prepare("SELECT * FROM users WHERE user_name=?");
                    $sqlstate->execute([$user_name]);
                    if ($sqlstate->rowCount() >= 1) {
                        ?>
                        <div class="error">
                            <p><b>NOTICE :</b> This User Name is Realy Exist.</p>
                        </div>
                        <?php
                    } else {
                        $sqlstate = $pdo->prepare("INSERT INTO users VALUES(NULL,?,?)");
                        $sqlstate->execute([$user_name,$password1]);
                        header('location: connexion.php');
                    }
                } else {    
                    ?>
                        <div class="error">
                            <p><b>NOTICE :</b> The Second Password Is Incroect.</p>
                        </div>
                        <?php
                }
            } else {
                ?>
                        <div class="error">
                            <p><b>NOTICE :</b> Mandatory fildes.</p>
                        </div>
                        <?php
            }
        }
    ?>
    <div class="container">
        <h2>SING IN</h2>
        <form method="post">
            <input type="text" name="login" placeholder="User Name"><br>
            <input type="password" name="password1" class="pass1" placeholder="Password"><br>
            <input type="password" name="password2" class="pass2" placeholder="Confirmation Of PASSWORD">
            <span class="eye">
                <i class="fas fa-eye"></i>
                <i class="fa fa-eye-slash" style="display:none;"></i>
            </span>
            <br><br>
            <input type="submit" value="SIGN IN" name="signin">
        </form>
    </div>
    <script>
        let eyeS = document.querySelector('.fas');
        let eyeN = document.querySelector('.fa');
        let pass1 = document.querySelector(".pass1")
        let pass2 = document.querySelector(".pass2")
        eyeS.addEventListener("click",function() {
            eyeS.style.display = "none"
            eyeN.style.display = "contents"
            pass1.setAttribute("type", "text")
            pass2.setAttribute("type", "text")
        })
        eyeN.addEventListener("click",function() {
            eyeS.style.display = "contents"
            eyeN.style.display = "none"
            pass1.setAttribute("type", "password")
            pass2.setAttribute("type", "password")
        })

    </script>
    <?php 
        include_once "include/footer.php";
    ?>
</body>
</html>

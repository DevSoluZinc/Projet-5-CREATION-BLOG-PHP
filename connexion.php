<?php 
session_start();
require('config/connect.php');
require('config/functions.php');

// Inscription
if (isset($_POST['register'])) {
    $name = $_POST['name'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $password = crypt($_POST['password'], "toto");

    $stmt = $bdd->prepare('INSERT INTO user (name, lastname, email, password) VALUES (:name, :lastname, :email, :password)');
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':lastname', $lastname);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $password);

    $stmt->execute();
}

// Connexion
if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $bdd->prepare('SELECT * FROM user WHERE email = :email');
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $user = $stmt->fetch();
    //echo("<pre>" .print_r($user , true) ."</pre>");
    //die;
    if ($user && $user["password"] == crypt($password, "toto")) {
        $_SESSION['user_id'] = $user['id'];
        header('Location: index.php');
        exit();
    } else {
        $error_message = crypt($password, "toto");
        echo($error_message);
    }
}

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
        integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css"
        integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="canonical" href="https://getbootstrap.com/docs/5.2/examples/footers/">
    <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>
</head>
<?php {{ include('header.php') ; }} ?>
<body>
<div class="container" id="container">
<div class="container-fluid" style="text-align: -webkit-center;">
        <form action="#" method="post"style="background: gray;
    color: white;
    border-radius: 20px;
    margin: 25px;
    padding: 25px;
    text-align: center;">
            <h1>Connexion</h1>
            <br>
            <input type="email" placeholder="Email" id="email" name="email" class="form-control mb-3" />
            <input type="password" placeholder="Mot de passe" id="password" name="password" class="form-control mb-3" />
            <button type="submit" name="login" class="btn btn-dark">Valider</button>
        </form>
    </div>

    <div class="container-fluid" style="text-align: -webkit-center;">
        <form action="#" method="post" style="background: gray;
    color: white;
    border-radius: 20px;
    margin: 25px;
    padding: 25px;
    text-align: center;">
            <h1>Création de compte</h1>
            <br>
            <input type="text" placeholder="Nom" id="name" name="name" class="form-control mb-3"/>
            <input type="text" placeholder="Prénom" id="lastname" name="lastname" class="form-control mb-3" />
            <input type="email" placeholder="Email" id="email" name="email" class="form-control mb-3"/>
            <input type="password" placeholder="Mot de passe" id="password" name="password" class="form-control mb-3" />
            <button type="submit" name="register" class="btn btn-dark mb-3">Inscription</button>
        </form>
    </div>
   
    
</div>




</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.8.3/angular.min.js"
    integrity="sha512-KZmyTq3PLx9EZl0RHShHQuXtrvdJ+m35tuOiwlcZfs/rE7NZv29ygNA8SFCkMXTnYZQK2OX0Gm2qKGfvWEtRXA=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"
    integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V"
    crossorigin="anonymous"></script>
<script src="connexion.js"></script>

</body>

</html>
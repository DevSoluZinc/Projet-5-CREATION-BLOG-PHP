<?php
session_start();
extract($_GET);
$id = strip_tags($id);

require_once('config/functions.php');
$article = getArticle($id);
if (!empty($_POST)) {
    extract($_POST);
    $errors = array();

    $author = strip_tags($author);
    $comment = strip_tags($comment);

    if (empty($author))
        array_push($errors, 'Entrez un pseudo');
    if (empty($comment))
        array_push($errors, 'Entrez un commentaire');
    if (count($errors) == 0) {
        $comment = addComment($id, $author, $comment);
        $success = 'Votre commentaire à été soumis à validation';
        unset($author);
        unset($comment);
    }
}
//}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Article | <?= $article->title ?></title>
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
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet"/>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>
</head>
    <!-- Custom styles for this template -->
    <link href="https://fonts.googleapis.com/css?family=Playfair&#43;Display:700,900&amp;display=swap" rel="stylesheet">
  </head>
  <body>
  <?php {{ include('header.php') ; }} ?>
<main class="container">
    <div class="border-bottom d-flex" style="align-items: stretch;justify-content: space-around;">
    <h3 class="pb-4 mb-4 fst-italic ">
      <?= $article->title ?>
      </h3>
      <p style="font-size: small;"> écrit le
                <?= date('d/m/Y', strtotime($article->date)) ?> par
                <?= $article->auteur ?>
            </p>
    </div>
      <article class="blog-post">
        <h2>
            <?= $article->chapo ?>
            </h1>
            <div class="card-body">
                <p>
                    <?= $article->content ?>
                </p>
            </div>
    </div>
    <div class="card p-2 m-2">
    <?php
    if (isset($success)) {
        echo "<script>toastr.success('".$success."')</script>";
    }
?>
       <?php if (check_login()): ?>
    <!-- Formulaire de commentaire -->
    <form action="article.php?id=<?= $article->id ?>" method="post">
        <div class="mb-3">
            <label for="author" class="form-label">Pseudo</label>
            <input type="text" class="form-control <?= (!empty($errors) && in_array('Entrez un pseudo', $errors)) ? 'is-invalid' : '' ?>" name="author" id="author" value="<?= $author ?? '' ?>">
            <?php if (!empty($errors) && in_array('Entrez un pseudo', $errors)): ?>
                <div class="invalid-feedback">
                    Entrez un pseudo valide.
                </div>
            <?php endif; ?>
        </div>
        <div class="mb-3">
            <label for="comment" class="form-label">Commentaire</label>
            <textarea class="form-control <?= (!empty($errors) && in_array('Entrez un commentaire', $errors)) ? 'is-invalid' : '' ?>" name="comment" id="comment" rows="3"><?= $comment ?? '' ?></textarea>
            <?php if (!empty($errors) && in_array('Entrez un commentaire', $errors)): ?>
                <div class="invalid-feedback">
                    Entrez un commentaire valide.
                </div>
            <?php endif; ?>
        </div>
        <button type="submit" class="btn btn-primary">Envoyer</button>
    </form>
<?php else: ?>
    <!-- Bouton de connexion -->
    <a class="btn btn-primary" href="connexion.php">Se connecter pour commenter</a>
<?php endif; ?>
    </div>
    <div class="card p-4 m-3">
        <h3 style="align-self: center;">Commentaires</h3>
            </div>
        <?php
        $comments = getComments($article->id);
        if (!empty($comments)): ?>
            <?php foreach ($comments as $comment): ?>
                <?php if ($comment->validate == 1): ?>
                <div class="card m-3">
                    <div class="card-body">
                        <h5 class="card-title">De
                            <?= $comment->author ?>
                        </h5>
                        <p class="card-text">
                            <?= $comment->comment ?>
                        </p>
                        <p class="card-text"><small class="text-muted">publié le
                                <?= $comment->date ?>
                            </small></p>
                    </div>
                </div>
                <?php endif; ?>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="card mb-3">
                <div class="card-body">
                    <p class="card-text">Aucun commentaire pour le moment.</p>
                </div>
            </div>
        <?php endif; ?>
    </div>
    <div class="container-fluid" style="background-color:black;margin-bottom: 0;
    margin-top: 200px;">
</main>

<?php {{ include('footer.php') ; }} ?>


</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.8.3/angular.min.js"
    integrity="sha512-KZmyTq3PLx9EZl0RHShHQuXtrvdJ+m35tuOiwlcZfs/rE7NZv29ygNA8SFCkMXTnYZQK2OX0Gm2qKGfvWEtRXA=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"
    integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V"
    crossorigin="anonymous"></script>
<script src="app.js"></script>

</html>
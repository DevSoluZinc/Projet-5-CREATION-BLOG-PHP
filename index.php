<?php
require('config/functions.php');
$articles = getArticles();
session_start(); // Démarrer la session
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    
</head>
    <!-- Custom styles for this template -->
    <link href="https://fonts.googleapis.com/css?family=Playfair&#43;Display:700,900&amp;display=swap" rel="stylesheet">
  </head>
  <body>
    
  <?php {{ include('header.php') ; }} ?>

<main class="container">
  <div class="row g-5">
    <div class="col-md-8">
      <h3 class="pb-4 mb-4 fst-italic border-bottom">
      Derniers articles
      </h3>

      <article class="blog-post">
      <?php foreach (array_slice($articles, -3) as $article): ?>
                        <div class="col sm-col-12 d-mb-3 sm-mb-3 mb-3">
                            <div class="card" style="font-family: Agenda-Light, Agenda Light, Agenda, Arial Narrow, sans-serif;
                            font-weight:100; 
                            background: rgba(0,0,0,0.3);
                            color: white;">
                                <i class="fa-solid fa-pen-nib fa-2x" style="white"></i>
                                <div class="card-body">
                                    <h5 class="card-title">
                                        <?= $article->title ?>
                                    </h5>
                                    <p class="card-text">
                                    <p>
                                        <?= isset($article->content) ? substr($article->content, 0, 30) : '' ?>
                                    </p>
                                    <?= $article->date ?>
                                    </p>
                                    <a href="article.php?id=<?= $article->id ?>" class="btn btn-dark">Lire la suite</a>
                                </div>

                            </div>
                        </div>
                    <?php endforeach; ?>

                    
                    <a href="pageArticle.php" style="font-family: Agenda-Light, Agenda Light, Agenda, 
                    Arial Narrow, sans-serif;
                    font-weight:100; 
                    background: rgba(0,0,0,0.3);
                    color: white;width:100%;    margin-bottom: 50px;" class="btn">Pour voir tous les articles</a>

<hr><div class="container">
    <h1>Formulaire de contact</h1>
    <form action="envoyer_formulaire.php" method="post">
        <div class="form-group mt-3">
            <label for="nom">Nom :</label>
            <input type="text" class="form-control" id="nom" name="nom" required>
        </div>

        <div class="form-group mt-3">
            <label for="email">Email :</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>

        <div class="form-group mt-3">
            <label for="message">Message :</label>
            <textarea class="form-control" id="message" name="message" required></textarea>
        </div>

        <button type="submit" class="btn btn-dark mt-3">Envoyer</button>
    </form>
</div>
      </article>

    </div>

    <div class="col-md-4">
    <div class="position-sticky" style="top: 2rem;">
        <div class="p-4 mb-3 bg-light rounded">
            <h4 class="fst-italic">A propos</h4>
            <img src="UserPhoto/Maxence.jpg" alt="Logo" class="img-fluid mb-3">
            <p class="mb-0">Maxence Medard, le développeur passionné qui transforme vos idées en réalité !</p>
        </div>
    </div>
</div>
</main>

<?php {{ include('footer.php') ; }} ?>

</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"
    integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V"
    crossorigin="anonymous"></script>
<script src="app.js"></script>

</html>
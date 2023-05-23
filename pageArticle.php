<?php
require('config/functions.php');
$articles = getArticles();
session_start();
?>

<!DOCTYPE html>
<html lang="fr">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Accueil</title>
        <link
            rel="stylesheet"
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
            integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65"
            crossorigin="anonymous">
        <link
            rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
            integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
            crossorigin="anonymous"
            referrerpolicy="no-referrer"/>

        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Accueil</title>
            <link
                rel="stylesheet"
                href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
                integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65"
                crossorigin="anonymous">
        </head>

        <!-- Custom styles for this template -->
        <link
            href="https://fonts.googleapis.com/css?family=Playfair&#43;Display:700,900&amp;display=swap"
            rel="stylesheet">
    </head>
    <body>

    <?php {{ include('header.php') ; }} ?>

        <main class="container">
                    <h3 class="pb-4 mb-4 fst-italic border-bottom">
                        Tous les Articles
                    </h3>

                    <article class="blog-post">
                    <div class="row">
                       <?php 
                                 $count = 0; // compteur d'articles
                                     foreach ($articles as $article): 
                                          if ($count < 4): // afficher seulement les 4 premiers articles
                                                ?> 
                                                <div class="col">
                                                <div class="card" style=" font-family: Agenda-Light, Agenda Light, Agenda, Arial Narrow, sans-serif; font-weight:100; background: rgba(0,0,0,0.3); color: white;margin-bottom: 50px;">
                                                     <i class="fa-solid fa-pen-nib fa-2x" style="white"></i>
                                            <div class="card-body">
                                        <h5 class="card-title">
                                              <?= $article->title ?>
                                  </h5>
                                   <p class="card-text">
                                   <?= $article->date ?>
                                     </p>
                                         <a href="article.php?id=<?= $article->id ?>" class="btn btn-dark">Lire la suite</a>
                                                 </div>
                                                 </div>
                                    </div>
                                    </div>
<?php 
          endif;
          $count++;
        endforeach; 
    ?>
</div>
  <?php 
    if (count($articles) > 4): // afficher le bouton seulement si il y a plus de 4 articles
  ?>
  <div class="text-center mt-3">
    <a href="#" class="btn btn-dark" id="load-more-btn">Afficher plus d'articles</a>
  </div>
  <?php endif; ?>
                    </div>
                </article>
            </div>
    </div>
        </main>
        <?php {{ include('footer.php') ; }} ?>

    </body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"
    integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V"
    crossorigin="anonymous"></script>
<script src="app.js"></script>
<script>
  // code JavaScript pour gérer le chargement des articles supplémentaires
  var loadMoreBtn = document.getElementById('load-more-btn');
  var articlesContainer = document.querySelector('.row');
  var articles = <?= json_encode($articles) ?>;
  var count = 4; // commencer à partir du cinquième article

  loadMoreBtn.addEventListener('click', function() {
    for (var i = count; i < count + 2 && i < articles.length; i++) {
      var article = articles[i];
      var articleHtml = `
      <div class="col-12">
          <div class="card" style=" font-family: Agenda-Light, Agenda Light, Agenda, Arial Narrow, sans-serif; font-weight:100; background: rgba(0,0,0,0.3); color: white;margin-bottom:50px">
          <i class="fa-solid fa-pen-nib fa-2x" style="white"></i>
            <div class="card-body">
              <h5 class="card-title">
                ${article.title}
              </h5>
              <p class="card-text">
                ${article.date}
              </p>
              <a href="article.php?id=${article.id}" class="btn btn-dark">Lire la suite</a>
            </div>
        </div>
        </div>
      `;
      articlesContainer.innerHTML += articleHtml;
    }
    count += 2; // incrémenter le compteur pour les deux prochains articles
    if (count >= articles.length) {
      loadMoreBtn.style.display = 'none'; // cacher le bouton lorsque tous les articles ont été affichés
    }
  });
</script>
</html>
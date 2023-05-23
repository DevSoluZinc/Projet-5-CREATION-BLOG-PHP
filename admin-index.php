<?php
// Vérifier s'il y a un message de confirmation à afficher
if (isset($_GET['updateArticle'])) {
    $message = "L'article a été mis à jour avec succès!";
    $type = "success";
    // Afficher le code du toastr
    echo "<script>toastr.$type('$message')</script>";
}
?>
<?php
require('config/functions.php');
$articles = getArticles();
$total_articles = count($articles);
$articles_this_month = 0;

foreach ($articles as $article) {
    if (date('Y-m', strtotime($article->date)) == date('Y-m')) {
        $articles_this_month++;
    }
}
$comments = getCommentsGeneral();
$total_comments = count($comments);
$comments_this_month = 0;
foreach ($comments as $comment) {
    if (date('Y-m', strtotime($comment->date)) == date('Y-m')) {
        $comments_this_month++;
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5">
    <meta name="author" content="AdminKit">
    <meta name="keywords"
        content="adminkit, bootstrap, bootstrap 5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css"
        integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="shortcut icon" href="img/icons/icon-48x48.png" />

    <link rel="canonical" href="https://demo.adminkit.io/forms-editors.html" />
    <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>
    <title>Tableau de bord | BlogPost</title>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">

   
    <link href="dark.css" rel="stylesheet">



    <style>
        body {
            opacity: 0;
        }
    </style>
</head>


<body data-theme="default" data-layout="fluid" data-sidebar-position="left" data-sidebar-layout="default">
    <div class="wrapper">
    <?php {{ include('admin-header.php') ; }} ?>

            <main class="content">
                <div class="container-fluid" style="text-align: -webkit-center">
                    <h1 class="mb-3"> STATISTIQUES DU SITE BLOGPOST </h1>
                    <div class="row">
                        <div class="col">
                            <div class="card" style="width: 18rem;">
                                <i class="fa-solid fa-comment fa-4x"></i>
                                <div class="card-body">
                                    <h5 class="card-title">Nombre d'articles sur le site</h5>
                                    <p class="card-text" style="font-size: xxx-large;">
                                        <?= $total_articles ?>
                                    </p>
                                    <a href="#" class="btn btn-primary">Allez voir les articles</a>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card" style="width: 18rem;">
                                <i class="fa-solid fa-comment fa-4x"></i>
                                <div class="card-body">
                                    <h5 class="card-title">Nombre d'articles sur le site ce mois-ci</h5>
                                    <p class="card-text" style="font-size: xxx-large;">
                                        <?= $articles_this_month ?>
                                    </p>
                                    <a href="#" class="btn btn-primary">Allez voir les articles</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="card" style="width: 18rem;">
                                <i class="fa-solid fa-comment fa-4x"></i>
                                <div class="card-body">
                                    <h5 class="card-title">Nombre de commentaire sur le site</h5>
                                    <p class="card-text" style="font-size: xxx-large;">
                                        <?= $total_comments ?>
                                    </p>
                                    <a href="#" class="btn btn-primary">Allez voir les commentaires</a>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card" style="width: 18rem;">
                                <i class="fa-solid fa-comment fa-4x"></i>
                                <div class="card-body">
                                    <h5 class="card-title">Nombre de commentaire sur le site ce mois-ci</h5>
                                    <p class="card-text" style="font-size: xxx-large;">
                                        <?= $comments_this_month ?>
                                    </p>
                                    <a href="#" class="btn btn-primary">Allez voir les commentaires</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>

            <?php {{ include('admin-footer.php') ; }} ?>
        </div>
    </div>

    <script src="admin.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            var editor = new Quill("#quill-editor", {
                modules: {
                    toolbar: "#quill-toolbar"
                },
                placeholder: "Type something",
                theme: "snow"
            });
            var bubbleEditor = new Quill("#quill-bubble-editor", {
                placeholder: "Compose an epic...",
                modules: {
                    toolbar: "#quill-bubble-toolbar"
                },
                theme: "bubble"
            });
        });
    </script>
</body>

</html>
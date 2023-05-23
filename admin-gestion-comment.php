
<?php
require('config/functions.php');
ob_start();
$articles = getArticles();
$comments= getCommentsGeneral()
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
    <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>

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
                <main class="content">
                    <h1>GESTIONS DES COMMENTAIRES</h1>
                    <?php

$comments = getCommentsGeneral();
$articles = array();

// Regrouper les commentaires par article
foreach ($comments as $comment) {
    $articles[$comment->articleId][] = $comment;
}

// Afficher les commentaires par article
foreach ($articles as $articleId => $comments) {
    $article = getArticle($articleId);
    echo '<h3>' . $article->title . '</h3>';
    echo '<div class="table-responsive">';
    echo '<table class="table">';
    echo '<thead>';
echo '<tr>';
echo '<th>Auteur</th>';
echo '<th>Commentaire</th>';
echo '<th>Date</th>';
echo '<th>Statut</th>';
echo '<th>Actions</th>';
echo '</tr>';
echo '</thead>';
    foreach ($comments as $comment) {
        echo '<tr>';
        echo '<td>' . $comment->author . '</td>';
        echo '<td>' . $comment->comment . '</td>';
        echo '<td>' . $comment->date . '</td>';
        if ($comment->validate == 0) {
            echo '<td>En attente</td>';
        } else {
            echo '<td>Validé</td>';
        }
        echo '<td>';
        echo '<div class="row">';
        // Bouton de validation
        if ($comment->validate == 0) {
            echo '<div class="col">';
            echo '<form method="post">';
            echo '<button type="submit" name="validate-comment-' . $comment->id . '" style="background: none;border: none;"><i style="color:green;" class="fa-solid fa-circle-check fa-2x"></i></button>';
            echo '</form>';
            echo '</div>';
        }
        // Bouton de suppression
        echo '<div class="col">';
        echo '<form method="post">';
        echo '<button type="submit" name="delete-comment-' . $comment->id . '" style="background: none;border: none;"><i style="color:red;" class="fa-solid fa-circle-xmark fa-2x"></i></button>';
        echo '</form>';
        echo '</td>';
        echo '</tr>';
        echo '</div>';
        echo '</div>';
        // Traitement du bouton de validation
        if (isset($_POST['validate-comment-' . $comment->id])) {
            
            updateCommentValidation($comment->id, 1);
            echo '<script>toastr.success("Le commentaire a été validé.")</script>';
        }
        // Traitement du bouton de suppression
        if (isset($_POST['delete-comment-' . $comment->id])) {
            deleteComment($comment->id);
            // Actualiser la page pour masquer le commentaire supprimé
            echo '<script>toastr.danger("Commentaire supprimé.")</script>';
                  }
    }
    echo '</table>';
    echo '</div>';
}// Bouton pour approuver tous les commentaires en attente
$pendingComments = array_filter($comments, function($comment) {
    return $comment->validate == 0;
});
echo '<div class="row">';
if (!empty($pendingComments)) {
    echo '<div class="col">';
    echo '<form method="post">';
    echo '<button type="submit" name="validate-all" class="btn btn-primary">Approuver tous les commentaires en attente</button>';
    echo '</form>';
    echo '</div>';
}
// Traitement du bouton pour approuver tous les commentaires en attente
if (isset($_POST['validate-all'])) {
    foreach ($pendingComments as $comment) {
        $commentId = $comment->id;
        updateCommentValidation($commentId, 1);
    }
    // Actualiser la page pour masquer les commentaires approuvés
    header('Location: ' . $_SERVER['REQUEST_URI']);
    exit();
}

// Bouton pour supprimer tous les commentaires
if (!empty($comments)) {
    echo '<div class="col">';
    echo '<form method="post">';
    echo '<button type="submit" name="delete-all" class="btn btn-danger">Supprimer tous les commentaires</button>';
    echo '</form>';
    echo '</div>';
}
echo '</div>';
// Traitement du bouton pour supprimer tous les commentaires
if (isset($_POST['delete-all'])) {
    foreach ($comments as $comment) {
        $commentId = $comment->id;
        deleteComment($commentId);
    }
    // Actualiser la page pour masquer les commentaires supprimés
    header('Location: ' . $_SERVER['REQUEST_URI']);
    exit();
    
}
ob_end_flush();
?>
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
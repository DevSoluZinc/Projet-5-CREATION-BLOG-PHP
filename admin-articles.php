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
if (isset($_POST['delete_article'])) {
    $id = $_POST['delete_article'];
    deleteArticle($id);
    $success = 'Votre Article à été supprimer';
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

    <title>Editors | AdminKit Demo</title>

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
                <?php
                if (isset($success)) {
                    echo "<script>toastr.success('" . $success . "')</script>";
                }
                ?>
<div class="table-responsive">
<table class="table">
    <thead>
        <tr>
            <th>Title</th>
            <th>Date</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($articles as $article):
        ?>
        <tr>
            <td><?= $article->title ?></td>
            <td><?= $article->date ?></td>
            <td>
                <a href="admin-update-article.php?id=<?= $article->id ?>" class="btn btn-primary">Modifier</a>
                <form method="post" style="display: inline;">
                    <input type="hidden" name="delete_article" value="<?= $article->id ?>">
                    <button type="submit" class="btn btn-danger">Supprimer</button>
                </form>
            </td>
        </tr>
        <?php
        endforeach;
        ?>
    </tbody>
</table>
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
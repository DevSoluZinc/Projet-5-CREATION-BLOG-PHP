<?php
require('config/functions.php');
// Initialisation de la variable $errors
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Vérification des saisies de l'utilisateur
    if (empty($_POST['title'])) {
        $errors[] = 'Entrez un titre';
    }

    if (empty($_POST['chapo'])) {
        $errors[] = 'Entrez un chapo';
    }

    if (empty($_POST['auteur'])) {
        $errors[] = 'Entrez un auteur';
    }

    if (empty($_POST['content'])) {
        $errors[] = 'Entrez un contenu';
    }

    // Si aucune erreur n'a été détectée, on peut traiter les données
    if (empty($errors)) {
        // Traitement des données
    }
    if (isset($_FILES['image']) && $_FILES['image']['error'] == UPLOAD_ERR_OK) {
        $imageData = file_get_contents($_FILES['image']['tmp_name']);
        // le reste du code pour insérer les données en base de données
    } else {
        // afficher un message d'erreur ou une valeur par défaut pour l'image
    }
}
if (empty($errors)) {
    if (isset($_POST['title']) && isset($_POST['chapo']) && isset($_POST['auteur']) && isset($_POST['content'])) {
        $title = $_POST['title'];
        $chapo = $_POST['chapo'];
        $auteur = $_POST['auteur'];
        $content = $_POST['content'];
         addArticle($title, $chapo, $auteur, $content);

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
            <div class="container">
                <h1 style="color:white;text-align: center;
    font-size: xxx-large;">AJOUT D'ARTICLE</h1>
                <form method="post" action="">
                    <div class="mb-3">
                        <label for="title" class="form-label">Titre</label>
                        <input type="text"
                            class="form-control <?=(!empty($errors) && in_array('Entrez un titre', $errors)) ? 'is-invalid' : '' ?>"
                            name="title" id="title" value="<?= $title ?? '' ?>">
                        <?php if (!empty($errors) && in_array('Entrez un titre', $errors)): ?>
                            <div class="invalid-feedback">
                                Entrez un titre valide.
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="mb-3">
                        <label for="chapo" class="form-label">Chapo</label>
                        <textarea
                            class="form-control <?=(!empty($errors) && in_array('Entrez un chapo', $errors)) ? 'is-invalid' : '' ?>"
                            name="chapo" id="chapo" rows="3"><?= $chapo ?? '' ?></textarea>
                        <?php if (!empty($errors) && in_array('Entrez un chapo', $errors)): ?>
                            <div class="invalid-feedback">
                                Entrez un chapo valide.
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="mb-3">
                        <label for="auteur" class="form-label">Auteur</label>
                        <input type="text"
                            class="form-control <?=(!empty($errors) && in_array('Entrez un auteur', $errors)) ? 'is-invalid' : '' ?>"
                            name="auteur" id="auteur" value="<?= $auteur ?? '' ?>">
                        <?php if (!empty($errors) && in_array('Entrez un auteur', $errors)): ?>
                            <div class="invalid-feedback">
                                Entrez un auteur valide.
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="mb-3">
                        <label for="content" class="form-label">Contenue</label>
                        <textarea
                            class="form-control <?=(!empty($errors) && in_array('Entrez un contenu', $errors)) ? 'is-invalid' : '' ?>"
                            name="content" id="content" rows="5"><?= $content ?? '' ?></textarea>
                        <?php if (!empty($errors) && in_array('Entrez un contenu', $errors)): ?>
                            <div class="invalid-feedback">
                                Entrez un contenue valide.
                            </div>
                        <?php endif; ?>
                    </div>
                    
                    <input type="submit" clas="btn btn-primary" value="Ajouter">
                </form>
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
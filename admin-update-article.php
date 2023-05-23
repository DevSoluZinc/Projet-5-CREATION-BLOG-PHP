<?php
require('config/functions.php');

// Initialisation de la variable $errors
$errors = [];

// Récupération de l'ID de l'article depuis l'URL
$id = $_GET['id'];

// Récupération de l'article correspondant à l'ID
$article = getArticle($id);

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
}

if (empty($errors)) {
    if (isset($_POST['title']) && isset($_POST['chapo']) && isset($_POST['auteur']) && isset($_POST['content'])) {
        $title = $_POST['title'];
        $chapo = $_POST['chapo'];
        $auteur = $_POST['auteur'];
        $content = $_POST['content'];

        updateArticle($id,$title, $chapo, $auteur, $content);
        // Rediriger vers la page admin-index.php avec un paramètre de message
    header('Location: admin-index.php?updated=true');
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

    <title>Mise à jour | BlogPost</title>

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
     
    <nav id="sidebar" class="sidebar js-sidebar">
            <div class="sidebar-content js-simplebar">
                <a class="sidebar-brand" href="admin-index.php">
                    <span class="sidebar-brand-text align-middle">
                        Blog Post Administrator
                    </span>
                </a>

                <div class="sidebar-user">
                    <div class="d-flex justify-content-center">
                        <div class="flex-shrink-0">
                            <!--<img src="img/avatars/avatar.jpg" class="avatar img-fluid rounded me-1" alt="Charles Hall" />-->
                        </div>
                        <div class="flex-grow-1 ps-2">
                            <a class="sidebar-user-title dropdown-toggle" href="#" data-bs-toggle="dropdown">
                                Maxence Medard
                            </a>
                            <div class="dropdown-menu dropdown-menu-start">
                                <a class="dropdown-item" href="pages-profile.html"><i class="align-middle me-1"
                                        data-feather="user"></i> Profile</a>
                                <a class="dropdown-item" href="#"><i class="align-middle me-1"
                                        data-feather="pie-chart"></i> Analytics</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="pages-settings.html"><i class="align-middle me-1"
                                        data-feather="settings"></i> Settings &
                                    Privacy</a>
                                <a class="dropdown-item" href="#"><i class="align-middle me-1"
                                        data-feather="help-circle"></i> Help Center</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#">Log out</a>
                            </div>

                            <div class="sidebar-user-subtitle">Designer</div>
                        </div>
                    </div>
                </div>

                <ul class="sidebar-nav">
                    <li class="sidebar-header">
                        Pages
                    </li>
                    <li class="sidebar-item">
                        <a href="admin-index.php" data-bs-toggle="collapse" class="sidebar-link collapsed">
                            <i class="align-middle" data-feather="sliders"></i> <span
                                class="align-middle">Dashboards</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a data-bs-target="#pages" data-bs-toggle="collapse" class="sidebar-link collapsed">
                            <i class="align-middle" data-feather="layout"></i> <span
                                class="align-middle">Articles</span>
                        </a>
                        <ul id="pages" class="sidebar-dropdown list-unstyled collapse " data-bs-parent="#sidebar">
                            <li class="sidebar-item"><a class="sidebar-link" href="admin-articles.php">Tous les
                                    articles</a></li>
                            <li class="sidebar-item"><a class="sidebar-link" href="admin-add-article.php">Ajout
                                    d'articles</a></li>
                        </ul>
                    </li>



                    <li class="sidebar-item">
                        <a href="#auth" data-bs-toggle="collapse" class="sidebar-link collapsed">
                            <i class="align-middle" data-feather="users"></i> <span class="align-middle">Gestions</span>
                        </a>
                        <ul id="auth" class="sidebar-dropdown list-unstyled collapse " data-bs-parent="#sidebar">
                            <li class="sidebar-item"><a class="sidebar-link" href="admin-gestion-user.php">Utilisateurs</a>
                            </li>
                            <li class="sidebar-item"><a class="sidebar-link" href="admin-gestion-comment.php">Commentaires</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
              

        <div class="main">
            <nav class="navbar navbar-expand navbar-light navbar-bg">
                <a class="sidebar-toggle js-sidebar-toggle">
                    <i class="hamburger align-self-center"></i>
                </a>
                <div class="navbar-collapse collapse">
                    <ul class="navbar-nav navbar-align">
                        <li class="nav-item">
                            <a class="nav-icon js-fullscreen d-none d-lg-block" href="#">
                                <div class="position-relative">
                                    <i class="align-middle" data-feather="maximize"></i>
                                </div>
                            </a>
                        </li>

                    </ul>
                </div>
            </nav>
            <main class="content">
            <div class="container">
                <h1 style="color:white;text-align: center;
    font-size: xxx-large;">MODIFICATION DE <?php echo $article -> title; ?></h1>
                <form method="post" action="">
                    <div class="mb-3">
                        <label for="title" class="form-label">Titre</label>
                        <input type="text"
                            class="form-control <?=(!empty($errors) && in_array('Entrez un titre', $errors)) ? 'is-invalid' : '' ?>"
                            name="title" id="title" value="<?php echo $article -> title; ?>">
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
                            name="chapo" id="chapo" rows="3"><?php echo $article -> chapo ?></textarea>
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
                            name="auteur" id="auteur" value="<?php echo $article -> auteur ?>">
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
                            name="content" id="content" rows="5"><?php echo $article -> content ?></textarea>
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
            <footer class="footer">
                <div class="container-fluid">
                    <div class="row text-muted">
                        <div class="col-6 text-start">
                            <p class="mb-0">
                                <a href="index.php" target="_blank" class="text-muted"><strong>BlogPost</strong></a>
                                &copy;
                            </p>
                        </div>

                    </div>
                </div>
            </footer>
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
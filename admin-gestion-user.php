
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
    <title>Utilisateurs | BlogPost</title>
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
                    <h1>GESTION DES UTILISATEURS</h1>
<?php
$users = getAllUsers();
// Tableau des utilisateurs valid�s
$usersValidated = array_filter($users, function($user) {
    return $user->role == 1;
});

// Tableau des utilisateurs non valid�s
$usersNonValidated = array_filter($users, function($user) {
    return $user->role != 1;
});



// Afficher le tableau des utilisateurs valid�s
echo '<h3>Utilisateurs valides</h3>';
echo '<div class="table-responsive">';
echo '<table class="table">';
echo '<thead>';
echo '<tr>';
echo '<th>Name</th>';
echo '<th>Lastname</th>';
echo '<th>Email</th>';
echo '<th>Action</th>';
echo '</tr>';
echo '</thead>';
echo '<tbody>';

foreach ($usersValidated as $user) {
    echo '<tr>';
    echo '<td>' . $user->name . '</td>';
    echo '<td>' . $user->lastname . '</td>';
    echo '<td>' . $user->email . '</td>';
    echo '<td>';
    echo '<form method="post">';
    echo '<button type="submit" name="delete-user-' . $user->id . '" style="background: none;border: none;"><i style="color:red;" class="fa-solid fa-circle-xmark fa-2x"></i></button>';
    echo '</form>';
    echo '</td>';
    echo '</tr>';
    echo '</div>';
    echo '</div>';

    // Traitement du bouton de suppression
    if (isset($_POST['delete-user-' . $user->id])) {
        deleteUser($user->id);
        // Actualiser la page pour masquer le commentaire supprim�
        echo '<script>toastr.danger("utilisateur supprim�.")</script>';
    }
}

echo '</tbody>';
echo '</table>';
echo '</div>';

// Afficher le tableau des utilisateurs non valid�s
echo '<h3>Utilisateurs non valides</h3>';
echo '<div class="table-responsive">';
echo '<table class="table">';
echo '<thead>';
echo '<tr>';
echo '<th>Name</th>';
echo '<th>Lastname</th>';
echo '<th>Email</th>';
echo '<th>Valider</th>';
echo '<th>Supprimer</th>';
echo '</tr>';
echo '</thead>';
echo '<tbody>';

foreach ($usersNonValidated as $user) {
    echo '<tr>';
    echo '<td>' . $user->name . '</td>';
    echo '<td>' . $user->lastname . '</td>';
    echo '<td>' . $user->email . '</td>';
    echo '<td>';
    echo '<form method="post">';
    echo '<button type="submit" name="validate-user-' . $user->id . '" style="background: none;border: none;"><i style="color:green;" class="fa-solid fa-circle-check fa-2x"></i></button>';
    echo '</form>';
    echo '</td>';
    echo '<td>';
    echo '<form method="post">';
    echo '<button type="submit" name="delete-user-' . $user->id . '" style="background: none;border: none;"><i style="color:red;" class="fa-solid fa-circle-xmark fa-2x"></i></button>';
    echo '</form>';
    echo '</td>';
    echo '</tr>';
    echo '</div>';
    echo '</div>';

    // Traitement du bouton de suppression
    if (isset($_POST['delete-user-' . $user->id])) {
        deleteUser($user->id);
        // Actualiser la page pour masquer le commentaire supprim�
        echo '<script>toastr.success("Utilisateur supprim�.")</script>';
        echo '<script>location.reload();</script>';
    }

    // Traitement du bouton de validation
    
    if (isset($_POST['validate-user-' . $user->id])) {
        
        updateUserRoleToValidated($user->id);
        echo '<script>toastr.success("Utilisateur valid�.")</script>';
        echo '<script>location.reload();</script>';
    }
}

echo '</tbody>';
echo '</table>';
echo '</div>';
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
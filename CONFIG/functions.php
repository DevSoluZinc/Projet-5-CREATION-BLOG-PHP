<?php
//FONCTION DE RECUPERATION DE TOUS LES ARTICLES
function getArticles()
{
    require('connect.php');
    $req = $bdd->prepare('SELECT id, title, date FROM article ORDER BY id DESC');
    $req->execute();
    $data = $req->fetchALL(PDO::FETCH_OBJ);
    $req->closeCursor();
    return $data;
}
//FONCTION DE RECUPERATION D'UN ARTICLES
function getArticle($id)
{
    require('connect.php');
    $req = $bdd->prepare('SELECT * FROM article WHERE id = ?');
    $req->execute(array($id));
    if ($req->rowCount() == 1) {
        $data = $req->fetch(PDO::FETCH_OBJ);
        return $data;
    } else {
        header('Location : index.php');
        $req->closeCursor();
    }
}
//FONCTION DE SUPPRESSION D'UN ARTICLES
function deleteArticle($id)
{
    require('connect.php');
    $req = $bdd->prepare('DELETE FROM article WHERE id = ?');
    $req->execute(array($id));
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit();
}
//FONCTION D'AJOUT D'UN ARTICLE :
function addArticle($title, $chapo, $auteur, $content)
{
    require('connect.php');
    // Protection contre les attaques XSS
    $title = htmlspecialchars($title);
    $chapo = htmlspecialchars($chapo);
    $auteur = htmlspecialchars($auteur);
    $content = htmlspecialchars($content);
    $date = date("Y-m-d H:i:s"); // date actuelle
    $req = $bdd->prepare('INSERT INTO article(title, chapo, auteur, date, content) VALUES(:title, :chapo, :auteur, :date, :content)');
    $req->execute(
        array(
            'title' => $title,
            'chapo' => $chapo,
            'auteur' => $auteur,
            'date' => $date,
            'content' => $content,
        )
    );
    $req->closeCursor();
    header('Location: admin-articles.php');
    exit();
}
//FONCTION D'UPDATE D'UN ARTICLE :
function updateArticle($id, $title, $chapo, $auteur, $content)
{
    require('connect.php');
    // Protection contre les attaques XSS
    $title = htmlspecialchars($title);
    $chapo = htmlspecialchars($chapo);
    $auteur = htmlspecialchars($auteur);
    $content = htmlspecialchars($content);
    $req = $bdd->prepare('UPDATE article SET title=:title, chapo=:chapo, auteur=:auteur, content=:content WHERE id=:id');
    $req->execute(
        array(
            'id' => $id,
            'title' => $title,
            'chapo' => $chapo,
            'auteur' => $auteur,
            'content' => $content

        )
    );
    $req->closeCursor();
exit();
}
//FONCTION DE RECUPERATION DES COMMENTAIRES D'UN ARTICLE
function getComments($articleId)
{
    require('connect.php');
    $req = $bdd->prepare('SELECT * FROM commentaire WHERE articleId = ? ORDER BY date DESC');
    $req->execute(array($articleId));
    $data = $req->fetchAll(PDO::FETCH_OBJ);
    $req->closeCursor();
    return $data;
}
//FONCTION DE RECUPERATION GENERAL DES COMMENTAIRES
function getCommentsGeneral()
{

    require('connect.php');
    $req = $bdd->prepare('SELECT * FROM commentaire ORDER BY date DESC');
    $req->execute();
    $data = $req->fetchAll(PDO::FETCH_OBJ);
    $req->closeCursor();
    return $data;

}
//FONCTION DE RECUPERATION DU ROLE DU USER
function get_user_role($id)
{
    require('connect.php');
    $stmt = $bdd->prepare('SELECT role FROM user WHERE id = :id');
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($result) {
        return $result['role'];
    } else {
        return false;
    }
}
//FONCTION D'AJOUT DE COMMENTAIRE
function addComment($articleId, $author, $comment): void
{
    require('connect.php');
    $req = $bdd->prepare('INSERT INTO commentaire (articleId, author, comment, date, validate)
    VALUES (?, ?, ?, NOW(),0)');
    $req->execute(array($articleId, $author, $comment));
    $req->closeCursor();
}
//FONCTION DE MAJ D'UN COMMENTAIRE
function updateCommentValidation($commentId, $validate) {
    require('connect.php');
    $req = $bdd->prepare('UPDATE commentaire SET validate = ? WHERE id = ?');
    $req->execute(array($validate, $commentId));
    $req->closeCursor();
}
//FONCTION DE SUPPRESSION D'UN COMMENTAIRE
function deleteComment($commentId) {
    require('connect.php');
    $req = $bdd->prepare('DELETE FROM commentaire WHERE id = ?');
    $req->execute(array($commentId));
    $req->closeCursor();
}
//FONCTION DE CONNEXION
function authenticateUser($email, $password): bool
{
require('connect.php');
$req = $bdd->prepare('SELECT password FROM users WHERE email = ?');
$req->execute(array($email));
$result = $req->fetch();
$req->closeCursor();
if ($result !== false && password_verify($password, $result['password'])) {
return true;
} else {
return false;
}
}
//FONCTION D'INSCRIPTION
function register($name, $password, $email, $lastname)
{
    require('connect.php');

    // Vérifier si le nom d'utilisateur est déjà utilisé
    $req = $bdd->prepare('SELECT id FROM users WHERE username = ?');
    $req->execute(array($name));
    if ($req->rowCount() > 0) {
        return false; // Le nom d'utilisateur est déjà utilisé
    }

    // Vérifier si l'adresse e-mail est déjà utilisée
    $req = $bdd->prepare('SELECT id FROM users WHERE email = ?');
    $req->execute(array($email));
    if ($req->rowCount() > 0) {
        return false; // L'adresse e-mail est déjà utilisée
    }

    // Insérer l'utilisateur dans la base de données
    //$hash = password_hash($password, PASSWORD_DEFAULT);
    $hach= sha1($password);
    $req = $bdd->prepare('INSERT INTO users (username, password, email) VALUES (?, ?, ?)');
    $result = $req->execute(array($username, $hash, $email));
    if ($result) {
        return true; // L'inscription est réussie
    } else {
        return false; // L'inscription a échoué
    }
}

// FONCTION DE VERIFICATION SI L'UTILISATEUR EST CONNECTER
function check_login()
{
    // Vérifie si la variable de session 'user_id' existe
    if (isset($_SESSION['user_id'])) {
        // Vérifie si l'utilisateur existe dans la base de données
        require('connect.php');
        $req = $bdd->prepare('SELECT * FROM user WHERE id = ?');
        $req->execute(array($_SESSION['user_id']));
        if ($req->rowCount() == 1) {
            $data = $req->fetch(PDO::FETCH_ASSOC);
            return $data['name']; // Renvoie le nom d'utilisateur de l'utilisateur connecté
        }
    }
    return false; // L'utilisateur n'est pas connecté
}
// FONCTION DE RECUPERATION DES UTILISATEURS
function getAllUsers()
{
    require('connect.php');
    $req = $bdd->prepare('SELECT * FROM user');
    $req->execute();
    $data = $req->fetchAll(PDO::FETCH_OBJ);
    return $data;
}

function updateUserRoleToValidated($userId)
{
    require('connect.php');

    $req = $bdd->prepare('UPDATE user SET role = 1 WHERE id = ?');
    $req->execute(array($userId));

    // Vérifier si la mise à jour a réussi
    if ($req->rowCount() > 0) {
        return true; // Rôle mis à jour avec succès
    } else {
        return false; // Échec de la mise à jour
    }


}
// Fonction de suppression d'utilisateur
function deleteUser($userId) {
    require('connect.php');
    $req = $bdd->prepare('DELETE FROM user WHERE id = ?');
    $req->execute(array($userId));
    $req->closeCursor();
}
// Fonction de récupération d'utilisateur par son id
function getUserById($userId) {
    require('connect.php');

    $req = $bdd->prepare('SELECT * FROM user WHERE id = ?');
    $req->execute(array($userId));
    $user = $req->fetch(PDO::FETCH_ASSOC);
    $req->closeCursor();

    return $user;
}
function updateUser($userId, $name, $lastname, $email, $image)
{
    require('connect.php');
    // Protection contre les attaques XSS
    $name = htmlspecialchars($name);
    $lastname = htmlspecialchars($lastname);
    $email = htmlspecialchars($email);
    $image = htmlspecialchars($image);

    // Mettre à jour les données de l'utilisateur dans la base de données
    $req = $bdd->prepare('UPDATE user SET name=:name, lastname=:lastname, email=:email, image=:image WHERE id=:id');
    $req->execute(array(
        'id' => $userId,
        'name' => $name,
        'lastname' => $lastname,
        'email' => $email,
        'image' => $image
    ));
    // Vérifier si la mise à jour a réussi
    if ($req->rowCount() > 0) {
        return true; // Mise à jour réussie
    } else {
        return false; // Échec de la mise à jour
    }
}


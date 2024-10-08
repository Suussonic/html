<?php
include 'models/Database.php';
session_start();


if ($_SERVER["REQUEST_METHOD"] == "POST") {
  
    $title = trim($_POST['title']);
    $description = trim($_POST['description']);
    $content = trim($_POST['content']);
    $id_author = $_SESSION['id'];
    $name_author = $_SESSION['firstname'];

  
    if (!empty($title) && !empty($description) && !empty($content)) {
        try {
          
            $stmt = $dbh->prepare("INSERT INTO question (title, description, content, id_author, name_author) VALUES (:title, :description, :content, :id_author, :name_author)");

          
            $stmt->execute([
                ':title' => $title,
                ':description' => $description,
                ':content' => $content,
                ':id_author' => $id_author,
                ':name_author' => $name_author
            ]);

        
            header("Location: /forum");
            exit;
        } catch (PDOException $e) {
        
            echo "Erreur lors de l'insertion dans la base de données : " . htmlspecialchars($e->getMessage());
        }
    } else {
        echo "Veuillez remplir tous les champs.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/public/assets/css/question.css">
    <title>Nouvelle Question</title>
</head>
<body>

<h1>Poser une nouvelle question</h1>

<form method="post">
    <input type="text" name="title" placeholder="Titre de la question" value="<?php echo isset($title) ? htmlspecialchars($title) : ''; ?>" required>
    <textarea name="description" placeholder="Description courte" required><?php echo isset($description) ? htmlspecialchars($description) : ''; ?></textarea>
    <textarea name="content" placeholder="Contenu détaillé" required><?php echo isset($content) ? htmlspecialchars($content) : ''; ?></textarea>
    <button type="submit">Envoyer</button>
</form>

<a href="forum.php">Retour au forum</a>

</body>
</html>

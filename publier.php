<!DOCTYPE html>
<html lang="en">
    <?php
        session_start();
        if(!isset($_SESSION['id_user'])){
            header("location: index.php");
        }
    ?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="bootstrap-icons-1.11.1/bootstrap-icons-1.11.1/bootstrap-icons.min.css">
    <title>Page de publication</title>
</head>
<body>
    <div class="row">
        <?php
            require_once('navbar.php');
        ?>
    </div>
    <h1><i class="spinner-border"></i>Loading</h1>
</body>
</html>
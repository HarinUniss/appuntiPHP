<?php session_start();  //accedo alla variabile globale $_SESSION ?>
<!-- Fare in modo che una volta fatto il loghin la sessione resti aperta nelle altre pagine del sito -->


<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sito di ricette - Home</title>
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" 
        rel="stylesheet"
    >
</head>



<?php

// Souvent on identifie cet objet par la variable $conn ou $db
$mysqlConnection = new PDO(
    'mysql:host=127.0.0.1;dbname=we_love_food;charset=utf8mb4',
    'root',
    ''
);

//linea che serve se mettiamo la pagina sul web al posto della parte precedente
//$db = new PDO('mysql:host=sql.hebergeur.com;dbname=mabase;charset=utf8', 'pierre.durand', 's3cr3t');
//

//altra possibilità
////crea connessione
//$conn = new mysqli("127.0.0.1", "root", "", "we_love_food");
//
////Controllo connessione
//if($conn->connect_error) {
//    die("Connessione fallita: " . $conn->connect_error); //streammo l'errore di connessione
//}
//$conn->close();
//
//<!--//parte che verifica se credenziali di accesso al DB sono corrette nel caso senga -->
//<!--    un messaggio d'errore senza mostrare sensibili dati a schermo -->

//try
//{
//    $db = new PDO('mysql:host=localhost;dbname=we_love_food;charset=utf8', 'root', '');
//}
//catch (Exception $e)
//{
//    die('Erreur : ' . $e->getMessage());
//}
//


?>


    <body class="d-flex flex-column min-vh-100">
        
        <div class="container">

            <!-- Includeo file header -->
            <?php include_once('header.php'); ?>

            <!-- Formulario di connessione-->
            <?php include_once('login.php'); ?>
                

            <!-- Se l'utilizzatore esiste stampa le ricette -->
            <?php if(isset($_SESSION['LOGGED_USER'])): ?>

            <h1>Sito di ricette!</h1>
                    <?php foreach(get_recipes($recipes, $limit) as $recipe) : ?>
                        <article>
                            <h3><?php echo $recipe['ti
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
//crea connessione
$conn = new mysqli("127.0.0.1", "root", "", "we_love_food");

//Controllo connessione
if($conn->connect_error) {
    die("Connessione fallita: " . $conn->connect_error); //streammo l'errore di connessione
}
$conn->close();
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
                            <h3><?php echo $recipe['title']; ?></h3>
                            <div><?php echo $recipe['recipe']; ?></div>
                            <i><?php echo display_author($recipe['author'], $users); ?></i>
                        </article>
                    <?php endforeach ?>
            <?php endif; ?>
        </div>

        <!-- Inserire Pie di pagina -->
        <?php include_once('footer.php'); ?>
    </body>
</html>
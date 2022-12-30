<?php

// Validazione formulario
if (isset($_POST['email']) &&  isset($_POST['password'])) //verifico se ha riempito entrambi i campi
{


    foreach ($users as $user) //per ogni user registrato in memoria
    {
        if (
            //verifico se mail e pasword sono corrette
            $user['email'] === $_POST['email'] &&
            $user['password'] === $_POST['password']
        ) 
            {   //se sono corrette creo variabile contenente email utente
            $_SESSION['LOGGED_USER'] = $user['email'];

        } else { //altrimenti segnalo problema
            $errorMessage = sprintf("Le informazioni inserite non permettono l'identificazione : (%s/%s)",
                $_POST['email'],
                $_POST['password']
            );
        }
    }
}
?>

<!--
   Se l'utilizzatore non é stato identificato, stampo il seguente formulario
-->
<?php if(!isset($_SESSION['LOGGED_USER'])): //se non é settata la variabile $_SESSION?>
        <form action="home.php" method="post">
            <!-- Se c'e un messaggio di reore lo stampo -->
            <?php if(isset($errorMessage)) : ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo $errorMessage; ?>
                </div>
            <?php endif; //altrimenti continuo con ?>  
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" aria-describedby="email-help" placeholder="you@exemple.com">
                    <div id="email-help" class="form-text">Email usata durante la creazione dell'acount</div>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password">
                </div>
                <button type="submit" class="btn btn-primary">Accedi</button>
        </form>
<!-- 
    Altrimenti se é settato loggerUser dunque l'uttilizzatore si é connesso stampa messaggio di successo
-->
<?php else: ?>
    <div class="alert alert-success" role="alert">
        Salve <?php echo $_SESSION['LOGGED_USER']; ?> E benvenuto nel sito di ricette !
    </div>
<?php endif; ?>
<?php
// header("Content-type:application/json");
// Exemple de données JSON
$data = ["login" => "test", "pwd" => 1234];
echo json_encode($data);

//Login base de donnée
$servername = 'localhost';
$username = 'root';
$password = '';

//On essaie de se connecter
try{
    $mail = new PDO("mysql:host=$servername;dbname=symfonymail", $username, $password);
    //On définit le mode d'erreur de PDO sur Exception
    $mail->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo 'Connexion réussie';
}

    /*On capture les exceptions si une exception est lancée et on affiche
     *les informations relatives à celle-ci*/
catch(PDOException $e){
    echo "Erreur : " . $e->getMessage();
}
?>

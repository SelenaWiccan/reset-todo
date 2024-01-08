<?php

// Inclure le fichier de connexion à la base de données
require_once 'data.php';

// Vérifier si des données ont été envoyées en POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Récupérer les données JSON envoyées via la requête POST
    $data = json_decode(file_get_contents("php://input"));

    // Vérifier si l'adresse e-mail existe dans les données JSON
    if (isset($data->email)) {
        // Récupérer l'adresse e-mail à partir des données JSON
        $email = $data->email;

        // Préparer et exécuter la requête SQL pour insérer l'adresse e-mail dans la base de données
        try {
            $statement = $pdo->prepare("INSERT INTO utilisateurs (email) VALUES (:email)");
            $statement->bindParam(':email', $email, PDO::PARAM_STR);
            $statement->execute();

            // Répondre avec un message de succès au format JSON
            echo json_encode(["success" => true, "message" => "Email inserted successfully"]);
        } catch (PDOException $e) {
            // Répondre avec un message d'erreur au format JSON en cas d'échec de l'insertion
            echo json_encode(["success" => false, "message" => "Error inserting email: " . $e->getMessage()]);
        }
    } else {
        // Répondre avec un message d'erreur au format JSON si l'adresse e-mail n'a pas été fournie
        echo json_encode(["success" => false, "message" => "Email not provided"]);
    }
} else {
    // Répondre avec un message d'erreur au format JSON si la méthode de requête n'est pas POST
    echo json_encode(["success" => false, "message" => "Only POST requests are allowed"]);
}


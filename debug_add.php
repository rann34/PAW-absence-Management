<?php
// debug_add.php
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "=== DÉBUT DEBUG ===<br>";

// Vérifier si on reçoit des données
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    echo "✅ Méthode POST détectée<br>";
    
    echo "📦 Données reçues:<br>";
    echo "<pre>";
    print_r($_POST);
    echo "</pre>";
    
    // Configuration BDD - IMPORTANT: remplacez le nom de la base
    $host = "localhost";
    $dbname = "awp_db";  // ← REMPLACEZ PAR LE VRAI NOM DE VOTRE BASE
    $user = "root";
    $pass = "";
    
    echo "🔌 Tentative de connexion à la BDD...<br>";
    
    try {
        $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $user, $pass);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo "✅ Connexion BDD réussie!<br>";
        
        // Préparer l'insertion
        $sql = "INSERT INTO students (student_id, first_name, last_name, email, group_id) 
                VALUES (?, ?, ?, ?, 'AWP')";
        $stmt = $conn->prepare($sql);
        
        echo "🚀 Tentative d'insertion...<br>";
        
        $result = $stmt->execute([
            $_POST['student_id'],
            $_POST['first_name'], 
            $_POST['last_name'],
            $_POST['email']
        ]);
        
        if ($result) {
            echo "🎉 SUCCÈS: Étudiant ajouté en base de données!<br>";
            echo "ID: " . $_POST['student_id'] . "<br>";
            echo "Nom: " . $_POST['first_name'] . " " . $_POST['last_name'] . "<br>";
            echo "Email: " . $_POST['email'] . "<br>";
        } else {
            echo "❌ Échec de l'insertion<br>";
        }
        
    } catch (PDOException $e) {
        echo "❌ ERREUR BDD: " . $e->getMessage() . "<br>";
    }
    
} else {
    echo "❌ Aucune donnée POST reçue<br>";
}

echo "=== FIN DEBUG ===";
?>
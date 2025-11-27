<?php
// add_student.php
error_reporting(E_ALL);
ini_set('display_errors', 1);
header('Content-Type: text/plain; charset=utf-8');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $student_id = $_POST['student_id'] ?? '';
    $last_name = $_POST['last_name'] ?? '';
    $first_name = $_POST['first_name'] ?? '';
    $email = $_POST['email'] ?? '';
    $group_id = $_POST['group_id'] ?? 'AWP';

    // Debug
    echo "=== DÉBUT ===\n";
    echo "Données reçues:\n";
    print_r($_POST);

    if (empty($student_id) || empty($last_name) || empty($first_name) || empty($email)) {
        die("❌ Tous les champs sont obligatoires");
    }

    $host = "localhost";
    $dbname = "awp_db";
    $user = "root";
    $pass = "";

    try {
        $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $user, $pass);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo "✅ Connexion BDD réussie\n";
        
        // Insertion simple sans vérification
        $sql = "INSERT INTO students (student_id, first_name, last_name, email, group_id) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $result = $stmt->execute([$student_id, $first_name, $last_name, $email, $group_id]);
        
        if ($result) {
            echo "✅ Étudiant ajouté avec succès!";
        } else {
            echo "❌ Échec de l'insertion";
        }
        
    } catch (PDOException $e) {
        echo "❌ Erreur BDD: " . $e->getMessage();
    }
    
    echo "\n=== FIN ===";
    
} else {
    echo "❌ Méthode non autorisée";
}
?>
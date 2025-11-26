<?php
// --- CONFIG BASE DE DONNÉES ---
$servername = "localhost";
$username = "root";       // ton utilisateur MySQL
$password = "";           // ton mot de passe MySQL
$dbname = "awp_db";

// --- CONNEXION ---
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Erreur de connexion : " . $conn->connect_error);
}

// --- RÉCUPÉRER LES DONNÉES AJAX ---
$fullname = $_POST['fullname'] ?? '';
$matricule = $_POST['matricule'] ?? '';
$group_id = $_POST['group_id'] ?? '';

// --- VALIDATION SIMPLE ---
if(empty($fullname) || empty($matricule)) {
    echo "Erreur : Veuillez remplir tous les champs !";
    exit;
}

// --- INSÉRER DANS LA TABLE 'students' ---
$sql = "INSERT INTO students (matricule, fullname, group_id) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);
if(!$stmt){
    echo "Erreur SQL : " . $conn->error;
    exit;
}
$stmt->bind_param("sss", $matricule, $fullname, $group_id);

if($stmt->execute()){
    echo "Étudiant ajouté avec succès !";
}else{
    echo "Erreur lors de l'ajout : " . $stmt->error;
}

// --- FERMER CONNEXION ---
$stmt->close();
$conn->close();
?>

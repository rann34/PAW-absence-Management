<?php
require_once "config.php";

function getConnection() {
    global $DB_HOST, $DB_USER, $DB_PASS, $DB_NAME;

    try {
        $conn = new PDO("mysql:host=$DB_HOST;dbname=$DB_NAME;charset=utf8", $DB_USER, $DB_PASS);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;

    } catch (PDOException $e) {
        error_log("DB ERROR: " . $e->getMessage(), 3, "db_errors.log");
        die("❌ Database connection failed");
    }
}
?>

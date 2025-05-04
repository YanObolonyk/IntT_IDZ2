<?php
include 'connection.php';

function logRequest($lat, $lon, $user_agent) { 
    try {
        $pdo = new PDO($GLOBALS['dsn'], $GLOBALS['user'], $GLOBALS['pass']);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $pdo->prepare("INSERT INTO logs (user_agent, latitude, longitude) VALUES (:user_agent, :latitude, :longitude)");
        $stmt->bindParam(':user_agent', $user_agent, PDO::PARAM_STR);
        $stmt->bindParam(':latitude', $lat);
        $stmt->bindParam(':longitude', $lon);
        $stmt->execute();
    } catch (PDOException $e) {
        // повідомлення про помилку у системний лог PHP
        error_log("Logging failed: " . $e->getMessage());
    }
}
?>

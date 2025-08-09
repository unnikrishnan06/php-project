<?php
require_once "includes/db.php";
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}
$id = $_GET['id'];
$stmt = $pdo->prepare("DELETE FROM users WHERE id = ?");
$stmt->execute([$id]);
header("Location: dashboard.php");
exit;
?>
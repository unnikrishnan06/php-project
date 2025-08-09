<?php include 'includes/header.php';
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}
$id = $_GET['id'];
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $stmt = $pdo->prepare("UPDATE users SET name = ? WHERE id = ?");
    $stmt->execute([$name, $id]);
    echo '<p class="success-message">User updated successfully!</p>';
}
$stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$id]);
$user = $stmt->fetch();
?>

<main class="container">
  <h2 class="page-title">Update User</h2>
  <form method="post" class="auth-form">
    <input type="text" name="name" value="<?= htmlspecialchars($user['name']) ?>" required class="form-input">
    <button type="submit" class="btn">Update</button>
  </form>
</main>

<?php include 'includes/footer.php'; ?>

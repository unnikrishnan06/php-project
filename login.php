<?php include 'includes/header.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = strtolower(trim($_POST['email']));
    $password = $_POST['password'];
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();
    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user'] = $user;
        header("Location: dashboard.php");
        exit;
    } else {
        echo '<p class="error-message">Invalid login credentials!</p>';
    }
}
?>

<main class="container">
  <h2 class="page-title">Login</h2>
  <form method="post" class="auth-form">
    <input type="email" name="email" placeholder="Email" required class="form-input">
    <input type="password" name="password" placeholder="Password" required class="form-input">
    <button type="submit" class="btn">Login</button>
  </form>
</main>

<?php include 'includes/footer.php'; ?>

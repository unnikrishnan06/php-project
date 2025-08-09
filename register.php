<?php include 'includes/header.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = strtolower(trim($_POST['email']));
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    if ($stmt->rowCount() > 0) {
        echo '<p class="error-message">Email already exists!</p>';
    } else {
        $imageName = $_FILES['image']['name'];
        $imageTmp = $_FILES['image']['tmp_name'];
        $imagePath = "uploads/" . basename($imageName);
        move_uploaded_file($imageTmp, $imagePath);
        $stmt = $pdo->prepare("INSERT INTO users (name, email, password, image) VALUES (?, ?, ?, ?)");
        $stmt->execute([$name, $email, $password, $imageName]);
        echo '<p class="success-message">Registered successfully!</p>';
    }
}
?>

<main class="container">
  <h2 class="page-title">Register</h2>
  <form method="post" enctype="multipart/form-data" class="auth-form">
    <input type="text" name="name" placeholder="Name" required class="form-input">
    <input type="email" name="email" placeholder="Email" required class="form-input">
    <input type="password" name="password" placeholder="Password" required class="form-input">
    <input type="file" name="image" required class="form-input-file">
    <button type="submit" class="btn">Register</button>
  </form>
</main>

<?php include 'includes/footer.php'; ?>

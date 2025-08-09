<?php include 'includes/header.php';
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}
?>

<main class="container">
  <h2 class="page-title">Dashboard</h2>
  <table class="dashboard-table">
    <thead>
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Image</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $stmt = $pdo->query("SELECT * FROM users");
      while ($row = $stmt->fetch()):
      ?>
      <tr>
        <td><?= htmlspecialchars($row['id']) ?></td>
        <td><?= htmlspecialchars($row['name']) ?></td>
        <td><?= htmlspecialchars($row['email']) ?></td>
        <td>
          <img src="uploads/<?= htmlspecialchars($row['image']) ?>" alt="<?= htmlspecialchars($row['name']) ?>'s profile image" class="user-image" />
        </td>
        <td>
          <a href="update_user.php?id=<?= htmlspecialchars($row['id']) ?>" class="btn btn-edit">Edit</a> |
          <a href="delete_user.php?id=<?= htmlspecialchars($row['id']) ?>" class="btn btn-delete" onclick="return confirm('Are you sure you want delete this user?');">Delete</a>
        </td>
      </tr>
      <?php endwhile; ?>
    </tbody>
  </table>
</main>

<?php include 'includes/footer.php'; ?>

<?php include 'includes/header.php'; 
$isLoggedIn = isset($_SESSION['user']);

if ($_SERVER['REQUEST_METHOD'] == 'POST' && $isLoggedIn) {
    if (isset($_POST['add'])) {
        $stmt = $pdo->prepare("INSERT INTO content (title, body) VALUES (?, ?)");
        $stmt->execute([$_POST['title'], $_POST['body']]);
    }
    if (isset($_POST['update'])) {
        $stmt = $pdo->prepare("UPDATE content SET title = ?, body = ? WHERE id = ?");
        $stmt->execute([$_POST['title'], $_POST['body'], $_POST['id']]);
    }
    if (isset($_POST['delete'])) {
        $stmt = $pdo->prepare("DELETE FROM content WHERE id = ?");
        $stmt->execute([$_POST['id']]);
    }
}
?>

<main class="container">
  <h2 class="page-title">Content Page</h2>

  <?php if ($isLoggedIn): ?>
  <section class="content-add">
    <h3 class="section-title">Add New Content</h3>
    <form method="post" class="content-form">
      <input type="text" name="title" placeholder="Title" required class="form-input">
      <textarea name="body" placeholder="Body" required class="form-textarea"></textarea>
      <button type="submit" name="add" class="btn">Add</button>
    </form>
  </section>
  <?php endif; ?>

  <section class="content-list">
    <?php 
    $stmt = $pdo->query("SELECT * FROM content ORDER BY created_at DESC");
    while ($row = $stmt->fetch()):
    ?>
    <article class="content-item">
      <h3 class="content-title"><?= htmlspecialchars($row['title']) ?></h3>
      <p class="content-body"><?= nl2br(htmlspecialchars($row['body'])) ?></p>

      <?php if ($isLoggedIn): ?>
      <form method="post" class="content-form content-edit-form">
        <input type="hidden" name="id" value="<?= $row['id'] ?>">
        <input type="text" name="title" value="<?= htmlspecialchars($row['title']) ?>" required class="form-input">
        <textarea name="body" required class="form-textarea"><?= htmlspecialchars($row['body']) ?></textarea>
        <button type="submit" name="update" class="btn btn-update">Update</button>
        <button type="submit" name="delete" class="btn btn-delete" onclick="return confirm('Delete this post?')">Delete</button>
      </form>
      <?php endif; ?>
    </article>
    <?php endwhile; ?>
  </section>
</main>

<?php include 'includes/footer.php'; ?>

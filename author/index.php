<?php
require_once '../config/database.php';

if (isset($_GET['delete_id'])) {
    $stmt = $pdo->prepare("DELETE FROM authors WHERE author_id = ?");
    $stmt->execute([$_GET['delete_id']]);
    header("Location: index.php");
    exit;
}

$stmt = $pdo->query("SELECT * FROM authors ORDER BY author_id DESC");
$authors = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Authors List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm mb-4">
        <div class="container">
            <a class="navbar-brand fw-bold" href="../index.php">📚 Publishing Management</a>
            <div class="navbar-nav ms-auto">
                <a class="nav-link active" href="index.php">Authors</a>
                <a class="nav-link" href="../books/index.php">Books</a>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2>Authors Directory</h2>
            <a href="create.php" class="btn btn-success">+ Add New Author</a>
        </div>

        <div class="card shadow-sm border-0">
            <div class="card-body p-0">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email Address</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (count($authors) > 0): ?>
                            <?php foreach ($authors as $author): ?>
                            <tr>
                                <td><span class="badge bg-secondary">#<?= $author['author_id'] ?></span></td>
                                <td><?= htmlspecialchars($author['first_name']) ?></td>
                                <td><?= htmlspecialchars($author['last_name']) ?></td>
                                <td><?= htmlspecialchars($author['email']) ?></td>
                                <td class="text-center">
                                    <a href="edit.php?id=<?= $author['author_id'] ?>" class="btn btn-sm btn-outline-primary me-1">Edit</a>
                                    <a href="index.php?delete_id=<?= $author['author_id'] ?>" 
                                       onclick="return confirm('Warning: Deleting this author will automatically delete all their books!')" 
                                       class="btn btn-sm btn-outline-danger">Delete</a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr><td colspan="5" class="text-center py-4 text-muted">No authors found. Click "Add New Author" to begin.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</body>
</html>

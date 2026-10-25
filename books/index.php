<?php
require_once '../config/database.php';

if (isset($_GET['delete_id'])) {
    $stmt = $pdo->prepare("DELETE FROM books WHERE book_id = ?");
    $stmt->execute([$_GET['delete_id']]);
    header("Location: index.php");
    exit;
}

$sql = "SELECT books.*, CONCAT(authors.first_name, ' ', authors.last_name) AS author_name 
        FROM books 
        JOIN authors ON books.author_id = authors.author_id 
        ORDER BY books.book_id DESC";
$stmt = $pdo->query($sql);
$books = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Books Catalog</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm mb-4">
        <div class="container">
            <a class="navbar-brand fw-bold" href="../index.php">📚 Publishing Management</a>
            <div class="navbar-nav ms-auto">
                <a class="nav-link" href="../authors/index.php">Authors</a>
                <a class="nav-link active" href="index.php">Books</a>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2>Books Catalog</h2>
            <a href="create.php" class="btn btn-success">+ Add New Book</a>
        </div>

        <div class="card shadow-sm border-0">
            <div class="card-body p-0">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Book Title</th>
                            <th>ISBN</th>
                            <th>Price</th>
                            <th>Year</th>
                            <th>Author (Foreign Key)</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (count($books) > 0): ?>
                            <?php foreach ($books as $book): ?>
                            <tr>
                                <td><span class="badge bg-secondary">#<?= $book['book_id'] ?></span></td>
                                <td class="fw-bold"><?= htmlspecialchars($book['title']) ?></td>
                                <td><code><?= htmlspecialchars($book['isbn']) ?></code></td>
                                <td class="text-success fw-bold">$<?= number_format($book['price'], 2) ?></td>
                                <td><?= $book['published_year'] ?></td>
                                <td><span class="badge bg-info text-dark"><?= htmlspecialchars($book['author_name']) ?></span></td>
                                <td class="text-center">
                                    <a href="edit.php?id=<?= $book['book_id'] ?>" class="btn btn-sm btn-outline-primary me-1">Edit</a>
                                    <a href="index.php?delete_id=<?= $book['book_id'] ?>" 
                                       onclick="return confirm('Are you sure you want to delete this book?')" 
                                       class="btn btn-sm btn-outline-danger">Delete</a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr><td colspan="7" class="text-center py-4 text-muted">No books found in database.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</body>
</html>

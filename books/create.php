<?php
require_once '../config/database.php';

$authors = $pdo->query("SELECT author_id, CONCAT(first_name, ' ', last_name) AS name FROM authors")->fetchAll();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title          = $_POST['title'];
    $isbn           = $_POST['isbn'];
    $price          = $_POST['price'];
    $published_year = $_POST['published_year'];
    $author_id      = $_POST['author_id'];

    $stmt = $pdo->prepare("INSERT INTO books (title, isbn, price, published_year, author_id) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$title, $isbn, $price, $published_year, $author_id]);

    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Book</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <div class="container py-5" style="max-width: 600px;">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-primary text-white fw-bold">
                Add New Book (Child Entity)
            </div>
            <div class="card-body p-4">
                <form method="POST">
                    <div class="mb-3">
                        <label class="form-label">Assign Author (Foreign Key)</label>
                        <select name="author_id" class="form-select" required>
                            <option value="">-- Select Author --</option>
                            <?php foreach ($authors as $author): ?>
                                <option value="<?= $author['author_id'] ?>"><?= htmlspecialchars($author['name']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Book Title</label>
                        <input type="text" name="title" class="form-control" required placeholder="e.g. 1984">
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">ISBN</label>
                            <input type="text" name="isbn" class="form-control" required placeholder="e.g. 978-0451524935">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Price ($)</label>
                            <input type="number" step="0.01" name="price" class="form-control" required placeholder="e.g. 14.99">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Published Year</label>
                        <input type="number" name="published_year" class="form-control" required placeholder="e.g. 1949">
                    </div>

                    <div class="d-flex justify-content-between mt-4">
                        <a href="index.php" class="btn btn-outline-secondary">Cancel</a>
                        <button type="submit" class="btn btn-success">Save Book</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>
</html>

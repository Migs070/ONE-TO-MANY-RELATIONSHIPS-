<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Publishing House System</title>
    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <!-- Top Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="index.php">📚 Publishing Management</a>
            <div class="navbar-nav ms-auto">
                <a class="nav-link" href="authors/index.php">Authors</a>
                <a class="nav-link" href="books/index.php">Books</a>
            </div>
        </div>
    </nav>

    <!-- Main Container -->
    <div class="container py-5">
        <div class="p-5 mb-4 bg-white rounded-3 shadow-sm border text-center">
            <h1 class="display-5 fw-bold text-dark">Publishing House Portal</h1>
            <p class="lead text-muted mt-3">Manage your authors, publication catalogs, and relational data seamlessly using PHP PDO.</p>
            <hr class="my-4">
            <div class="d-flex justify-content-center gap-3">
                <a href="authors/index.php" class="btn btn-primary btn-lg shadow-sm">Manage Authors (Parent)</a>
                <a href="books/index.php" class="btn btn-outline-secondary btn-lg shadow-sm">Manage Books (Child)</a>
            </div>
        </div>
    </div>

</body>
</html>

<?php
include 'config.php';
include 'functions.php';

$itemsPerPage = 5;
$currentPage = isset($_GET['page']) ? intval($_GET['page']) : 1;
$offset = ($currentPage - 1) * $itemsPerPage;

// Handle search
$searchKeyword = isset($_GET['search']) ? $_GET['search'] : '';
$items = searchItems($searchKeyword, $offset, $itemsPerPage);
$totalItems = getTotalSearchItems($searchKeyword);
$totalPages = ceil($totalItems / $itemsPerPage);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Search Result Page</title>
</head>
<body>
    <h2>Search Result Page</h2>

    <!-- Display Items -->
    <ul>
        <?php foreach ($items as $item): ?>
            <li><?= $item['id'] ?> - <?= $item['name'] ?></li>
        <?php endforeach; ?>
    </ul>

    <!-- Pagination Links -->
    <div class='pagination'>
        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
            <a href='search.php?page=<?= $i ?>&search=<?= urlencode($searchKeyword) ?>'><?= $i ?></a>
        <?php endfor; ?>
    </div>
</body>
</html>

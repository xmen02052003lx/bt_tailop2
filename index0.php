<?php
include 'config.php';
include 'functions.php';

$itemsPerPage = 5;
$currentPage = isset($_GET['page']) ? intval($_GET['page']) : 1;
$offset = ($currentPage - 1) * $itemsPerPage;

// Handle item addition
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $itemName = isset($_POST['item_name']) ? trim($_POST['item_name']) : '';

    if (!empty($itemName)) {
        addItem($itemName);
    }
}

$items = getItems($offset, $itemsPerPage);
$totalItems = getTotalItems();
$totalPages = ceil($totalItems / $itemsPerPage);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Home Page</title>
</head>
<body>
    <h2>Home Page</h2>

    <!-- Add Item Form -->
    <form action="" method="post">
        <label for="item_name">Add Item:</label>
        <input type="text" id="item_name" name="item_name" required>
        <button type="submit">Add Item</button>
    </form>

    <!-- Display Items -->
    <ul>
        <?php foreach ($items as $item): ?>
            <li><?= $item['id'] ?> - <?= $item['name'] ?></li>
        <?php endforeach; ?>
    </ul>

    <!-- Pagination Links -->
    <div class='pagination'>
        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
            <a href='?page=<?= $i ?>'><?= $i ?></a>
        <?php endfor; ?>
    </div>
</body>
</html>

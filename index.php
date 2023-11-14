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

// Handle search
$searchKeyword = isset($_GET['search']) ? $_GET['search'] : '';
if (!empty($searchKeyword)) {
    $items = searchItems($searchKeyword, $offset, $itemsPerPage);
    $totalItems = getTotalSearchItems($searchKeyword);
    $totalPages = ceil($totalItems / $itemsPerPage);
} else {
    $items = getItems($offset, $itemsPerPage);
    $totalItems = getTotalItems();
    $totalPages = ceil($totalItems / $itemsPerPage);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Home Page</title>
</head>
<body>
    <h2><a href="index.php" class="home-link">Click here to go to Home Page</a></h2>

    <!-- Add Item Form -->
    <form action="" method="post">
        <label for="item_name">Add Item:</label>
        <input class="" type="text" id="item_name" name="item_name" required>
        <button type="submit" class="btn btn-primary btn-sm">Add Item</button>
    </form>

    <!-- Search Form -->
    <form action="" method="get">
        <label for="search">Search:</label>
        <input type="text" id="search" name="search" value="<?= htmlspecialchars($searchKeyword) ?>">
        <button type="submit" class="btn btn-primary btn-sm">Search</button>
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
            <a href='?page=<?= $i ?>&search=<?= urlencode($searchKeyword) ?>'><?= $i ?></a>
        <?php endfor; ?>
    </div>
</body>
</html>

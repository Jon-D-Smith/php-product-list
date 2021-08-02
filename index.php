<?php
require('database.php');

$category_id = filter_input(INPUT_GET, 'category_id', FILTER_VALIDATE_INT);
if ($category_id == NULL || $category_id == FALSE) {
    $category_id = 1;
}

$queryCategory = 'SELECT * FROM categories WHERE category_id = :category_id';
$statement1 = $db->prepare($queryCategory);
$statement1->bindValue(':category_id', $category_id);
$statement1->execute();
$category = $statement1->fetch();
$category_name = $category['categoryName'];
$statement1->closeCursor();

$queryAllCategories = 'SELECT * FROM categories ORDER BY categoryID';

$statement2 = $db->prepare($queryAllCategories);
$statement2->execute();
$categories = $statement2->fetchAll();
$statement2->closeCursor();

$queryProducts = 'SELECT * FROM products WHERE categoryID = :category_id ORDER BY productID';
$statement3 = $db->prepare($queryProducts);
$statement3->bindValue(':category_id', $category_id);
$statement3->execute();
$products = $statement3->fetchAll();
$statement3->closeCursor();
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Guitar Shop</title>
    <link rel="stylesheet" href="main.css" type="text/css">
</head>

<body>
    <main>
        <h1>Product List</h1>
        <aside>
            <h2>Categories</h2>
            <nav>
                <ul>
                    <?php foreach ($categories as $category) : ?>
                        <li>
                            <a href="?category_id=<?php echo $category['categoryID']; ?>">
                                <?php echo $category['categoryName']; ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </nav>
        </aside>
    </main>
</body>

</html>
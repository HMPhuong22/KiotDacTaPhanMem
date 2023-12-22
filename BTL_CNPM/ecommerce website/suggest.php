<?php
require_once("components/connect.php");

if (isset($_GET['search'])) {
    $search = $_GET['search'];

    $stmt = $conn->prepare("SELECT * FROM `products` WHERE name LIKE :search");
    $stmt->bindValue(':search', '%' . $search . '%', PDO::PARAM_STR);
    $stmt->execute();

    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($result) {
        echo '<ul>';
        foreach ($result as $product) {
            echo '<li>' . $product['name'] . '</li>';
        }
        echo '</ul>';
    } else {
        echo '<p class="empty">Null</p>';
    }
}
?>

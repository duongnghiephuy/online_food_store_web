<!-- Delete a product -->
<?php
session_start();

if (isset($_SESSION['manager_id'])) : ?>
    <?php

    include("../conf/db.php");
    if (isset($_GET['delete'])) {
        include("../conf/db.php");
        try {
            $id = htmlspecialchars(strip_tags($_GET['delete']));
            $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $query = 'DELETE FROM products WHERE id=' . $id . '';
            $stmt = $con->prepare($query);
            $stmt->execute();
            header('Location: read_products.php?message=deleted');
        } catch (PDOException $exception) {
            die("Error:" . $exception->getMessage());
        }
    } else {
        die("Error: ID not set.");
    }
    ?>
<?php else : ?>
    <?php
    header("Location: managerlogin.php");
    ?>
<?php endif; ?>
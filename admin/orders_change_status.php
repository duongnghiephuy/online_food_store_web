<!-- Change order status -->
<?php
include("../conf/db.php");
include("../order_class.php");
$orders = new Orders();


if (isset($_GET['finish'])) {
    $orders->change_status($_GET['finish'], 0);
} elseif (isset($_GET['fail'])) {
    $orders->change_status($_GET['fail'], -1);
}
header("Location: orders_management.php ");

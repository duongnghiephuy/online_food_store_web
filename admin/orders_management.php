<!-- Order management page -->
<?php
session_start();

if (isset($_SESSION['manager_id'])) : ?>
    <!DOCTYPE html>
    <?php
    include("header.php");

    ?>
    <?php
    include("./header.php"); ?>
    <?php
    include("../conf/db.php");
    include("../order_class.php");
    $orders = new Orders();
    $res = $orders->readAll();
    ?>
    <main>
        <h2>Manage Orders</h2>
    </main>
    <link rel="stylesheet" href="../pages/orders_management.css" <section class="nest-grid">
    <div class="row-span">
        <p><strong>ID</strong></p>
        <p><strong>CUSTOMER</strong></p>
        <p><strong>TITLE</strong></p>
        <p><strong>ADDRESS</strong></p>
        <p><strong>PHONE NUMBER</strong></p>
        <p><strong>EMAIL</strong></p>
        <p><strong>STATUS</strong></p>
    </div>
    <?php
    $num = $res->rowCount();
    if ($num > 0) : ?>
        <?php foreach ($res as $row) : ?>
            <div class="row-span">
                <p><?= $row["id"]; ?></p>
                <p><?= $row["customer"]; ?> </p>
                <p><?= $row["title"]; ?></p>
                <p><?= $row["address"]; ?> </p>
                <p><?= $row["phone_number"]; ?></p>
                <p><?= $row["email"]; ?></p>
                <p><?= $row["status"]; ?></p>
                <p><a class="button1 finish" href="<?php echo 'orders_change_status.php?finish=' . $row['id'] . '' ?>" onclick="return confirm('Are you sure you want to finish this order?') ">Finish</a></p>
                <p><a class="button1 fail" href="<?php echo 'orders_change_status.php?fail=' . $row['id'] . '' ?>" onclick="return confirm('Are you sure you want to fail this order?') ">Fail</a></p>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
    </section>
    </div>
    </body>

    </html>
<?php else : ?>
    <?php
    header("Location: managerlogin.php");
    ?>
<?php endif; ?>
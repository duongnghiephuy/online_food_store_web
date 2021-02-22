<!-- Order input page  -->

<?php
include("navbar.php")
?>
<?php
if (isset($_GET['id'])) {
    include("../conf/db.php");
    $id = intval(htmlspecialchars(strip_tags($_GET['id'])));
} else {
    $id = 0;
}
if ($_POST) {
    try {
        require("./order_class.php");
        $title = htmlspecialchars(strip_tags($_POST['title']));
        $customer = htmlspecialchars(strip_tags($_POST['customer']));
        $address = htmlspecialchars(strip_tags($_POST['address']));
        $number = htmlspecialchars(strip_tags($_POST['phone_number']));
        $email = htmlspecialchars(strip_tags($_POST['email']));

        $orders = new Orders();
        $id = $orders->add_order($title, $customer, $address, $number, $email);
        echo "<div class='alert alert-success'> ID đơn hàng của bạn: $id</div>";
        echo "<div class='alert alert-success'> Chúng tôi sẽ gọi lại để xác nhận đơn hàng $id</div>";
    } catch (Exception $exception) {
        die("Error:" . $exception->getMessage());
    }
}
?>
<link rel="stylesheet" href="./pages/orders.css">
<section>

    <form action="orders.php?id=<?php echo $row['id']; ?>" method="POST" enctype="multipart/form-data">
        <div class="form-grid">
            <fieldset class="nest_grid">
                <label for="title">Món kho</label>
                <select name="title">
                    <?php
                    include("./conf/db.php");
                    $query = 'SELECT id,title,price FROM products ORDER BY id DESC';
                    $stmt = $con->prepare($query);

                    $stmt->execute();

                    $num = $stmt->rowCount();
                    echo "Hey";
                    echo $num;
                    if ($num > 0) : ?>

                        <?php foreach ($stmt as $res) : ?>
                            <?php if ($res['id'] == $id) : ?>
                                <option selected value='<?= $res['title'] ?>'><?= $res["title"]; ?></option>
                            <?php else : ?>
                                <option value='<?= $res['title'] ?>'><?= $res["title"]; ?></option>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </select>
                <label for='customer'>Tên người đặt</label>
                <input type="text" name="customer">
                <label for='address'>Địa chỉ</label>
                <input type="text" name="address">
                <label for='phone_number'>Số điện thoại</label>
                <input type="tel" name="phone_number">
                <label for='email'>Email</label>
                <input type="email" name="email" placeholder="example@gmail.com">

            </fieldset>
            <button type="submit">Order</button>
        </div>

    </form>

</section>
<footer>
    Hai Bà Trưng, Hà Nội
</footer>
</div>
</body>

</html>
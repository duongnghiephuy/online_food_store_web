<!-- Page to read one product's detail -->
<?php
include("header.php");
?>
<link rel="stylesheet" href="../pages/product_read_one.css">
<main>
    <h2>Read one product</h2>
    <div class="box">
        <a class="button1" href="read_products.php">Back to read products</a>
    </div>
</main>

<?php
if (isset($_GET['id'])) {
    include("../conf/db.php");
    try {
        $id = htmlspecialchars(strip_tags($_GET['id']));


        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $query = 'SELECT id,title,description,price,photo FROM products WHERE id=' . $id . '';
        $stmt = $con->prepare($query);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $exception) {
        die("Error:" . $exception->getMessage());
    }
} else {
    die("Error: ID not set.");
}
?>
<section class="nest-grid">
    <div>
        <p>ID</p>
    </div>
    <div>
        <p><?php echo $row['id']; ?></p>
    </div>
    <div>
        <p>Title</p>
    </div>
    <div>
        <p><?php echo $row['title']; ?></p>
    </div>
    <div>
        <p>Description</p>
    </div>
    <div>
        <p><?php echo $row['description']; ?></p>
    </div>
    <div>
        <p>Price</p>
    </div>
    <div>
        <p><?php echo $row['price']; ?> VND</p>
    </div>
    <div>
        <p>Photo</p>
    </div>
    <div>
        <?php echo '<img class="phone-img" src="' . $row['photo'] . '">'; ?>
    </div>
</section>
</div>
</body>

</html>
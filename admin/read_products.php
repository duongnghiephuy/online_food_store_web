<!-- Page to read all products info -->
<?php
session_start();

if (isset($_SESSION['manager_id'])) : ?>
    <?php
    include("header.php");
    ?>
    <link rel="stylesheet" href="../pages/read_products.css">
    <main>
        <h2>Read products</h2>
        <?php
        if (isset($_GET['message']) && $_GET['message'] == 'deleted') {
            echo "<div class='alert alert-success'>Record was deleted.</div>";
        }   ?>
        <div class="box">
            <a href="create_products.php" class="button1">Create New Products</a>
        </div>
    </main>
    <section class="nest-grid">
        <div>
            <p><strong>ID</strong></p>
        </div>
        <div>
            <p><strong>TITLE</strong></p>
        </div>
        <div>
            <p><strong>PRICE</strong></p>
        </div>
        <div>
            <p><strong>ACTION</strong></p>
        </div>
        <?php
        include("../conf/db.php");
        $query = 'SELECT id,title,price FROM products ORDER BY id DESC';
        $stmt = $con->prepare($query);
        $stmt->execute();

        $num = $stmt->rowCount();

        if ($num > 0) : ?>
            <?php foreach ($stmt as $row) : ?>
                <div>
                    <p><?= $row["id"]; ?></p>
                </div>
                <div>
                    <p><?= $row["title"]; ?></p>
                </div>
                <div>
                    <p><?= $row["price"]; ?> VND</p>
                </div>
                <div class="action">
                    <a class="button1 read" href="<?php echo 'product_read_one.php?id=' . $row['id'] . '' ?>">Read</a>
                    <a class="button1 edit" href="<?php echo 'product_update.php?id=' . $row['id'] . '' ?>">Edit</a>
                    <a class="button1 delete" href="<?php echo 'product_delete.php?delete=' . $row['id'] . '' ?>" onclick="return confirm('Are you sure you want to delete this product?') ">Delete</a>
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
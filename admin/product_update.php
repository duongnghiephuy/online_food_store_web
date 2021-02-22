<!-- Page to update a product info -->
<?php
session_start();

if (isset($_SESSION['manager_id'])) : ?>
    <?php
    include("header.php");
    ?>
    <link rel="stylesheet" href="../pages/create_products.css">
    <main>
        <h2>Edit product</h2>
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


        if ($_POST) {


            try {

                // insert query
                $query = "UPDATE products SET title=:title, description=:description, price=:price, photo=:photo WHERE id=:id";

                // prepare query for execution
                $stmt = $con->prepare($query);

                $title = htmlspecialchars(strip_tags($_POST['title']));
                $description = htmlspecialchars(strip_tags($_POST['description']));
                $price = htmlspecialchars(strip_tags($_POST['price']));
                $photo = htmlspecialchars(strip_tags($_POST['photo-url']));
                $header = get_headers($photo, 1);

                if (strpos($header['Content-Type'], 'image/') === false) {
                    $photo = "https://cdn.mos.cms.futurecdn.net/X8ajP3firD9QzBCipfEtPk.jpg";
                }



                $stmt->bindValue(':title', $title);
                $stmt->bindValue(':description', $description);
                $stmt->bindValue(':price', $price, PDO::PARAM_INT);
                $stmt->bindValue(':photo', $photo);
                $stmt->bindValue(':id', $row['id']);


                if ($stmt->execute()) {
                    echo "<div class='alert alert-success'>Record was saved.</div>";
                } else {
                    echo "<div class='alert alert-danger'>Unable to save record.</div>";
                }
            } catch (PDOException $exception) {
                die("Error:" . $exception->getMessage());
            }
        }
        ?>
        <div class="box">
            <a class="button1" href="read_products.php">Back to read products<a>
        </div>
    </main>
    <form action="product_update.php?id=<?php echo $row['id']; ?>" method="post" enctype="multipart/form-data">
        <section>
            <label for="title">Title</label>
            <input name="title" type="text" value="<?php echo $row['title']; ?>">
            <label for="description">Description</label>
            <textarea name="description"><?php echo $row['description']; ?></textarea>
            <label for="price">Price</label>
            <input name="price" type="text" value="<?php echo $row['price']; ?>">
            <label for="photo-url">Photo URL</label>
            <input name="photo-url" type="url" value="<?php echo $row['photo']; ?>">

        </section>
        <button type="submit">Edit</button>
    </form>

    </div>

    </body>

    </html>
<?php else : ?>
    <?php
    header("Location: managerlogin.php");
    ?>
<?php endif; ?>
<!-- Add manager account

Require manager account to access -->
<?php
session_start();

if (isset($_SESSION['manager_id'])) : ?>
    <?php
    include("header.php");
    ?>
    <link rel="stylesheet" href="../pages/create_products.css">
    <main>
        <h2>Create products</h2>
        <?php
        if ($_POST) {

            include("../conf/db.php");
            try {

                // insert query
                $query = "INSERT INTO products SET title=:title, description=:description, price=:price, photo=:photo, created=:created";

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

                $created = date("Y-m-d H:i:s");
                $stmt->bindValue(':created', $created);
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

    <!-- Input form for creating product -->
    <form action="create_products.php" method="post" enctype="multipart/form-data">
        <section>
            <label for="title">Title</label>
            <input name="title" type="text">
            <label for="description">Description</label>
            <textarea name="description"></textarea>
            <label for="price">Price</label>
            <input name="price" type="text">
            <label for="photo-url">Photo URL</label>
            <input name="photo-url" type="url" placeholder="https://example.jpg">
            <div></div>

        </section>
        <button type="submit">Create</button>

    </form>

    </div>

    </body>

    </html>
<?php else : ?>
    <?php
    header("Location: managerlogin.php");
    ?>
<?php endif; ?>
<!-- Add manager account

Require manager account to access -->
<?php
session_start();

if (isset($_SESSION['manager_id'])) : ?>


    <!DOCTYPE html>
    <?php
    include("header.php");

    ?>
    <link rel="stylesheet" href="../pages/managerlogin.css">
    <main>
        <h2>Add manager</h2>
        <?php

        if ($_POST) {


            include("../conf/db.php");
            include("./manager_accounts.php");

            try {

                if (isset($_POST['managername']) && isset($_POST['password'])) {
                    $name = htmlspecialchars(strip_tags($_POST['managername']));
                    $password = htmlspecialchars(strip_tags($_POST['password']));
                }
                $manager = new Manager();
                $id = $manager->addManager($name, $password);

                echo "<div class='alert alert-success'> New manager ID is $id</div>";
            } catch (Exception $exception) {
                die("Error:" . $exception->getMessage());
            }
        }
        ?>

        <!-- Form input for new manager account -->
    </main>
    <form action="./add_manager.php" method="post" enctype="multipart/form-data">
        <section>
            <label class="AdName" for="managername">New Manager Name</label>
            <input class="AdName" name="managername" type="text" placeholder="Enter new manger name" required>
            <label class="AdPass" for="password">Password</label>
            <input class="AdPass" name="password" type="password" placeholder="Enter password" required>

        </section>
        <button type="submit">Add Manager</button>

    </form>

    </div>

    </body>

    </html>
<?php else : ?>
    <?php
    header("Location: managerlogin.php");
    ?>
<?php endif; ?>
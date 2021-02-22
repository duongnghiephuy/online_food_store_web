<!-- Manager login page -->

<?php
include("header.php");
?>
<link rel="stylesheet" href="../pages/managerlogin.css">
<main>
    <h2>Manager Login</h2>
    <?php
    if ($_POST) {


        include("../conf/db.php");
        include("./manager_accounts.php");



        try {

            if (isset($_POST['managername']) && isset($_POST['password'])) {
                $name = htmlspecialchars(strip_tags($_POST['managername']));
                $password = htmlspecialchars(strip_tags($_POST['password']));
            }
            echo $name;
            $manager = new Manager();
            if ($manager->login($name, $password)) {
                header("Location: dashboard.php ");
            }
        } catch (Exception $exception) {
            die("Error:" . $exception->getMessage());
        }
    }
    ?>
    <!-- 
Login form -->
</main>
<form action="./managerlogin.php" method="post" enctype="multipart/form-data">
    <section>
        <label class="AdName" for="managername">Manager Name</label>
        <input class="AdName" name="managername" type="text" placeholder="Enter manger name" required>
        <label class="AdPass" for="password">Password</label>
        <input class="AdPass" name="password" type="password" placeholder="Enter password" required>

    </section>
    <button type="submit">Login</button>

</form>

</div>

</body>

</html>
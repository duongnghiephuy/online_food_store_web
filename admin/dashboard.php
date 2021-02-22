<!-- Add manager account

Require manager account to access -->
<?php
session_start();

if (isset($_SESSION['manager_id'])) : ?>
<?php else : ?>
    <?php
    header("Location: managerlogin.php");
    ?>
<?php endif; ?>
<?php
include("header.php");
?>
<main>
    <h2>
        Welcome to Admin Panel
    </h2>
</main>
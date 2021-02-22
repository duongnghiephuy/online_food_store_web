<!-- Home page -->

<?php
include("navbar.php")
?>
<link rel="stylesheet" href="./pages/index.css">
<section>
  <!-- Items for order -->

  <ul class="grid-list">
    <?php
    include("conf/db.php");
    $query = 'SELECT id,title,description,price,photo FROM products ORDER BY id DESC';
    $stmt = $con->prepare($query);
    $stmt->execute();

    $num = $stmt->rowCount();

    if ($num > 0) : ?>
      <?php foreach ($stmt as $row) : ?>
        <li class="item">
          <figure class="phone-item">
            <?php echo '<img class="ca-img" src="' . $row['photo'] . '">'; ?>

            <caption>
              <p class="title"><?php echo $row['title']; ?></p>
              <p><?php echo $row['description']; ?></p>
              <p><?php echo $row['price']; ?> VND</p>
              <p>
                <a class="button1" href="<?php echo 'details.php?id=' . $row['id'] . ''; ?>">Đọc thêm</a>
                <a class="button1" href="<?php echo 'orders.php?id=' . $row['id'] . ''; ?>">Đặt món</a>
              </p>
            </caption>
          </figure>
        </li>

      <?php endforeach; ?>

    <?php endif; ?>
  </ul>
</section>
</div>
<footer>
  Hai Bà Trưng, Hà Nội
</footer>
</body>

</html>
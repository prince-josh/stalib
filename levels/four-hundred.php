<?php include "../admin/conn.php";?>

<?php
$sel = "select * from books where level = '400' order by id desc";
$runsel = mysqli_query($con, $sel);
$count = mysqli_num_rows($runsel);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Libraries CSS Files -->
    <link href="../lib/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="../lib/animate/animate.min.css" rel="stylesheet">
    <link href="../lib/ionicons/css/ionicons.min.css" rel="stylesheet">
    <link href="../lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="../lib/lightbox/css/lightbox.min.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
    <!--custom css-->
    <link rel="stylesheet" href="../css/style.css">
    <title>400lv - STALib</title>
</head>
<body>
    <header id='page-top'>
    <?php include "../header.level.php";?>
      </header> 
      <!--book list-->
      <section id="book-list" class="container">
        <?php 
        if ($count == 0) {
            echo "<center> <h3 class='mt-5'> No materials available for this level yet </h3></center>";
        }
        ?>
        <?php
        while ($row = mysqli_fetch_assoc($runsel)) {
            $id = $row['id'];
            $title = $row['title'];
            $code  = $row['course_code'];
            $level = $row['level'];
            $material = $row['material'];
            $desc = $row['description'];
            $dp = $row['dp'];
            $updated_at = $row['updated_at'];
            $created_at = $row['created_at'];
            ?>
            
        <div class="book-item">
          <a href="../details?id=<?php echo $id;?>">
            <?php if (empty($dp)) {
            echo "<img src='../img/default.png' alt=''>";
          }else {
            echo "<img src='../admin/assets/images/$dp' alt=''>";
          }
            ?>
            <div class="book-details">
              <div class="book-name"><?php echo $title; ?></div>
              <div class=""><span><?php echo $level. " level"; ?></span> * <span><?php echo $code; ?></span> * <span>
              <?php
                $bytes = filesize("../admin/materials/$material");
                if ($bytes >= 1073741824)
                {
                    echo $bytes = number_format($bytes / 1073741824, 2) . ' GB';
                }
                elseif ($bytes >= 1048576)
                {
                  echo $bytes = number_format($bytes / 1048576, 2) . ' MB';
                }
                elseif ($bytes >= 1024)
                {
                  echo $bytes = number_format($bytes / 1024, 2) . ' KB';
                }
                elseif ($bytes > 1)
                {
                  echo $bytes = $bytes . ' bytes';
                }
                elseif ($bytes == 1)
                {
                  echo $bytes = $bytes . ' byte';
                }
                else
                {
                    $bytes = '0 bytes';
                }
                ?>
              </i></span></div>
              <div class="book-description">
                <?php
              if (!empty($desc)) {
                  echo $desc;
                }else{
                  echo "No description given";
                }
              ?> </div>
            </a>
            </div>
        </div>
        <?php } ?>
      </section>
      <!--book list end-->
     <!-- JavaScript Libraries -->
<script src="js/jquery-1.10.2.js"></script>
<script src="../lib/jquery/jquery.min.js"></script>
<script src="../lib/jquery/jquery-migrate.min.js"></script>
<script src="../lib/popper/popper.min.js"></script>
<script src="../lib/bootstrap/js/bootstrap.min.js"></script>
<script src="../lib/easing/easing.min.js"></script>
<script src="../lib/counterup/jquery.waypoints.min.js"></script>
<script src="../lib/counterup/jquery.counterup.js"></script>
<script src="../lib/owlcarousel/owl.carousel.min.js"></script>
<script src="../lib/lightbox/js/lightbox.min.js"></script>
<script src="../lib/typed/typed.min.js"></script>
</body>
</html>
<?php
  include "admin/conn.php";
  
  ini_set("display_errors", 1);
?>

<?php
if (!isset($_GET['id'])) {
    header("location: index.php");
}else{
    $id = $_GET['id'];
    $sel = "select * from books where id = '$id'";
    $run = mysqli_query($con, $sel);
    $row = mysqli_fetch_assoc($run);
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
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Libraries CSS Files -->
    <link href="lib/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/ionicons/css/ionicons.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/lightbox/css/lightbox.min.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
    <!--custom css-->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/details.css">
    <title><?php echo $title; ?> - STALib</title>
</head>
<body>
    <header id='page-top'>
    <?php include "header.php";?>    
    </header> 
      <!--book details-->
      <section id="single-book-details" class="container">
        <div class="single-book-item">
        <?php if (empty($dp)) {
            echo "<img src='img/default.png' alt=''>";
          }else {
            echo "<img src='admin/assets/images/$dp' alt=''>";
          }
            ?>
            <div class="book-details">
              <div class="book-name"><?php echo $title; ?></div>
              <div class=""><span><?php echo $level. " level"; ?></span> * <span><?php echo $code; ?></span> * <span>
                <?php
                $bytes = filesize("admin/materials/$material");
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
              </span></div>
              <div class="book-description">
                <?php 
                  if (!empty($desc)) {
                    echo $desc;
                  }else{
                    echo "No description given";
                  }
                ?>  
              </div>
              <div class="actions">
                <!-- <form action="" method="post">
                <div class="preview"><button download class="btn" name="preview">preview</button></div>
                <?php
                // if (isset($_POST['preview'])) {
                //   include "viewpdf.php";
                //   viewPDF($material);
                // }
                ?>
                </form> -->
                <a href="admin/materials/<?php echo $material; ?>" download><div><button class="btn btn-primary">Download</button></div></a>
                <!-- <div class="download"><button ></button></div> -->
              </div>
            </div>
        </div>
      </section>
      <!--book details end-->
      <!--book list-->
      <section id="book-list" class="container">
        <h3>Similar Books</h3>
        <?php 
        //select similar books
        $sql = "SELECT * FROM books WHERE level = '$level' AND id != '$id'";
        $runsql = mysqli_query($con, $sql);
        while ($result = mysqli_fetch_assoc($runsql)) {
            $id = $result['id'];
            $title = $result['title'];
            $code  = $result['course_code'];
            $level = $result['level'];
            $material = $result['material'];
            $desc = $result['description'];
            $dp = $result['dp'];
            $updated_at = $result['updated_at'];
            $created_at = $result['created_at'];
    ?>
        <div class="book-item">
          <a href="details.php?id=<?php echo $id;?>">
          <?php if (empty($dp)) {
            echo "<img src='img/default.png' alt=''>";
          }else {
            echo "<img src='admin/assets/images/$dp' alt=''>";
          }
            ?>
            <div class="book-details">
              <div class="book-name"><?php echo $title; ?></div>
              <div class=""><span><?php echo $level. " level"; ?></span> * <span><?php echo $code; ?></span> * <span>
              <?php
                $bytes = filesize("admin/materials/$material");
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
              </div>
              <div class="book-description"><?php 
                if (!empty($desc)) {
                  echo $desc;
                }else{
                  echo "No description given";
                }
              ?> </div>
            </a>
            </div>
            
        </div>
        <?php }?>
      </section>
      <!--book list end-->
     <!-- JavaScript Libraries -->
<script src="js/jquery-1.10.2.js"></script>
<script src="lib/jquery/jquery.min.js"></script>
<script src="lib/jquery/jquery-migrate.min.js"></script>
<script src="lib/popper/popper.min.js"></script>
<script src="lib/bootstrap/js/bootstrap.min.js"></script>
<script src="lib/easing/easing.min.js"></script>
<script src="lib/counterup/jquery.waypoints.min.js"></script>
<script src="lib/counterup/jquery.counterup.js"></script>
<script src="lib/owlcarousel/owl.carousel.min.js"></script>
<script src="lib/lightbox/js/lightbox.min.js"></script>
<script src="lib/typed/typed.min.js"></script>
</body>
</html>
<?php }?>
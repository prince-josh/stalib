<?php 
        // include "admin/conn.php";
        function viewPDF($x){
            header("content-type: application/pdf");
            readfile("admin/materials/$x");
        }
        // if (isset($_GET['id'])) {
        //     $id = $_GET['id'];
        //     $sel = "select * from books where id = '$id'";
        //     $run = mysqli_query($con, $sel);
        //     if ($run) {
        //         echo "<script> alert('success') </script>";
        //     }else{
        //         echo "<script> alert('failed') </script>";
        //     }

        //     $row = mysqli_fetch_assoc($run);
        //     $material = $row['material'];
        //     header("content-type: application/pdf");
        //     readfile("admin/materials/$material)");
        // }
?>  
<?php
include 'config.php';

if (isset($_GET['ma_nv'])) {
    $ma_nv = $_GET['ma_nv'];
    $sql = "DELETE FROM nhanvien WHERE Ma_NV='$ma_nv'";
    if (mysqli_query($conn, $sql)) {
        header("location: list_products.php");
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
    }
}

mysqli_close($conn);

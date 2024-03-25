<?php
$conn = mysqli_connect("localhost", "root", "", "kt");

if (!$conn) {
    echo "Database not connected" . mysqli_connect_error();
}

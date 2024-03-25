<!DOCTYPE html>
<html lang="en">
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" />

<!-- jQuery library -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>

<!-- Popper JS -->
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách nhân viên</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }

        img {
            display: block;
            margin: 0 auto;
        }

        .pagination {
            text-align: center;
            margin-top: 20px;
        }

        .pagination a {
            padding: 8px 16px;
            text-decoration: none;
            color: #000;
            background-color: #f2f2f2;
            border: 1px solid #ddd;
            border-radius: 5px;
            margin: 0 5px;
        }

        .pagination a.active {
            background-color: #4CAF50;
            color: white;
        }

        .pagination a:hover:not(.active) {
            background-color: #ddd;
        }
    </style>
</head>

<body>
    <h2>List Nhan Vien</h2>
    <table>
        <tr>
            <th>Ma NV</th>
            <th>Ten NV</th>
            <th>Phai</th>
            <th>Noi sinh</th>
            <th>Ma phong</th>
            <th>Luong</th>
            <th>Action</th>
        </tr>
        <?php
        include 'config.php';

        // Number of records per page
        $records_per_page = 5;

        // Get the current page number from the URL, default to page 1
        $current_page = isset($_GET['page']) ? $_GET['page'] : 1;

        // Calculate the starting record for the current page
        $start_from = ($current_page - 1) * $records_per_page;

        // Query to fetch records for the current page
        $sql = "SELECT * FROM nhanvien LIMIT $start_from, $records_per_page";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row["Ma_NV"] . "</td>";
                echo "<td>" . $row["Ten_NV"] . "</td>";
                echo "<td>";
                if ($row["Phai"] == "NAM") {
                    echo "<img src='img/nam.png' alt='Nam' width='50'>";
                } else {
                    echo "<img src='img/nu.png' alt='Nu' width='50'>";
                }
                echo "</td>";
                echo "<td>" . $row["Noi_Sinh"] . "</td>";
                echo "<td>" . $row["Ma_Phong"] . "</td>";
                echo "<td>" . $row["Luong"] . "</td>";
                echo "<td><a href='delete.php?ma_nv=" . $row["Ma_NV"] . "'>Delete</a> | <a href='edit.php?ma_nv=" . $row["Ma_NV"] . "'>Edit</a></td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='7'>0 results</td></tr>";
        }

        mysqli_close($conn);
        ?>
    </table>

    <!-- Pagination -->
    <div class="pagination">
        <?php
        if (isset($total_pages)) {
            for ($i = 1; $i <= $total_pages; $i++) {
                echo "<a href='?page=$i'" . ($current_page == $i ? " class='active'" : "") . ">$i</a> ";
            }
        }
        ?>
    </div>
    <a href="add.php" class="btn btn-outline-success">Thêm</a>
</body>

</html>
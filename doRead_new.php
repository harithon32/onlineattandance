<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Read New Attendance</title>
</head>
<body>
<?php
require 'connectdb.php';

$attendance_name = "";

if (isset($_POST['read'])) {
    $sql = "DELETE FROM `read_admin` WHERE 1";
    $result = mysqli_query($conn, $sql);
    if (!$result) {
       echo "delete failed: " . mysqli_error($conn);
    }
}

if (isset($_POST['attendance_name'])) {
    $attendance_name = $_POST['attendance_name'];
}

$errors = array(); // Initialize an array to store validation errors

if (!isset($_POST['end']))

if (isset($_POST['btnEnter'])) {
    $stambuk = $_POST['stambuk'];

    if (empty($stambuk)) {
        $errors[] = "Stambuk cannot be empty.";
    } else {
        // Check if the data exists in datasantri
        $check_sql = "SELECT COUNT(*) FROM `datasantri` WHERE `Stambuk` = $stambuk";
        $check_result = mysqli_query($conn, $check_sql);
        $count = mysqli_fetch_row($check_result)[0];

        if ($count == 0) {
            $errors[] = "No data found in datasantri for Stambuk $stambuk.";
        } else {
            // Check if the data already exists in read_admin
            $check_sql = "SELECT COUNT(*) FROM `read_admin` WHERE `stambuk` = '$stambuk'";
            $check_result = mysqli_query($conn, $check_sql);
            $count = mysqli_fetch_row($check_result)[0];

            if ($count == 0) {
                // Data does not exist, insert it
                $sql = "SELECT * FROM `datasantri` WHERE `Stambuk` = $stambuk";
                $result = mysqli_query($conn, $sql);
                if ($result) {
                    while ($row = mysqli_fetch_row($result)) {
                        $stambuk = $row[0];
                        $nama = $row[1];
                        $kelas = $row[2];
                        $daerah = $row[3];
                        $konsulat = $row[4];
                        $rayon = $row[5];

                        $sql = "INSERT INTO read_admin VALUES ('$stambuk','$nama','$kelas','$daerah','$konsulat','$rayon')";
                        mysqli_query($conn, $sql);
                    }
                    mysqli_free_result($result);
                } else {
                    die("Query failed: " . mysqli_error($conn));
                }
            } else {
                $errors[] = "Data with Stambuk $stambuk already exists in read_admin.";
            }
        }
    }
}
?>

<!-- HTML Form -->
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- ... (head section) ... -->
</head>
<body>
    <h2>Read New Attendance | <?php echo $attendance_name; ?></h2>
    <br/>

    <!-- Display validation errors, if any -->
    <?php
    if (!empty($errors)) {
        echo "<ul>";
        foreach ($errors as $error) {
            echo "<li>$error</li>";
        }
        echo "</ul>";
    }
    ?>

    <table border="1">
        <tr>
            <th>No</th>
            <th>Stambuk</th>
            <th>Nama</th>
            <th>Kelas</th>
            <th>Daerah</th>
            <th>Konsulat</th>
            <th>Rayon</th>
        </tr>
        <?php 
        $no = 1;
        $sql = "SELECT * FROM `read_admin`";
        $result = mysqli_query($conn, $sql);
        while($row = mysqli_fetch_row($result)){
            ?>
            <tr>
                <td><?php echo $no++; ?></td>
                <td><?php echo $row[0]; ?></td>
                <td><?php echo $row[1]; ?></td>
                <td><?php echo $row[2]; ?></td>
                <td><?php echo $row[3]; ?></td>
                <td><?php echo $row[4]; ?></td>
                <td><?php echo $row[5]; ?></td>
            </tr>
            <?php 
        }
        ?>
    </table>
    
    <br>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <input type="hidden" name="attendance_name" value="<?php echo $attendance_name; ?>">
        <table>
            <tr>            
                <td>Stambuk</td>
                <td><input type="text" name="stambuk"></td>
                <td><input type="submit" value="Enter" name="btnEnter"></td>
            </tr>
            <tr>
                <td><input type="submit" name="end" value="End"></td>
            </tr>       
        </table>
    </form>
</body>
</html>

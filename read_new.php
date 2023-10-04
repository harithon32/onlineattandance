<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Read New Attendance</title>
</head>
<body>
    <h2>Read New Attendance</h2>
    <form action="doRead_new.php" method="POST">
        <label for="attendance_name">Attendance Name:</label>
        <input type="text" name="attendance_name" required><br>
        <input type="submit" value="Read" name="read">
    </form>
</body>
</html>
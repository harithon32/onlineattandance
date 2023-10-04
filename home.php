<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>
<body>
	<h2>Home Page</h2>
	<br/>
	<table border="1">
		<tr>
            <th>No</th>
			<th>Id</th>
			<th>Name</th>
            <th>File</th>
			<th>Datetime</th>
		</tr>
		<?php 
		require 'connectdb.php';
		$no = 1;
		$sql = "select * from attendance_admin";
		$data = mysqli_query($conn, $sql);
		while($d = mysqli_fetch_array($data)){
			?>
			<tr>
				<td><?php echo $no++; ?></td>
                <td><?php echo $d['id']; ?></td>
				<td><?php echo $d['name']; ?></td>
                <td><?php echo $d['file']; ?></td>
				<td><?php echo $d['datetime']; ?></td>
			</tr>
			<?php 
		}
		?>
	</table>
    <br>
    <a href="read_new.php">Read New Attendance</a>
</body>
</html>

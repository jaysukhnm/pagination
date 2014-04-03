<?php
include('database_connection.php');


if (isset($_POST['lastmsg']) && is_numeric($_POST['lastmsg'])) {
	$lastmsg = $_POST['lastmsg'];
	$query = "select * from members where id >'$lastmsg' order by id asc limit 10";
	$result = mysqli_query($dbc, $query);


	while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
		$msg_id = $row['id'];
		$message = $row['name'];
		?>
			<div id="<?php echo $msg_id; ?>" class="message_box" > 
			<?php echo $msg_id."--".$message."<br/><br/>"; ?>
			</div> 
		<?php
	}
}
	?>

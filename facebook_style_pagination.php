<?php
include('database_connection.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<title>An Alternative to pagination : Facebook Style</title>
		<script type="text/javascript" src="jquery-1.3.2.min.js"></script>
		<script type="text/javascript">
			$(function() {
				function last_msg_funtion() {
					var last_msg_id = $(".message_box:last").attr("id");
					if (last_msg_id != 'end') {
						$.ajax({
							type: "POST",
							url: "facebook_style_ajax_more.php",
							data: "lastmsg=" + last_msg_id,
							beforeSend: function() {
								$('a.load_more').append('<img src="facebook_style_loader.gif" />');
							},
							success: function(html) {
								$(".facebook_style").remove();
								$("ol#updates").append(html);
							}
						});
					}
					return false;
				}
				$(window).scroll(function() {
					if ($(window).scrollTop() == $(document).height() - $(window).height()) {
						last_msg_funtion();
					}
				});

			});
		</script>	
	</head>
	<body>
		<div id='container'>
			<ol class="row" id="updates">
				<?php
				$query = "select * from members ORDER BY id ASC LIMIT 30";
				$result = mysqli_query($dbc, $query);
				while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
					$msg_id = $row['id'];
					$message = $row['name'];
					?>
					<div id="<?php echo $msg_id; ?>" class="message_box" > 
						<?php echo $msg_id . "--" . $message . "<br/><br/>"; ?>
					</div> 
				<?php } ?>
			</ol>

		</div>
	</body>
</html>

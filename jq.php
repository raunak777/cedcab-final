<!DOCTYPE html>
<html>
<head>
	<title></title>
	<?php include 'boot.php'; ?>
	<link href="https://cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css" rel="stylesheet" />
	<!-- <script src="https://code.jquery.com/jquery-2.1.4.min.js"></script> -->
	<script src="https://cdn.datatables.net/1.10.9/js/jquery.dataTables.min.js"></script>
</head>
<body>
	<table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
		<script type="text/javascript">
			$(document).ready(function() {
				$.ajax({
					type: "POST",
					url: "jsontest.php",
					dataType: "JSON",
					success: function(data)
					{
						$.each(data, function(key, value) {
							if (value.status==0) {
								value.status="pending";
							}
							
							var dataObject = {
								columns: [{
									title: "id"
								}, {
									title: "pickup"
								}],
								data: [
								[value.ride_id, value.pickup],
								]
							};
							var columns = [];
							$('#example').dataTable({
								"data": dataObject.data,
								"columns": dataObject.columns

							});
					});
			}
		});
		});
	</script>
</body>
</html>
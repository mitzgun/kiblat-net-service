<!DOCTYPE html>
<html lang="en">
	<head>

		<meta charset="UTF-8" />
		<meta name="description" content="">
		<meta name="author" content="">
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<link rel="stylesheet" href="<?php echo base_url(); ?>bootstrap/css/bootstrap.min.css" />
		<link rel="stylesheet" href="<?php echo base_url(); ?>bootstrap/css/bootstrap-responsive.min.css" />
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	</head>
	<body>
		<div class="navbar">
			<div class="navbar-inner">
				<a class="brand" href="#">Kiblat Tambah Ads</a>

			</div>
		</div>
		<div class="container">
			<?php echo !empty($error); ?>

			<?php echo form_open_multipart('ads/do_upload'); ?>

			<input type="file" name="userfile" size="20" />

			<br />
			<br />

			<input type="submit" value="upload" />

			</form>
		</div>
		<script src="<?php echo base_url(); ?>/bootstrap/js/jquery.min.js"></script>
		<script src="<?php echo base_url(); ?>/bootstrap/js/bootstrap.min.js"></script>
		<script src="<?php echo base_url(); ?>/bootstrap/js/jquery.min.js"></script>

	</body>
</html>

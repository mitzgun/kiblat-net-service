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
				<a class="brand" href="#">Kiblat Upload Ads</a>

			</div>
		</div>
		<?php //print_r($data);?>
		<div class="container">
			<br>
			<div class="container">
				<a class="btn btn-success" href="<?php echo base_url()."index.php/ads/tambah" ?>"><i class="icon-pencil"></i> Tambah Iklan</a>
				
			</div>
			</br>
			<div style="clear:both; width:100%;"></div>
			<section>
				<table class="table table-condensed table-hover table-bordered">
					<thead>
						<tr>
							<th>No.</th>
							<th>Iklan</th>
							<th>Image</th>
							<th>Action</th>
							
						</tr>
					</thead>
					<tbody>
					<?php foreach ($data as $key => $d) { ?>
						<tr>
							<td><?php echo $key+1 ?></td>
							<td><?php echo $d['name'] ?></td>
							<td><img height="100" width="200" src="<?php echo $d['url'] ?>"/></td>
							<td><a href="<?php echo base_url().'index.php/ads/hapus_ads?url=ads/'.$d['name'] ?>" onclick="return confirm('Anda yakin ?');"> <i class="icon-trash"></i> Hapus Iklan</a></td>
							
						</tr>
					<?php }?>
						
						
					</tbody>
				</table>
				<div class="pagination pagination-centered" style="height: 5px"></div>
			</section>
		</div>
		<script src="<?php echo base_url(); ?>/bootstrap/js/jquery.min.js"></script>
		<script src="<?php echo base_url(); ?>/bootstrap/js/bootstrap.min.js"></script>
		<script src="<?php echo base_url(); ?>/bootstrap/js/jquery.min.js"></script>

	</body>
</html>

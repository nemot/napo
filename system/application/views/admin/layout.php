<html>
	<head>
		<title>Xambox</title>
	</head>
	<body>
		<ul>
			<li>
				<a href="<?=base_url()?>admin/"> Index </a>
			</li>
			<li>
				<a href="<?=base_url()?>admin/categories/"> Categories </a>
			</li>
		</ul>
		<?
			if (isset($content)) {
				$this->load->view($content);
			}
		?>
	</body>
</html>
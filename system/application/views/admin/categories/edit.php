<?= validation_errors()?>
<form action="" method="post">
	<dt>Name</dt>
		<tt> <input name="name" type="text" value="<?=set_value('name', $category['name'])?>"> </tt>
	<input type="submit" value="Save">
</form>

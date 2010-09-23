<?= validation_errors()?>
<form action="" method="post" enctype="multipart/form-data">
	<dt>Name</dt>
		<tt> <input name="name" type="text"> </tt>
	<dt>Teaser</dt>
		<tt>
			<textarea name="teaser"></textarea>
		</tt>
	<dt>Description</dt>
		<tt>
			<textarea name="description"></textarea>
		</tt>
	<dt>Image</dt>
		<tt>
			<input type="file" name="image">
		</tt>
	<input type="submit" value="add">
</form>

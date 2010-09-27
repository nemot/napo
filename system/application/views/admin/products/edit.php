<?= validation_errors()?>
<form action="" method="post" enctype="multipart/form-data">
	<dt>Name</dt>
		<tt> <input name="name" type="text" value="<?= set_value('name', $product['name'])?>"> </tt>
	<dt>Teaser</dt>
		<tt>
			<textarea name="teaser"><?= set_value('teaser', $product['teaser'])?></textarea>
		</tt>
	<dt>Description</dt>
		<tt>
			<textarea name="description"><?= set_value('description', $product['description'])?></textarea>
		</tt>
	<dt>Current image</dt>
		<tt>
			<img src='/images/products/thumbs/<?=$product['preview']?>'>
		</tt>
	<dt>Change image</dt>
		<tt>
			<input type="file" name="image">
		</tt>
	<input type="submit" value="save">
</form>

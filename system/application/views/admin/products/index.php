<a href="<?=  base_url()?>admin/products/add">Add</a>
<p>
	<?= $this->session->flashdata('notice');?>
</p>

<table width="50%" border="1">
	<tr>
		<th>№</th>
		<th>Image</th>
		<th>Name</th>
		<th>Teaser</th>
		<th>Description</th>
		<th>Actions</th>
	</tr>
<?
$i = 1;
foreach ($products as $row) { ?>
	<tr>
		<td><?=$i++?></td>
		<td>
			<img src="/images/products/thumbs/<?=$row['preview']?>">
		</td>
		<td><?=$row['name']?></td>
		<td><?=$row['teaser']?></td>
		<td><?=$row['description']?></td>
		<td>
			<a href="<?=  base_url()?>admin/products/gallery?id=<?=$row['id']?>">Gallery</a>
			<a href="<?=  base_url()?>admin/products/edit?id=<?=$row['id']?>">Edit</a>
			<a href="<?=  base_url()?>admin/products/delete?id=<?=$row['id']?>">Delete</a>
		</td>
	</tr>
<?
}
?>
</table>
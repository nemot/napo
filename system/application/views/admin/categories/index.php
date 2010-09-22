<a href="<?=  base_url()?>admin/categories/add">Add</a>
<p>
	<?= $this->session->flashdata('notice');?>
</p>

<table width="50%" border="1">
	<tr>
		<th>№</th>
		<th>Name</th>
		<th>Actions</th>
	</tr>
<?
$i = 1;
foreach ($categories as $cat) { ?>
	<tr>
		<td><?=$i++?></td>
		<td><?=$cat['name']?></td>
		<td>
			<a href="<?=  base_url()?>admin/categories/edit?id=<?=$cat['id']?>">Edit</a>
			<a href="<?=  base_url()?>admin/categories/delete?id=<?=$cat['id']?>">Delete</a>
		</td>
	</tr>
<?
}
?>
</table>


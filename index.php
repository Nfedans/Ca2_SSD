<?php
require_once('database.php');

// Get category ID
if (!isset($creation_id)) {
$creation_id = filter_input(INPUT_GET, 'creation_id', 
FILTER_VALIDATE_INT);
if ($creation_id == NULL || $creation_id == FALSE) {
$creation_id = 1;
}
}

// Get name for current category
$queryCreation = "SELECT * FROM creations
WHERE creationID = :creation_id";
$statement1 = $db->prepare($queryCreation);
$statement1->bindValue(':creation_id', $creation_id);
$statement1->execute();
$creation = $statement1->fetch();
$statement1->closeCursor();
$creation_name = $creation['creationName'];

// Get all categories
$queryAllCreations = 'SELECT * FROM creations
ORDER BY creationID';
$statement2 = $db->prepare($queryAllCreations);
$statement2->execute();
$creations = $statement2->fetchAll();
$statement2->closeCursor();

// Get records for selected category
$queryRecords = "SELECT * FROM records
WHERE creationID = :creation_id
ORDER BY recordID";
$statement3 = $db->prepare($queryRecords);
$statement3->bindValue(':creation_id', $creation_id);
$statement3->execute();
$records = $statement3->fetchAll();
$statement3->closeCursor();
?>
<div class="container">
<?php
include('includes/header.php');
?>

<aside>
<!-- display a list of categories -->
<h2>Selection of creations</h2>
<nav>
<ul>
<?php foreach ($creations as $creation) : ?>
<li><a href=".?creation_id=<?php echo $creation['creationID']; ?>">
<?php echo $creation['creationName']; ?>
</a>
</li>
<?php endforeach; ?>
</ul>
</nav>          
</aside>

<section>
<!-- display a table of records -->
<h2><?php echo $creation_name; ?></h2>
<table>
<tr>
<th>Image</th>
<th>Name</th>
<th>Description</th>
<th>Difficulty</th>
<th>Delete</th>
<th>Edit</th>
</tr>
<?php foreach ($records as $record) : ?>
<tr>
<td><img src="image_uploads/<?php echo $record['image']; ?>" width="100px" height="100px" /></td>
<td><?php echo $record['name']; ?></td>
<td><?php echo $record['description']; ?></td>
<td class="right"><?php echo $record['difficulty']; ?></td>
<td><form action="delete_record.php" method="post"
id="delete_record_form">
<input type="hidden" name="record_id"
value="<?php echo $record['recordID']; ?>">
<input type="hidden" name="creation_id"
value="<?php echo $record['creationID']; ?>">
<input type="submit" value="Delete">
</form></td>
<td><form action="edit_record_form.php" method="post"
id="delete_record_form">
<input type="hidden" name="record_id"
value="<?php echo $record['recordID']; ?>">
<input type="hidden" name="creation_id"
value="<?php echo $record['creationID']; ?>">
<input type="submit" value="Edit">
</form></td>
</tr>
<?php endforeach; ?>
</table>
<p><a href="add_record_form.php">Add Record</a></p>
<p><a href="category_list.php">Manage Creations</a></p>
</section>
<?php
include('includes/footer.php');
?>
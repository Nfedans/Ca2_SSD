<?php
require('database.php');
$query = 'SELECT *
          FROM creations
          ORDER BY creationID';
$statement = $db->prepare($query);
$statement->execute();
$categories = $statement->fetchAll();
$statement->closeCursor();
?>
<!-- the head section -->
 <div class="container">
<?php
include('includes/header.php');
?>
        <h1>Add Record</h1>
        <form action="add_record.php" method="post" enctype="multipart/form-data"
              id="add_record_form">

            <label>Creation:</label>
            <select name="creation_id">
            <?php foreach ($creations as $creation) : ?>
                <option value="<?php echo $creation['creationID']; ?>">
                    <?php echo $creation['creationName']; ?>
                </option>
            <?php endforeach; ?>
            </select>
            <br>
            <label>Name:</label>
            <input type="input" name="name" required>
            <br>

            <label>Difficulty:</label>
            <input type="input" name="difficulty" placeholder="0 - 5" pattern="[0-5]">
            <br>        
            
            <label>Image:</label>
            <input type="file" name="image" accept="image/*" />
            <br>
            
            <label>&nbsp;</label>
            <input type="submit" value="Add Record">
            <br>
        </form>
        <p><a href="index.php">View Homepage</a></p>
    <?php
include('includes/footer.php');
?>
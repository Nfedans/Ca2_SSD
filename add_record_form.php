<?php
//header('Location: ' . 'http://localhost/Ca2_SSD/index.php', true, 303);
//exit;
require('database.php');

$query = 'SELECT *
          FROM creations
          ORDER BY creationID';
$statement = $db->prepare($query);
$statement->execute();
$creations = $statement->fetchAll();
$statement->closeCursor();
?>
<!-- the head section -->
 
<div class="container">
<div id="left_section">
<?php
include('includes/header.php');
?>

<?php
include('sideComp.php');
?>

            <div id="add_rec">
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

            <label>Description:</label>
            <input type="input" name="description" placeholder="Thorough explaination here...">
            <br>       

            <label>Difficulty:</label>
            <input type="input" name="difficulty" placeholder="0 - 5" pattern="[0-5]">
            <br>        
            
            <label>Image:</label>
            <input type="file" name="image" accept="image/*" />
            <br>
            
            <label>&nbsp;</label>
            <input type="submit" value="Add Record" href="index.php" >
            <br>

            <p><a href="index.php">View Homepage</a></p>
        </form>
            </div>



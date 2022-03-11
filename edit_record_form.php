<?php
require('database.php');


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


$record_id = filter_input(INPUT_POST, 'record_id', FILTER_VALIDATE_INT);
$query = 'SELECT *
          FROM records
          WHERE recordID = :record_id';
$statement = $db->prepare($query);
$statement->bindValue(':record_id', $record_id);
$statement->execute();
$crtns = $statement->fetch(PDO::FETCH_ASSOC);
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

<div id="prodHead">
        <h2>Edit Record</h2>
        </div>

        
        <div id="formCont">
        <form action="edit_record.php" method="post" enctype="multipart/form-data"
              id="add_record_form">
            <input type="hidden" name="original_image" value="<?php echo $crtns['image']; ?>" />
            <input type="hidden" name="record_id"
                   value="<?php echo $crtns['recordID']; ?>">

            <label>creation ID:</label>
            <input type="creation_id" name="creation_id"  placeholder="previous ID = <?php echo $crtns['creationID']; ?>"
                   value="<?php echo $crtns['creationID']; ?>">
          

            <label>Name:</label>
            <input type="input" name="name" placeholder="previous name = <?php echo $crtns['name']; ?>"
                   value="<?php echo $crtns['name']; ?>" required>
           

            <label>Description:</label>
            <input type="input" name="description" placeholder="previous description = <?php echo $crtns['description']; ?>"
                   value="<?php echo $crtns['description']; ?>" required>
          

            <label>Difficulty:</label>
            <input type="input" name="difficulty" placeholder="[0 - 5] (previously = <?php echo $crtns['difficulty']; ?>)"
                   value="<?php echo $crtns['difficulty']; ?>" pattern="[0-5]">
           

            <label>Image:</label>
            <input type="file" name="image" accept="image/*" />
                    
            <?php if ($crtns['image'] != "") { ?>
            <p><img src="image_uploads/<?php echo $crtns['image']; ?>" height="150" /></p>
            <?php } ?>
            
            <label>&nbsp;</label>
            <input type="submit" value="Save Changes">
         
            <p><a href="index.php">View Homepage</a></p>
        </form>
        
            </div>
            </div>
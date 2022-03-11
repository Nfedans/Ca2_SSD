<?php
// Get ID
$creation_id = filter_input(INPUT_POST, 'creation_id', FILTER_VALIDATE_INT);

// Validate inputs
if ($creation_id == null || $creation_id == false) {
    $error = "Invalid creation ID.";
    include('error.php');
} else {
    require_once('database.php');

    // Add the product to the database  
    $query = 'DELETE FROM creations 
              WHERE creationID = :creation_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':creation_id', $creation_id);
    $statement->execute();
    $statement->closeCursor();

    // Display the Category List page
    include('category_list.php');
}
?>

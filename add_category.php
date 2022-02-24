<?php
// Get the category data
$name = $name = filter_input(INPUT_POST, 'name');

// Validate inputs
if ($name == null) {
    $error = "Invalid category data. Check all fields and try again.";
    include('error.php');
} else {
    require_once('database.php');


    // Auto incrementer

    $maxId = "SELECT categoryID FROM categories
    WHERE categoryID = (SELECT MAX(categoryID)
    FROM categories);";

    $maxId = $db->prepare($maxId);
    $maxId->execute();

    $result = $maxId->setFetchMode(PDO::FETCH_ASSOC);
    foreach(new RecursiveArrayIterator($maxId->fetchAll()) as $k=>$v) {
        echo $v;
      }
   



    //$newId = $maxId + 1;
    
   


    // Add the product to the database
    $query = "INSERT INTO categories (`categoryID`, categoryName)
              VALUES (:newId, :name)";
    $statement = $db->prepare($query);
    $statement->bindValue(':newId', $newId);
    $statement->bindValue(':name', $name);
    $statement->execute();
    $statement->closeCursor();

    // Display the Category List page
    include('category_list.php');
}
?>
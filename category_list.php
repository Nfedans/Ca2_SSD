<?php
    require_once('database.php');

    // Get all categories
    $query = 'SELECT * FROM creations
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
<div id="cat_list">
    <h1>Category List</h1>
    <table>
        <tr>
            <th>Name</th>
            <th>&nbsp;</th>
        </tr>
        <?php foreach ($creations as $creation) : ?>
        <tr>
            <td><?php echo $creation['creationName']; ?></td>
            <td>
                <form action="delete_category.php" method="post"
                      id="delete_product_form">
                    <input type="hidden" name="creation_id"
                           value="<?php echo $creation['creationID']; ?>">
                    <input type="submit" value="Delete">
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
    <br>

    <h2>Add Category</h2>
    <form action="add_category.php" method="post"
          id="add_category_form">

        <label>Name:</label>
        <input type="input" name="name">
        <input id="add_category_button" type="submit" value="Add">
    </form>
    <br>
    <p><a href="index.php">Homepage</a></p>
        </div>

    <?php
include('includes/footer.php');
?>
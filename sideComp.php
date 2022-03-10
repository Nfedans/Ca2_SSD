<div id="section_holder">

<div id="info_section">

<p>Welcome to Nikita's Origami Site! Let's make something cool!</p>

</div>

<aside>
<!-- display a list of categories -->
<h2>Scroll Our Collection Below</h2>
<nav>
<ul>

<div id="scroll_box">
<?php foreach ($creations as $creation) : ?>
<li><a href=".?creation_id=<?php echo $creation['creationID']; ?>">
<?php echo $creation['creationName']; ?>
</a>
</li>
<?php endforeach; ?>

</div>


</ul>
</nav>          
</aside>
</div>

</div>
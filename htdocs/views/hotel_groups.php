<?php 
    $title = "Hotel_Groups";
    
    include 'templates/title.php';
    include 'models/hotel_group.php';
?>

<?php
    $hotel_groups = Hotel_Group::fetchAll();
?>

<table class="ui celled table">
  <thead>
    <tr><th>id</th>
    <th>Email</th>
    <th>Phone</th>
    <th>Number Of Hotels</th>
  </tr></thead>
  <tbody>
  <?php 
    foreach ($hotel_groups as $hotel_group) { 
  ?>
    <tr>
      <td><?php echo($hotel_group->id) ?></td>
      <td><?php echo($hotel_group->email) ?></td>
      <td><?php echo($hotel_group->phone) ?></td>
      <td><?php echo($hotel_group->rooms) ?></td>
      <td><?php echo($hotel_group->stars) ?></td>
    </tr>
  <?php } ?>
  </tbody>
</table>

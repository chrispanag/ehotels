<?php 
    $title = "Hotel Groups";
    
    include '../templates/title.php';
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
    foreach ($values['hotel_groups'] as $hotel_group) { 
  ?>
    <tr>
      <td><?php echo($hotel_group->id) ?></td>
      <td><?php echo($hotel_group->email) ?></td>
      <td><?php echo($hotel_group->phone) ?></td>
      <td><?php echo($hotel_group->hotel_number) ?></td>
    </tr>
  <?php } ?>
  </tbody>
</table>

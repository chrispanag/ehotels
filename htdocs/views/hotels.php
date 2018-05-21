<?php 
    $title = "Hotels";
    
    include 'templates/title.php';
    include 'models/hotel.php';
?>

<?php
    $hotels = Hotel::fetchAll();
?>

<table class="ui celled table">
  <thead>
    <tr><th>id</th>
    <th>Email</th>
    <th>Phone</th>
    <th>Number Of Rooms</th>
    <th>Stars</th>
  </tr></thead>
  <tbody>
  <?php 
    foreach ($hotels as $hotel) { 
  ?>
    <tr>
      <td><?php echo($hotel->id) ?></td>
      <td><?php echo($hotel->email) ?></td>
      <td><?php echo($hotel->phone) ?></td>
      <td><?php echo($hotel->rooms) ?></td>
      <td><?php echo($hotel->stars) ?></td>
    </tr>
  <?php } ?>
  </tbody>
</table>
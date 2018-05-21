<?php 
    $title = "Hotel Rooms";
    
    include '../templates/title.php';
    include '../models/hotel_room.php';
?>

<?php
    $hotel_rooms = Hotel_Room::fetchAll();
?>

<table class="ui celled table">
  <thead>
    <tr><th>Room id</th>
    <th>Price</th>
    <th>Capacity</th>
    <th>View</th>
    <th>Amenities</th>
    <th>Expendable</th>
  </tr></thead>
  <tbody>
  <?php 
    foreach ($hotel_rooms as $hotel_room) { 
  ?>
    <tr>
      <td><?php echo($hotel_room->id) ?></td>
      <td><?php echo($hotel_room->price) ?></td>
      <td><?php echo($hotel_room->capacity) ?></td>
      <td><?php echo($hotel_room->view) ?></td>
      <td><?php echo($hotel_room->amenities) ?></td>
      <td><?php echo($hotel_room->expendable) ?></td>
    </tr>
  <?php } ?>
  </tbody>
</table>

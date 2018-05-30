<?php 
    $title = "Hotel Rooms";
    $disableButton = False;
    
    include '../templates/title.php';
?>

<table class="ui celled table">
  <thead>
    <tr><th>Room id</th>
    <th>Price</th>
    <th>Capacity</th>
    <th>View</th>
    <th>Amenities</th>
    <th>Expendable</th>
    <th>Hotel</th>
    <th>Actions</th>
  </tr></thead>
  <tbody>
  <?php 
    foreach ($values["rooms"] as $room) { 
  ?>
    <tr>
      <td><?php echo($room->id) ?></td>
      <td><?php echo($room->price) ?></td>
      <td><?php echo($room->capacity) ?></td>
      <td><?php echo($room->view) ?></td>
      <td><?php echo($room->amenities) ?></td>
      <td><?php echo($room->expendable) ?></td>
      <td><?php echo($room->hotel()->email) ?></td>
      <td>
      <div class="ui fluid vertical labeled icon buttons">
        <a href="./deleteRoom?id=<?php echo($room->id) ?>"
        <button class="ui button">
          <i class="trash icon"></i>
          Delete
        </button>
        </a>
        <button class="ui button">
          <i class="edit icon"></i>
          Edit
        </button>
      </div>
      </td>
    </tr>
  <?php } ?>
  </tbody>
</table>

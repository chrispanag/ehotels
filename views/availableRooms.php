<?php 
    $title = "Available Hotel Rooms";
    $disableButton = True;
    
    include '../templates/title.php';
?>
<form class="ui large form" method="get" action="/available">
<div class="fields">
        <div class="field">
            <label>Start Date</label>
            <input type="text" name="start_date" placeholder=<?= $start_date ?>>
        </div>
        <div class="field">
            <label>Finish Date</label>
            <input type="text" name="finish_date" placeholder=<?= $finish_date ?>>
        </div>
    </div>
    <button class="ui left button" type="submit"><i class="search icon"></i>Find</button>
</form>
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
        <a href="./reserveRoom?id=<?php echo($room->id) ?>&start_date=<?= $start_date?>&finish_date=<?= $finish_date?>"
        <button class="ui button">
          <i class="play icon"></i>
          Reserve
        </button>
        </a>
      </div>
      </td>
    </tr>
  <?php } ?>
  </tbody>
</table>

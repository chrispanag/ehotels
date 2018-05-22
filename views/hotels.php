<?php 
    $title = "Hotels";
    
    include '../templates/title.php';
?>
<table class="ui large celled table">
  <thead>
    <tr><th>id</th>
    <th>Email</th>
    <th>Phone</th>
    <th>Number Of Rooms</th>
    <th>Stars</th>
    <th>Actions</th>
  </tr></thead>
  <tbody>
  <?php 
    foreach ($values['hotels'] as $hotel) { 
  ?>
    <tr>
      <td><?php echo($hotel->id) ?></td>
      <td><?php echo($hotel->email) ?></td>
      <td><?php echo($hotel->phone) ?></td>
      <td><?php echo($hotel->rooms) ?></td>
      <td><?php echo($hotel->stars) ?></td>
      <td>
      <div class="ui fluid vertical labeled icon buttons">
        <a href="./deleteHotel?id=<?php echo($hotel->id) ?>"
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
      </td
    </tr>
  <?php } ?>
  </tbody>
</table>
<?php 
    $title = "Hotel Groups";
    
    include '../templates/title.php';
?>
<table class="ui celled table">
  <thead>
    <tr><th>id</th>
    <th>Email</th>
    <th>Phone</th>
    <th>Hotel Number</th>
    <th>Actions</th>
  </tr></thead>
  <tbody>
  <?php 
    foreach ($values['hotel_groups'] as $hotel_group) { 
  ?>
    <tr>
      <td><?php echo($hotel_group->id) ?></td>
      <td><?php echo($hotel_group->email) ?></td>
      <td><?php echo($hotel_group->phone) ?></td>
      <td><?php echo(count($hotel_group->getHotels())) ?></td>
      <td>
      <div class="ui fluid vertical labeled icon buttons">
        <a href="./deleteHotelGroup?id=<?php echo($hotel_group->id) ?>"
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

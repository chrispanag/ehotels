<?php 
    $title = "Available Hotel Rooms By Location";
    $disableButton = True;
    
    include '../templates/title.php';
?>
<form class="ui large form" method="get" action="/available">
<div class="fields">
        <div class="field">
            <label>Start Date</label>
            <input type="text" name="start_date" value=<?= $start_date ?>>
        </div>
        <div class="field">
            <label>Finish Date</label>
            <input type="text" name="finish_date" value=<?= $finish_date ?>>
        </div>
        <div class="field">
            <label>Starting Price</label>
            <input type="number" name="price_start" value=<?= $price_start ?>>
        </div>
        <div class="field">
            <label>Upper Price</label>
            <input type="number" name="price_upper" value=<?= $price_upper ?>>
        </div>
        <div class="field">
            <label>Capacity</label>
            <input type="number" name="capacity" value=<?= $capacity ?>>
        </div>
        <div class="field">
            <label>Hotel Stars</label>
            <input type="number" name="stars" value=<?= $stars ?>>
        </div>
    </div>
    <div class="field">
          <label>Cities</label>
          <select name="selected_city" class="ui search dropdown">
            <option value="">Select City</option>
            <?php foreach($cities as $city) { 
                $selected = "";
                if ($city === $selected_city) $selected = "selected"
            ?>
                <option value="<?= $city ?>" <?php echo($selected) ?>><?php echo($city) ?></option>
            <?php } ?>
          </select>
      </div>
      <div class="field">
      <label>Hotel Group</label>
        <select name="selected_hotel_group" class="ui search dropdown">
            <option value="">Select Hotel Group</option>
            <?php foreach($hotel_groups as $hotel_group) { 
                $selected = "";
                if ($hotel_group->id === $selected_hotel_group) $selected = "selected"
            ?>
                <option value="<?php echo($hotel_group->id) ?>" <?php echo($selected) ?>><?php echo($hotel_group->email) ?></option>
            <?php } ?>
        </select>
    </div>
    <button class="ui left button" type="submit" name="action" value="default"><i class="search icon"></i>Find</button>
    <button class="ui left button" type="submit" name="action" value="groupby"><i class="search icon"></i>Grouped By Location</button>
</form>
<table class="ui celled table">
  <thead>
    <tr>
    <th>Rooms</th>
    <th>Location</th>
  </tr></thead>
  <tbody>
  <?php 
    foreach ($locations as $location) { 
  ?>
    <tr>
      <td><?php echo($location[0]) ?></td>
      <td><?php echo($location[1]) ?></td>
    </tr>
  <?php } ?>
  </tbody>
</table>
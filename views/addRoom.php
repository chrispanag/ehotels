<div class="ui container">
<span class="ui huge  header">
Add Room
</span>
<div class="ui divider"></div>
</div>

<form class="ui large form" method="post" action="/new_room">
    <div class="fields">
        <div class="field">
            <label>Price</label>
            <input type="number" name="price" placeholder="<?php echo $price?>">
        </div>
        <div class="field">
            <label>Capacity</label>
            <input type="number" name="capacity" placeholder="<?php echo $capacity?>">
        </div>
    </div>
    <div class="field">
        <label>View</label>
        <input type="text" name="view" placeholder="<?php echo $view?>">
    </div>
    <div class="field">
        <label>Amenities</label>
        <input type="text" name="amenities" placeholder="<?php echo $amenities?>">
    </div>
    <div class="field">
        <label>Repairs Needed</label>
        <input type="text" name="repairs_need" placeholder="<?php echo $repairs_need?>">
    </div>
    <div class="field">
        <label>Expendable</label>
        <input type="text" name="expendable" placeholder="<?php echo $expendable?>">
    </div>
    <div class="field">
      <label>Hotel</label>
        <select name="hotel_id" class="ui search dropdown">
            <option value="">Select Hotel</option>
            <?php foreach($hotels as $hotel) { ?>
                <option value="<?php echo($hotel->id) ?>"><?php echo($hotel->email) ?></option>
            <?php } ?>
        </select>
    </div>
    <button class="ui button" type="submit">Create</button>
</form>
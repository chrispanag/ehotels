<div class="ui container">
<span class="ui huge  header">
<?php echo($type) ?> Reservation
</span>
<div class="ui divider"></div>
</div>

<form class="ui large form" method="post" action="/new_reservation">
    <div class="fields">
        <div class="field">
            <label>Start Date</label>
            <input type="text" name="start_date" placeholder="<?php echo($start_date) ?>">
        </div>
        <div class="field">
            <label>Finish Date</label>
            <input type="text" name="finish_date" placeholder="<?php echo($finish_date) ?>">
        </div>
    </div>
    <div class="field">
      <label>Customers</label>
        <select name="customer_id" class="ui search dropdown">
            <option value="">Select Customer</option>
            <?php foreach($customers as $customer) { 
                $selected = "";
                if ($customer->irs_number === $customer) $selected = "selected"
            ?>
                <option value="<?php echo($customer->irs_number) ?>" <?php echo($selected) ?>><?php echo($customer->first_name . " " . $customer->last_name) ?></option>
            <?php } ?>
        </select>
    </div>
    <div class="field">
      <label>Rooms</label>
        <select name="room_id" class="ui search dropdown">
            <option value="">Select Room</option>
            <?php foreach($rooms as $room) { 
                $selected = "";
                if ($room->id === $room_id) $selected = "selected"
            ?>
                <option value="<?php echo($room->id) ?>" <?php echo($selected) ?>><?php echo($room->id) ?></option>
            <?php } ?>
        </select>
    </div>
    <div class="field">
        <div class="ui toggle checkbox">
            <input type="checkbox" name="paid" tabindex="0" class="hidden">
            <label>Paid</label>
        </div>
     </div>
    <button class="ui button" type="submit">Create</button>
</form>

<script>
$('.ui.checkbox')
  .checkbox()
;
</script>
<div class="ui container">
<span class="ui huge header">
<?php echo($type) ?> Hotel
</span>
<div class="ui divider"></div>
</div>

<form class="ui large form" method="post" action="/new_hotel">
    <div class="fields">
        <div class="field">
        <label>Email Address</label>
        <input type="text" name="email" placeholder="<?php echo($email) ?>">
    </div>
    <div class="field">
        <label>Phone</label>
        <input type="text" name="phone" placeholder="<?php echo($phone) ?>">
    </div>
    <div class="field">
            <label>Stars</label>
            <input type="number" name="stars" placeholder="<?php echo($stars) ?>">
        </div>
    </div>
    <div class="field">
      <label>Hotel Group</label>
        <select name="hotel_group_id" class="ui search dropdown">
            <option value="">Select Hotel Group</option>
            <?php foreach($hotel_groups as $hotel_group) { 
                $selected = "";
                if ($hotel_group->id === $hotel_group_id) $selected = "selected"
            ?>
                <option value="<?php echo($hotel_group->id) ?>" <?php echo($selected) ?>><?php echo($hotel_group->email) ?></option>
            <?php } ?>
        </select>
    </div>
    <div class="field">
      <label>Manager</label>
        <select name="employee_id" class="ui search dropdown">
            <option value="">Select Managers</option>
            <?php foreach($employees as $employee) {
                $selected = "";
                if ($employee->irs_number === $irs_number) $selected = "selected"
            ?>
                <option value="<?php echo($employee->irs_number) ?>" <?php echo($selected) ?>><?php echo($employee->first_name." ".$employee->last_name) ?> </option>
            <?php } ?>
        </select>
    </div>
    <?php include '../templates/address_fields.php' ?>
    <button class="ui button" type="submit">Save</button>
</form>
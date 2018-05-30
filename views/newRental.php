<div class="ui container">
<span class="ui huge  header">
<?php echo($type) ?> Rental
</span>
<div class="ui divider"></div>
</div>

<form class="ui large form" method="get" action="/checkIn">
    <input type="hidden" name="room_id" readonly="" value="<?php echo($room_id) ?>">
    <input type="hidden" name="start_date" readonly="" value="<?php echo($start_date) ?>">

    <div class="field">
      <label>Employees</label>
        <select name="employee_id" class="ui search dropdown">
            <option value="">Select Employee</option>
            <?php foreach($employees as $employee) { 
            ?>
                <option value="<?php echo($employee->irs_number) ?>"><?php echo($employee->first_name . " " . $employee->last_name) ?></option>
            <?php } ?>
        </select>
    </div>
    <div class="field">
    <label>Payment Method</label>
    <select name="payment_method" class="ui search dropdown">
            <option value="">Select Payment Method</option>
            <option value="CASH">Cash</option>
            <option value="CREDIT_CARD">Credit Card</option>
        </select>
    </div>
    <button class="ui button" type="submit">Create</button>
</form>

<script>
$('.ui.checkbox')
  .checkbox()
;
</script>
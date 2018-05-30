<div class="ui container">
<span class="ui huge  header">
Reserve Room
</span>
<div class="ui divider"></div>
</div>

<form class="ui large form" method="post" action="/new_reservation">
    <div class="fields">
        <div class="field">
            <label>Start Date</label>
            <input type="text" name="start_date" placeholder="">
        </div>
        <div class="field">
            <label>Finish Date</label>
            <input type="text" name="finish_date" placeholder="">
        </div>
    </div>
    <div class="field">
            <div class="ui toggle checkbox">
                <input type="checkbox" name="paid" tabindex="0" class="hidden">
                <label>Paid</label>
            </div>
        </div>
    <div class="field">
      <label>Customer</label>
        <select name="customer_id" class="ui search dropdown">
            <option value="">Select Customer</option>
            <?php foreach($values["customers"] as $customer) { ?>
                <option value="<?php echo($customer->irs_number) ?>"><?php echo($customer->first_name." ".$customer->last_name) ?></option>
            <?php } ?>
        </select>
    </div>
    <input type="hidden" name="room_id" value=<?php echo($values["room_id"]) ?>>
    <button class="ui button" type="submit">Create</button>
</form>
<script>
$('.ui.checkbox')
  .checkbox()
;
</script>
<div class="ui container">
<span class="ui huge  header">
<?php echo($type) ?> Hotel Group
</span>
<div class="ui divider"></div>
</div>

<form class="ui large form" method="post" action="/new_hotel_group">
    <div class="field">
        <label>Email Address</label>
        <input type="text" name="email" placeholder="<?php echo($email)?>">
    </div>
    <div class="field">
        <label>Phone</label>
        <input type="text" name="phone" placeholder="<?php echo($phone)?>">
    </div>
    <button class="ui button" type="submit">Create</button>
</form>
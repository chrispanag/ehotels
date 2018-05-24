<div class="ui container">
<span class="ui huge  header">
Add Hotel Group
</span>
<div class="ui divider"></div>
</div>

<form class="ui large form" method="post" action="/new_hotel_group">
    <div class="field">
        <label>Email Address</label>
        <input type="text" name="email" placeholder="hotel_group@example.com">
    </div>
    <div class="field">
        <label>Phone</label>
        <input type="text" name="phone" placeholder="+XX XXXXXXXXX">
    </div>
    <button class="ui button" type="submit">Create</button>
</form>
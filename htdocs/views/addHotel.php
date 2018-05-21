<div class="ui container">
<span class="ui huge  header">
Add Hotel
</span>
<div class="ui divider"></div>
</div>

<form class="ui large form" method="post" action="/new_hotel">
    <div class="fields">
        <div class="field">
        <label>Email Address</label>
        <input type="text" name="email" placeholder="hotel@example.com">
    </div>
    <div class="field">
        <label>Phone</label>
        <input type="text" name="phone" placeholder="+XX XXXXXXXXX">
    </div>
    </div>
    <div class="fields">
        <div class="field">
            <label>Number of Rooms</label>
            <input type="number" name="rooms" placeholder="XX">
        </div>
        <div class="field">
            <label>Stars</label>
            <input type="number" name="stars" placeholder="XX">
        </div>
    </div>
    <button class="ui button" type="submit">Create</button>
</form>
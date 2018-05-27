<div class="ui container">
<span class="ui huge  header">
Add Customer
</span>
<div class="ui divider"></div>
</div>

<form class="ui large form" method="post" action="/new_customer">
    <div class="field">
        <label>First Name</label>
        <input type="text" name="first_name" placeholder="First Name">
    </div>
    <div class="field">
        <label>Last Name</label>
        <input type="text" name="last_name" placeholder="Last Name">
    </div>
    <div class="field">
        <label>IRS Number</label>
        <input type="text" name="irs_number" placeholder="IRS Number">
    </div>
    <div class="field">
        <label>Social Security Number</label>
        <input type="text" name="ssn" placeholder="SSN">
    </div>
    <button class="ui button" type="submit">Create</button>
</form>
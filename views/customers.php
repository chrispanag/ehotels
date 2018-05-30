<?php 
    $title = "Customers";
    
    include '../templates/title.php';
?>
<table class="ui celled table">
  <thead>
    <tr><th>IRS Number</th>
    <th>SSN</th>
    <th>First Name</th>
    <th>Last Name</th>
    <th>First Registration</th>
    <th>Customers</th>
  </tr>
  </thead>
  <tbody>
  <?php 
    foreach ($customers as $customer) { 
  ?>
    <tr>
      <td><?php echo($customer->irs_number) ?></td>
      <td><?php echo($customer->ssn) ?></td>
      <td><?php echo($customer->first_name) ?></td>
      <td><?php echo($customer->last_name) ?></td>
      <td><?php echo($customer->first_registration) ?></td>
      <td>
      <div class="ui fluid vertical labeled icon buttons">
        <a href="./deleteCustomer?id='<?php echo($customer->irs_number) ?>'"
        <button class="ui button">
          <i class="trash icon"></i>
          Delete
        </button>
        </a>
        <button class="ui button">
          <i class="edit icon"></i>
          Edit
        </button>
      </div>
      </td>
    </tr>
  <?php } ?>
  </tbody>
</table>

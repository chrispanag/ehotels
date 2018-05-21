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
  </tr>
  </thead>
  <tbody>
  <?php 
    foreach ($values['customers'] as $customer) { 
  ?>
    <tr>
      <td><?php echo($customer->irs_num) ?></td>
      <td><?php echo($customer->ssn) ?></td>
      <td><?php echo($customer->first_name) ?></td>
      <td><?php echo($customer->last_name) ?></td>
      <td><?php echo($customer->first_registration) ?></td>
    </tr>
  <?php } ?>
  </tbody>
</table>

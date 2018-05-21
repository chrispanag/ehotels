<?php 
    $title = "Employees";
    
    include 'templates/title.php';
    include 'models/employee.php';
?>

<?php
    $employees = Employee::fetchAll();
?>

<table class="ui celled table">
  <thead>
    <tr><th>IRS Number</th>
    <th>SSN</th>
    <th>First Name</th>
    <th>Last Name</th>
  </tr></thead>
  <tbody>
  <?php 
    foreach ($employees as $employee) { 
  ?>
    <tr>
      <td><?php echo($employee->irs_num) ?></td>
      <td><?php echo($employee->ssn) ?></td>
      <td><?php echo($employee->first_name) ?></td>
      <td><?php echo($employee->last_name) ?></td>
       </tr>
  <?php } ?>
  </tbody>
</table>

<?php 
    $title = "Employees";
    
    include '../templates/title.php';
?>
<div class="ui container">
<table class="ui celled table">
  <thead>
    <tr><th>IRS Number</th>
    <th>SSN</th>
    <th>First Name</th>
    <th>Last Name</th>
    <th>Actions</th>
  </tr></thead>
  <tbody>
  <?php 
    foreach ($values["employees"] as $employee) { 
  ?>
    <tr>
      <td><?php echo($employee->irs_number) ?></td>
      <td><?php echo($employee->ssn) ?></td>
      <td><?php echo($employee->first_name) ?></td>
      <td><?php echo($employee->last_name) ?></td>
      <td>
      <div class="ui fluid vertical labeled icon buttons">
        <a href="./deleteEmployee?id=<?php echo($employee->irs_number) ?>"
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
</div>

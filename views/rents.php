<?php 
    $title = "Rents";
    
    include '../templates/title.php';
?>
<table class="ui celled table">
  <thead>
    <tr>
    <th>Customer</th>
    <th>Employee</th>
    <th>Room Id</th>
    <th>Start Date</th>
    <th>End Date</th>
    <th>Amount Paid</th>
    <th>Payment Method</th>
  </tr></thead>
  <tbody>
  <?php 
    foreach ($rents as $rent) { 
  ?>
    <tr>
      <td><?php echo($rent->customer_id) ?></td>
      <td><?php echo($rent->employee_id) ?></td>
      <td><?php echo($rent->room_id) ?></td>
      <td><?php echo($rent->start_date) ?></td>
      <td><?php echo($rent->finish_date) ?></td>
      <td><?php echo($rent->payment->payment_amount) ?></td>
      <td><?php echo($rent->payment->payment_method) ?></td>
    </tr>
  <?php } ?>
  </tbody>
</table>

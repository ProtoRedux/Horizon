<?php
include_once 'header.php';
require_once 'includes\config.inc.php';
require_once 'includes\functions.inc.php';
privilegeLevel("Production");
?>
<!-- Displays all the current instructions -->
<div class="p-5">
  <div class="row text-center">
    <div class="col-sm">
      <p class="db-row-header">Id</p>
    </div>
    <div class="col-sm">
      <p class="db-row-header">Instruction Type</p>
    </div>
    <div class="col-sm">
      <p class="db-row-header">Part Number</p>
    </div>
    <div class="col-sm">
      <p class="db-row-header">Description</p>
    </div>
    <div class="col-sm">
      <p class="db-row-header">Customer Code</p>
    </div>
    <div class="col-sm">
      <p class="db-row-header">Customer Name</p>
    </div>
    <div class="col-sm">
      <p class="db-row-header">System Type</p>
    </div>
    <div class="col-sm">
      <p class="db-row-header">Instruction Level</p>
    </div>
    <div class="col-sm">
      <p class="db-row-header">Status</p>
    </div>
    <div class="col-sm">
      <p class="db-row-header">Revision</p>
    </div>
    <div class="col-sm">
      <p class="db-row-header">Initial Release</p>
    </div>
    <div class="col-sm">
      <p class="db-row-header">Last Update</p>
    </div>
  </div>
  <?php
  $result = getInstructions($conn);
  while ($row = mysqli_fetch_assoc($result)) {

    $id = $row['id'];
    $instruction_type = $row['instruction_type'];
    $part_number = $row['part_number'];
    $description = $row['description'];
    $customer = $row['customer_code'];
    $customer_name = $row['customer_name'];
    $system_type = $row['system_type'];
    $instruction_level = $row['instruction_level'];
    $status = $row['status'];
    $revision = $row['revision'];
    $initial_release = $row['initial_release'];
    $last_update = $row['last_update'];


    echo '<div class="row text-center">
    <div class="col-sm">
    <p class="db-row-text">' . $id . '</p>
    </div>
    <div class="col-sm">
    <p class="db-row-text">' . $instruction_type . '</p>
    </div>
    <div class="col-sm">
    <p class="db-row-text">' . $part_number . '</p>
    </div>
    <div class="col-sm">
    <p class="db-row-text">' . $description . '</p>
    </div>
    <div class="col-sm">
    <p class="db-row-text">' . $customer . '</p>
    </div>
    <div class="col-sm">
    <p class="db-row-text">' . $customer_name . '</p>
    </div>
    <div class="col-sm">
    <p class="db-row-text">' . $system_type . '</p>
    </div>
    <div class="col-sm">
    <p class="db-row-text">' . $instruction_level . '</p>
    </div>
    <div class="col-sm">
    <p class="db-row-text">' . $status . '</p>
    </div>
    <div class="col-sm">
    <p class="db-row-text">' . $revision . '</p>
    </div>
    <div class="col-sm">
    <p class="db-row-text">' . $initial_release . '</p>
    </div>
    <div class="col-sm">
    <p class="db-row-text">' . $last_update . '</p>
    </div>
  </div>';
  }

  ?>

</div>
</div>

<?php
include_once 'footer.php';
?>
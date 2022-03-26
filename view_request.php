<?php
include_once 'header.php';
require_once 'includes\config.inc.php';
require_once 'includes\functions.inc.php';
privilegeLevel("Engineering");

$searchData = getRequest($conn);
$updateRequest = requestType($searchData);

//If user approves, request is added to instruction table (and removed from request table)
//If user denys, request is deleted

if (isset($_POST["approve_request"])) {
  //If the request is a new instruction
  if ($searchData['instruction_id'] == 0) {
    deleteRequest($conn, $searchData['id']);
    newInstruction($conn, $_POST["part_number"], $_POST["description"], $_POST["customer_code"], $_POST["customer_name"], $_POST["system_type"], $_POST["instruction_level"], $_POST["status"], $_POST["revision"], $_POST['initial_release'], $_POST['last_update'], $_POST["instruction_type"]);
    $searchData = getRequest($conn);
  } else {
    deleteRequest($conn, $searchData['id']);
    updateInstruction($conn, $_POST["part_number"], $_POST["description"], $_POST["customer_code"], $_POST["customer_name"], $_POST["system_type"], $_POST["instruction_level"], $_POST["status"], $_POST["revision"], $_POST['initial_release'], $_POST['last_update'], $_POST["instruction_type"], $_POST['instruction_id']);
    $searchData = getRequest($conn);
  }
} elseif (isset($_POST["deny_request"])) {
  echo $searchData['id'];
  deleteRequest($conn, $searchData['id']);;
  $searchData = getRequest($conn);
}
?>


<?php if ($searchData ?? false) {
  $bannerMessage = "Instruction Requests";
} else {
  $bannerMessage = "Requests Complete";
}
?>

<div class="container d-flex justify-content-center align-items-center test">
  <div class="form-container ">
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST">
      <h3 class="login-text"><?php echo $bannerMessage ?>
      </h3>

      <?php
      $message = getMessage();
      echo $message
      ?>

      <?php
      if ($searchData ?? false) {
      ?>
        <div class="form-group ">
          <div class="input-group form-group">
            <div class="input-group-prepend">
              <span class="input-group-text" id="basic-addon3">Request Type:
              </span>
            </div>
            <input type="text" name="request_type" class="form-control" id="request_type" value='<?php echo $updateRequest ?>' </div>
            <div class="form-group">
              <div class="input-group form-group">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="basic-addon3">Part Number:
                  </span>
                </div>
                <input type="text" name="part_number" class="form-control" id="part_number" value='<?php echo htmlspecialchars($searchData['part_number']) ?>' placeholder="Part Number">
              </div>
              <div class="form-group">
                <div class="input-group form-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon3">Instruction Id:
                    </span>
                  </div>
                  <input type="text" name="instruction_id" class="form-control" id="instruction_id" value='<?php echo htmlspecialchars($searchData['instruction_id']) ?>' placeholder="Instruction Id">
                </div>
                <div class="form-group">
                  <div class="input-group form-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text" id="basic-addon3">Description:
                      </span>
                    </div>
                    <input type="text" name="description" class="form-control" id="description" value='<?php echo htmlspecialchars($searchData['description']) ?>' placeholder="Part Description">
                  </div>
                  <div class="form-group">
                    <div class="input-group form-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon3">Customer Code:
                        </span>
                      </div>
                      <input type="text" name="customer_code" class="form-control" id="customer_code" value='<?php echo htmlspecialchars($searchData['customer_code']) ?>' placeholder="Customer Code">
                    </div>
                    <div class="form-group">
                      <div class="input-group form-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text" id="basic-addon3">Customer Name:
                          </span>
                        </div>
                        <input type="text" name="customer_name" class="form-control" id="customer_name" value='<?php echo htmlspecialchars($searchData['customer_name']) ?>' placeholder="Customer Name">
                      </div>
                      <div class="form-group">
                        <div class="input-group form-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon3">System Type:
                            </span>
                          </div>
                          <input type="text" name="system_type" class="form-control" id="system_type" value='<?php echo htmlspecialchars($searchData['system_type']) ?>' placeholder="System Type">
                        </div>
                        <div class="form-group">
                          <div class="input-group form-group">
                            <div class="input-group-prepend">
                              <span class="input-group-text" id="basic-addon3">Instruction Level:
                              </span>
                            </div>
                            <input type="text" name="instruction_level" class="form-control" id="instruction_level" value='<?php echo htmlspecialchars($searchData['instruction_level']) ?>' placeholder="Instruction Level">
                          </div>
                          <div class="form-group">
                            <div class="input-group form-group">
                              <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon3">Instruction Type:
                                </span>
                              </div>
                              <input type="text" name="instruction_type" class="form-control" id="instruction_type" value='<?php echo htmlspecialchars($searchData['instruction_type']) ?>' placeholder="Instruction Type">
                            </div>
                            <div class="form-group">
                              <div class="input-group form-group">
                                <div class="input-group-prepend">
                                  <span class="input-group-text" id="basic-addon3">Status:
                                  </span>
                                </div>
                                <input type="text" name="status" class="form-control" id="status" value='<?php echo htmlspecialchars($searchData['status']) ?>' placeholder="Status">
                              </div>
                              <div class="form-group">
                                <div class="input-group form-group">
                                  <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon3">Revision:
                                    </span>
                                  </div>
                                  <input type="text" name="revision" class="form-control" id="revision" value='<?php echo htmlspecialchars($searchData['revision']) ?>' placeholder="Revision">
                                </div>
                                <div class="form-group">
                                  <div class="input-group form-group">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text" id="basic-addon3">Inital Release:
                                      </span>
                                    </div>
                                    <input type="text" name="initial_release" class="form-control" id="initial_release" value='<?php echo htmlspecialchars($searchData['initial_release']) ?>' placeholder="Initial Release">
                                  </div>

                                  <div class="form-group">
                                    <div class="input-group form-group">
                                      <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon3">Last Update:
                                        </span>
                                      </div>
                                      <input type="text" name="last_update" class="form-control" id="last_update" placeholder="Last Update" value='<?php echo htmlspecialchars($searchData['last_update']) ?>'>
                                      <button type="submit" class="btn-login" name="approve_request" id='approve_request'>Approve</button>
                                      <button type="submit" class="btn-login deny" name="deny_request" id='deny_request'>Deny</button>
                                    </div>
                                  <?php
                                }
                                  ?>
    </form>
  </div>
</div>
<?php
include_once 'footer.php';
?>
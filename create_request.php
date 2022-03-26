<?php
include_once 'header.php';
require_once 'includes\config.inc.php';
require_once 'includes\functions.inc.php';
privilegeLevel("Production");

//Adds a new request to request table
if (isset($_POST["add_submit"])) {
  $initialRelease = date("Y/m/d", strtotime($_POST["initial_release"]));
  $lastUpdate = date("Y/m/d", strtotime($_POST["last_update"]));

  newRequest($conn, $_POST["part_number"], $_POST["description"], $_POST["customer_code"], $_POST["customer_name"], $_POST["system_type"], $_POST["instruction_level"], $_POST["status"], $_POST["revision"], $initialRelease, $lastUpdate, $_POST["instruction_type"]);
}
?>
<div class="container d-flex justify-content-center align-items-center test">
  <div class="form-container ">
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST">
      <h3 class="login-text">Add Instruction Request
      </h3>
      <?php
      $message = getMessage();
      echo $message
      ?>
      <div class="form-group">
        <div class="input-group form-group">
          <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon3">Part Number:
            </span>
          </div>
          <input type="text" name="part_number" class="form-control" id="part_number" placeholder="Part Number">
        </div>
        <div class="form-group">
          <div class="input-group form-group">
            <div class="input-group-prepend">
              <span class="input-group-text" id="basic-addon3">Description:
              </span>
            </div>
            <input type="text" name="description" class="form-control" id="description" placeholder="Part Description">
          </div>
          <div class="form-group">
            <div class="input-group form-group">
              <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon3">Customer Code:
                </span>
              </div>
              <input type="text" name="customer_code" class="form-control" id="customer_code" placeholder="Customer Code">
            </div>
            <div class="form-group">
              <div class="input-group form-group">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="basic-addon3">Customer Name:
                  </span>
                </div>
                <input type="text" name="customer_name" class="form-control" id="customer_name" placeholder="Customer Name">
              </div>
              <div class="form-group">
                <div class="input-group form-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon3">System Type:
                    </span>
                  </div>
                  <input type="text" name="system_type" class="form-control" id="system_type" placeholder="System Type">
                </div>
                <div class="form-group">
                  <div class="input-group form-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text" id="basic-addon3">Instruction Level:
                      </span>
                    </div>
                    <input type="text" name="instruction_level" class="form-control" id="instruction_level" placeholder="Instruction Level">
                  </div>
                  <div class="form-group">
                    <div class="input-group form-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon3">Instruction Type:
                        </span>
                      </div>
                      <input type="text" name="instruction_type" class="form-control" id="instruction_type" placeholder="Instruction Type">
                    </div>
                    <div class="form-group">
                      <div class="input-group form-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text" id="basic-addon3">Status:
                          </span>
                        </div>
                        <input type="text" name="status" class="form-control" id="status" placeholder="Status">
                      </div>
                      <div class="form-group">
                        <div class="input-group form-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon3">Revision:
                            </span>
                          </div>
                          <input type="text" name="revision" class="form-control" id="revision" placeholder="Revision">
                        </div>
                        <div class="form-group">
                          <div class="input-group form-group">
                            <div class="input-group-prepend">
                              <span class="input-group-text" id="basic-addon3">Inital Release:
                              </span>
                            </div>
                            <input type="text" name="initial_release" class="form-control" id="initial_release" placeholder="Initial Release">
                          </div>

                          <div class="form-group">
                            <div class="input-group form-group">
                              <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon3">Last Update:
                                </span>
                              </div>
                              <input type="text" name="last_update" class="form-control" id="last_update" placeholder="Last Update">

                              <button type="submit" class="btn-login" name="add_submit" id='add_submit'>Add Instruction
                              </button>
                            </div>

    </form>
  </div>
</div>
<?php
include_once 'footer.php'
?>
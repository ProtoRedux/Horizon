<?php
include_once 'header.php';
require_once 'includes\config.inc.php';
require_once 'includes\functions.inc.php';
privilegeLevel("Production");

//Deletes selected instruction after search 
if (isset($_POST["search_instruction_submit"])) {
  $searchData = getInstruction($conn, $_POST["search_part_number"], $_POST["search_instruction_type"]);
} elseif (isset($_POST["delete_submit"])) {
  deleteInstruction($conn, $_POST['id']);
}
?>


<div class="container d-flex justify-content-center align-items-center test">
  <div class="form-container ">
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST">
      <h3 class="login-text">Delete Instruction
      </h3>
      <?php
      $message = getMessage();
      echo $message
      ?>
      <div class="form-group my-1 ">
        <input type="text" name="search_part_number" class="form-control" id="search_part_number" placeholder="Search Part Number">
      </div>
      <select class="form-select form-select-sm" aria-label="Default select example" class="form-control" id="search_instruction_type" name="search_instruction_type">
        <option selected>Build
        </option>
        <option value="1">Install
        </option>
        <option value="2">Configuration
        </option>
        <option value="3">BIOS
        </option>
        <option value="4">Test
        </option>
        <option value="5">Packing
        </option>
      </select>
      <div class="form-group ">
        <button type="submit" class="btn-login" name="search_instruction_submit" id='search_instruction_submit'>Search
        </button>
      </div>
      <?php
      if ($searchData ?? false) {
      ?>
        <div class="form-group ">
          <div class="input-group form-group">
            <div class="input-group-prepend">
              <span class="input-group-text" id="basic-addon3">Database Id:
              </span>
            </div>
            <input type="text" name="id" class="form-control" id="id" value='<?php echo htmlspecialchars($searchData['id']) ?>' placeholder="Id">
          </div>
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

                                  <button type="submit" class="btn-login" name="delete_submit" id='delete_submit'>Delete Item
                                  </button>
                                </div>
                              <?php
                            }
                              ?>
    </form>
  </div>
</div>
<?php
include_once 'footer.php'
?>
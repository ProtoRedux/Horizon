<?php
include_once 'header.php';
require_once 'includes\config.inc.php';
require_once 'includes\functions.inc.php';
privilegeLevel("Production");
?>
<div class="container d-flex justify-content-center align-items-center test">
    <div class="form-container ">
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST">
            <h3 class="login-text">Statistics
            </h3>
            <!-- Displays stats important to the user -->
            <?php
            $result = getInstructions($conn);
            $totalRows = mysqli_num_rows($result);
            $updatesReq = countFieldValues($result, "status", "Update Required");
            $requestResult = GetTotalRequests($conn);
            $requestRows =  mysqli_num_rows($requestResult);
            $instructRequested = countFieldValues($result, "status", "Instruction Requested");
            ?>

            <?php
            $message = getMessage();
            echo $message
            ?>

            <div class="form-group">
                <div class="input-group form-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text stats" id="basic-addon3">Total instructions:
                        </span>
                    </div>
                    <input type="text" name="total_instructions" class="form-control" id="total_instructions" value='<?php echo $totalRows ?>'>

                </div>
                <div class="form-group">
                    <div class="input-group form-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text stats" id="basic-addon3">Updates Required:
                            </span>
                        </div>
                        <input type="text" name="pending" class="form-control" id="pending" value='<?php echo $updatesReq ?>'>
                    </div>
                    <div class="form-group">
                        <div class="input-group form-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text stats" id="basic-addon3">Pending Approval:
                                </span>
                            </div>
                            <input type="text" name="approval" class="form-control" id="approval" value='<?php echo $requestRows ?>'>
                        </div>
                        <div class="form-group">
                            <div class="input-group form-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text stats" id="basic-addon3">Instructions Requested:
                                    </span>
                                </div>
                                <input type="text" name="requested" class="form-control" id="requested" value='<?php echo $instructRequested ?>'>
                            </div>
        </form>
    </div>
</div>

<?php
include_once 'footer.php'
?>
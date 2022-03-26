<?php
include_once 'header.php';
require_once 'includes\config.inc.php';
require_once 'includes\functions.inc.php';
privilegeLevel("Engineering");
include_once 'header.php';

$userData;
if (isset($_POST["search_user_email"])) {
    $userData = readUser($conn, $_POST["search_user_email"]);
}
if (isset($_POST["delete_user_submit"])) {
    $id = $userData['id'];
    echo $id;
    DeleteUser($conn, $id);
}
?>
<div class="container d-flex justify-content-center align-items-center test">

    <div class="form-container ">
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
            <h3 class="login-text">Search for user</h3>

            <?php
            $message = getMessage();
            echo $message;

            if (isset($_POST['search_user_email'])) {
                $search = $_POST['search_user_email'];
            } else {
                $search = "";
            }
            ?>

            <div class="form-group my-1 ">
                <input type="text" name="search_user_email" value="<?php echo $search ?>" class="form-control" id="search_user_email" aria-describedby="emailHelp" placeholder="Search user email">
            </div>

            <?php
            if ($userData ?? false) {
            ?>
                <div class="form-group my-1 ">
                    <input type="text" name="user_id_read" class="form-control" id="user_id_read" value='<?php echo intval($userData['id']) ?>' disabled aria-describedby="emailHelp" placeholder="User ID">
                </div>

                <div class="form-group my-1 ">
                    <input type="email" name="user_email_read" class="form-control" value='<?php echo htmlspecialchars($userData['email']) ?>' id="user_email_read" disabled aria-describedby="emailHelp" placeholder="User email">
                </div>
                <div class="form-group my-1 ">
                    <input type="text" name="user_department_read" class="form-control" value='<?php echo htmlspecialchars($userData['department']) ?>' id="user_department_read" disabled aria-describedby="emailHelp" placeholder="Department">
                </div>
            <?php
            }
            ?>
            <button type="submit" name="modify_user_submit" class="btn-login">Search</button>
            <button type="submit" name="delete_user_submit" id="delete_user_submit" class="btn-login">Remove User</button>

            <?php
            include_once 'footer.php'
            ?>
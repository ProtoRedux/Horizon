<?php

//Checks for empty fields 
function emptyInputSignup($user_email, $pwd, $pwdRepeat)
{
    if (empty($user_email) || empty($pwd) || empty($pwdRepeat)) $result = true;
    else {
        $result = false;
    }
    return $result;
};
//Checks user email is valid
function invalidEmail($user_email)
{

    if (!filter_var($user_email, FILTER_VALIDATE_EMAIL)) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

//Checks password length is at least 6 char
function invalidPassword($pwd)
{
    $pwdLength = strlen($pwd);
    if ($pwdLength < 6) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

//Checks passwords match
function pwdMatch($pwd, $pwdRepeat)
{
    if ($pwd !== $pwdRepeat) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

//Checks department field is not empty
function invalidDepartment($department)
{
    if ($department == "noInput") {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

//Checks is an email address exists and returns the row from users db
function userExists($conn, $user_email)
{
    $sql = "SELECT * FROM users WHERE email = ?;";
    //Prepared statement to prevent sql injection
    $stmt = mysqli_stmt_init($conn);
    //Checks if sql statement executes & redirects to current page
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header('Location: ' . $_SERVER['PHP_SELF']);;
        exit();
    }
    mysqli_stmt_bind_param($stmt, "s", $user_email);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);
    if ($row = mysqli_fetch_assoc($resultData)) {
        return $row;
    } else {
        $result = false;
        return $result;
    };
}

//Get row where instruction and part number match user input
//This should only ever be one result! ###Implement checks later for this
function getInstruction($conn, $part_number, $instruction_type)
{
    $sql = "SELECT * FROM instruction WHERE part_number = ? AND instruction_type = ?;";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header('Location: ' . $_SERVER['PHP_SELF']);
        exit();
    }

    mysqli_stmt_bind_param($stmt, "ss", $part_number, $instruction_type);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($resultData)) {
        return $row;
    } else {
        $result = false;
        return $result;
    }
}

//Returns the number of rows in the request table
function GetTotalRequests($conn)
{
    $sql = "SELECT * FROM request ORDER BY Id DESC;";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header('Location: ' . $_SERVER['PHP_SELF']);;
        exit();
    }
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    mysqli_stmt_close($stmt);
    return $result;
}

//Delete a single request where id is matched
function deleteRequest($conn, $id)
{
    $sql = "DELETE FROM request WHERE id = ?;";
    //Prepared statement to prevent sql injection
    $stmt = mysqli_stmt_init($conn);
    //Checks if sql statement executes & redirects to current page
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        $error = mysqli_error($conn);
        echo $error;
    }
    //Binds statement with user email
    mysqli_stmt_bind_param($stmt, "s", $id);
    mysqli_stmt_execute($stmt);
    //my_sqli_stmt_close($stmt);
}

//Get a single request from request table, order does not matter here
function getRequest($conn)
{
    $sql = "SELECT * FROM request LIMIT 1;";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header('Location: ' . $_SERVER['PHP_SELF']);;
        exit();
    }
    mysqli_stmt_execute($stmt);
    $resultData = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($resultData)) {
        return $row;
    } else {
        $result = false;
        return $result;
    }
}

//Add an instruction to the request table to be later be approved or denied
function updateRequest($conn, $instruction_id, $part_number, $description, $customer_code, $customer_name, $system_type, $instruction_level, $status, $revision, $initial_release, $last_update, $instruction_type)
{
    $sql = "INSERT INTO request (
        instruction_id, part_number, description, 
        customer_code, customer_name, system_type, 
        instruction_level, status, revision, 
        initial_release, last_update, instruction_type
      ) 
      VALUES 
        (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);";

    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header('Location: ' . $_SERVER['PHP_SELF']);
        exit();
    }
    mysqli_stmt_bind_param($stmt, "ssssssssssss", $instruction_id, $part_number, $description, $customer_code, $customer_name, $system_type, $instruction_level, $status, $revision, $initial_release, $last_update, $instruction_type);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit();
}

//Add a instruction to request table WITHOUT an instruction id! This means it is a new request and not an update request
function newRequest($conn, $part_number, $description, $customer_code, $customer_name, $system_type, $instruction_level, $status, $revision, $initial_release, $last_update, $instruction_type)
{
    $sql = "INSERT INTO request (
        part_number, description, 
        customer_code, customer_name, system_type, 
        instruction_level, status, revision, 
        initial_release, last_update, instruction_type
      ) 
      VALUES 
        (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header('Location: ' . $_SERVER['PHP_SELF'] . "?error=sqlError");
        exit();
    }
    mysqli_stmt_bind_param($stmt, "sssssssssss", $part_number, $description, $customer_code, $customer_name, $system_type, $instruction_level, $status, $revision, $initial_release, $last_update, $instruction_type);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header('Location: ' . $_SERVER['PHP_SELF'] . "?error=none");
    exit();
}

//Adds an instruction straight into instruction table, accessiable by engineer's only
function newInstruction($conn, $part_number, $description, $customer_code, $customer_name, $system_type, $instruction_level, $status, $revision, $initial_release, $last_update, $instruction_type)
{
    $sql = "INSERT INTO instruction (
        part_number, description, 
        customer_code, customer_name, system_type, 
        instruction_level, status, revision, 
        initial_release, last_update, instruction_type
      ) 
      VALUES 
        (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);";

    //Prepared statement to prevent sql injection
    $stmt = mysqli_stmt_init($conn);
    //Checks if sql statement executes & redirects to current page
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header('Location: ' . $_SERVER['PHP_SELF'] . "?error=sqlError");
        exit();
    }
    mysqli_stmt_bind_param($stmt, "sssssssssss", $part_number, $description, $customer_code, $customer_name, $system_type, $instruction_level, $status, $revision, $initial_release, $last_update, $instruction_type);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header('Location: ' . $_SERVER['PHP_SELF'] . "?error=none");
    exit();
}

//Deletes instruction where id matches
function deleteInstruction($conn, $id)
{
    $sql = "DELETE FROM instruction WHERE id = ?";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header('Location: ' . $_SERVER['PHP_SELF'] . "?error=sqlError");
        exit();
    }
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header('Location: ' . $_SERVER['PHP_SELF'] . "?error=noneDeleteSuccess");
    exit();
}

//Updates a current instruction
function updateInstruction($conn, $part_number, $description, $customer_code, $customer_name, $system_type, $instruction_level, $status, $revision, $initial_release, $last_update, $instruction_type, $id)
{
    $sql = "UPDATE instruction SET part_number = ?, description = ?, customer_code = ?, customer_name = ?, system_type = ?, instruction_level = ?, status = ?, revision = ?, initial_release = ?, last_update = ?, instruction_type = ? WHERE id = ?;";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        echo ("Error description: " . $stmt->error);
        //header('Location: '.$_SERVER['PHP_SELF']. "?error=sqlError");
        exit();
    }
    mysqli_stmt_bind_param($stmt, "issssssssssi", $part_number, $description, $customer_code, $customer_name, $system_type, $instruction_level, $status, $revision, $initial_release, $last_update, $instruction_type, $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    header('Location: ' . $_SERVER['PHP_SELF'] . "?error=none");
    exit();
}


//Gets all instructions from instruction table
function getInstructions($conn)
{
    $sql = "SELECT * FROM instruction ORDER BY Id DESC;";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header('Location: ' . $_SERVER['PHP_SELF']);;
        exit();
    }
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);
    mysqli_stmt_close($stmt);
    return $result;
}


//Creates a new user with password hashing
function createUser($conn, $user_email, $pwd, $pwdRepeat, $department)
{
    $sql = "INSERT INTO users (email, password, department) VALUES (?, ? ,?) ;";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location:../add_user.php?error=sqlError");
        exit();
    }
    //Hashes the users password
    $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

    mysqli_stmt_bind_param($stmt, "sss", $user_email, $hashedPwd, $department);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location:../add_user.php?error=noneUserAdded");
    exit();
}

//Deletes user from users table
function DeleteUser($conn, $id)
{
    $sql = "DELETE FROM users WHERE id = ?;";
    //Prepared statement to prevent sql injection
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location:../add_user.php?error=sqlError");
        exit();
    }
    mysqli_stmt_bind_param($stmt, "s", $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header('Location: ' . $_SERVER['PHP_SELF'] . "?error=noneUserDeleted");
    exit();
}

//Finds user with email match
//###Todo - Add javascript matching on key down
function readUser($conn, $user_email)
{
    $sql = "SELECT * FROM users WHERE email=? LIMIT 1";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $user_email);
    $stmt->execute();
    $result = $stmt->get_result(); // get the mysqli result
    $numRows = $result->num_rows;
    if ($numRows) {
        $user = $result->fetch_assoc(); // fetch data  
    } else {
        $user = false;
    }
    return $user;
}

//Returns message variable depending on get error
function getMessage()
{
    $message = "";

    if (isset($_GET["error"])) {

        if ($_GET["error"] == "emptyInput") {
            $message = "Please fill in all fields";

        } else if ($_GET["error"] == "invalidPassword") {
            $message = "Password requires at least 6 characters";

        } else if ($_GET["error"] == "passwordMismatch") {
            $message = "Please make sure passwords match";

        } else if ($_GET["error"] == "invalidDepartment") {
            $message = "Please select a valid department";

        } else if ($_GET["error"] == "userExists") {
            $message = "This email already exists";

        } else if ($_GET["error"] == "wrongLogin") {
            $message = "Incorrect login details";

        } else if ($_GET["error"] == "selectDepartment") {
            $message = "Please select a department";

        } else if ($_GET["error"] == "noneDeleteSuccess") {
            $message = "Delete Successful";

        } else if ($_GET["error"] == "noneUserAdded") {
            $message = "User added";

        } else if ($_GET["error"] == "none") {
            $message = "Record inserted";

        } else if ($_GET["error"] == "noneUserDeleted") {
            $message = "User deleted";
        }
        return $message;
    }
}
//Checks for empty input login
function emptyInputLogin($user_email, $pwd)
{ {
        if (empty($user_email) || empty($pwd)) $result = true;
        else {
            $result = false;
        }
        return $result;
    };
}
//Logs in the user and directs them to stats page
function loginUser($conn, $user_email, $pwd)
{
    $userExists = userExists($conn, $user_email);
    if ($userExists === false) {
        header("location:../index.php?error=wrongLogin");
        exit();
    }
    $pwdHashed = $userExists["password"];
    $checkedPwd = password_verify($pwd, $pwdHashed);
    //Redirect if wrong password
    if ($checkedPwd === false) {
        header("location:../index.php?error=wrongLogin");
        exit();
    } else if ($checkedPwd === true) {
        //Creates session and assigns session variables to user attributes
        session_start();
        $_SESSION["userid"] = $userExists["id"];
        $_SESSION["email"] = $userExists["email"];
        $_SESSION["department"] = $userExists["department"];
        header("location: ../stats.php");
        exit();
    }
}
//Engineering have unrestricted priviledges, production does not
function privilegeLevel($Department)
{
    if ($_SESSION['department'] == "Engineering") {
        return;
    }

    if (!isset($_SESSION['userid'])) {
        header("location: access_denied.php");
        exit();
    } elseif ($_SESSION['department'] != $Department) {
        header("location: access_denied.php");
        exit();
    }
}
//Checks session id and draws corresponding navbar
function drawNav()
{
    if (isset($_SESSION['userid'])) {
        if ($_SESSION['department'] == "Engineering") {
            echo
            '<a class="nav-item nav-link" href="stats.php">Stats</a>
            <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Instructions
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item" href="add_instruction.php">Add Instruction</a></li>
              <li><a class="dropdown-item" href="delete_instruction.php">Delete Instruction</a></li>
              <li><a class="dropdown-item" href="view_instructions.php">View Instructions</a></li>
              <li><a class="dropdown-item" href="view_request.php">View Requests</a></li>
            </ul>
          </li>
   
          <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Users
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="add_user.php">Add User</a></li>
            <li><a class="dropdown-item" href="modify_user.php">Delete User</a></li>       
          </ul>
        </li>
             <a class="nav-item nav-link" href="includes/logout.inc.php">Logout</a>';
        }

        if ($_SESSION['department'] == "Production") {
            echo
            '<a class="nav-item nav-link" href="stats.php">Stats</a>
                <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  Instructions
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <li><a class="dropdown-item" href="view_instructions.php">View Instructions</a></li>
                  <li><a class="dropdown-item" href="update_request.php">Update Instruction</a></li>
                  <li><a class="dropdown-item" href="create_request.php">Add Instuction</a></li>
                </ul>
              </li>
              <a class="nav-item nav-link" href="includes/logout.inc.php">Logout</a>';
        }
    }
}
//Counts field values for stats page
function countFieldValues($result, $fieldName, $value)
{
    $counter = 0;
    while ($row = mysqli_fetch_assoc($result)) {
        if ($row[$fieldName] == $value) {
            $counter++;
        }
    }
    return $counter;
}
//returns the type of request instruction, either New or Update
function requestType($row)
{
    $requestType = "";
    if ($row['instruction_id'] == 0) {
        $requestType = "New Instruction";
    } else {
        $requestType = "Instruction update";
    }
    return $requestType;
}

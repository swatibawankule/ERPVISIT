<?php
include_once "top_nav.php";
// core configuration

include_once "config/core.php";

 

// set page title

$page_title = "Reset Password";

 

// include login checker

// include_once "login_checker.php";

 

// include classes

include_once "config/database.php";

include_once "objects/user.php";

 

// get database connection

$database = new Database();

$db = $database->getConnection();

 

// initialize objects

$user = new User($db);

 

// include page header HTML

// include_once "layout_head.php";

 

echo "<div class='col-sm-12'>";

 

  // get given access code

$access_token=isset($_GET['access_token']) ? $_GET['access_token'] : die("Access code not found.");

 

// check if access code exists

$user->access_token=$access_token;

 

if(!$user->accessCodeExists()){

    die('access_token not found.');

}

 

else{

    // reset password form will be here

     // if form was posted

if($_POST){

 

    // set values to object properties

    $user->password=$_POST['password'];

 

    // reset password

    if($user->updatePassword()){

        echo "<div class='alert alert-info'>Password was reset. Please <a href='{$home_url}index'>login.</a></div>";

    }

 

    else{

        echo "<div class='alert alert-danger'>Unable to reset password.</div>";

    }

}

echo "<form action='" . htmlspecialchars($_SERVER["PHP_SELF"]) . "?access_token={$access_token}' method='post'>
 
    <table class='table table-hover table-responsive table-bordered' style='align:center'>
    
        <tr>

            <td>Password</td>

            <td><input type='password' name='password' class='form-control' required></td>

        </tr>

        <tr>

            <td></td>

            <td><button type='submit' class='btn btn-primary'>Reset Password</button></td>

        </tr>

    </table>

</form>";

}

 

echo "</div>";

 

// include page footer HTML

//include_once "footer.php";

?>
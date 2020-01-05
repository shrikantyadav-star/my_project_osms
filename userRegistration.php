<?php 
include('dbConnection.php');
if(isset($_REQUEST['rSingnup'])){
    // Checking for Empty Fields
    if(($_REQUEST['rName'] == "") || ($_REQUEST['rEmail'] == "") || ($_REQUEST['rPassword'] == "")){
        $regmsg = '<div class="alert alert-warning mt-2" role="alert">All Fields are Required</div>';
        }else{
        // Email Already Registered
        $sql = "SELECT `r_email` FROM `requesterlogin_tb` WHERE r_email = '".$_REQUEST['rEmail']."'";
        $result = $conn->query($sql);
        if($result->num_rows == 1){
            $regmsg = '<div class="alert alert-warning mt-2" role="alert">Email Id Already Registered</div>';
        }
        else{
            // Assigning user's values to variables
        $rName = $_REQUEST['rName'];
        $rEmail = $_REQUEST['rEmail'];
        $rPassword = $_REQUEST['rPassword'];
        $sql = "INSERT INTO `requesterlogin_tb`(`r_name`, `r_email`, `r_password`) VALUES ('$rName','$rEmail','$rPassword')";
        if($conn->query($sql) == TRUE){
        $regmsg = '<div class="alert alert-success mt-2" role="alert">Account Created Successfully</div>';
        }else{
        $regmsg = '<div class="alert alert-warning mt-2" role="alert">Unable to Create Account</div>';
      }
    }
  }
}
?>
<!-- Start Registration Form Container -->
<div class="container pt-5" id="Registration">
    <h2 class="text-center">Create an Account</h2>
    <div class="row mt-4 mb-4">
        <div class="col-md-6 offset-md-3">
            <form action="" method="POST" class="shadow-lg p-4">
                <div class="form-group">
                    <i class="fas fa-user"></i><label for="name" class="font-weight-bold pl-2">Name</label>
                    <input type="text" name="rName" placeholder="Enter your name..." class="form-control">
                </div>
                <div class="form-group">
                        <i class="fas fa-user"></i><label for="email" class="font-weight-bold pl-2">Email</label>
                        <input type="email" name="rEmail" placeholder="Enter your email..." class="form-control">
                        <small class="form-text">We will never share your email with anyone.</small>
                </div>
                <div class="form-group">
                        <i class="fas fa-key"></i><label for="password" class="font-weight-bold pl-2">New Password</label>
                        <input type="password" name="rPassword" placeholder="Enter your password..." class="form-control">
                </div>
                <button type="submit" name="rSingnup" class="btn btn-danger mt-5 btn-block font-weight-bold shadow-sm">Sign Up</button>
                <em style="font-size:10px;">Note - By clicking Sign Up, you agree to our Terms, Data
                        Policy and Cookie Policy.</em>
                        <?php if(isset($regmsg)) {echo $regmsg;} ?>
            </form>
        </div>
    </div>
</div>
<!-- End Registration Form Container -->
<?php    
define('TITLE', 'Update Technician');
define('PAGE', 'technician');
include('includes/header.php'); 
include('../dbConnection.php');
session_start();
 if(isset($_SESSION['is_adminlogin'])){
  $aEmail = $_SESSION['aEmail'];
 } else {
  echo "<script> location.href='login.php'; </script>";
 }
 // update
 if(isset($_REQUEST['empupdate'])){
  // Checking for Empty Fields
  if(($_REQUEST['empid'] == "") || ($_REQUEST['empName'] == "") || ($_REQUEST['empCity'] == "")
   || ($_REQUEST['empMobile'] == "") || ($_REQUEST['empEmail'] == "")){
   // msg displayed if required field missing
   $msg = '<div class="alert alert-warning col-sm-6 ml-5 mt-2" role="alert"> Fill All Fileds </div>';
  } else {
    // Assigning User Values to Variable
    $empid = $_REQUEST['empid'];
    $empName = $_REQUEST['empName'];
    $empCity = $_REQUEST['empCity'];
    $empMobile = $_REQUEST['empMobile'];
    $empEmail = $_REQUEST['empEmail'];

  $sql = "UPDATE technician_tb SET empid = '$empid', empName = '$empName', empCity = '$empCity',
   empMobile = '$empMobile', empEmail= '$empEmail' WHERE empid = '$empid'";
    if($conn->query($sql) == TRUE){
     // below msg display on form submit success
     $msg = '<div class="alert alert-success col-sm-6 ml-5 mt-2" role="alert"> Updated Successfully </div>';
    } else {
     // below msg display on form submit failed
     $msg = '<div class="alert alert-danger col-sm-6 ml-5 mt-2" role="alert"> Unable to Update </div>';
    }
  }
  }
 ?>
<div class="col-sm-6 mt-5  mx-3 jumbotron">
  <h3 class="text-center">Update Technician Details</h3>
  <?php
 if(isset($_REQUEST['view'])){
  $sql = "SELECT * FROM technician_tb WHERE empid = {$_REQUEST['id']}";
 $result = $conn->query($sql);
 $row = $result->fetch_assoc();
 }
 ?>
  <form action="" method="POST">
    <div class="form-group">
      <label for="empid">Emp ID</label>
      <input type="text" class="form-control" id="empid" name="empid" value="<?php if(isset($row['empid'])) {echo $row['empid']; }?>">
    </div>
    <div class="form-group">
      <label for="empName">Name</label>
      <input type="text" class="form-control" id="empName" name="empName" value="<?php if(isset($row['empName'])) {echo $row['empName']; }?>">
    </div>
    <div class="form-group">
      <label for="empCity">City</label>
      <input type="text" class="form-control" id="empCity" name="empCity" value="<?php if(isset($row['empCity'])) {echo $row['empCity']; }?>">
    </div>
    <div class="form-group">
      <label for="empMobile">Mobile</label>
      <input type="nubmer" class="form-control" id="empMobile" name="empMobile" value="<?php if(isset($row['empMobile'])) {echo $row['empMobile']; }?>">
    </div>
    <div class="form-group">
      <label for="empEmail">Email</label>
      <input type="email" class="form-control" id="empEmail" name="empEmail" value="<?php if(isset($row['empEmail'])) {echo $row['empEmail']; }?>">
    </div>

    <div class="text-center">
      <button type="submit" class="btn btn-danger" id="empupdate" name="empupdate">Update</button>
      <a href="requester.php" class="btn btn-secondary">Close</a>
    </div>
    <?php if(isset($msg)) {echo $msg; } ?>
  </form>
</div>

<?php
include('includes/footer.php'); 
?>
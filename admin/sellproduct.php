<?php    
define('TITLE', 'Sell Product');
define('PAGE', 'assets');
include('includes/header.php'); 
include('../dbConnection.php');
session_start();
 if(isset($_SESSION['is_adminlogin'])){
  $aEmail = $_SESSION['aEmail'];
 } else {
  echo "<script> location.href='login.php'; </script>";
 }
 if(isset($_REQUEST['psubmit'])){
  // Checking for Empty Fields
  if(($_REQUEST['custname'] == "") || ($_REQUEST['custadd'] == "") || ($_REQUEST['cpname'] == "")
   || ($_REQUEST['cpquantity'] == "") || ($_REQUEST['cpeach'] == "") || ($_REQUEST['cptotal'] == "")
    || ($_REQUEST['cpdate'] == "")){
   // msg displayed if required field missing
   $msg = '<div class="alert alert-warning col-sm-6 ml-5 mt-2" role="alert"> Fill All Fileds </div>';
  } else {
    // Assigning User Values to Variable for update
    $pid = $_REQUEST['pid'];
    $pava = ($_REQUEST['pava'] - $_REQUEST['cpquantity']);

    // Assigning User Values to Variable for insert
    $custname = $_REQUEST['custname'];
    $custadd = $_REQUEST['custadd'];
    $cpname = $_REQUEST['cpname'];
    $cpquantity = $_REQUEST['cpquantity'];
    $cpeach = $_REQUEST['cpeach'];
    $cptotal = $_REQUEST['cptotal'];
    $cpdate = $_REQUEST['cpdate'];
    $sqlin = "INSERT INTO customer_tb(custname, custadd, cpname, cpquantity, cpeach, cptotal, cpdate) VALUES 
    ('$custname','$custadd', '$cpname', '$cpquantity', '$cpeach', '$cptotal', '$cpdate')";
    if($conn->query($sqlin) == TRUE){
      // below function captures inserted id
      $genid = mysqli_insert_id($conn);
      session_start();
      $_SESSION['myid'] = $genid;
      echo "<script> location.href='productsellsuccess.php'; </script>";
    } 
    // Updating Assest data for available product after sell
    $sql = "UPDATE assets_tb SET pava = '$pava' WHERE pid = '$pid'";
    $conn->query($sql);
  }
}
 ?>
<div class="col-sm-6 mt-5  mx-3 jumbotron">
  <h3 class="text-center">Customer Bill</h3>
  <?php
 if(isset($_REQUEST['issue'])){
  $sql = "SELECT * FROM assets_tb WHERE pid = {$_REQUEST['id']}";
 $result = $conn->query($sql);
 $row = $result->fetch_assoc();
 }
 ?>
  <form action="" method="POST">
    <div class="form-group">
      <label for="pid">Product ID</label>
      <input type="text" class="form-control" id="pid" name="pid" value="<?php if(isset($row['pid'])) {echo $row['pid']; }?>"
        readonly>
    </div>
    <div class="form-group">
      <label for="custname">Customer Name</label>
      <input type="text" class="form-control" id="custname" name="custname">
    </div>
    <div class="form-group">
      <label for="custadd">Customer Address</label>
      <input type="text" class="form-control" id="custadd" name="custadd">
    </div>
    <div class="form-group">
      <label for="cpname">Product Name</label>
      <input type="text" class="form-control" id="cpname" name="cpname" value="<?php if(isset($row['pname'])) {echo $row['pname']; }?>" readonly>
    </div>
    <div class="form-group">
      <label for="pava">Available</label>
      <input type="text" class="form-control" id="pava" name="pava" value="<?php if(isset($row['pava'])) {echo $row['pava']; }?>"
        readonly onkeypress="isInputNumber(event)">
    </div>
    <div class="form-group">
      <label for="cpquantity">Quantity</label>
      <input type="text" class="form-control" id="cpquantity" name="cpquantity" onkeypress="isInputNumber(event)">
    </div>
    <div class="form-group">
      <label for="cpeach">Price Each</label>
      <input type="text" class="form-control" id="cpeach" name="cpeach" value="<?php if(isset($row['psellingcost'])) {echo $row['psellingcost']; }?>"
        onkeypress="isInputNumber(event)" readonly>
    </div>
    <div class="form-group">
      <label for="cptotal">Total Price</label>
      <input type="text" class="form-control" id="cptotal" name="cptotal" onkeypress="isInputNumber(event)">
    </div>
    <div class="form-group">
      <label for="inputDate">Date</label>
      <input type="date" class="form-control" id="inputDate" name="cpdate">
    </div>
    <div class="text-center">
      <button type="submit" class="btn btn-danger" id="psubmit" name="psubmit">Submit</button>
      <a href="assets.php" class="btn btn-secondary">Close</a>
    </div>
    <?php if(isset($msg)) {echo $msg; } ?>
  </form>
</div>
<!-- Only Number for input fields -->
<script>
  function isInputNumber(evt) {
    var ch = String.fromCharCode(evt.which);
    if (!(/[0-9]/.test(ch))) {
      evt.preventDefault();
    }
  }
</script>
<?php
include('includes/footer.php'); 
?>
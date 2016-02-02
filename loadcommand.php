<?php include('inc/header.html');
$con = mysqli_connect('localhost','root','spydergeek','grains');
if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
}
mysqli_select_db($con,"ajax_demo");
$sql="SELECT * FROM categories";
$result = mysqli_query($con,$sql);
?>
<div class="container">
<div class="row">
<div class="col-md-6 col-md-offset-3">
<form class="form-control">
  <select name="commands" onchange="showCommands(this.value)">
    <option value="">Select a Command:</option>
    <?php
    while($row = mysqli_fetch_array($result))
    {?>
      /** create the options **/
      <option value="<?php echo $row['id'];?>"><?php echo $row['name'];?></option>
    <?php }
    ?>
  </select>
</form>
<br />
<div id="txtHint"><b>Command Information listed here...</b></div>
</div>
</div>
</div>
<?php include('inc/footer.html');?>

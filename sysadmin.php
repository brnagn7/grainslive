<?php include('inc/header.html'); ?>
    <!-- Page Content -->
    <div class="container">
        <!-- Page Heading/Breadcrumbs -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Local System Administration
                    <small>Linux</small>
                </h1>
            </div>
        </div>
        <!-- /.row -->
        <div class="panel panel-danger">
          <div class="panel-heading">
          <h3 class="panel-title">Local System Administration <img src="webroot/img/tux2.png" class="img-rounded"></h3>
          <h5><span align="right" class="glyphicon glyphicon-book"></span> Intermediate
          </div>
  <ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#home">Administration</a></li>
  </ul>

  <div class="tab-content">
    <div id="home" class="tab-pane fade in active">
      <h3>Local System Administration</h3>
      <p>This section is the main entry point for <strong>System Administration</strong> where you will find a nice collection of tasks that are essential for any Administrator. I have here only that which scratches the surface, there are so many usefull websites online today that it really is very easy to pick up and learn Linux in no time.</p>
    </div>
    <?php
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
    <div class="alert alert-danger">


    <div id="txtHint"><strong>Command Information listed here...</strong></div>
  </div>
<!-- end main div -->
</div>
<hr>
    </div>
    <!-- /.container -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
    <?php include('inc/footer.html'); ?>

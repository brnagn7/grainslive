<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Edward Mooney">
    <title>Grains of Wheat - producing much fruit</title>
    <!-- Bootstrap Core CSS -->
    <?php echo $this->Html->css(array('cyborg','modern-business'));?>
    <!-- Custom Fonts -->
    <?php echo $this->Html->css('/font-awesome/css/font-awesome.min');?>
    <!-- Custom JS -->
    <?php echo $this->Html->script(array('jquery', 'bootstrap.min'));?>
    <!-- CLI -->
  <link href='http://fonts.googleapis.com/css?family=Source+Code+Pro' rel='stylesheet' type='text/css'>
  <link rel="stylesheet" href="http://code.jquery.com/ui/1.9.2/themes/base/jquery-ui.css">
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
  <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/jquery-ui.min.js"></script>
  <script src="http://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.4.2/underscore-min.js"></script>
  <script>Josh = {Debug: true };</script>
  <?php echo $this->Html->script(array('history', 'killring', 'readline', 'input', 'shell', 'pathhandler', 'example'));?>
    <!-- End CLI -->
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <!-- <a class="navbar-brand" href="/">
    <img src="/img/spyderdrop.png"
    style="position:absolute;top:31px;left:170px;"></a></a> -->
    <?php echo $this->Html->link('Home', '/',['class' => 'navbar-brand']);?>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a href="/pages/about">About</a>
                    </li>
                    <li>
                        <a href="/pages/contact">Contact</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
<div align="center"><?php echo $this->Html->image('banner3.jpg', ['class' => 'img-rounded']);?></div>

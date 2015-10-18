<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?=$this->element('Guests/title')?>
    </title>
    
 	<link href='https://fonts.googleapis.com/css?family=Ubuntu:400,300,300italic,500,400italic,500italic,700italic,700&subset=latin,greek' rel='stylesheet' type='text/css'>
 
    <?= $this->Html->meta('icon') ?>

    <?= 
    $this->Html->css(array(
    	'/assets/fontawesome/css/font-awesome.min',
    	'/assets/bootstrap/css/bootstrap.min',
    	'/assets/bootstrap/css/bootstrap-select.min',
    	'/assets/css/dropzone',
    	'/assets/css/style',
    	'/assets/css/user.style',
    ));
    ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
    
    <!--[if lte IE 9]>
	<script type="text/javascript" src="/assets/js/ie-scripts.js"></script>
	<![endif]-->
    
</head>

<body class="page-subpage page-profile navigation-top-header page-fade-in" id="page-top">
<div id="outer-wrapper">
	<div id="inner-wrapper">
		<?= $this->element('Guests/top_bar') ?>
		<div id="page-canvas">
			<div id="page-content">
				<?= $this->Flash->render() ?>
				<?= $this->fetch('content') ?>
			</div>
		</div>
	</div>
</div>

 <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false&libraries=places&language=el"></script>
  
   <?= 
   $this->Html->script(array(
    	'/assets/js/jquery.min',
    	'/assets/js/before.load',
    	'/assets/bootstrap/js/bootstrap.min',
   		'/assets/js/bootstrap-select.min',
   		'/assets/js/smoothscroll',
   		'/assets/js/dropzone',
   		'/assets/js/icheck.min',
   		'/assets/js/infobox',
   		'/assets/js/richmarker-compiled',
    	'/assets/js/custom',
   		'/assets/js/maps',
   		'/assets/js/_infobox',
    ));
   ?>
        
</body>
</html>

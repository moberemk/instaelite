<?php
/**
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $title_for_layout; ?>
	</title>
	<?php
	echo $this->Html->meta('icon');

	echo $this->Html->css('bootstrap.min');
	echo $this->Html->css('font-awesome.min');
	echo $this->Html->css('lightbox');
	echo $this->Html->css('style');
	echo $this->Html->css('multi-select');
	echo $this->Html->css('http://vjs.zencdn.net/4.1/video-js.css');

	// echo $this->Html->script('http://code.jquery.com/jquery-1.9.1.js');
	echo $this->Html->script('jquery-1.8.3.min');
	echo $this->Html->script('bootstrap.min');
	echo $this->Html->script('jquery.backstretch.min');
	echo $this->Html->script('lightbox-2.6.min');
	echo $this->Html->script('jquery.multi-select');
	echo $this->Html->script('video');

	echo $this->fetch('meta');
	echo $this->fetch('css');
	echo $this->fetch('script');
	?>
	<script>
	  videojs.options.flash.swf = "<?php echo Router::url('js/video-js.swf'); ?>"
	</script>
</head>
<body>
	<div class="navbar-container">
		<div class="navbar navbar-inverse navbar-fixed-top">
			<div class="navbar-header">
			    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
			      <span class="sr-only">Toggle navigation</span>
			      <span class="icon-bar"></span>
			      <span class="icon-bar"></span>
			      <span class="icon-bar"></span>
			    </button>
				<?php echo $this->Html->link('InstaElite', '/', array('class'=>'navbar-brand')); ?>
			</div>
			<div class="collapse navbar-collapse navbar-ex1-collapse">
				<ul class="nav navbar-nav">
					<?php
					if(isset($activeUser)) {
						echo '<li class="dropdown"><a href="#" role="button" class="dropdown-toggle" data-toggle="dropdown">Me <b class="caret"></b></a>';
						echo '<ul class="dropdown-menu" role="menu">';
						echo '<li>'.$this->Html->link('<i class="icon-user"></i> Profile', array('admin'=>false, 'controller'=>'users', 'action'=>'view', $activeUser['username']), array('escape'=>false)).'</li>';
						echo '<li>'.$this->Html->link('<i class="icon-wrench"></i> Options', array('admin'=>false, 'controller'=>'users', 'action'=>'options'), array('escape'=>false)).'</li>';
						echo '<li>'.$this->Html->link('<i class="icon-edit"></i> Change Password', array('admin'=>false, 'controller'=>'users', 'action'=>'change_password'), array('escape'=>false)).'</li>';
						echo '</ul>';
						echo '</li>';
						echo '<li class="dropdown"><a href="#" role="button" class="dropdown-toggle" data-toggle="dropdown">Offers <span class="badge">'.$activeUserOffers.'</span><b class="caret"></b></a>';
						echo '<ul class="dropdown-menu" role="menu">';
						echo '<li>'.$this->Html->link('<i class="icon-envelope"></i> Current Offers ', array('admin'=>false, 'controller'=>'offers', 'action'=>'index'), array('escape'=>false)).'</li>';
						echo '<li>'.$this->Html->link('<i class="icon-money"></i> Revenue ', array('admin'=>false, 'controller'=>'users', 'action'=>'revenue'), array('escape'=>false)).'</li>';
						echo '<li>'.$this->Html->link('<i class="icon-dollar"></i> Payment ', array('admin'=>false, 'controller'=>'users', 'action'=>'payment'), array('escape'=>false)).'</li>';
						echo '</ul>';
						echo '</li>';
						if($activeUser['group_id'] == 0) {
							echo '<li class="dropdown">';
							echo '<a href="#" role="button" class="dropdown-toggle" data-toggle="dropdown">Administration<b class="caret"></b></a>';
							echo '<ul class="dropdown-menu" role="menu">';
							echo '<li>'.$this->Html->link('<i class="icon-user"></i> Users', array('admin'=>true, 'controller'=>'users', 'action'=>'index'), array('escape'=>false)).'</li>';
							echo '<li>'.$this->Html->link('<i class="icon-bar-chart"></i> Campaigns', array('admin'=>true, 'controller'=>'campaigns', 'action'=>'index'), array('escape'=>false)).'</li>';
							echo '<li>'.$this->Html->link('<i class="icon-archive"></i> Offers', array('admin'=>true, 'controller'=>'offers', 'action'=>'index'), array('escape'=>false)).'</li>';
							echo '<li>'.$this->Html->link('<i class="icon-list-alt"></i> Categories', array('admin'=>true, 'controller'=>'categories', 'action'=>'index'), array('escape'=>false)).'</li>';
							echo '</ul>';
							echo '</li>';
						}
					}
					?>
				</ul>
				<ul class="nav navbar-nav pull-right">
					<?php
					if(isset($activeUser)) {
						echo '<li>'.$this->Html->link('<i class="icon-signout"></i> Log Out', array('controller'=>'users', 'action'=>'logout', 'admin'=>false), array('escape'=>false)).'</li>';
					} else {
						echo '<li>'.$this->Html->link('Log In', array('controller'=>'users', 'action'=>'login')).'</li>';
					}
					?>
				</ul>
			</div>
		</div>
		<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-responsive-collapse">
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		</button>
	</div>
	<div id="main-wrapper">
		<div class="container">
			<div id="content" class="clearfix">
				<?php echo $this->Session->flash(); ?>
				
				<?php echo $this->fetch('content'); ?>
			</div>
		</div>
		<footer>
			<div class="container">
				<div class="row-fluid">
					<div class="col-md-4">
						<?php
						echo '<div>'.$this->Html->image('logo.png', array('style'=>'max-width: 100%;')).'</div>';
						echo '<div>'.$this->Html->image('phone_number_min.png', array('style'=>'max-width: 100%;')).'</div>';
						?>
					</div>
					<div class="col-md-4">

					</div>
					<div class="col-md-4">
						<h3>Connect with Us</h3>
						<ul class="list-unstyled">
							<li>
							<?php echo $this->Html->image('twitter.png'); ?> <a href="http://www.twitter.com/instaelite">@InstaElite</a>
							<li><?php echo $this->Html->image('facebook.png'); ?> <a href="http://www.facebook.com/instaelite">Facebook.com/InstaElite</a></li>
							<li><?php echo $this->Html->image('email.png'); ?> <a href="mailto:connect@instaelite.com">connect@instaelite.com</a></li>
						</ul>
					</div>
				</div>
				<div style="text-align: center">
					<ul class="list-unstyled list-inline">
						<li><?php echo $this->Html->link('Privacy Policy', array('admin'=>false, 'controller'=>'pages', 'action'=>'view', 'privacy')); ?></li>
						<li><?php echo $this->Html->link('Terms of Use', array('admin'=>false, 'controller'=>'pages', 'action'=>'view', 'terms')); ?></li>
						<li><?php echo $this->Html->link('Our Comittment', array('admin'=>false, 'controller'=>'pages', 'action'=>'view', 'commitment')); ?></li>
					</ul>
					<p>Copyright © 2013 <strong>InstaElite</strong>. All Rights Reserved.</p>
				</div>
			</div>
		</footer>
	</div>
	<script type="text/javascript">
		$(document).ready(function () {
			$('#main-wrapper').backstretch('<?php echo Router::url("/img/bg.jpg"); ?>');
			$("select[multiple='multiple']").multiSelect();
		});
	</script>
</body>
</html>

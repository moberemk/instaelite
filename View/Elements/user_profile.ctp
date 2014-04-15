<div class="user-profile<?php if($miniView){echo ' mini-view';} ?>" id="<?php echo $user['User']['username'].'_profile'; ?>">
	<?php if($user['User']['cover_photo'] != '') { ?>
	<div class="cover-photo" style="background-image: url('<?php echo Router::url('/img/users/cover_photos/'.$user['User']['id'].'/'.$user['User']['cover_photo']); ?>');"></div>
	<?php } ?>
	<div class="content">
		<div class="user-bio">
			<div class="picture">
			<?php
			if($user['User']['profile_photo']) {
				echo $this->Html->image('users/profile_photos/'.$user['User']['id'].'/'.$user['User']['profile_photo']);
			} else {
				echo $this->Html->image('users/anonymousUser.jpg');
			}
			?>
			</div>
			<div class="user-text">
				<div class="name">
						<ul class="link-list list-unstyled list-inline pull-right">
						<?php
							if($user['User']['website']) {
								echo '<li>'.$this->Html->link('<i class="icon-globe"></i>', $user['User']['website'], array('escape'=>false)).'</li>';
							}
							if($user['User']['twitter']) {
								echo '<li>'.$this->Html->link('<i class="icon-twitter"></i>', $user['User']['twitter'], array('escape'=>false)).'</li>';
							}
							if($user['User']['facebook']) {
								echo '<li>'.$this->Html->link('<i class="icon-facebook"></i>', $user['User']['facebook'], array('escape'=>false)).'</li>';
							}
							if($user['User']['pinterest']) {
								echo '<li>'.$this->Html->link('<i class="icon-pinterest"></i>', $user['User']['pinterest'], array('escape'=>false)).'</li>';
							}
						?>
						</ul>
					<h2><?php echo $this->Html->link($user['User']['name'], array('controller'=>'users', 'action'=>'view', $user['User']['username'])); ?></h2>
					<h3><?php echo $this->Html->link($user['User']['username'], 'http://instagram.com/'.$user['User']['username']); ?></h3>
				</div>
				<div class="bio"><?php echo $user['User']['bio']; ?></div>
			</div>
			<div class="category-box">
				<ul class="categories list-inline list-unstyled">
					<?php foreach($user['Category'] as $category) {
						echo '<li>'.$this->Html->link('#'.$category['name'], array('controller'=>'categories', 'action'=>'view', $category['id'])).'</li>';
					} ?>
				</ul>
			</div>
			<div class="status-box row">
				<div class="follower-count col-xs-4">
					<span class="title">Followers</span>
					<span class="count"><?php echo $user['User']['follower_count']; ?></span>
				</div>
				<div class="campaign-count col-xs-4">
					<span class="title">Campaigns</span>
					<span class="count"><?php	echo $this->User->acceptedOffers($user); ?></span>
				</div>
				<div class="rank col-xs-4">
					<span class="title">Rank</span>
					<span class="count"><?php echo $this->User->rank($user); ?></span>
				</div>
			</div>
		</div>
		<?php if(count($offers)) { ?>
			<div class="row campaigns">
				<?php
				foreach ($offers as $key => $offer) {
					echo '<div class="col-sm-4">';
					echo $this->element('profile_campaign', array('offer' => $offer));
					echo '</div>';
				}
				?>
			</div>
		<?php } ?>
	</div>
</div>

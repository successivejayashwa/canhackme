					<div class="text-right">
						<a href="#">Back to top</a>
					</div>
				</div>
			</div>
			<footer>
				<div class="bg-dark border-top">
					<nav class="navbar navbar-expand-lg navbar-dark col-md-7 mx-auto">
						<div class="navbar-text mr-auto">
							<span class="text-light">© <a class="text-light" href="<?php Data::text(__AUTHOR__['website']); ?>" target="_blank"><?php Data::text(__AUTHOR__['name']); ?></a>. All rights reserved.</span>
						</div>
						<div class="collapse navbar-collapse">
							<ul class="navbar-nav ml-auto">
<?php if(Users::is_signed()): ?>
								<li class="nav-item">
									<a class="nav-link<?php if($args['active'] === 'profile'): ?> active<?php endif; ?>" href="/users/profile/<?php Data::url(strtolower(Users::get_my_user('user_name'))); ?>"><i class="fa fa-user-circle-o mr-1" aria-hidden="true"></i> My profile</a></a>
								</li>
								<li class="nav-item">
									<a class="nav-link<?php if($args['active'] === 'settings'): ?> active<?php endif; ?>" href="/users/settings"><i class="fa fa-cog mr-1" aria-hidden="true"></i> Settings</a></a>
								</li>
								<li class="nav-item">
									<a class="nav-link" href="/users/sign-out?token=<?php Data::url(Users::get_signed_token()); ?>&url=<?php Data::url(Templater::get_url_path()); ?>"><i class="fa fa-sign-out mr-1" aria-hidden="true"></i> Sign out</a>
								</li>
<?php else: ?>
								<li class="nav-item<?php if($args['active'] === 'sign-in'): ?> active<?php endif; ?>">
									<a class="nav-link" href="/users/sign-in"><i class="fa fa-sign-in mr-1" aria-hidden="true"></i> Sign in</a>
								</li>
								<li class="nav-item<?php if($args['active'] === 'sign-up'): ?> active<?php endif; ?>">
									<a class="nav-link" href="/users/sign-up"><i class="fa fa-user-plus mr-1" aria-hidden="true"></i> Sign up</a>
								</li>
<?php endif; ?>
							</ul>
						</div>
					</nav>
				</div>
			</footer>
		</div>
	</body>
<?php if(isset($args['script']{0})): ?>
	<script>
		$(function(){ <?php echo $args['script']; ?> });
	</script>
<?php endif; ?>
</html>

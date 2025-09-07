<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="author" content="Untree.co">
	<link rel="shortcut icon" href="<?= base_url('public/assets/images/favicon.png') ?>">

	<meta name="description" content="" />
	<meta name="keywords" content="bootstrap, bootstrap5" />

	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Work+Sans:wght@400;600;700&display=swap" rel="stylesheet">


	<link rel="stylesheet" href="<?= base_url('public/assets/fonts/icomoon/style.css') ?>">
	<link rel="stylesheet" href="<?= base_url('public/assets/fonts/flaticon/font/flaticon.css') ?>">

	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">

	<link rel="stylesheet" href="<?= base_url('public/assets/css/tiny-slider.css') ?>">
	<link rel="stylesheet" href="<?= base_url('public/assets/css/aos.css') ?> ">
	<link rel="stylesheet" href="<?= base_url('public/assets/css/glightbox.min.css') ?>">
	<link rel="stylesheet" href="<?= base_url('public/assets/css/style.css') ?>">

	<link rel="stylesheet" href="<?= base_url('public/assets/css/flatpickr.min.css') ?>">
	<link rel="stylesheet" href="<?= base_url('public/assets/css/card.css') ?>">


	<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
	<link rel="stylesheet" href="<?= base_url('public/assets/css/table.css') ?>">
	<link rel="stylesheet" href="<?= base_url('public/assets/css/dropdown.css') ?>">
	<link rel="stylesheet" href="<?= base_url('public/assets/css/register.css') ?>">
	<title>Blog App</title>
</head>
<body>

	<div class="site-mobile-menu site-navbar-target">
		<div class="site-mobile-menu-header">
			<div class="site-mobile-menu-close">
				<span class="icofont-close js-menu-toggle"></span>
			</div>
		</div>
		<div class="site-mobile-menu-body">
		</div>
		<div>
			
		</div>
	</div>

	<nav class="site-nav" style="background-color:#2c2c2c;">
		<div class="container">
			<div class="menu-bg-wrap">
				<div class="site-navigation">
					<div class="row g-0 align-items-center">
						<div class="col-1">
							<a href="#" class="burger site-menu-toggle js-menu-toggle d-inline-block light">
								<span></span>
							</a>
						</div>
						<div class="col-1">
							
							<a href="<?php echo base_url("/") ?>" class="logo m-0 float-start">Blogs<span class="text-primary">.</span></a>
						</div>
						<div class="col-8 text-center">
							<form action="#" class="search-form ">
								<input type="text" class="form-control" placeholder="Search...">
								<span class="bi-search"></span>
							</form>
						</div>
						<div class="col-2 text-end">
							
							<ul class="js-clone-nav d-none d-lg-inline-block text-start site-menu mx-auto">
								<?php if(!isset(auth()->user()->username)): ?>
									<li><a href="<?php echo base_url('login') ?>">Login</a></li>
									<li><a href="<?php echo base_url('register') ?>">Register</a></li>
								<?php else: ?>
									<li class="has-children">
										<a href="#">
											<img style="aspect-ratio: 1/1; border-radius:50%; height: 30px;" src="<?= 'https://avatar.iran.liara.run/username?username=' . auth()->user()->username ?>" alt="user-avatar">
											<?php echo auth()->user()->username ?>
										</a>
										<ul class="dropdown">
											<li><a href="<?php echo base_url('logout') ?>">Logout</a></li>
										</ul>
									</li>
								<?php endif; ?>
							</ul>

							<ul class="js-clone-nav d-none text-start site-menu mx-auto">
									<li><a href="<?php echo base_url('/') ?>">Home</a></li>
									<li><a href="<?php echo base_url('/category') ?>">Category master</a></li>
									<li><a href="<?php echo base_url('/user') ?>">User master</a></li>
									<li><a href="<?php echo base_url('/role') ?>">Role master</a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</nav>

	<div class="app" style="min-height:100vh;background-color:#3c3c3c;">
		<?= $this->renderSection('content'); ?>
	</div>

	<footer class="site-footer" style="padding:10px;">
		<div class="container">
			<div style="width:100%; display:flex; align-items:center; justify-content:center">
         		<p>Copyright &copy;<script>document.write(new Date().getFullYear());</script>. All Rights Reserved. &mdash; Designed with love by Damodar
            </p>
          </div>
        </div>
      </div> <!-- /.container -->
    </footer> <!-- /.site-footer -->

    <!-- Preloader -->
    <div id="overlayer"></div>
    <div class="loader">
    	<div class="spinner-border text-primary" role="status">
    		<span class="visually-hidden">Loading...</span>
    	</div>
    </div>


    <script src="<?= base_url('public/assets/js/bootstrap.bundle.min.js') ?>"></script>
    <script src="<?= base_url('public/assets/js/tiny-slider.js') ?>"></script>

    <script src="<?= base_url('public/assets/js/flatpickr.min.js') ?>"></script>


    <script src="<?= base_url('public/assets/js/aos.js') ?>"></script>
    <script src="<?= base_url('public/assets/js/glightbox.min.js') ?>"></script>
    <script src="<?= base_url('public/assets/js/navbar.js') ?>"></script>
    <script src="<?= base_url('public/assets/js/counter.js') ?>"></script>
    <script src="<?= base_url('public/assets/js/custom.js') ?>"></script>
	<script src="<?= base_url('public/assets/js/dropdown.js') ?>"></script>
    
</body>
</html>

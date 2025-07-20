<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-light-primary elevation-4">
	<!-- Brand Logo -->
	<a href="<?= base_url('home'); ?>" class="brand-link ">
		<div class="sidebar-brand-icon rotate-n-15">
			<img src="<?= base_url('assets/img/AdminLTELogo.png') ?>" alt="Strong Point" class="brand-image img-circle elevation-3" style="opacity: .8">
		</div>
		<span class="brand-text   mx-2">Strong Point</span>
	</a>

	<!-- Sidebar -->
	<div class="sidebar">
		<!-- Sidebar user panel (optional) -->
		<!-- <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="<?= base_url('assets/') ?>dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">Alexander Pierce</a>
            </div>
        </div> -->

		<!-- Sidebar Menu -->

		<nav class="mt-2">

			<ul class="nav nav-pills nav-sidebar nav-child-indent flex-column" data-widget="treeview" role="menu" data-accordion="false">



				<div class="user-panel mt-2 pb-2 mb-2 ">
					<li class="nav-item has-treeview menu-open">
						<a class="nav-link" href="<?= base_url('home'); ?>">
							<i class="fas fa-home fa-fw"></i>
							<span>Home</span></a>
					</li>
				</div>
				<div class="user-panel mt-2 pb-2 mb-2 ">
					<li class="nav-item has-treeview menu-open">
						<a class="nav-link" href="">
							<i class="fas fa-building fa-fw"></i>
							<span>OPD</span></a>

						<?php $list_opd = $this->db->query("SELECT opd FROM `opd` GROUP by opd order by id")->result_array(); ?>
						<?php foreach ($list_opd as $o) : ?>
							<ul class="nav nav-treeview  nav-child-indent">
								<li class="nav-item ">
									<a href="<?= base_url('opd/instansi/' . strtolower($o['opd'])); ?>" class="nav-link <?= (strtolower($o['opd']) == (strtolower(urldecode($this->uri->segment(3))))) ? 'active bg-primary' : ''; ?>">
										<?php
										// var_dump(($list_opd == (ucwords(urldecode($this->uri->segment(3))))));
										// var_dump($list_opd);
										// var_dump((ucwords(urldecode($this->uri->segment(3)))));
										// die();
										?>
										<i class="far fa-circle nav-icon"></i>
										<p><?= $o['opd']; ?></p>
									</a>
								</li>
							</ul>
						<?php endforeach; ?>
					</li>
				</div>
				<!-- <hr class="sidebar-divider d-none d-md-block" /> -->
				<!-- Nav Item - Logout -->
				<li class="nav-item">
					<a class="nav-link" href="<?= base_url('auth/logout'); ?>" data-toggle="modal" data-target="#logoutModal">
						<i class="fas fa-fw fa-sign-out-alt"></i>

						<span>Logout</span></a>
				</li>


			</ul>
		</nav>
		<!-- /.sidebar-menu -->
	</div>
	<!-- /.sidebar -->
</aside>
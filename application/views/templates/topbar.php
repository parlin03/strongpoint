 <!-- Navbar -->
 <nav class="main-header navbar navbar-expand navbar-white navbar-light">
     <!-- Left navbar links -->
     <ul class="navbar-nav">
         <li class="nav-item">
             <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
         </li>
         <li class="nav-item d-none d-sm-inline-block">
             <a href="<?= base_url('home'); ?>" class="nav-link">Strong Point</a>
         </li>
         <!-- <li class="nav-item d-none d-sm-inline-block">
             <a href="#" class="nav-link">Contact</a>
         </li> -->
     </ul>

     <ul class="navbar-nav">

         <!-- <li class="nav-item d-none d-sm-inline-block">
             <a href="#" class="nav-link">Contact</a>
         </li> -->
     </ul>
     <!-- SEARCH FORM -->
     <!-- <form class="form-inline ml-3"> -->
     <!-- <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-navbar" type="submit">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div> -->
     <!-- </form> -->

     <!-- Right navbar links -->
     <ul class="navbar-nav ml-auto">

         <!-- Notifications Dropdown Menu -->
         <li class="nav-item dropdown">
             <!-- <a class="nav-link" data-toggle="dropdown" href="#">
                 <i class="far fa-bell"></i>
                 <span class="badge badge-warning navbar-badge">15</span>
             </a>
             <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                 <span class="dropdown-item dropdown-header">15 Notifications</span>
                 <div class="dropdown-divider"></div>
                 <a href="#" class="dropdown-item">
                     <i class="fas fa-envelope mr-2"></i> 4 new messages
                     <span class="float-right text-muted text-sm">3 mins</span>
                 </a>
                 <div class="dropdown-divider"></div>
                 <a href="#" class="dropdown-item">
                     <i class="fas fa-users mr-2"></i> 8 friend requests
                     <span class="float-right text-muted text-sm">12 hours</span>
                 </a>
                 <div class="dropdown-divider"></div>
                 <a href="#" class="dropdown-item">
                     <i class="fas fa-file mr-2"></i> 3 new reports
                     <span class="float-right text-muted text-sm">2 days</span>
                 </a>
                 <div class="dropdown-divider"></div>
                 <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
             </div> -->
         </li>
         <!-- Nav Item - User Information -->
         <li class="nav-item dropdown">
             <a class="nav-link dropdown-toggle" href="" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                 <img src="<?= base_url('assets/img/profile/') . $user['image'] ?>" class="img-circle elevation-2" alt="User Image" style="height:24px;width:24px">
                 <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= $user['name']; ?></span>
             </a>
             <!-- Dropdown - User Information -->
             <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                 <a class="dropdown-item" href="<?= base_url('user'); ?>">
                     <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                     My Profile
                 </a>
                 <a class="dropdown-item" href="<?= base_url('user/edit'); ?>">
                     <i class="fas fa-fw fa-user-edit fa-sm fa-fw mr-2 text-gray-400"></i>
                     Edit Profile
                 </a>
                 <a class="dropdown-item" href="<?= base_url('user/changepassword'); ?>">
                     <i class="fas fa-fw fa-key fa-sm fa-fw mr-2 text-gray-400"></i>
                     Change Password
                 </a>

                 <div class="dropdown-divider"></div>
                 <a class="dropdown-item" href="<?= base_url('auth/logout'); ?>" data-toggle="modal" data-target="#logoutModal">
                     <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                     Logout
                 </a>
             </div>
         </li>
         <!-- <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#"><i
            class="fas fa-th-large"></i></a>
      </li> -->
     </ul>
 </nav>
 <!-- /.navbar -->
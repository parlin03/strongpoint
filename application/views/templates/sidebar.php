<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-light-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?= base_url('home'); ?>" class="brand-link ">
        <div class="sidebar-brand-icon rotate-n-15">
            <!-- <img src="<?= base_url('assets/img/favicon.ico') ?>" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8"> -->
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
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

                <!-- Query Menu -->
                <?php
                $role_id = $this->session->userdata('role_id');
                $queryMenu = "SELECT 
                            `user_menu`.`id`, `menu` FROM `user_menu` JOIN `user_access_menu` ON
                            `user_menu`.`id` = `user_access_menu`.`menu_id` WHERE
                            `user_access_menu`.`role_id`= $role_id ORDER BY `user_access_menu`.`menu_id`
                            ASC ";
                $menu = $this->db->query($queryMenu)->result_array(); ?>
                <!-- Looping Menu -->
                <?php foreach ($menu as $m) : ?>
                    <div class="user-panel mt-2 pb-2 mb-2 ">
                        <!-- <li class="nav-item"><?= $m['menu']; ?></li> -->


                        <?php
                        $menuId = $m['id'];
                        $querySubMenu = "SELECT  `user_sub_menu`.`id`, `user_sub_menu`.`menu_id`,`user_sub_menu`.`title`,
                        `user_sub_menu`.`url`, `user_sub_menu`.`icon`, `user_sub_menu`.`is_active`, `menu` 
                        FROM `user_sub_menu` JOIN `user_menu`  
                        ON `user_sub_menu`.`menu_id`  = `user_menu`.`id`
                        WHERE `user_sub_menu`.`menu_id`= $menuId
                        AND `user_sub_menu`.`is_active` = 1 order by `user_sub_menu`.`id`";
                        $subMenu = $this->db->query($querySubMenu)->result_array(); //
                        // var_dump($subMenu);
                        ?>
                        <?php foreach ($subMenu as $sm) : ?>

                            <?php
                            $subMenuId = $sm['id'];
                            // echo $subMenuId;
                            $queryAltSubMenu = "SELECT * 
                                FROM `user_alt_submenu` JOIN `user_sub_menu`  
                                ON `user_alt_submenu`.`submenu_id`  = `user_sub_menu`.`id`
                                WHERE `user_alt_submenu`.`submenu_id`= $subMenuId
                                AND `user_alt_submenu`.`is_active` = 1
                                ORDER BY `user_alt_submenu`.`id` ASC ";
                            $altSubMenu = $this->db->query($queryAltSubMenu);
                            //                var_dump($altSubMenu); 
                            ?>

                            <?php if ($altSubMenu->num_rows() < 1) : ?>
                                <li class="nav-item">
                                    <a href="<?= base_url($sm['url']); ?>" class="nav-link  <?= ($title == $sm['title']) ? 'active' : ''; ?>">
                                        <i class="<?= $sm['icon']; ?>"></i>
                                        <p><?= $sm['title']; ?></p>
                                    </a>
                                </li>
                            <?php else : ?>
                                <?php
                                $uri = $this->uri->segment(1) . "/" . $this->uri->segment(2);
                                if ($uri == $sm['url']) {
                                    $show = 'menu-open';
                                    $active = 'active';
                                } else {
                                    $show = '';
                                    $active = '';
                                }
                                ?>
                                <li class="nav-item has-treeview <?= $show ?>">
                                    <!-- <?php var_dump($title);
                                            var_dump($sm['title']);
                                            ?> -->

                                    <a href="<?= base_url($sm['url']); ?>" class="nav-link <?= $active ?>">
                                        <i class="<?= $sm['icon']; ?>"></i>
                                        <p>
                                            <?= $sm['title']; ?>
                                            <i class="right fas fa-angle-left"></i>
                                        </p>
                                    </a>
                                    <?php $rasm = $altSubMenu->result_array(); ?>
                                    <!-- <div class="bg-white py-2 collapse-inner rounded"> -->
                                    <?php foreach ($rasm as $asm) : ?>
                                        <ul class="nav nav-treeview  nav-child-indent">
                                            <li class="nav-item ">
                                                <a href="<?= base_url($asm['alt_url']); ?>" class="nav-link <?= ($asm['alt_url'] == uri_string()) ? 'active bg-primary' : ''; ?>">
                                                    <!-- <i class="far fa-circle nav-icon"></i> -->
                                                    <p><?= $asm['alt_title']; ?></p>
                                                </a>
                                            </li>
                                        </ul>
                                    <?php endforeach; ?>
                                    <!-- </div> -->
                                </li>

                            <?php endif; ?>

                        <?php endforeach; ?>
                    </div>
                <?php endforeach; ?>



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
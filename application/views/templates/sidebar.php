        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-danger sidebar sidebar-dark accordion" id="accordionSidebar">
            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
                <div class="sidebar-brand-icon rotate-n-15">
                    <img src="<?= base_url('assets/img/login/'); ?>ahayy-rounded.png" alt="logo" width="50">
                </div>
                <div class="sidebar-brand-text mx-3">AHAYY</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Query Menu -->
            <?php
            $id_role = $this->session->userdata('id_role');
            $queryMenu = "SELECT `user_menu`.`id_menu`, `nm_menu` 
                            FROM `user_menu` 
                            JOIN `user_access_menu`
                            ON `user_menu`.`id_menu` = `user_access_menu`.`id_menu`
                            WHERE `user_access_menu`.`id_role` = $id_role
                            ORDER BY `user_access_menu`.`id_menu` ASC";

            $menu = $this->db->query($queryMenu)->result_array();
            ?>

            <!-- Looping Menu -->
            <?php foreach ($menu as $m) : ?>
                <div class="sidebar-heading">
                    <?= $m['nm_menu']; ?>
                </div>

                <!-- Sub Menu -->
                <?php
                $id_menu = $m['id_menu'];
                $querySubmenu = "SELECT * FROM `user_submenu`
                                    JOIN `user_menu` ON `user_submenu`.`id_menu` = `user_menu`.`id_menu`
                                    WHERE `user_submenu`.`id_menu` = $id_menu";

                $submenu = $this->db->query($querySubmenu)->result_array();
                ?>

                <?php foreach ($submenu as $s) : ?>
                    <?php if ($title == $s['title']) : ?>
                        <li class="nav-item active">
                        <?php else : ?>
                        <li class="nav-item">
                        <?php endif; ?>
                        <a class="nav-link pb-0" href="<?= base_url($s['url']); ?>">
                            <i class="<?= $s['icon']; ?>"></i>
                            <span><?= $s['title']; ?></span>
                        </a>
                        </li>
                    <?php endforeach; ?>

                    <!-- Divider -->
                    <hr class="sidebar-divider mt-3">

                <?php endforeach; ?>

                <!-- Heading -->
                <div class="sidebar-heading">
                    Keluar
                </div>

                <!-- Nav Item - Profile Menu -->
                <li class="nav-item">
                    <a href="<?= base_url('auth/logout'); ?>" class="nav-link logout">
                        <i class="fas fa-fw fa-sign-out-alt"></i>
                        <span>Logout</span>
                    </a>
                </li>

                <!-- Divider -->
                <hr class="sidebar-divider d-none d-md-block">

                <!-- Sidebar Toggler (Sidebar) -->
                <div class="text-center d-none d-md-inline">
                    <button class="rounded-circle border-0" id="sidebarToggle"></button>
                </div>

        </ul>
        <!-- End of Sidebar -->
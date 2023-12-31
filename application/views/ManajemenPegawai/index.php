            <!-- Begin Page Content -->
            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="card h4 mb-4 border-bottom-danger font-weight-bold text-danger">
                    <div class="card-body">
                        <?= $title; ?>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">

                        <?= $this->session->flashdata('message'); ?>

                        <?php if (empty($data_user)) : ?>
                            <div class="alert alert-warning" role="alert"><i class="fas fa-exclamation-circle"></i><span> Data Pengguna yang dicari tidak ditemukan!</span></div>
                        <?php endif; ?>

                        <!-- Table -->
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <a href="<?= base_url('ManajemenPegawai/user_tambah'); ?>" title="Tambah Data" class="btn btn-success font-weight-bold"><i class="fas fa-fw fa-plus"></i> Tambah</a>
                                <button id="btn-refresh" class="btn btn-primary box-title" title="Refresh Data"><i class="fas fa-fw fa-sync-alt"></i></button>

                                <form action="" method="post" class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search float-right">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small" name="keyword" placeholder="Cari">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="submit">
                                                <i class="fas fa-search fa-sm" title="Cari data"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>

                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table" id="table" width="100%" cellspacing="0">
                                        <thead>
                                            <tr class="text-dark">
                                                <th>#</th>
                                                <th>ID Pegawai</th>
                                                <th>Nama Pegawai</th>
                                                <th>Role</th>
                                                <th>Username</th>
                                                <th>Status Akun</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i = 1; ?>
                                            <?php foreach ($data_user as $user) : ?>
                                                <tr>
                                                    <td><?= $i; ?></td>
                                                    <td><?= $user['id_pegawai']; ?></td>
                                                    <td><?= $user['nama_pegawai']; ?></td>
                                                    <?php
                                                    if ($user['id_role'] == 1) {
                                                        echo "<td>Admin</td>";
                                                    } else if ($user['id_role'] == 2) {
                                                        echo "<td>Manager</td>";
                                                    }
                                                    ?>
                                                    <td><?= $user['username']; ?></td>
                                                    <td><?= $user['status_akun']; ?></td>
                                                    <td style="text-align: center;">
                                                        <a href="<?= base_url('ManajemenPegawai/user_ubah/'); ?><?= base64_encode($user['id_pegawai']); ?>" title="Ubah" class="btn btn-circle btn-warning my-1"><i class="fas fa-fw fa-edit"></i></a>
                                                        <a href="<?= base_url('ManajemenPegawai/user_hapus/'); ?><?= base64_encode($user['id_pegawai']); ?>" title="Hapus" class="btn btn-danger btn-circle delete-pengguna"><i class="fas fa-fw fa-trash"></i></a>
                                                    </td>
                                                </tr>
                                                <?php $i++; ?>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
            <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->
            <!-- Begin Page Content -->
            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="card h4 mb-4 border-bottom-success font-weight-bold text-success">
                    <div class="card-body">
                        <?= $title; ?>
                    </div>
                </div>
                <?= $this->session->flashdata('message'); ?>
                <div class="row">
                    <div class="col-lg-7">
                        <form action="" method="post">
                            <div class="card mb-4">
                                <div class="card-body text-dark font-weight-bold">
                                    <div class="form-group">
                                        <label>ID Servis</label>
                                        <div class="col-sm">
                                            <input type="text" class="form-control" id="id_servis" name="id_servis" value="<?= $ubah_servis['id_servis']; ?>" readonly>
                                            <?= form_error('id_servis', '<small class="text-danger pl-3">', '</small>'); ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>ID Pelanggan</label>
                                        <div class="col-sm">
                                            <input type="text" class="form-control" id="id_pelanggan" name="id_pelanggan" value="<?= $ubah_servis['id_pelanggan']; ?>" readonly>
                                            <?= form_error('id_pelanggan', '<small class="text-danger pl-3">', '</small>'); ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Nama Pelanggan</label>
                                        <div class="col-sm">
                                            <input type="text" class="form-control text-capitalize" id="nm_pelanggan" name="nm_pelanggan" maxlength="30" value="<?= $ubah_servis['nm_pelanggan']; ?>">
                                            <?= form_error('nm_pelanggan', '<small class="text-danger pl-3">', '</small>'); ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>No. Telepon Pelanggan</label>
                                        <div class="col-sm">
                                            <input type="text" class="form-control" id="noTlp" name="noTlp" maxlength="15" value="<?= $ubah_servis['noTlp_pelanggan']; ?>">
                                            <?= form_error('noTlp', '<small class="text-danger pl-3">', '</small>'); ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Merk Kendaraan</label>
                                        <div class="col-sm">
                                            <input type="text" class="form-control text-capitalize" id="merk" name="merk" maxlength="30" value="<?= $ubah_servis['merk_kendaraan']; ?>">
                                            <?= form_error('merk', '<small class="text-danger pl-3">', '</small>'); ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>No. Plat</label>
                                        <div class="col-sm">
                                            <input type="text" class="form-control text-uppercase" id="no_plat" name="no_plat" maxlength="11" value="<?= $ubah_servis['no_plat']; ?>">
                                            <?= form_error('no_plat', '<small class="text-danger pl-3">', '</small>'); ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Keluhan</label>
                                        <div class="col-sm">
                                            <textarea class="form-control" id="keluhan" name="keluhan"><?= $ubah_servis['keluhan']; ?></textarea>
                                            <?= form_error('keluhan', '<small class="text-danger pl-3">', '</small>'); ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Nama Mekanik</label>
                                        <?php
                                        $query = "SELECT * FROM pegawai WHERE jabatan='Mekanik'";
                                        $result = $this->db->query($query)->result_array();
                                        ?>
                                        <div class="col-sm">
                                            <select class="form-control" id="nm_mekanik" name="nm_mekanik">
                                                <option value="">Pilih mekanik</option>
                                                <?php foreach ($result as $mekanik) : ?>
                                                    <?php if ($mekanik['nm_pegawai'] == $ubah_servis['nm_mekanik']) : ?>
                                                        <option value="<?= $mekanik['nm_pegawai']; ?>" selected><?= $mekanik['nm_pegawai']; ?></option>
                                                    <?php else : ?>
                                                        <option value="<?= $mekanik['nm_pegawai']; ?>"><?= $mekanik['nm_pegawai']; ?></option>
                                                    <?php endif; ?>
                                                <?php endforeach; ?>
                                            </select>
                                            <?= form_error('nm_mekanik', '<small class="text-danger pl-3">', '</small>'); ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Nama Barang</label>
                                        <div class="col-sm">
                                            <select type="text" class="form-control" id="id_brg" name="id_brg">
                                                <option value="">Pilih barang</option>
                                                <?php foreach ($barang as $b) : ?>
                                                    <?php if ($b['id_brg'] == $ubah_servis['id_brg']) : ?>
                                                        <option value="<?= $b['id_brg']; ?>" selected><?= $b['nm_brg']; ?></option>
                                                    <?php else : ?>
                                                        <option value="<?= $b['id_brg']; ?>"><?= $b['nm_brg']; ?></option>
                                                    <?php endif; ?>
                                                <?php endforeach; ?>
                                            </select>
                                            <?= form_error('id_brg', '<small class="text-danger pl-3">', '</small>'); ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm">
                                            <input type="hidden" class="form-control" id="nm_brg" name="nm_brg" value="<?= $ubah_servis['nm_brg']; ?>" readonly>
                                            <!-- <?= form_error('nm_brg', '<small class="text-danger pl-3">', '</small>'); ?> -->
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Harga</label>
                                        <div class="col-sm">
                                            <input type="number" class="form-control" id="harga" name="harga" value="<?= $ubah_servis['harga_brg']; ?>" readonly>
                                            <?= form_error('harga', '<small class="text-danger pl-3">', '</small>'); ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Jumlah</label>
                                        <div class="col-sm">
                                            <input type="number" class="form-control" id="jumlah" name="jumlah" min="1" placeholder="Masukkan jumlah barang" value="<?= $ubah_servis['jumlah_brg']; ?>">
                                            <?= form_error('jumlah', '<small class="text-danger pl-3">', '</small>'); ?>
                                        </div>
                                    </div>

                                    <a href="<?= base_url('ManajemenData'); ?>" title="Kembali ke halaman Servis" class="btn btn-sm btn-secondary font-weight-bold mt-3">Kembali</a>
                                    <button type="submit" class="btn btn-sm btn-success font-weight-bold ml-2 mt-3">Simpan</button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>

            </div>
            <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->
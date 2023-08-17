            <!-- Begin Page Content -->
            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="card h4 mb-4 border-bottom-success font-weight-bold text-success">
                    <div class="card-body">
                        <?= $title; ?>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-7">
                        <form action="" method="post">
                            <div class="card mb-4">
                                <div class="card-body text-dark font-weight-bold">
                                    <div class="form-group">
                                        <label>No. Nota</label>
                                        <div class="col-sm">
                                            <input type="text" class="form-control" id="no_nota" name="no_nota" value="<?= $no_nota; ?>" readonly>
                                        </div>
                                    </div>
                                    <input type="hidden" class="form-control" id="nm_admin" name="nm_admin" value="<?= $user['nama_pegawai']; ?>">
                                    <div class="form-group">
                                        <label>ID Servis</label>
                                        <?php
                                        $query = "SELECT * FROM servis WHERE id_servis NOT IN (SELECT id_servis FROM pembayaran)";
                                        $result = $this->db->query($query)->result_array();
                                        ?>
                                        <div class="col-sm">
                                            <select class="form-control" id="id_servis" name="id_servis">
                                                <option value="">Pilih ID Servis</option>
                                                <?php foreach ($result as $s) : ?>
                                                    <option value="<?= $s['id_servis']; ?>"><?= $s['id_servis']; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                            <?= form_error('id_servis', '<small class="text-danger pl-3">', '</small>'); ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Nama Pelanggan</label>
                                        <div class="col-sm">
                                            <input type="text" class="form-control" id="nm_pelanggan" name="nm_pelanggan" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Merk Kendaraan</label>
                                        <div class="col-sm">
                                            <input type="text" class="form-control" id="merk" name="merk" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Keluhan</label>
                                        <div class="col-sm">
                                            <input type="text" class="form-control" id="keluhan" name="keluhan" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Nama Barang</label>
                                        <div class="col-sm">
                                            <input type="text" class="form-control" id="nm_brg" name="nm_brg" readonly>
                                            <?= form_error('nm_brg', '<small class="text-danger pl-3">', '</small>'); ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Harga</label>
                                        <div class="col-sm">
                                            <input type="number" class="form-control" id="harga" name="harga" readonly>
                                            <?= form_error('harga', '<small class="text-danger pl-3">', '</small>'); ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Jumlah</label>
                                        <div class="col-sm">
                                            <input type="number" class="form-control" id="jumlah" name="jumlah" readonly>
                                            <?= form_error('jumlah', '<small class="text-danger pl-3">', '</small>'); ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Nama Mekanik</label>
                                        <div class="col-sm">
                                            <input type="text" class="form-control" id="nm_mekanik" name="nm_mekanik" readonly>
                                            <?= form_error('nm_mekanik', '<small class="text-danger pl-3">', '</small>'); ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Harga Jasa</label>
                                        <div class="col-sm">
                                            <input type="number" class="form-control" id="jasa" name="jasa" min="1" max="9999999999" placeholder="Masukkan harga jasa">
                                            <?= form_error('jasa', '<small class="text-danger pl-3">', '</small>'); ?>
                                        </div>
                                    </div>

                                    <a href="<?= base_url('ManajemenData/pembayaran'); ?>" title="Kembali ke halaman Pembayaran" class="btn btn-sm btn-secondary font-weight-bold mt-3">Kembali</a>
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
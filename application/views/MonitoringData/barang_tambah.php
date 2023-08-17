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
                                        <label>No. Faktur</label>
                                        <div class="col-sm">
                                            <input type="text" class="form-control" id="no_faktur" name="no_faktur" value="<?= $no_faktur; ?>" readonly>
                                            <?= form_error('no_faktur', '<small class="text-danger pl-3">', '</small>'); ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Pemasok</label>
                                        <div class="col-sm">
                                            <select class="form-control" id="id_pemasok" name="id_pemasok">
                                                <option value="">Pilih Pemasok</option>
                                                <?php foreach ($data_pemasok as $pemasok) : ?>
                                                    <option value="<?= $pemasok['id_pemasok']; ?>"><?= $pemasok['id_pemasok']; ?> - <?= $pemasok['nm_pemasok']; ?></option>
                                                <?php endforeach; ?>
                                            </select> <?= form_error('id_pemasok', '<small class="text-danger pl-3">', '</small>'); ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>ID Barang</label>
                                        <div class="col-sm">
                                            <input type="text" class="form-control" id="id_brg" name="id_brg" value="<?= $id_brg; ?>" readonly>
                                            <?= form_error('id_brg', '<small class="text-danger pl-3">', '</small>'); ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Nama Barang</label>
                                        <div class="col-sm">
                                            <input type="text" class="form-control text-capitalize" id="nm_brg" name="nm_brg" maxlength="30" placeholder="Masukkan nama barang">
                                            <?= form_error('nm_brg', '<small class="text-danger pl-3">', '</small>'); ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Harga</label>
                                        <div class="col-sm">
                                            <input type="number" class="form-control" id="harga" name="harga" min="1" max="9999999999" placeholder="Masukkan harga barang">
                                            <?= form_error('harga', '<small class="text-danger pl-3">', '</small>'); ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Jumlah</label>
                                        <div class="col-sm">
                                            <input type="number" class="form-control" id="jumlah" name="jumlah" min="1" max="99999" placeholder="Masukkan jumlah barang">
                                            <?= form_error('jumlah', '<small class="text-danger pl-3">', '</small>'); ?>
                                        </div>
                                    </div>

                                    <a href="<?= base_url('MonitoringData/barang'); ?>" title="Kembali ke halaman Pengguna" class="btn btn-sm btn-secondary font-weight-bold mt-3">Kembali</a>
                                    <button type="submit" class="btn btn-sm btn-success font-weight-bold ml-2 mt-3">Simpan</button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
            </div>

            </div>
            <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->
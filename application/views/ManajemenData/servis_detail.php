            <!-- Begin Page Content -->
            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="card h4 mb-4 border-bottom-success font-weight-bold text-success">
                    <div class="card-body">
                        <?= $title; ?>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <form action="" method="post">
                            <div class="card mb-4">
                                <div class="card-body text-dark">
                                    <table>
                                        <tr>
                                            <td class="font-weight-bold">ID Servis</td>
                                            <td>: <?= $detail_servis['id_servis']; ?></td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-bold">Tanggal</td>
                                            <td>: <?= $detail_servis['tgl']; ?></td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-bold">ID Pelanggan : </td>
                                            <td>: <?= $detail_servis['id_pelanggan']; ?></td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-bold">Nama Pelanggan</td>
                                            <td>: <?= $detail_servis['nm_pelanggan']; ?></td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-bold"> No. Telepon</td>
                                            <td>: <?= $detail_servis['noTlp_pelanggan']; ?></td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-bold"> Merk Kendaraan</td>
                                            <td>: <?= $detail_servis['merk_kendaraan']; ?></td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-bold"> No. Plat</td>
                                            <td>: <?= $detail_servis['no_plat']; ?></td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-bold">Keluhan</td>
                                            <td>: <?= $detail_servis['keluhan']; ?></td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-bold">Nama Mekanik</td>
                                            <td>: <?= $detail_servis['nm_mekanik']; ?></td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-bold">ID Barang</td>
                                            <td>: <?= $detail_servis['id_brg']; ?></td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-bold">Nama Barang</td>
                                            <td>: <?= $detail_servis['nm_brg']; ?></td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-bold">Harga</td>
                                            <td>: Rp <?= number_format($detail_servis['harga_brg'], 0, ',', '.'); ?></td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-bold">Jumlah</td>
                                            <td>: <?= $detail_servis['jumlah_brg']; ?></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <a href="<?= base_url('ManajemenData'); ?>" title="Kembali ke halaman Servis" class="btn btn-sm btn-secondary font-weight-bold mt-3">Kembali</a>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>

            </div>
            <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->
        </div>
        <!-- End of Content Wrapper -->

        </div>
        <!-- End of Page Wrapper -->

        <!-- Footer -->
        <footer class="sticky-footer pl-3">
            <div class="container my-auto">
                <div class="copyright text-center">
                    <span>Copyright &copy; Sistem Pengelolaan Bengkel - AHAYY <?= date('Y'); ?></span>
                </div>
            </div>
        </footer>
        <!-- End of Footer -->

        <!-- Scroll to Top Button-->
        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-chevron-circle-up"></i>
        </a>

        <!-- Logout Modal-->
        <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Yakin ingin keluar?</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">Pilih tombol "Logout" jika kamu ingin mengakhiri sesi.</div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                        <a class="btn btn-danger" href="<?= base_url('auth/logout'); ?>">Logout</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bootstrap core JavaScript-->
        <script src="<?= base_url('assets/'); ?>vendor/jquery/jquery.min.js"></script>
        <script src="<?= base_url('assets/'); ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

        <!-- Core plugin JavaScript-->
        <script src="<?= base_url('assets/'); ?>vendor/jquery-easing/jquery.easing.min.js"></script>

        <!-- Custom scripts for all pages-->
        <script src="<?= base_url('assets/'); ?>js/sb-admin-2.min.js"></script>

        <!-- Sweetalert core JavaScript -->
        <script src="<?= base_url('assets/'); ?>js/popper.min.js"></script>
        <script src="<?= base_url('assets/'); ?>js/sweetalert2.all.min.js"></script>
        <script src="<?= base_url('assets/'); ?>js/promise-polyfill.js"></script>
        <script src="<?= base_url('assets/'); ?>js/js-delete-sweetAlert.js"></script>

        <!-- Page level plugins -->
        <script src="<?= base_url('assets/'); ?>vendor/datatables/jquery.dataTables.min.js"></script>
        <script src="<?= base_url('assets/'); ?>vendor/datatables/dataTables.bootstrap4.min.js"></script>

        <!-- Remove search field -->
        <style>
            .dataTables_filter {
                display: none;
            }
        </style>

        <!-- Script Data tables -->
        <script>
            $(document).ready(function() {
                $('[data-toggle="tooltip"]').tooltip();
                var t = $('#table').DataTable({
                    "columnDefs": [{
                        "searchable": false,
                        "orderable": false,
                        "targets": 0
                    }],
                    "order": [
                        [1, 'asc']
                    ],
                    "language": {
                        "sProcessing": "Sedang memproses ...",
                        "lengthMenu": "Tampilkan _MENU_ data per halaman",
                        "zeroRecord": "Maaf data tidak tersedia",
                        "info": "Menampilkan _PAGE_ halaman dari _PAGES_ halaman",
                        "infoEmpty": "Tidak ada data yang tersedia",
                        "infoFiltered": "(difilter dari _MAX_ total data)",
                        "sSearch": "Cari",
                        "oPaginate": {
                            "sFirst": "Pertama",
                            "sPrevious": "Sebelumnya",
                            "sNext": "Selanjutnya",
                            "sLast": "Terakhir"
                        }
                    }
                });
                t.on('order.dt search.dt', function() {
                    t.column(0, {
                        search: 'applied',
                        order: 'applied'
                    }).nodes().each(function(cell, i) {
                        cell.innerHTML = i + 1;
                    });
                }).draw();
            });
            $('#btn-refresh').on('click', () => {
                $('#ic-refresh').addClass('fa-spin');
                var oldURL = window.location.href;
                var index = 0;
                var newURL = oldURL;
                index = oldURL.indexOf('?');
                if (index == -1) {
                    window.location = window.location.href;

                }
                if (index != -1) {
                    window.location = oldURL.substring(0, index)
                }
            });
        </script>

        <!-- Script data autofill -->
        <script type="text/javascript">
            $(document).ready(function() {
                $('#id_brg').change(function() {
                    var barang = $(this).val();
                    $.ajax({
                        url: "<?= base_url('ManajemenData/barang_list'); ?>",
                        type: "POST",
                        data: "id_brg=" + barang,
                        async: true,
                        dataType: 'json',
                        success: function(data) {
                            $('#nm_brg').val(data.nm_brg);
                            $('#harga').val(data.harga_brg);
                        }
                    });
                });
            });
            $(document).ready(function() {
                $('#id_servis').change(function() {
                    var servis = $(this).val();
                    $.ajax({
                        url: "<?= base_url('ManajemenData/servis_list'); ?>",
                        type: "POST",
                        data: "id_servis=" + servis,
                        async: true,
                        dataType: 'json',
                        success: function(data) {
                            $('#nm_pelanggan').val(data.nm_pelanggan);
                            $('#merk').val(data.merk);
                            $('#keluhan').val(data.keluhan);
                            $('#nm_brg').val(data.nm_brg);
                            $('#harga').val(data.harga_brg);
                            $('#jumlah').val(data.jumlah);
                            $('#nm_mekanik').val(data.mekanik);
                        }
                    });
                });
            });
            $(document).ready(function() {
                $('#no_nota').change(function() {
                    var nota = $(this).val();
                    $.ajax({
                        url: "<?= base_url('ManajemenData/nota_list'); ?>",
                        type: "POST",
                        data: "no_nota=" + nota,
                        async: true,
                        dataType: 'json',
                        success: function(data) {
                            $('#total').val(data.total);
                        }
                    });
                });
            });
            $(document).ready(function() {
                $('#id_pegawai').change(function() {
                    var pegawai = $(this).val();
                    $.ajax({
                        url: "<?= base_url('ManajemenPegawai/pegawai_list'); ?>",
                        type: "POST",
                        data: "id_pegawai=" + pegawai,
                        async: true,
                        dataType: 'json',
                        success: function(data) {
                            $('#nm_pegawai').val(data.nama);
                        }
                    });
                });
            });
        </script>

        <script>
            function change() {
                var x = document.getElementById('password').type;
                if (x == 'password') {
                    document.getElementById('password').type = 'text';
                    document.getElementById('eye-button').innerHTML = `<i class="fas fa-fw fa-eye-slash" title="sembunyikan password"></i>`;
                } else {
                    document.getElementById('password').type = 'password';
                    document.getElementById('eye-button').innerHTML = `<i class="fas fa-fw fa-eye" title="tampilkan password"></i>`;
                }
            }
        </script>

        </body>

        </html>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-3">
        <h1 class="h3 mb-3 text-gray-800"><?= $title; ?></h1>
    </div>

    <!-- if ada pesan -->
    <?= $this->session->flashdata('message'); ?>

    <!-- Content Row -->
    <div class="row mb-3">

        <!-- add trs masuk -->
        <div class="col-lg-12 mb-3">
            <div class="card shadow">
                <div class="my-auto card-body py-3 d-sm-flex align-items-center justify-content-between">
                    <h6 class="mb-2 font-weight-bold text-primary">Form Tambah Transaksi</h6>
                    <div class="ml-auto">
                        <a href="" class="btn btn-sm btn-primary shadow-sm mb-1 mb-md-0" data-toggle="modal" data-target="#addTrsMasukModal">
                            <i class="fas fa-plus-circle"></i> Tambah
                        </a>
                        <a href="" class="btn btn-sm btn-secondary shadow-sm mb-1 mb-md-0" data-toggle="modal" data-target="#cetakTrs">
                            <i class="fas fa-print"></i> Cetak
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- list trs masuk -->
        <div class="col-md-12">
            <!-- Collapsable role -->
            <div class="card shadow mb-4">
                <!-- Card Header - Accordion -->
                <a href="#collapseListTrsMasuk" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseListTrsMasuk">
                    <h6 class="m-0 font-weight-bold text-primary">Daftar Transaksi Masuk</h6>
                </a>
                <!-- Card Content - Collapse -->
                <div class="collapse show" id="collapseListTrsMasuk">
                    <div class="card-body">
                        <table class="table table-striped table-hover dtableExportResponsive">
                            <thead>
                                <tr class="text-center">
                                    <th style="width: 5%;" scope="col">#</th>
                                    <th scope="col">ID Transaksi</th>
                                    <th scope="col">Payment Type</th>
                                    <th scope="col">Tanggal</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">No. HP</th>
                                    <th scope="col">Nominal</th>
                                    <th scope="col">Program</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($transaksi as $uwr) : ?>
                                    <tr>
                                        <th scope="row" class="text-center"><?= $no; ?></th>
                                        <td>
                                            <?php if ($uwr['pdf_url'] != '') : ?>
                                                <a href="<?= $uwr['pdf_url']; ?>" class="text-decoration-none" target="_blank" title="buka laporan pdf"><?= $uwr['order_id']; ?></a>
                                            <?php else : ?>
                                                <?= $uwr['order_id']; ?>
                                            <?php endif; ?>
                                        </td>
                                        <td><?= $uwr['payment_type']; ?></td>
                                        <td>
                                            <?= date('d', strtotime($uwr['tgl'])) . ' ' . month(date('n', strtotime($uwr['tgl'])), 'mmm') . ' ' . date('Y', strtotime($uwr['tgl'])) . ', ' . date('H:i:s', strtotime($uwr['tgl'])); ?>
                                        </td>
                                        <td><?= $uwr['user_nama']; ?></td>
                                        <td><?= $uwr['user_email']; ?></td>
                                        <td><?= $uwr['user_telp']; ?></td>
                                        <td class="text-right"><?= format_rupiah($uwr['nominal']); ?></td>
                                        <td><?= $uwr['program']; ?></td>
                                        <td>
                                            <span class="badge badge-<?= ($uwr['status'] == 'capture' || $uwr['status'] == 'settlement') ? 'info' : 'warning'; ?>"><?= strtoupper($uwr['status']); ?></span>
                                        </td>
                                        <td class="text-center">
                                            <?php if ($uwr['status'] == 'capture' || $uwr['status'] == 'pending') : ?>
                                                <a href="<?= base_url('admin/cekstatustransaksi/') . $uwr['order_id']; ?>" class="btn btn-sm mb-1 btn-dark" id="delTrsMasuk">Cek</a>
                                            <?php endif; ?>
                                            <a href="" class="btn btn-sm mb-1 btn-success" data-toggle="modal" data-target="#editTrsMasukModal" id="editTrsMasuk" data-idtrsmasuk="<?= $uwr['id']; ?>" data-nama="<?= $uwr['user_nama']; ?>" data-email="<?= $uwr['user_email']; ?>" data-telp="<?= $uwr['user_telp']; ?>" data-nominal="<?= $uwr['nominal']; ?>" data-program="<?= $uwr['program']; ?>" data-status="<?= $uwr['status']; ?>" data-urlpdf="<?= $uwr['pdf_url']; ?>">Edit</a>
                                            <a href="" data-href="<?= base_url('admin/deletetrsmasuk/') . $uwr['id']; ?>" class="btn btn-sm mb-1 btn-danger" data-toggle="modal" id="delTrsMasuk" data-target="#deleteTrsMasukModal">Delete</a>
                                        </td>
                                    </tr>
                                <?php $no++;
                                endforeach; ?>
                            </tbody>
                            <tfoot>
                                <tr class="text-center">
                                    <th style="width: 5%;" scope="col">#</th>
                                    <th scope="col">ID Transaksi</th>
                                    <th scope="col">Payment Type</th>
                                    <th scope="col">Tanggal</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">No. HP</th>
                                    <th scope="col">Nominal</th>
                                    <th scope="col">Program</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>


    </div>
    <!-- end of row -->

</div>
<!-- .container-fluid -->

</div>
<!-- End of Main Content -->

<!-- Modal tambah trs masuk -->
<div class="modal fade" id="addTrsMasukModal" tabindex="-1" role="dialog" aria-labelledby="addTrsMasukModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog scrollable" role="document" data-backdrop="static" data-keyboard="false">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addTrsMasukModalLabel">Tambah Transaksi</h5>
                <button type="button" class="close closeAddTrsMasukModal" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('admin/trsmasuk'); ?>" method="post">
                <div class="modal-body" style="height: 400px; overflow-y: auto;">
                    <div class="form-group">
                        <label for="user_nama">Nama <span class="text-danger">*</span></label>
                        <input type="text" name="user_nama" class="form-control" id="user_nama" placeholder="Nama.." autocomplete="off" maxlength="50">
                    </div>
                    <div class="form-group">
                        <label for="user_email">Email</label>
                        <input type="email" name="user_email" class="form-control" id="user_email" placeholder="email@contoh.com.." autocomplete="off" maxlength="128">
                    </div>
                    <div class="form-group">
                        <label for="user_telp">No. HP</label>
                        <input type="text" name="user_telp" class="form-control" id="user_telp" placeholder="08.." autocomplete="off" maxlength="15">
                    </div>
                    <div class="form-group">
                        <label for="nominal">Nominal <span class="text-danger">*</span></label>
                        <input type="text" name="nominal" class="form-control" id="nominal" placeholder="Rp.." onkeyup="convertToRupiah(this);" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="status">Status <span class="text-danger">*</span></label>
                        <select name="status" class="form-control" id="status">
                            <option value="#" selected disabled>Pilih status</option>
                            <option value="pending" title="Transaksi berhasil dibuat dan menunggu pembayaran oleh customer melalui (ATM/ebanking/E-wallet app/ store).">pending</option>
                            <option value="capture" title="Transaksi kartu berhasil dilakukan. Jika tidak dilakukan manual, Transaksi akan otomatis berubah menjadi settlement pada hari selanjutnya. Status transaksi capture aman untuk dianggap sebagai pembayaran yang berhasil.">capture</option>
                            <option value="settlement" title="Dana telah diterima, Transaksi berhasil. Status transaksi capture aman untuk dianggap sebagai pembayaran yang berhasil.">settlement</option>
                            <option value="deny" title="Payment provider / Fraud Detection System menolak kredensial yang digunakan untuk pembayaran. Anda dapat melihat detail/alasan transaksi tersebut ditolak pada nilai parameter status_message.">deny</option>
                            <option value="cancel" title="Transaksi dibatalkan. pembatalan transaksi dapat dilakukan oleh Midtrans atau merchant.">cancel</option>
                            <option value="expire" title="Transaksi sudah tidak tersedia / kadaluarsa, dikarenakan tidak ada pembayaran yang diterima atau lewat dari batas waktu yang telah ditentukan.">expire</option>
                            <option value="failure" title="Kesalahan tak terduga selama pemrosesan transaksi. Kegagalan transaksi dapat disebabkan oleh berbagai alasan, sebagian besar masalah ini terjadi dikarenakan seperti bank gagal memberikan respons (time-out) dan kasus ini sangat jarang terjadi.">failure</option>
                            <option value="refund" title="Refund dapat dilakuan oleh Merchant. Transaksi akan ditandai sebagai refund.">refund</option>
                            <option value="partial_refund" title="Transaksi ditandai sebagai partial refund.">partial_refund</option>
                            <option value="partial_chargeback" title="Transaksi ditandai sebagai partial chrgeback.">partial_chargeback</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="program">Program</label>
                        <select name="program" class="form-control" id="program">
                            <option value="#" selected disabled>Pilih program</option>
                            <?php foreach ($program as $p) : ?>
                                <option value="<?= $p['nama_detailprogram']; ?>"><?= $p['nama_detailprogram']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="order_id" value="<?= rand(); ?>">
                    <input type="hidden" name="tgl" value="<?= date('Y-m-d H:i:s', time()); ?>">
                    <button type="button" class="btn btn-secondary closeAddTrsMasukModal" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal edit trs masuk -->
<div class="modal fade" id="editTrsMasukModal" tabindex="-1" role="dialog" aria-labelledby="editTrsMasukModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog scrollable" role="document" data-backdrop="static" data-keyboard="false">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editTrsMasukModalLabel">Edit Transaksi</h5>
                <button type="button" class="close closeEditTrsMasukModal" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('admin/updateTrsmasuk'); ?>" method="post">
                <div class="modal-body" style="height: 400px; overflow-y: auto;">
                    <div class="form-group">
                        <label for="user_namaEdit">Nama <span class="text-danger">*</span></label>
                        <input type="text" name="user_namaEdit" class="form-control" id="user_namaEdit" placeholder="Nama.." autocomplete="off" maxlength="50">
                    </div>
                    <div class="form-group">
                        <label for="user_emailEdit">Email</label>
                        <input type="email" name="user_emailEdit" class="form-control" id="user_emailEdit" placeholder="email@contoh.com.." autocomplete="off" maxlength="128">
                    </div>
                    <div class="form-group">
                        <label for="user_telpEdit">No. HP</label>
                        <input type="text" name="user_telpEdit" class="form-control" id="user_telpEdit" placeholder="08.." autocomplete="off" maxlength="15">
                    </div>
                    <div class="form-group">
                        <label for="nominalEdit">Nominal <span class="text-danger">*</span></label>
                        <input type="text" name="nominalEdit" class="form-control" id="nominalEdit" placeholder="Rp.." onkeyup="convertToRupiah(this);" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="statusEdit">Status <span class="text-danger">*</span></label>
                        <select name="statusEdit" class="form-control" id="statusEdit">
                            <option value="#" selected disabled>Pilih status</option>
                            <option value="pending" title="Transaksi berhasil dibuat dan menunggu pembayaran oleh customer melalui (ATM/ebanking/E-wallet app/ store).">pending</option>
                            <option value="capture" title="Transaksi kartu berhasil dilakukan. Jika tidak dilakukan manual, Transaksi akan otomatis berubah menjadi settlement pada hari selanjutnya. Status transaksi capture aman untuk dianggap sebagai pembayaran yang berhasil.">capture</option>
                            <option value="settlement" title="Dana telah diterima, Transaksi berhasil. Status transaksi capture aman untuk dianggap sebagai pembayaran yang berhasil.">settlement</option>
                            <option value="deny" title="Payment provider / Fraud Detection System menolak kredensial yang digunakan untuk pembayaran. Anda dapat melihat detail/alasan transaksi tersebut ditolak pada nilai parameter status_message.">deny</option>
                            <option value="cancel" title="Transaksi dibatalkan. pembatalan transaksi dapat dilakukan oleh Midtrans atau merchant.">cancel</option>
                            <option value="expire" title="Transaksi sudah tidak tersedia / kadaluarsa, dikarenakan tidak ada pembayaran yang diterima atau lewat dari batas waktu yang telah ditentukan.">expire</option>
                            <option value="failure" title="Kesalahan tak terduga selama pemrosesan transaksi. Kegagalan transaksi dapat disebabkan oleh berbagai alasan, sebagian besar masalah ini terjadi dikarenakan seperti bank gagal memberikan respons (time-out) dan kasus ini sangat jarang terjadi.">failure</option>
                            <option value="refund" title="Refund dapat dilakuan oleh Merchant. Transaksi akan ditandai sebagai refund.">refund</option>
                            <option value="partial_refund" title="Transaksi ditandai sebagai partial refund.">partial_refund</option>
                            <option value="partial_chargeback" title="Transaksi ditandai sebagai partial chrgeback.">partial_chargeback</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="programEdit">Program</label>
                        <select name="programEdit" class="form-control" id="programEdit">
                            <option value="#" selected disabled>Pilih program</option>
                            <?php foreach ($program as $p) : ?>
                                <option value="<?= $p['nama_detailprogram']; ?>"><?= $p['nama_detailprogram']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="url_pdfEdit">URL PDF
                            <abbr title="URL ini ada biasanya untuk transaksi melalui Virtual Account" class="initialism">
                                <i class="fas fa-question-circle"></i>
                            </abbr>
                        </label>
                        <input type="text" name="url_pdfEdit" class="form-control" id="url_pdfEdit" placeholder=".." autocomplete="off" maxlength="15">
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="idTrsMasuk" id="idTrsMasuk">
                    <button type="button" class="btn btn-secondary closeEditTrsMasukModal" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Edit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- transaksi Delete Modal-->
<div class="modal fade" id="deleteTrsMasukModal" tabindex="-1" role="dialog" aria-labelledby="deleteTrsMasukModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteTrsMasukModalLabel">Are You sure to delete this?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Select "Delete" below if you sure to delete.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" id="cDelTrsMasuk">Delete</a>
            </div>
        </div>
    </div>
</div>

<!-- cetak trs -->
<div class="modal fade" id="cetakTrs" tabindex="-1" role="dialog" aria-labelledby="cetakTrsLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="cetakTrsLabel">Cetak Transaksi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('admin/laporanaction'); ?>" method="post">
                <div class="modal-body" style="height: 300px; overflow-y: auto;">
                    <div class="form-group row mb-3">
                        <label for="periode_lap" class="col-sm-2 col-form-label">Pilih Periode</label>
                        <div class="col-sm-10 row">
                            <div class="col-sm-4 col-md-4 col-xl-2">
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="pilihPeriodeHariIni" name="periode_lap" class="custom-control-input" value="hari_ini" checked>
                                    <label class="custom-control-label" for="pilihPeriodeHariIni">Hari ini</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="pilihPeriodeBulanIni" name="periode_lap" class="custom-control-input" value="bulan_ini">
                                    <label class="custom-control-label" for="pilihPeriodeBulanIni">Bulan ini</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="pilihPeriodeTahunIni" name="periode_lap" class="custom-control-input" value="tahun_ini">
                                    <label class="custom-control-label" for="pilihPeriodeTahunIni">Tahun ini</label>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-6 col-xl-2">
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="pilihPeriodePerTanggal" name="periode_lap" class="custom-control-input" value="pertanggal">
                                    <label class="custom-control-label" for="pilihPeriodePerTanggal">Per Tanggal</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="pilihPeriodePerBulan" name="periode_lap" class="custom-control-input" value="perbulan">
                                    <label class="custom-control-label" for="pilihPeriodePerBulan">Per Bulan</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="pilihPeriodePerTahun" name="periode_lap" class="custom-control-input" value="pertahun">
                                    <label class="custom-control-label" for="pilihPeriodePerTahun">Per Tahun</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row mb-3" id="pilihTglSection" style="display: none;">
                        <label for="pilihPeriode" class="col-sm-2 col-form-label">Pilih Tanggal
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="label_tgl_akhir" name="label_tgl_akhir" value="yes">
                                <label class="custom-control-label" for="label_tgl_akhir">Tgl. Akhir</label>
                            </div>
                        </label>
                        <div class="col-sm-10">
                            <input type="date" class="form-control" id="per_tanggal1" name="per_tanggal1" placeholder="Masukkan Tanggal Awal" title="Tanggal Awal" disabled>
                            <input type="date" class="form-control mt-1" id="per_tanggal2" name="per_tanggal2" placeholder="Masukkan Tanggal Akhir" title="Tanggal Akhir" disabled>
                        </div>
                    </div>
                    <div class="form-group row mb-3" id="pilihBulanSection" style="display: none;">
                        <label for="pilihPeriode" class="col-sm-2 col-form-label">Pilih Bulan
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="label_bulan_akhir" name="label_bulan_akhir" value="yes">
                                <label class="custom-control-label" for="label_bulan_akhir">Bulan Akhir</label>
                            </div>
                        </label>
                        <div class="col-sm-10">
                            <div class="row">
                                <div class="col-md-8">
                                    <select name="per_bulan1" id="per_bulan1" class="form-control" disabled>
                                        <option value="01">Januari</option>
                                        <option value="02">Februari</option>
                                        <option value="03">Maret</option>
                                        <option value="04">April</option>
                                        <option value="05">Mei</option>
                                        <option value="06">Juni</option>
                                        <option value="07">Juli</option>
                                        <option value="08">Agustus</option>
                                        <option value="09">September</option>
                                        <option value="10">Oktober</option>
                                        <option value="11">November</option>
                                        <option value="12">Desember</option>
                                    </select>
                                </div>
                                <div class="col-md-4 mt-1 mt-md-0">
                                    <select name="tahun_perbulan1" id="tahun_perbulan1" class="form-control" disabled>
                                        <?php if ($yearMinMax['max_year'] != null && $yearMinMax['min_year'] != null) : for ($i = $yearMinMax['max_year']; $i >= $yearMinMax['min_year']; $i--) : ?>
                                                <option value="<?= $i; ?>"><?= $i; ?></option>
                                        <?php endfor;
                                        endif; ?>
                                    </select>
                                </div>
                                <div class="col-md-8">
                                    <select name="per_bulan2" id="per_bulan2" class="form-control mt-1" disabled>
                                        <option value="01">Januari</option>
                                        <option value="02">Februari</option>
                                        <option value="03">Maret</option>
                                        <option value="04">April</option>
                                        <option value="05">Mei</option>
                                        <option value="06">Juni</option>
                                        <option value="07">Juli</option>
                                        <option value="08">Agustus</option>
                                        <option value="09">September</option>
                                        <option value="10">Oktober</option>
                                        <option value="11">November</option>
                                        <option value="12">Desember</option>
                                    </select>
                                </div>
                                <div class="col-md-4 mt-1 mt-md-0">
                                    <select name="tahun_perbulan2" id="tahun_perbulan2" class="form-control mt-0 mt-md-1" disabled>
                                        <?php if ($yearMinMax['max_year'] != null && $yearMinMax['min_year'] != null) : for ($i = $yearMinMax['max_year']; $i >= $yearMinMax['min_year']; $i--) : ?>
                                                <option value="<?= $i; ?>"><?= $i; ?></option>
                                        <?php endfor;
                                        endif; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row mb-3" id="pilihTahunSection" style="display: none;">
                        <label for="pilihPeriode" class="col-sm-2 col-form-label">Pilih Tahun
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="label_tahun_akhir" name="label_tahun_akhir" value="yes">
                                <label class="custom-control-label" for="label_tahun_akhir">Tahun Akhir</label>
                            </div>
                        </label>
                        <div class="col-sm-10">
                            <select name="per_tahun1" id="per_tahun1" class="form-control" disabled>
                                <?php if ($yearMinMax['max_year'] != null && $yearMinMax['min_year'] != null) : for ($i = $yearMinMax['max_year']; $i >= $yearMinMax['min_year']; $i--) : ?>
                                        <option value="<?= $i; ?>"><?= $i; ?></option>
                                <?php endfor;
                                endif; ?>
                            </select>
                            <select name="per_tahun2" id="per_tahun2" class="form-control mt-1" disabled>
                                <?php if ($yearMinMax['max_year'] != null && $yearMinMax['min_year'] != null) : for ($i = $yearMinMax['max_year']; $i >= $yearMinMax['min_year']; $i--) : ?>
                                        <option value="<?= $i; ?>"><?= $i; ?></option>
                                <?php endfor;
                                endif; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label for="user_nama" class="col-sm-2 col-form-label">Donatur</label>
                        <div class="col-sm-10">
                            <select name="user_nama" id="user_nama" class="selectpicker form-control" data-live-search="true">
                                <option value="semua">Semua</option>
                                <?php foreach ($donatur as $a) : ?>
                                    <option value="<?= $a['nama']; ?>"><?= $a['nama']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label for="program" class="col-sm-2 col-form-label">Program</label>
                        <div class="col-sm-10">
                            <select name="program" id="program" class="selectpicker form-control" data-live-search="true">
                                <option value="semua">Semua</option>
                                <?php foreach ($programCetak as $a) : ?>
                                    <option value="<?= $a['nama_program']; ?>"><?= ($a['nama_program'] == '') ? 'Tidak Bernama' : $a['nama_program']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label for="status" class="col-sm-2 col-form-label">Status Transaksi</label>
                        <div class="col-sm-10">
                            <select name="status" class="form-control selectpicker" id="status" data-live-search="true" required>
                                <option value="semua">Semua</option>
                                <option value="input_manual">input_manual</option>
                                <option value="pending">pending</option>
                                <option value="capture">capture</option>
                                <option value="settlement">settlement</option>
                                <option value="deny">deny</option>
                                <option value="cancel">cancel</option>
                                <option value="expire">expire</option>
                                <option value="failure">failure</option>
                                <option value="refund">refund</option>
                                <option value="partial_refund">partial_refund</option>
                                <option value="partial_chargeback">partial_chargeback</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="jenis_transaksi" value="Masuk">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Cetak</button>
                </div>
            </form>
        </div>
    </div>
</div>
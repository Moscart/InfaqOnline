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

        <!-- add trs keluar -->
        <div class="col-lg-12 mb-3">
            <div class="card shadow">
                <div class="my-auto card-body py-3 d-sm-flex align-items-center justify-content-between">
                    <h6 class="mb-2 font-weight-bold text-primary">Form Tambah Transaksi</h6>
                    <div class="ml-auto">
                        <a href="" class="btn btn-sm btn-primary shadow-sm mb-1 mb-md-0" data-toggle="modal" data-target="#addTrsKeluarModal">
                            <i class="fas fa-plus-circle"></i> Tambah
                        </a>
                        <a href="" class="btn btn-sm btn-secondary shadow-sm mb-1 mb-md-0" data-toggle="modal" data-target="#cetakTrs">
                            <i class="fas fa-print"></i> Cetak
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- list trs keluar -->
        <div class="col-md-12">
            <!-- Collapsable role -->
            <div class="card shadow mb-4">
                <!-- Card Header - Accordion -->
                <a href="#collapseListTrsKeluar" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseListTrsKeluar">
                    <h6 class="m-0 font-weight-bold text-primary">Daftar Transaksi Keluar</h6>
                </a>
                <!-- Card Content - Collapse -->
                <div class="collapse show" id="collapseListTrsKeluar">
                    <div class="card-body">
                        <table class="table table-striped table-hover dtableExportResponsive">
                            <thead>
                                <tr class="text-center">
                                    <th style="width: 5%;" scope="col">#</th>
                                    <th scope="col">Tanggal</th>
                                    <th scope="col">Program</th>
                                    <th scope="col">Nominal</th>
                                    <th scope="col">Keterangan</th>
                                    <th scope="col">Petugas</th>
                                    <th scope="col">Pj Penerima</th>
                                    <th scope="col">No. HP Penerima</th>
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
                                            <?= date('d', strtotime($uwr['tgl'])) . ' ' . month(date('n', strtotime($uwr['tgl'])), 'mmm') . ' ' . date('Y', strtotime($uwr['tgl'])); ?>
                                        </td>
                                        <td><?= $uwr['program']; ?></td>
                                        <td class="text-right"><?= format_rupiah($uwr['nominal']); ?></td>
                                        <td class="font-italic"><?= substr(strip_tags($uwr['keterangan']), 0, 100) . '..'; ?></td>
                                        <td>
                                            <span class="badge badge-light"><?= $uwr['petugas']; ?></span>
                                        </td>
                                        <td><?= $uwr['penerima_nama']; ?></td>
                                        <td><?= $uwr['penerima_telp']; ?></td>
                                        <td class="text-center">
                                            <a href="" class="btn btn-sm mb-1 btn-success" data-toggle="modal" data-target="#editTrsKeluarModal" id="editTrsKeluar" data-idtrskeluar="<?= $uwr['id']; ?>" data-program="<?= $uwr['program']; ?>" data-penerima="<?= $uwr['penerima_nama']; ?>" data-telp="<?= $uwr['penerima_telp']; ?>" data-alamat="<?= $uwr['penerima_alamat_instansi']; ?>" data-tgl="<?= $uwr['tgl']; ?>" data-nominal="<?= $uwr['nominal']; ?>" data-keterangan="<?= $uwr['keterangan']; ?>">Edit</a>
                                            <a href="" data-href="<?= base_url('admin/deletetrskeluar/') . $uwr['id']; ?>" class="btn btn-sm mb-1 btn-danger" data-toggle="modal" id="delTrsKeluar" data-target="#deleteTrsKeluarModal">Delete</a>
                                        </td>
                                    </tr>
                                <?php $no++;
                                endforeach; ?>
                            </tbody>
                            <tfoot>
                                <tr class="text-center">
                                    <th style="width: 5%;" scope="col">#</th>
                                    <th scope="col">Tanggal</th>
                                    <th scope="col">Program</th>
                                    <th scope="col">Nominal</th>
                                    <th scope="col">Keterangan</th>
                                    <th scope="col">Petugas</th>
                                    <th scope="col">Pj Penerima</th>
                                    <th scope="col">No. HP Penerima</th>
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

<!-- Modal tambah trs keluar -->
<div class="modal fade" id="addTrsKeluarModal" tabindex="-1" role="dialog" aria-labelledby="addTrsKeluarModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog scrollable" role="document" data-backdrop="static" data-keyboard="false">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addTrsKeluarModalLabel">Tambah Transaksi</h5>
                <button type="button" class="close closeAddTrsKeluarModal" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('admin/trskeluar'); ?>" method="post">
                <div class="modal-body" style="height: 400px; overflow-y: auto;">
                    <div class="form-group">
                        <label for="program">Program</label>
                        <select name="program" class="form-control" id="program">
                            <option value="#" selected disabled>Pilih program</option>
                            <?php foreach ($program as $p) : ?>
                                <option value="<?= $p['nama_program']; ?>" data-maks="<?= $p['dana_program']; ?>"><?= ($p['nama_program'] == '') ? 'Tidak Bernama' : $p['nama_program']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="penerima_nama">Nama Penanggungjawab <span class="text-danger">*</span></label>
                        <input type="text" name="penerima_nama" class="form-control" id="penerima_nama" placeholder="Nama pj penerima.." autocomplete="off" maxlength="60">
                    </div>
                    <div class="form-group">
                        <label for="penerima_telp">No. HP <span class="text-danger">*</span></label>
                        <input type="text" name="penerima_telp" class="form-control" id="penerima_telp" placeholder="08.." autocomplete="off" maxlength="15">
                    </div>
                    <div class="form-group">
                        <label for="penerima_alamat_instansi">Alamat Instansi<span class="text-danger">*</span></label>
                        <input type="text" name="penerima_alamat_instansi" class="form-control" id="penerima_alamat_instansi" placeholder="Alamat instansi penerima.." autocomplete="off" maxlength="250">
                    </div>
                    <div class="form-group">
                        <label for="tgl">Tanggal <span class="text-danger">*</span></label>
                        <input type="date" name="tgl" class="form-control" id="tgl">
                    </div>
                    <div class="form-group">
                        <label for="nominal">Nominal <span class="text-danger">*</span></label>
                        <input type="text" name="nominal" class="form-control" id="nominal" placeholder="Rp.." onkeyup="convertToRupiah(this);" autocomplete="off">
                        <small class="pl-1">Maks Rp <span id="maksNominalTrsKeluar"></span></small>
                    </div>
                    <div class="form-group">
                        <label for="keterangan">Keterangan <span class="text-danger">*</span></label>
                        <input type="text" name="keterangan" class="form-control" id="keterangan" placeholder="Keterangan kegunaan dana.." autocomplete="off" maxlength="250">
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="petugas" value="<?= $user['name']; ?>">
                    <button type="button" class="btn btn-secondary closeAddTrsKeluarModal" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal edit trs keluar -->
<div class="modal fade" id="editTrsKeluarModal" tabindex="-1" role="dialog" aria-labelledby="editTrsKeluarModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog scrollable" role="document" data-backdrop="static" data-keyboard="false">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editTrsKeluarModalLabel">Edit Transaksi</h5>
                <button type="button" class="close closeEditTrsKeluarModal" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('admin/updateTrskeluar'); ?>" method="post">
                <div class="modal-body" style="height: 400px; overflow-y: auto;">
                    <div class="form-group">
                        <label for="programEdit">Program <span class="text-danger">*</span></label>
                        <select name="programEdit" class="form-control" id="programEdit">
                            <option value="#" selected disabled>Pilih program</option>
                            <?php foreach ($program as $p) : ?>
                                <option value="<?= $p['nama_program']; ?>" data-maks="<?= $p['dana_program']; ?>"><?= ($p['nama_program'] == '') ? 'Tidak Bernama' : $p['nama_program']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="penerima_namaEdit">Nama Penanggungjawab <span class="text-danger">*</span></label>
                        <input type="text" name="penerima_namaEdit" class="form-control" id="penerima_namaEdit" placeholder="Nama pj penerima.." autocomplete="off" maxlength="60">
                    </div>
                    <div class="form-group">
                        <label for="penerima_telpEdit">No. HP</label>
                        <input type="text" name="penerima_telpEdit" class="form-control" id="penerima_telpEdit" placeholder="08.." autocomplete="off" maxlength="15">
                    </div>
                    <div class="form-group">
                        <label for="penerima_alamat_instansiEdit">Alamat </label>
                        <input type="text" name="penerima_alamat_instansiEdit" class="form-control" id="penerima_alamat_instansiEdit" placeholder="Alamat instansi penerima.." autocomplete="off" maxlength="250">
                    </div>
                    <div class="form-group">
                        <label for="tglEdit">Tanggal </label>
                        <input type="date" name="tglEdit" class="form-control" id="tglEdit" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="nominalEdit">Nominal <span class="text-danger">*</span></label>
                        <input type="text" name="nominalEdit" class="form-control" id="nominalEdit" placeholder="Rp.." onkeyup="convertToRupiah(this);" autocomplete="off">
                        <small class="pl-1">Maks Rp <span id="maksNominalTrsKeluarEdit"></span></small>
                    </div>
                    <div class="form-group">
                        <label for="keteranganEdit">Keterangan </label>
                        <input type="text" name="keteranganEdit" class="form-control" id="keteranganEdit" placeholder="Keterangan kegunaan dana.." autocomplete="off" maxlength="250">
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="idTrsKeluar" id="idTrsKeluar">
                    <button type="button" class="btn btn-secondary closeEditTrsKeluarModal" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Edit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- sub program Delete Modal-->
<div class="modal fade" id="deleteTrsKeluarModal" tabindex="-1" role="dialog" aria-labelledby="deleteTrsKeluarModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteTrsKeluarModalLabel">Are You sure to delete this?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Select "Delete" below if you sure to delete.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" id="cDelTrsKeluar">Delete</a>
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
                <div class="modal-body" style="height: 230px; overflow-y: auto;">
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
                        <label for="petugas" class="col-sm-2 col-form-label">Petugas</label>
                        <div class="col-sm-10">
                            <select name="petugas" id="petugas" class="selectpicker form-control" data-live-search="true">
                                <option value="semua">Semua</option>
                                <?php foreach ($petugas as $a) : ?>
                                    <option value="<?= $a['petugas']; ?>"><?= $a['petugas']; ?></option>
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
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="jenis_transaksi" value="Keluar">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Cetak</button>
                </div>
            </form>
        </div>
    </div>
</div>
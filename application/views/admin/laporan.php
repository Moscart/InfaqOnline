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

        <!-- cetak laporan -->
        <div class="col-lg-12 mb-3">
            <!-- Collapsable role -->
            <div class="card shadow mb-4">
                <!-- Card Header - Accordion -->
                <a href="#collapseCetakLaporan" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCetakLaporan">
                    <h6 class="m-0 font-weight-bold text-primary">Form Cetak Laporan</h6>
                </a>
                <!-- Card Content - Collapse -->
                <div class="collapse show" id="collapseCetakLaporan">
                    <div class="card-body">
                        <form method="POST" action="<?= base_url('admin/laporanaction') ?>">
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
                                    <div class="col-sm-4 col-md-4 col-xl-2">
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
                                <label for="email" class="col-sm-2 col-form-label">Donatur</label>
                                <div class="col-sm-10">
                                    <select name="email" id="email" class="selectpicker form-control" data-live-search="true">
                                        <option value="semua">Semua</option>
                                        <?php foreach ($donatur as $a) : ?>
                                            <option value="<?= $a['nama']; ?>"><?= $a['nama']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label for="jenis_trasaksi" class="col-sm-2 col-form-label">Jenis Transaksi</label>
                                <div class="col-sm-10">
                                    <select name="jenis_trasaksi" id="jenis_trasaksi" class="form-control">
                                        <option value="#" disabled selected>Pilih jenis transaksi</option>
                                        <option value="Masuk">Masuk</option>
                                        <option value="Keluar">Keluar</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-2"></div>
                                <div class="col-sm-10">
                                    <button type="submit" class="btn btn-success shadow-sm mb-2 mb-md-0">
                                        Cetak
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- end of cetak laporan -->

    </div>
    <!-- end of row -->

</div>
<!-- .container-fluid -->

</div>
<!-- End of Main Content -->
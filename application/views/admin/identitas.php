<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <!-- if ada pesan -->
    <?= $this->session->flashdata('message'); ?>

    <!-- Content Row -->
    <div class="row mb-3">

        <div class="col-lg-8 mb-3">
            <!-- Collapsable role -->
            <div class="card shadow mb-4">
                <!-- Card Header - Accordion -->
                <a href="#collapseIdentitasUmum" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseIdentitasUmum">
                    <h6 class="m-0 font-weight-bold text-primary">Identitas Umum</h6>
                </a>
                <!-- Card Content - Collapse -->
                <div class="collapse show" id="collapseIdentitasUmum">
                    <div class="card-body">
                        <!-- form edit identitas -->
                        <form action="<?= base_url('admin/identitas'); ?>" method="post" class="mb-3">
                            <div class="form-group">
                                <label for="namaApotek">Nama Apotek</label>
                                <input type="text" class="form-control" id="namaApotek" name="namaApotek" placeholder="Nama Apotek..." value="<?= $identitas['nama']; ?>" required>
                                <?= form_error('namaApotek', '<small class="text-danger pl-1">', '</small>'); ?>
                            </div>
                            <div class="form-group">
                                <label for="alamatApotek">Alamat</label>
                                <input type="text" class="form-control" id="alamatApotek" name="alamatApotek" placeholder="Alamat Apotek..." value="<?= $identitas['alamat']; ?>" required>
                                <?= form_error('alamatApotek', '<small class="text-danger pl-1">', '</small>'); ?>
                            </div>
                            <div class="form-group">
                                <label for="noTelpApotek">No. Telepon</label>
                                <input type="text" class="form-control" id="noTelpApotek" name="noTelpApotek" placeholder="Nomor Telepon Apotek..." value="<?= $identitas['no_telp']; ?>" required>
                                <?= form_error('noTelpApotek', '<small class="text-danger pl-1">', '</small>'); ?>
                            </div>
                            <div class="form-group">
                                <label for="pemilikApotek">Pemilik</label>
                                <input type="text" class="form-control" id="pemilikApotek" name="pemilikApotek" placeholder="Pemilik Apotek..." value="<?= $identitas['pemilik']; ?>" required>
                                <?= form_error('pemilikApotek', '<small class="text-danger pl-1">', '</small>'); ?>
                            </div>
                            <div class="form-group">
                                <label for="siaApotek">SIA</label>
                                <input type="text" class="form-control" id="siaApotek" name="siaApotek" placeholder="Surat Izin Apotek..." value="<?= $identitas['sia']; ?>">
                                <?= form_error('siaApotek', '<small class="text-danger pl-1">', '</small>'); ?>
                            </div>
                            <div class="form-group">
                                <label for="apaApotek">APA</label>
                                <input type="text" class="form-control" id="apaApotek" name="apaApotek" placeholder="Apoteker Penanggung jawab Apotek..." value="<?= $identitas['apa']; ?>">
                                <?= form_error('apaApotek', '<small class="text-danger pl-1">', '</small>'); ?>
                            </div>

                            <div class="form-group">
                                <input type="hidden" name="typePost" value="<?= base64_encode('umum'); ?>">
                                <button type="submit" class="btn btn-block btn-primary">Edit</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <!-- Collapsable role -->
            <div class="card shadow mb-4">
                <!-- Card Header - Accordion -->
                <a href="#collapseSystem" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseSystem">
                    <h6 class="m-0 font-weight-bold text-primary">Identitas Sistem</h6>
                </a>
                <!-- Card Content - Collapse -->
                <div class="collapse show" id="collapseSystem">
                    <div class="card-body">
                        <!-- form -->
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <p class="text-center mb-2">Favicon saat ini<br>
                                    <img src="<?= base_url('/assets/img/favicon/') . $identitas['favicon']; ?>" alt="favicon" class="w-50">
                                </p>
                                <?php if ($identitas['favicon'] != 'default.ico') : ?>
                                    <form action="<?= base_url('admin/identitas'); ?>" method="post" class="mb-2 text-center">
                                        <input type="hidden" name="typePost" value="<?= base64_encode('defaultFavicon') ?>">
                                        <button type="submit" class="btn btn-primary" onclick="return confirm('Udah yakin belom...?')">Reset</button>
                                    </form>
                                <?php endif; ?>
                            </div>
                            <div class="col-md-6 mb-3">
                                <p class="text-center mb-2">Icon saat ini<br>
                                    <i class="fas fa-<?= $identitas['icon']; ?> fa-6x"></i>
                                </p>
                                <?php if ($identitas['icon'] != 'medkit') : ?>
                                    <form action="<?= base_url('admin/identitas'); ?>" method="post" class="mb-2 text-center">
                                        <input type="hidden" name="typePost" value="<?= base64_encode('defaultIcon') ?>">
                                        <button type="submit" class="btn btn-primary" onclick="return confirm('Udah yakin belom...?')">Reset</button>
                                    </form>
                                <?php endif; ?>
                            </div>
                        </div>
                        <form action="<?= base_url('admin/identitas'); ?>" enctype="multipart/form-data" method="post" class="form-row mb-3">
                            <div class="col-12">
                                <label for="faviconApotek">Favicon Baru</label>
                            </div>
                            <div class="col-12 col-md-8">
                                <input type="file" class="form-control-file" name="faviconApotek" id="faviconApotek" required>
                                <small class="form-text text-muted pl-1">File type .ico, .jpg, .png ukuran 32x32</small>
                            </div>
                            <div class="col-12 col-md-4 mt-2 mt-md-0">
                                <input type="hidden" name="typePost" value="<?= base64_encode('favicon'); ?>">
                                <button type="submit" class="btn btn-primary btn-block" id="btnGantiFavicon" disabled>Ganti Favicon</button>
                            </div>
                            <?= form_error('favicon', '<small class="text-danger pl-1">', '</small>'); ?>
                        </form>
                        <form action="<?= base_url('admin/identitas'); ?>" method="post" class="form-row mb-3">
                            <div class="col-12 col-md-8">
                                <label for="iconApotek">Icon Baru</label>
                                <input type="text" class="form-control" id="iconApotek" name="iconApotek" placeholder="fontawesome v5.10.12" value="<?= $identitas['icon']; ?>" required>
                                <small class="form-text text-muted pl-1">Font Awesome v5.10.12</small>
                                <?= form_error('iconApotek', '<small class="text-danger pl-1">', '</small>'); ?>
                            </div>
                            <div class="col-12 col-md-4 my-auto">
                                <input type="hidden" name="typePost" value="<?= base64_encode('icon'); ?>">
                                <button type="submit" class="btn btn-primary mt-2 btn-block">Ganti Icon</button>
                            </div>
                        </form>
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
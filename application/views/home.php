    <?php $this->load->view('./header.php') ?>
    <main>
        <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <?php foreach ($artikel as $a) : ?>
                    <div class="carousel-item active banner-container">
                        <img src="<?= base_url('assets/img/artikel/') . $a['banner']; ?>" class="d-block w-100 banner-content" alt="Banner <?= $a['judul']; ?>">
                    </div>
                <?php endforeach; ?>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
        <div class="container py-5">
            <div class="row gy-4">
                <div class="col-lg-6 col-12">
                    <div class="card shadow bg-dark border-0 position-relative">
                        <div class="w-max pe-4 mt-4 p-3 rounded-start rounded-pill bg-warning fs-7 fw-bold text-uppercase">
                            Total Infak
                        </div>
                        <div class="position-absolute text-white end-0 top-0">
                            <div class="row gx-2 me-3">
                                <div class="col">
                                    <div class="bg-warning rounded-pill rounded-top p-1" style="height: 50px;"></div>
                                </div>
                                <div class="col">
                                    <div class="bg-warning rounded-pill rounded-top p-1" style="height: 50px;"></div>
                                </div>
                                <div class="col">
                                    <div class="bg-warning rounded-pill rounded-top p-1" style="height: 50px;"></div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body fw-bold text-muted">
                            Rp<span class="fs-1 text-white"><?= format_rupiah($saldo); ?></span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-12">
                    <h3 class="fw-bolder text-uppercase fs-4">Infak Terbaru</h3>
                    <div class="row gy-1">
                        <?php foreach ($lastDanaMasuk as $ldm) : ?>
                            <div class="col-12">
                                <div class="bg-dark fs-7 text-white rounded-pill p-2">
                                    <div class="row px-3">
                                        <div class="col-6 align-self-center fw-bold"><?= date('d', strtotime($ldm['tgl'])) . '/' . month(date('n', strtotime($ldm['tgl'])), 'mmm') . '/' . date('Y', strtotime($ldm['tgl'])); ?></div>
                                        <div class="col-6 text-end fw-bold text-muted">Rp<span class="text-warning fs-6"><?= format_rupiah($ldm['nominal']); ?></span></div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="bg-dark py-5">
            <div class="container">
                <div class="fs-4 fw-bold text-center mb-4 text-white">ARTIKEL</div>
                <div class="row gy-4 justify-content-center">
                    <?php foreach ($artikel as $art) : ?>
                        <div class="col-lg-4 col-md-6 col-12">
                            <div class="card h-100 rounded-4 border-0 shadow overflow-hidden">
                                <div class="img-container">
                                    <img src="<?= base_url(); ?>assets/img/artikel/<?= $art['banner']; ?>" class="img-content" alt="<?= $art['judul']; ?>">
                                </div>
                                <div class="card-body d-flex flex-column p-4">
                                    <h5 class="card-title"><?= $art['judul']; ?></h5>
                                    <p class="card-text text-muted"><?= strip_tags(substr($art['isi'], 0, 100)) . ' [...]'; ?></p>
                                    <a href="<?= base_url(); ?>artikel/<?= $art['link']; ?>" class="btn btn-outline-primary d-block rounded-pill mx-5 mt-auto">Selengkapnya</a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <a type="button" class="btn btn-warning rounded-pill fs-7 fw-bold text-uppercase py-3 px-5 mt-5 mx-auto d-block w-max" href="<?= base_url(); ?>artikel">Lihat lainnya</a>
            </div>
        </div>
        <div class="container py-5">
            <div class="row gy-5">
                <div class="col-lg-8 col-12 mb-3 md-mb-0">
                    <img src="https://img.freepik.com/premium-vector/love-charity-giving-donation-via-volunteer-team-worked-together-help-collect-donations-poster-banner-flat-design-illustration_2175-2450.jpg?w=2000" class="w-100 rounded-5 shadow" alt="">
                </div>
                <div class="col-lg-4 col-12 my-auto">
                    <div class="fs-4 fw-bold text-center mb-2">INFAK</div>
                    <div class="text-center text-center mb-3">
                        Berbagi dengan orang lain adalah bentuk terbaik dari mensyukuri apa yang telah kita dapatkan. Infak lebih mudah dan terpercaya di sini.
                    </div>
                    <?php if (count($program) > 0) : ?>
                        <button type="button" class="btn btn-primary rounded-pill fs-7 w-100 text-uppercase py-2 mb-3" data-bs-toggle="modal" data-bs-target="#listProgramModal">
                            Pilih Program&nbsp;&nbsp;<i class="fas fa-angle-double-down"></i>
                        </button>
                        <div class="modal fade" id="listProgramModal" tabindex="-1" data-bs-backdrop="false" aria-labelledby="listProgramModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="listProgramModalLabel">Pilih Program Donasi</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="closeListProgramModal"></button>
                                    </div>
                                    <div class="modal-body" style="height: 400px; overflow-y: auto;">
                                        <?php foreach ($program['program'] as $p) : ?>
                                            <p class="fs-5 fw-bold"><?= $p['nama_program']; ?></p>
                                            <div class="row mb-4">
                                                <?php foreach ($p['program_detail'] as $pd) : ?>
                                                    <div class="col-sm-6 mb-2">
                                                        <img src="<?= $pd['banner_detailprogram'] ?>" alt="Banner detail program <?= $pd['banner_detailprogram']; ?>" class="img-thumbnail" style="cursor: pointer;" title="klik untuk pilih program" id="selectThisProgram" data-program="<?= $pd['nama_detailprogram']; ?>">
                                                        <p class="text-center text-muted"><?= $pd['nama_detailprogram']; ?></p>
                                                    </div>
                                                <?php endforeach; ?>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                    <div class="input-group mb-3">
                        <span class="input-group-text">Rp</span>
                        <div class="form-floating">
                            <input type="text" class="form-control" min="1" id="nominal" placeholder="Masukkan Nominal" onkeyup="convertToRupiah(this);" data-program="" data-nama="<?= ($this->session->userdata('email')) ? $user['name'] : ''; ?>" data-email="<?= ($this->session->userdata('email')) ? $user['email'] : ''; ?>" data-telp="<?= ($this->session->userdata('email')) ? $user['no_telp'] : ''; ?>">
                            <label for="nominal">Nominal</label>
                        </div>
                    </div>
                    <div class="row mb-3 g-2">
                        <div class="col-xl-4 col-lg-6 col-md-4 col-6">
                            <input type="radio" class="btn-check" name="list-nominal" id="list-nominal1" value="10000" autocomplete="off">
                            <label class="btn btn-outline-primary w-100" for="list-nominal1">Rp10.000</label>
                        </div>
                        <div class="col-xl-4 col-lg-6 col-md-4 col-6">
                            <input type="radio" class="btn-check" name="list-nominal" id="list-nominal2" value="15000" autocomplete="off">
                            <label class="btn btn-outline-primary w-100" for="list-nominal2">Rp15.000</label>
                        </div>
                        <div class="col-xl-4 col-lg-6 col-md-4 col-6">
                            <input type="radio" class="btn-check" name="list-nominal" id="list-nominal3" value="20000" autocomplete="off">
                            <label class="btn btn-outline-primary w-100" for="list-nominal3">Rp20.000</label>
                        </div>
                        <div class="col-xl-4 col-lg-6 col-md-4 col-6">
                            <input type="radio" class="btn-check" name="list-nominal" id="list-nominal4" value="25000" autocomplete="off">
                            <label class="btn btn-outline-primary w-100" for="list-nominal4">Rp25.000</label>
                        </div>
                        <div class="col-xl-4 col-lg-6 col-md-4 col-6">
                            <input type="radio" class="btn-check" name="list-nominal" id="list-nominal5" value="50000" autocomplete="off">
                            <label class="btn btn-outline-primary w-100" for="list-nominal5">Rp50.000</label>
                        </div>
                        <div class="col-xl-4 col-lg-6 col-md-4 col-6">
                            <input type="radio" class="btn-check" name="list-nominal" id="list-nominal6" value="100000" autocomplete="off">
                            <label class="btn btn-outline-primary w-100" for="list-nominal6">Rp100.000</label>
                        </div>
                    </div>
                    <button type="button" id="pay-button" class="btn btn-warning rounded-pill fs-7 fw-bold w-100 text-uppercase py-2">Lanjutkan Pembayaran</button>
                </div>
            </div>
        </div>
    </main>
    <?php $this->load->view('./footer.php') ?>
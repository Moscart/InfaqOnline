<?php $this->load->view('./header.php') ?>
<main>
    <div class="py-5">
        <div class="container">
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
    </div>
</main>
<?php $this->load->view('./footer.php') ?>
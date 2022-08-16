<?php $this->load->view('./header.php') ?>
<main>
    <div class="py-5">
        <div class="container">
            <div class="fs-4 fw-bold text-center mb-4">ARTIKEL</div>
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
        </div>
    </div>
</main>
<?php $this->load->view('./footer.php') ?>
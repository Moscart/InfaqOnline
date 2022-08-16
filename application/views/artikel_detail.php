<?php $this->load->view('./header.php') ?>
<main>
    <div class="py-5">
        <div class="container">
            <div class="fs-4 fw-bold text-center mb-4"><?= $artikel['judul']; ?></div>
            <div class="card h-100 rounded-4 border-0 shadow overflow-hidden">
                <div class="img-container">
                    <img id="img-artikel" src="<?= base_url(); ?>assets/img/artikel/<?= $artikel['banner']; ?>" class="img-content" alt="<?= $artikel['judul']; ?>">
                </div>
                <div class="card-body d-flex flex-column p-4">
                    <h5 class="card-title fw-bold fs-3"><?= $artikel['judul']; ?></h5>
                    <h6 class="text-muted"><?= $artikel['tgl_upload']; ?></h6>
                    <div class="mt-4">
                        <?= $artikel['isi']; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<div id="myModal" class="modal">
    <span class="close">&times;</span>
    <img class="modal-content" id="img01">
</div>
<script>
    var modal = document.getElementById("myModal");

    var img = document.getElementById("img-artikel");
    var modalImg = document.getElementById("img01");
    img.onclick = function() {
        modal.style.display = "block";
        modalImg.src = this.src;
    }

    var span = document.getElementsByClassName("close")[0];

    span.onclick = function() {
        modal.style.display = "none";
    }
</script>
<?php $this->load->view('./footer.php') ?>
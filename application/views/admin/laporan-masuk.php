<?php
// echo '<pre>';
// print_r($transaksi);
// echo '</pre>';
// die;
error_reporting(0);
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?= $title; ?></title>
    <!-- load favico -->
    <link rel="icon" href="<?= base_url('assets/img/favicon/') . $identitas['favicon']; ?>" type="image/x-icon">
    <link href="<?= base_url(); ?>assets/css/report.css" rel="stylesheet">
</head>

<body>

    <!-- button back to home -->
    <buttton type="button" class="btn btn-success" onclick="history.go(-1);" title="Kembali ke halaman sebelumnya" id="btnBackReport">Kembali</buttton>

    <!-- element-to-print -->
    <div id="element-to-print">
        <!-- hedaer -->
        <div class="text-right text-italic" style="font-size: 10px; color: #575757;">
            Arsip <?= $identitas['nama'] . ' - ' . $title; ?>
        </div>
        <!-- end of hedaer -->

        <!-- hedaer nota -->
        <div class="row">
            <div class="col-6">
                <table class="tabel-keterangan-laporan">
                    <tr>
                        <td colspan="2" class="nama-laporan">LAPORAN TRANSAKSI MASUK</td>
                    </tr>
                    <tr>
                        <td class="keterangan">Periode</td>
                        <td class="isi-keterangan">: <?= $transaksi['periodeHeader']; ?></td>
                    </tr>
                    <tr>
                        <td class="keterangan">Donatur</td>
                        <td class="isi-keterangan">: <?= $transaksi['donaturHeader']; ?></td>
                    </tr>
                    <tr>
                        <td class="keterangan">Program</td>
                        <td class="isi-keterangan">: <?= $transaksi['programHeader']; ?></td>
                    </tr>
                    <tr>
                        <td class="keterangan">Status</td>
                        <td class="isi-keterangan">: <?= $transaksi['statusHeader']; ?></td>
                    </tr>
                </table>
            </div>
            <div class="col-5">
                <p class="font-weight-bold text-right mb-1 mt-0"><?= $identitas['nama_instansi']; ?></p>
                <span class="text-right d-block"><?= $identitas['alamat']; ?></span>
                <span class="text-right d-block">Telp. <?= $identitas['no_telp']; ?></span>
            </div>
        </div>
        <!-- end of hedaer nota -->

        <!-- hr -->
        <div style="margin-top: -5px; margin-bottom: 12px; width: 100%; border-bottom: 1.5pt solid black;"></div>

        <!-- isi laporan -->
        <div class="mb-3">
            <table class="tabel-pembelian-rangkuman" border="1">
                <tr>
                    <th class="kol-no">No</th>
                    <th class="kol-fak">ID Transaksi</th>
                    <th class="kol-tgl">Tanggal</th>
                    <th class="kol-sup">Donatur</th>
                    <th class="kol-sta">Program</th>
                    <th class="kol-tot">Total</th>
                    <th class="kol-sta">Status</th>
                </tr>
                <?php $nomor = 1;
                if (count($transaksi['dataTransaksi']) > 0) : ?>
                    <?php foreach ($transaksi['dataTransaksi'] as $d) : ?>
                        <tr>
                            <td align="center" class="kol-no"><?= $nomor++; ?></td>
                            <td align="left" class="kol-fak"><?= $d['order_id']; ?></td>
                            <td align="left" class="kol-tgl"><?= $d['tgl']; ?></td>
                            <td align="left" class="kol-sup"><?= $d['user_nama']; ?></td>
                            <td align="left" class="kol-sta"><?= $d['program']; ?></td>
                            <td align="right" class="kol-tot"><?= $d['nominal']; ?>&nbsp;</td>
                            <td align="center" class="kol-sta"><?= $d['status']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else : ?>
                    <tr>
                        <td colspan="7" class="text-center data-kosong" style="background-color: #f2f2f2;">Tidak ada data.</td>
                    </tr>
                <?php endif; ?>
            </table>
        </div>
        <!-- end of isi laporan -->

        <!-- total -->
        <div class="kol-tot-pembelian text-right p-2">
            Total : <?= $transaksi['total']; ?>
        </div>
        <!-- end of total -->

    </div>
    <!-- end of element-to-print -->

    <script src="<?= base_url(); ?>assets/js/html2pdf.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var element = document.getElementById('element-to-print');
            html2pdf(element, {
                margin: 10,
                filename: '<?= $title; ?>.pdf',
                image: {
                    type: 'jpeg',
                    quality: 1
                },
                html2canvas: {
                    scale: 2,
                    logging: true,
                    dpi: 192,
                    letterRendering: true
                },
                jsPDF: {
                    unit: 'mm',
                    format: 'a4',
                    orientation: 'portrait'
                },
                pagebreak: {
                    mode: ['avoid-all', 'css', 'legacy']
                }, //It determines how HTML elements should be split.
                pdfCallback: pdfCallback
            });

            function pdfCallback(pdfObject) {
                var number_of_pages = pdfObject.internal.getNumberOfPages()
                var pdf_pages = pdfObject.internal.pages
                // var myFooter = "Footer info"
                for (var i = 1; i < pdf_pages.length; i++) {
                    // We are telling our pdfObject that we are now working on this page
                    pdfObject.setPage(i)

                    pdfObject.text(" Arsip <?= $identitas['nama'] . ' - ' . $title; ?>", 10, 10)

                    // The 10,200 value is only for A4 landscape. You need to define your own for other page sizes
                    pdfObject.text("Page " + i + " of " + pdf_pages, 10, 200)
                }
            }
        });
    </script>

</body>

</html>
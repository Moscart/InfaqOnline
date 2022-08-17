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

        <?php if ($totalInfaqDonatur['total'] > 0) : ?>

            <!-- Earnings (Monthly) Card -->
            <div class="col-xl-4 col-md-4 mb-4">
                <div class="card border-left-success shadow py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Total Keseluruhan</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?= 'Rp ' . format_rupiah($totalInfaqDonatur['total']); ?></div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-wallet fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Total pending Card -->
            <div class="col-xl-4 col-md-4 mb-4">
                <div class="card border-left-warning shadow py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Status Pending</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?= number_format($countInfaqPending['pending_count'], 0, ",", "."); ?></div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-clock fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Total Nominal pending Card -->
            <div class="col-xl-4 col-md-4 mb-4">
                <div class="card border-left-danger shadow py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Nominal Pending</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?= 'Rp ' . format_rupiah($totalInfaqPending['pending_total']); ?></div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Area Chart -->
            <div class="col-xl-12 col-lg-12">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">History Perbulan Terbaru</h6>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <div class="chart-area">
                            <canvas id="myAreaChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>

        <?php endif; ?>

        <!-- tabel history -->
        <div class="col-lg-12">
            <!-- Collapsable history -->
            <div class="card shadow mb-4">
                <!-- Card Header - Accordion -->
                <a href="#collapseHistory" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseHistory">
                    <h6 class="m-0 font-weight-bold text-primary">History</h6>
                </a>
                <!-- Card Content - Collapse -->
                <div class="collapse show" id="collapseHistory">
                    <div class="card-body">
                        <table class="table table-striped table-hover dtableExportResponsive">
                            <thead>
                                <tr class="text-center">
                                    <th style="width: 5%;" scope="col">#</th>
                                    <th scope="col">ID Transaksi</th>
                                    <th scope="col">Tanggal</th>
                                    <th scope="col">Nominal</th>
                                    <th scope="col">Program</th>
                                    <th scope="col">Status</th>
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
                                        <td>
                                            <?= date('d', strtotime($uwr['tgl'])) . ' ' . month(date('n', strtotime($uwr['tgl'])), 'mmm') . ' ' . date('Y', strtotime($uwr['tgl'])) . ', ' . date('H:i', strtotime($uwr['tgl'])); ?>
                                        </td>
                                        <td class="text-right"><?= format_rupiah($uwr['nominal']); ?></td>
                                        <td><?= $uwr['program']; ?></td>
                                        <td>
                                            <span class="badge badge-<?= ($uwr['status'] == 'capture' || $uwr['status'] == 'settlement') ? 'info' : 'warning'; ?>"><?= strtoupper($uwr['status']); ?></span>
                                        </td>
                                    </tr>
                                <?php $no++;
                                endforeach; ?>
                            </tbody>
                            <tfoot>
                                <tr class="text-center">
                                    <th style="width: 5%;" scope="col">#</th>
                                    <th scope="col">ID Transaksi</th>
                                    <th scope="col">Tanggal</th>
                                    <th scope="col">Nominal</th>
                                    <th scope="col">Program</th>
                                    <th scope="col">Status</th>
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
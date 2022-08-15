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

        <!-- last login akun -->
        <div class="col-lg-12">
            <!-- Collapsable role -->
            <div class="card shadow">
                <!-- Card Header - Accordion -->
                <a href="#collapseLastLogin" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseLastLogin">
                    <h6 class="m-0 font-weight-bold text-primary">Aktivitas Akun</h6>
                </a>
                <!-- Card Content - Collapse -->
                <div class="collapse show" id="collapseLastLogin">
                    <div class="card-body">
                        <table class="table table-hover table-striped dtableResponsiveOnly">
                            <thead>
                                <tr class="text-center">
                                    <th scope="col">Fullname</th>
                                    <th scope="col">User Role</th>
                                    <th scope="col">Waktu</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1;
                                foreach ($lastLogin as $n) : ?>
                                    <tr>
                                        <td><?= $n['fullname']; ?></td>
                                        <td><?= $n['role']; ?></td>
                                        <td scope="row"><?= $n['last_login']; ?></td>
                                    </tr>
                                <?php $no++;
                                endforeach; ?>
                            </tbody>
                            <tfoot>
                                <tr class="text-center">
                                    <th scope="col">Fullname</th>
                                    <th scope="col">User Role</th>
                                    <th scope="col">Waktu</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- end of last login akun -->

    </div>
    <!-- end of row -->

</div>
<!-- .container-fluid -->

</div>
<!-- End of Main Content -->
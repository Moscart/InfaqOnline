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

        <div class="col-md-4">
            <!-- Collapsable role -->
            <div class="card shadow mb-4">
                <!-- Card Header - Accordion -->
                <a href="#collapseProgram" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseProgram">
                    <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-folder fa-sm"></i> Program</h6>
                </a>
                <!-- Card Content - Collapse -->
                <div class="collapse show" id="collapseProgram">
                    <div class="card-body">
                        <!-- form add new program -->
                        <form action="<?= base_url('admin/program'); ?>" method="post" class="mb-3">
                            <div class="form-row">
                                <div class="col-12 mb-2">
                                    <label class="sr-only" for="program">Tambah Program</label>
                                    <input type="text" class="form-control" id="program" name="program" placeholder="Tambah program baru...">
                                    <?= form_error('program', '<small class="text-danger pl-1">', '</small>'); ?>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary">Tambah</button>
                                </div>
                            </div>
                        </form> <!-- end of form add new program -->
                        <!-- list program -->
                        <table class="table table-hover table-striped dtableResponsiveNoSearch">
                            <thead>
                                <tr class="text-center">
                                    <th scope="col">#</th>
                                    <th scope="col">Program</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1;
                                foreach ($program as $r) : ?>
                                    <tr>
                                        <th scope="row" class="text-center"><?= $no++; ?></th>
                                        <td><?= $r['nama_program']; ?></td>
                                        <td>
                                            <a href="" class="btn btn-sm mb-1 btn-success" data-idprogram="<?= $r['id_program']; ?>" data-program="<?= $r['nama_program']; ?>" data-toggle="modal" data-target="#editProgramModal" id="editProgram">Edit</a>
                                            <a href="" data-href="<?= base_url('admin/deleteprogram/') . $r['id_program']; ?>" class="btn btn-sm mb-1 btn-danger" data-toggle="modal" id="delProgram" data-target="#deleteProgramModal">Delete</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table> <!-- end of list program -->
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card shadow mb-4">
                <!-- Card Header - Accordion -->
                <a href="#collapseSubProgram" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseSubProgram">
                    <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-folder-open fa-sm"></i> Sub Program</h6>
                </a>
                <!-- Card Content - Collapse -->
                <div class="collapse show" id="collapseSubProgram">
                    <div class="card-body">
                        <!-- btn modal trigger -->
                        <a href="" class="btn btn-primary mb-3 d-block" data-toggle="modal" data-target="#newSubProgramModal">Form Sub Program Baru</a>
                        <!-- list user -->
                        <table class="table table-striped table-hover dtableExportResponsive">
                            <thead class="text-center">
                                <th style="width: 5%;">#</th>
                                <th>Nama</th>
                                <th>Program Parent</th>
                                <th>Banner</th>
                                <th>Action</th>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($subProgram as $uwr) : ?>
                                    <tr>
                                        <th scope="row"><?= $no; ?></th>
                                        <td><?= $uwr['nama_detailprogram']; ?></td>
                                        <td>
                                            <span class="badge badge-light"><?= $uwr['nama_program']; ?></span>
                                        </td>
                                        <td class="text-center">
                                            <img src="<?= base_url('assets/img/program/') . $uwr['banner']; ?>" alt="banner <?= $uwr['nama_detailprogram']; ?>" class="img-thumbnail" style="width: 100px;">
                                        </td>
                                        <td class="text-center">
                                            <a href="" class="btn btn-sm mb-1 btn-success" data-idprogramdetail="<?= $uwr['id_programdetail']; ?>" data-nama="<?= $uwr['nama_detailprogram']; ?>" data-idprogram="<?= $uwr['id_program']; ?>" data-program="<?= $uwr['nama_program']; ?>" data-banner="<?= $uwr['banner']; ?>" data-deskripsi="<?= $uwr['deskripsi']; ?>" data-toggle="modal" data-target="#editSubProgramModal" id="editSubProgram">Edit</a>
                                            <a href="" data-href="<?= base_url('admin/deletesubprogram/') . $uwr['id_programdetail']; ?>" class="btn btn-sm mb-1 btn-danger" data-toggle="modal" id="delSubProgram" data-target="#deleteSubProgramModal">Delete</a>
                                        </td>
                                    </tr>
                                <?php $no++;
                                endforeach; ?>
                            </tbody>
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

<!-- Modal edit program -->
<div class="modal fade" id="editProgramModal" tabindex="-1" role="dialog" aria-labelledby="editProgramModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editProgramModalLabel">Edit Program</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('admin/updateprogram'); ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="hidden" name="inputIdProgram" id="inputIdProgram">
                        <input type="text" class="form-control" id="inputEditProgram" name="inputEditProgram" placeholder="Edit program name...">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Edit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal delete program -->
<div class="modal fade" id="deleteProgramModal" tabindex="-1" role="dialog" aria-labelledby="deleteProgramModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteProgramModalLabel">Are You sure to delete this?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Select "Delete" below if you sure to delete.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" id="cDelProgram">Delete</a>
            </div>
        </div>
    </div>
</div>

<!-- Modal tambah sub program -->
<div class="modal fade" id="newSubProgramModal" tabindex="-1" role="dialog" aria-labelledby="newSubProgramModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog scrollable" role="document" data-backdrop="static" data-keyboard="false">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newSubProgramModalLabel">Tambah Sub Program</h5>
                <button type="button" class="close closeAddSubProgramModal" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('admin/subProgramAction'); ?>" method="post" enctype="multipart/form-data">
                <div class="modal-body" style="height: 380px; overflow-y: auto;">
                    <div class="form-group text-center">
                        <img src="<?= base_url('assets/img/default-banner-infaq-online-4x4.jpg'); ?>" alt="Banner sub program default" class="img-thumbnail w-25" id="previewBannerSubProgram">
                    </div>
                    <div class="form-group">
                        <label for="id_program">Program <span class="text-danger">*</span></label>
                        <select name="id_program" id="id_program" class="form-control">
                            <option value="#" selected disabled>Pilih program</option>
                            <?php foreach ($program as $r) : ?>
                                <option value="<?= $r['id_program'] ?>"><?= $r['nama_program']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="nama_detailprogram">Nama Sub Program <span class="text-danger">*</span></label>
                        <input type="text" name="nama_detailprogram" class="form-control" id="nama_detailprogram" placeholder="Nama Sub Program.." autocomplete="off" maxlength="100">
                    </div>
                    <div id="errorNotifUploadAddSubProgram"></div>
                    <div class="form-group">
                        <label for="bannerSubProgram">Gambar <span class="text-danger">*</span></label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="bannerSubProgram" name="bannerSubProgram">
                            <label class="custom-file-label" for="bannerSubProgram" data-browse="Browse">Pilih file</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="deskripsi">Deskripsi <span class="text-danger">*</span></label>
                        <textarea name="deskripsi" class="form-control" id="deskripsi" rows="3"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="token" value="<?= base64_encode('add'); ?>">
                    <button type="button" class="btn btn-secondary closeAddSubProgramModal" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal edit sub program -->
<div class="modal fade" id="editSubProgramModal" tabindex="-1" role="dialog" aria-labelledby="editSubProgramModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editSubProgramModalLabel">Edit Sub Program</h5>
                <button type="button" class="close closeEditSubProgramModal" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('admin/subProgramAction'); ?>" method="post" enctype="multipart/form-data">
                <div class="modal-body" style="height: 380px; overflow-y: auto;">
                    <div class="form-group text-center">
                        <img src="<?= base_url('assets/img/default-banner-infaq-online-4x4.jpg'); ?>" alt="Banner sub program default" class="img-thumbnail w-25" id="previewBannerSubProgramEdit">
                    </div>
                    <div class="form-group">
                        <label for="id_programEdit">Program <span class="text-danger">*</span></label>
                        <select name="id_programEdit" id="id_programEdit" class="form-control">
                            <option value="#" selected disabled>Pilih program</option>
                            <?php foreach ($program as $r) : ?>
                                <option value="<?= $r['id_program'] ?>"><?= $r['nama_program']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="nama_detailprogramEdit">Nama Sub Program <span class="text-danger">*</span></label>
                        <input type="text" name="nama_detailprogramEdit" class="form-control" id="nama_detailprogramEdit" placeholder="Nama Sub Program.." autocomplete="off" maxlength="100">
                    </div>
                    <div id="errorNotifUploadEditSubProgram"></div>
                    <div class="form-group">
                        <label for="bannerSubProgramEdit">Gambar <span class="text-danger">*</span></label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="bannerSubProgramEdit" name="bannerSubProgramEdit">
                            <label class="custom-file-label" for="bannerSubProgramEdit" data-browse="Browse">Pilih file</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="deskripsiEdit">Deskripsi <span class="text-danger">*</span></label>
                        <textarea name="deskripsiEdit" class="form-control" id="deskripsiEdit" rows="3"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="token" value="<?= base64_encode('edit'); ?>">
                    <input type="hidden" name="bannerSubProgramOld" id="bannerSubProgramOld">
                    <input type="hidden" name="hiddenIdSubProgram" id="hiddenIdSubProgram">
                    <button type="button" class="btn btn-secondary closeEditSubProgramModal" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Edit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- sub program Delete Modal-->
<div class="modal fade" id="deleteSubProgramModal" tabindex="-1" role="dialog" aria-labelledby="deleteSubProgramModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteSubProgramModalLabel">Are You sure to delete this?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Select "Delete" below if you sure to delete.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" id="cDelSubProgram">Delete</a>
            </div>
        </div>
    </div>
</div>

<!-- declare here but call in cutom.js -->
<script src="//cdn.ckeditor.com/4.19.0/full/ckeditor.js"></script>
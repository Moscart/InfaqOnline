// ambil dari accordionSidebar
const windowOrigin = $('body').data('baseurl');

// ubah tombol logout jadi loading
$('#logOut').on('click', function () {
    $('#logOut').addClass('disabled').html(`<div class="spinner-border spinner-border-sm text-light" role="status"><span class="sr-only">Loading...</span></div>`);
});

// ganti input ke teks ketika show passowrd di  klik
$('#showPass').on('click', function (event) {
    event.preventDefault();
    if ($('#password').attr("type") == "text") {
        $('#password').attr('type', 'password');
        $('#toggle').removeClass('fa-eye text-primary');
        $('#toggle').addClass('fa-eye');
    } else if ($('#password').attr("type") == "password") {
        $('#password').attr('type', 'text');
        $('#toggle').removeClass('fa-eye');
        $('#toggle').addClass('fa-eye text-primary');
    }
});

// modify iput name file upload
$('.custom-file-input').on('change', function () {
    let fileName = $(this).val().split('\\').pop();
    $(this).next('.custom-file-label').addClass('selected').html(fileName);
});

// show hdie pass on /user
$('#showPass').on('click', function (event) {
    event.preventDefault();
    if ($('#current_password').attr("type") == "text") {
        $('#current_password').attr('type', 'password');
        $('#toggle').removeClass('fa-eye text-primary');
        $('#toggle').addClass('fa-eye');
    } else if ($('#current_password').attr("type") == "password") {
        $('#current_password').attr('type', 'text');
        $('#toggle').removeClass('fa-eye');
        $('#toggle').addClass('fa-eye text-primary');
    }
})

// show hdie pass on /user
$('#showPass1').on('click', function (event) {
    event.preventDefault();
    if ($('#new_password1').attr("type") == "text") {
        $('#new_password1').attr('type', 'password');
        $('#toggle1').removeClass('fa-eye text-primary');
        $('#toggle1').addClass('fa-eye');
    } else if ($('#new_password1').attr("type") == "password") {
        $('#new_password1').attr('type', 'text');
        $('#toggle1').removeClass('fa-eye');
        $('#toggle1').addClass('fa-eye text-primary');
    }
})

// show hdie pass on /user
$('#showPass2').on('click', function (event) {
    event.preventDefault();
    if ($('#new_password2').attr("type") == "text") {
        $('#new_password2').attr('type', 'password');
        $('#toggle2').removeClass('fa-eye text-primary');
        $('#toggle2').addClass('fa-eye');
    } else if ($('#new_password2').attr("type") == "password") {
        $('#new_password2').attr('type', 'text');
        $('#toggle2').removeClass('fa-eye');
        $('#toggle2').addClass('fa-eye text-primary');
    }
});

// admin/role changeacces user
$('.toChangeRoleAccess').on('click', function () {
    const menuId = $(this).data('menu');
    const roleId = $(this).data('role');

    $.ajax({
        url: `${windowOrigin}admin/changeaccess`,
        type: "post",
        data: {
            menuId: menuId,
            roleId: roleId
        },
        success: function () {
            document.location.href = `${windowOrigin}admin/roleaccess/${roleId}`;
        }
    });
});

// admin editRole
$(document).on('click', '#editRole', function () {
    $('#inputEditRole').val($(this).data('role'));
    $('#inputIdRole').val($(this).data('idrole'));
});

// admin deleteRole
$(document).on('click', '#delRole', function () {
    $('#cDelRole').attr('href', $(this).data('href'));
});

// admin editUser
$(document).on('click', '#editUser', function () {
    $('#inputEditRoleUser option:contains("' + $(this).data('idrole') + '")').text($(this).data('idrole') + ' (terakhir dipilih)').attr('selected', true);
    $('#hiddenInputEmail, #inputEditEmail').val($(this).data('email'));
    $('#hiddenInputUsername, #inputEditUsername').val($(this).data('ussname'));
    $('#inputEditFullname').val($(this).data('fullname'));
});

// admin onclose modal edit user
$('.closeEditUserModal').click(function () {
    let selectedRole = $('#inputEditRoleUser option:contains(" (terakhir dipilih)")');
    let textRoleSelected = $('#inputEditRoleUser option:contains(" (terakhir dipilih)")').text().split(' (terakhir dipilih)')[0];
    selectedRole.text(textRoleSelected).attr('selected', false);
    $('#inputEditPassword').val('');
});

// admin deleteUser
$(document).on('click', '#delUser', function () {
    $('#cDelUser').attr('href', $(this).data('href'));
});

// admin editUser nyalakan edit password
$('#enablePass').change(function () {
    $('#inputEditPassword').prop('disabled', false);
    $(this).prop('checked', true).parent().slideUp('slow');
});

// ketika modal edit user diclose
$('#editUserModal').on('hidden.bs.modal', function () {
    $('#inputEditPassword').prop('disabled', true);
    $('#enablePass').prop('checked', false).parent().show();
});

// menu/editMenu
$(document).on('click', '#editMenu', function () {
    $('#editMenu_id').val($(this).data('menuid'));
    $('#judul').val($(this).data('menu'));
});

// admin deleteMenu
$(document).on('click', '#delMenu', function () {
    $('#cDelMenu').attr('href', $(this).data('href'));
});

// admin deleteSubmenu
$(document).on('click', '#delSubmenu', function () {
    $('#cDelSubmenu').attr('href', $(this).data('href'));
});

// admin/artikelaction make a slug url
$('#judulArtikel').keyup(function () {
    let title = $(this).val();
    $('#linkUrlSlug').val(generateSlug(title).substring(0, 150)).change();
});

// admin/artikelaction cek ketersediaan link url
$(document).on('keyup, change', '#linkUrlSlug', function () {
    const linkSlug = $(this).val();
    if (linkSlug != '')
        $.ajax({
            url: `${windowOrigin}admin/isLinkAvailable`,
            type: "post",
            data: {
                linkSlug: linkSlug
            },
            success: function (resp) {
                if (resp == 'ok') $('#linkUrlSlug').removeClass('is-invalid').addClass('is-valid').attr('title', 'Link aman, belum terpakai');
                else $('#linkUrlSlug').removeClass('is-valid').addClass('is-invalid').attr('title', 'Error, link sudah terpakai');
            }
        });
    else $('#linkUrlSlug').removeClass('is-valid').addClass('is-invalid').attr('title', 'Inputan tidak boleh kosong');
});

// tampilkan gambar banner artikel sehabis pilih file
$('#bannerArtikel').change(function (e) {
    let allowedTypes = ['image/gif', 'image/png', 'image/jpg', 'image/jpeg'];
    let allowedSize = ['8388608']; //8 MB limit

    let file = e.target.files[0];
    let fileType = file.type;
    let fileSize = file.size;

    // jika format file diluar kriteria
    if (!allowedTypes.includes(fileType)) {
        $('#bannerArtikel').next('.custom-file-label').removeClass('selected').html('Pilih file');
        document.getElementById('previewBannerArtikel').src = `${windowOrigin}assets/img/default-banner-infaq-online-4x4.jpg`;
        $('#isiErrorNotifModal').html(`Maaf ya, silakan pilih file yang valid (<strong>${allowedTypes.join(', ')}</strong>). File Anda : ${fileType}`);
        $('#errorNotifModal').modal('show');
        return false;
    }
    // jika file lebih besar dari ketentuan size
    else if (fileSize > allowedSize) {
        $('#bannerArtikel').next('.custom-file-label').removeClass('selected').html('Pilih file');
        document.getElementById('previewBannerArtikel').src = `${windowOrigin}assets/img/default-banner-infaq-online-4x4.jpg`;
        $('#isiErrorNotifModal').html(`Ukuran file terlalu besar, maksimal ukuran yg disarankan <stong>${formatBytes(alloweSize)}</strong>`);
        $('#errorNotifModal').modal('show');
        return false;
    }
    // tampilkan preview gambar jika syarat terpenuhi 
    else {
        let reader = new FileReader();
        reader.onload = function (e) {
            // get loaded data and render thumbnail.
            document.getElementById('previewBannerArtikel').src = e.target.result;
        };
        // read the image file as a data URL.
        reader.readAsDataURL(this.files[0]);
    }
});

// admin/artikel delartikel
$(document).on('click', '#delArtikel', function () {
    $('#cDelArtikel').attr('href', $(this).data('href'));
});

// admin/program editProgram
$(document).on('click', '#editProgram', function () {
    $('#inputIdProgram').val($(this).data('idprogram'));
    $('#inputEditProgram').val($(this).data('program'));
});

// admin/program deleteProgram
$(document).on('click', '#delProgram', function () {
    $('#cDelProgram').attr('href', $(this).data('href'));
});

// tampilkan gambar banner add sub program sehabis pilih file
$('#bannerSubProgram').change(function (e) {
    let allowedTypes = ['image/gif', 'image/png', 'image/jpg', 'image/jpeg'];
    let allowedSize = ['8388608']; //8 MB limit

    let file = e.target.files[0];
    let fileType = file.type;
    let fileSize = file.size;

    // jika format file diluar kriteria
    if (!allowedTypes.includes(fileType)) {
        $('#bannerSubProgram').next('.custom-file-label').removeClass('selected').html('Pilih file');
        document.getElementById('previewBannerSubProgram').src = `${windowOrigin}assets/img/default-banner-infaq-online-4x4.jpg`;
        $('#errorNotifUploadAddSubProgram').html(`<div class="alert alert-danger alert-dismissible fade show mb-2" role="alert">Maaf ya, silakan pilih file yang valid (<strong>${allowedTypes.join(', ')}</strong>). File Anda : ${fileType}<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>`);
        return false;
    }
    // jika file lebih besar dari ketentuan size
    else if (fileSize > allowedSize) {
        $('#bannerSubProgram').next('.custom-file-label').removeClass('selected').html('Pilih file');
        document.getElementById('previewBannerSubProgram').src = `${windowOrigin}assets/img/default-banner-infaq-online-4x4.jpg`;
        $('#errorNotifUploadAddSubProgram').html(`<div class="alert alert-danger alert-dismissible fade show mb-2" role="alert"><strong>Ukuran file terlalu besar, maksimal ukuran yg disarankan <stong>${formatBytes(alloweSize)}</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>`);
        return false;
    }
    // tampilkan preview gambar jika syarat terpenuhi 
    else {
        let reader = new FileReader();
        reader.onload = function (e) {
            // get loaded data and render thumbnail.
            document.getElementById('previewBannerSubProgram').src = e.target.result;
        };
        // read the image file as a data URL.
        reader.readAsDataURL(this.files[0]);
    }
});

// rubah textarea ke ckeditor
$('#newSubProgramModal').on('show.bs.modal', function () {
    CKEDITOR.replace('deskripsi');
});

// admin ketika close modl addSubProgram
$('.closeAddSubProgramModal').click(function () {
    $('#previewBannerSubProgram').attr('src', windowOrigin + 'assets/img/default-banner-infaq-online-4x4.jpg');
    $('.custom-file-label').removeClass('selected').html('Pilih file');
});

// tampilkan gambar banner edit sub program sehabis pilih file
$('#bannerSubProgramEdit').change(function (e) {
    let allowedTypes = ['image/gif', 'image/png', 'image/jpg', 'image/jpeg'];
    let allowedSize = ['8388608']; //8 MB limit

    let file = e.target.files[0];
    let fileType = file.type;
    let fileSize = file.size;

    // jika format file diluar kriteria
    if (!allowedTypes.includes(fileType)) {
        $('#bannerSubProgramEdit').next('.custom-file-label').removeClass('selected').html('Pilih file');
        document.getElementById('previewBannerSubProgramEdit').src = `${windowOrigin}assets/img/default-banner-infaq-online-4x4.jpg`;
        $('#errorNotifUploadEditSubProgram').html(`<div class="alert alert-danger alert-dismissible fade show mb-2" role="alert">Maaf ya, silakan pilih file yang valid (<strong>${allowedTypes.join(', ')}</strong>). File Anda : ${fileType}<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>`);
        return false;
    }
    // jika file lebih besar dari ketentuan size
    else if (fileSize > allowedSize) {
        $('#bannerSubProgramEdit').next('.custom-file-label').removeClass('selected').html('Pilih file');
        document.getElementById('previewBannerSubProgramEdit').src = `${windowOrigin}assets/img/default-banner-infaq-online-4x4.jpg`;
        $('#errorNotifUploadEditSubProgram').html(`<div class="alert alert-danger alert-dismissible fade show mb-2" role="alert"><strong>Ukuran file terlalu besar, maksimal ukuran yg disarankan <stong>${formatBytes(alloweSize)}</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>`);
        return false;
    }
    // tampilkan preview gambar jika syarat terpenuhi 
    else {
        let reader = new FileReader();
        reader.onload = function (e) {
            // get loaded data and render thumbnail.
            document.getElementById('previewBannerSubProgramEdit').src = e.target.result;
        };
        // read the image file as a data URL.
        reader.readAsDataURL(this.files[0]);
    }
});

// admin editSubProgram
$(document).on('click', '#editSubProgram', function () {
    $('#previewBannerSubProgramEdit').attr('src', windowOrigin + 'assets/img/program/' + $(this).data('banner'));
    $('#bannerSubProgramOld').val($(this).data('banner'));
    $('#id_programEdit option:contains("' + $(this).data('program') + '")').text($(this).data('program') + ' (terakhir dipilih)').attr('selected', true);
    $('#nama_detailprogramEdit').val($(this).data('nama'));
    $('#hiddenIdSubProgram').val($(this).data('idprogramdetail'));
    $('#deskripsiEdit').text($(this).data('deskripsi'));
    CKEDITOR.replace('deskripsiEdit');
});

// admin ketika close modl editSubProgram
$('.closeEditSubProgramModal').click(function () {
    let selectedSubProgram = $('#id_programEdit option:contains(" (terakhir dipilih)")');
    let textSubProgramSelected = $('#id_programEdit option:contains(" (terakhir dipilih)")').text().split(' (terakhir dipilih)')[0];
    selectedSubProgram.text(textSubProgramSelected).attr('selected', false);
    $('#previewBannerSubProgramEdit').attr('src', windowOrigin + 'assets/img/default-banner-infaq-online-4x4.jpg');
    $('.custom-file-label').removeClass('selected').html('Pilih file');
});

// admin deleteSubProgram
$(document).on('click', '#delSubProgram', function () {
    $('#cDelSubProgram').attr('href', $(this).data('href'));
});

// admin ketika close modl addMenuFe
$('.closeAddMenuFeModal').click(function () {
    $('#titleMenuFe').val('');
    $('#urlMenuFe').val('');
});

// admin ketika close modl addMenuFe
$('.closeAddSubmenuFeModal').click(function () {
    $('#titleSubmenuFeEdit').val('');
    $('#urlSubmenuFeEdit').val('');
});

// admin ketika close modl editMenuFe
$('.closeEditMenuFeModal').click(function () {
    let selectedMenuFe = $('#isActiveMenuFeEdit option:contains(" (terakhir dipilih)")');
    let textMenuFeSelected = $('#isActiveMenuFeEdit option:contains(" (terakhir dipilih)")').text().split(' (terakhir dipilih)')[0];
    selectedMenuFe.text(textMenuFeSelected).attr('selected', false);
});

// admin ketika close modl editSubmenuFe
$('.closeEditSubmenuFeModal').click(function () {
    let selectedSubmenuFe = $('#isActiveSubmenuFeEdit option:contains(" (terakhir dipilih)")');
    let textSubmenuFeSelected = $('#isActiveSubmenuFeEdit option:contains(" (terakhir dipilih)")').text().split(' (terakhir dipilih)')[0];
    selectedSubmenuFe.text(textSubmenuFeSelected).attr('selected', false);
});

// admin deleteNavbarFrontend
$(document).on('click', '#delFrontendNav', function () {
    $('#cDelFrontendNav').attr('href', $(this).data('href'));
});

// admin editMenuFe
$(document).on('click', '#editMenuFront', function () {
    $('#titleMenuFeEdit, #hiddenTitleMfOld').val($(this).data('title'));
    $('#urlMenuFeEdit').val($(this).data('url'));
    $('#isActiveMenuFeEdit option:contains("' + $(this).data('strisactive') + '")').text($(this).data('strisactive') + ' (terakhir dipilih)').attr('selected', true);
    $('#hiddenMfId').val($(this).data('idmf'));
});

// admin editSubmenuFe
$(document).on('click', '#editSubmenuFront', function () {
    $('#parent_idSubmenuFeEdit option:contains("' + $(this).data('parent') + '")').text($(this).data('parent') + ' (terakhir dipilih)').attr('selected', true);
    $('#titleSubmenuFeEdit, #hiddenTitleMfdOld').val($(this).data('title'));
    $('#urlSubmenuFeEdit').val($(this).data('url'));
    $('#isActiveSubmenuFeEdit option:contains("' + $(this).data('strisactive') + '")').text($(this).data('strisactive') + ' (terakhir dipilih)').attr('selected', true);
    $('#hiddenMfdId').val($(this).data('idmfd'));
});

// close add trs masuk
$('.closeAddTrsMasukModal').click(function () {
    $('#user_nama').val('');
    $('#user_email').val('');
    $('#user_telp').val('');
    $('#nominal').val('');
});

// close edit trs masuk
$('.closeEditTrsMasukModal').click(function () {
    $('#user_namaEdit').val('');
    $('#user_emailEdit').val('');
    $('#user_telpEdit').val('');
    $('#nominalEdit').val('');
    let selectedStatus = $('#statusEdit option:contains(" (terakhir dipilih)")');
    let textStatusSelected = $('#statusEdit option:contains(" (terakhir dipilih)")').text().split(' (terakhir dipilih)')[0];
    selectedStatus.text(textStatusSelected).attr('selected', false);
    let selectedProgram = $('#programEdit option:contains(" (terakhir dipilih)")');
    let textProgramSelected = $('#programEdit option:contains(" (terakhir dipilih)")').text().split(' (terakhir dipilih)')[0];
    selectedProgram.text(textProgramSelected).attr('selected', false);
});

// ketika tombol edit trs masuk diklik
$(document).on('click', '#editTrsMasuk', function () {
    $('#user_namaEdit').val($(this).data('nama'));
    $('#user_emailEdit').val($(this).data('email'));
    $('#user_telpEdit').val($(this).data('telp'));
    $('#nominalEdit').val(convertToRupiahInt($(this).data('nominal')));
    $('#statusEdit option:contains("' + $(this).data('status') + '")').text($(this).data('status') + ' (terakhir dipilih)').attr('selected', true);
    $('#programEdit option:contains("' + $(this).data('program') + '")').text($(this).data('program') + ' (terakhir dipilih)').attr('selected', true);
    $('#idTrsMasuk').val($(this).data('idtrsmasuk'));
});

// admin deleteTrsMAsuk
$(document).on('click', '#delTrsMasuk', function () {
    $('#cDelTrsMasuk').attr('href', $(this).data('href'));
});

// close add trs keluar
$('.closeAddTrsKeluarModal').click(function () {
    $('#penerima_nama').val('');
    $('#penerima_telp').val('');
    $('#penerima_alamat_instansi').val('');
    $('#tgl').val('');
    $('#nominal').val('');
    $('#keterangan').val('');
});

// close edit trs keluar
$('.closeEditTrsKeluarModal').click(function () {
    let selectedProgram = $('#programEdit option:contains(" (terakhir dipilih)")');
    let textProgramSelected = $('#programEdit option:contains(" (terakhir dipilih)")').text().split(' (terakhir dipilih)')[0];
    selectedProgram.text(textProgramSelected).attr('selected', false);
    $('#penerima_namaEdit').val('');
    $('#penerima_telpEdit').val('');
    $('#penerima_alamat_instansiEdit').val('');
    $('#tglEdit').val('');
    $('#nominalEdit').val('');
    $('#keteranganEdit').val('');
});

// ketika tombol edit trs keluar diklik
$(document).on('click', '#editTrsKeluar', function () {
    $('#programEdit option:contains("' + $(this).data('program') + '")').text($(this).data('program') + ' (terakhir dipilih)').attr('selected', true);
    $('#penerima_namaEdit').val($(this).data('penerima'));
    $('#penerima_telpEdit').val($(this).data('telp'));
    $('#penerima_alamat_instansiEdit').val($(this).data('alamat'));
    $('#tglEdit').val($(this).data('tgl'));
    $('#nominalEdit').val(convertToRupiahInt($(this).data('nominal')));
    $('#keteranganEdit').val($(this).data('keterangan'));
    $('#idTrsKeluar').val($(this).data('idtrskeluar'));
});

// ketika modal edit trs keluar muncul
$('#editTrsKeluarModal').on('show.bs.modal', function () {
    const programSelected = $('#editTrsKeluar').data('program');
    const maksimalDana = $('#programEdit option:contains("' + programSelected + '")').data('maks');
    $('#maksNominalTrsKeluarEdit').html(`<strong>${convertToRupiahInt(maksimalDana)}</strong>`);
})

// admin deleteTrsKeluar
$(document).on('click', '#delTrsKeluar', function () {
    $('#cDelTrsKeluar').attr('href', $(this).data('href'));
});

// ketika program trs keluar dipilih
$('#program option, #programEdit option').click(function () {
    $('#maksNominalTrsKeluar, #maksNominalTrsKeluarEdit').html(`<strong>${convertToRupiahInt($(this).data('maks'))}</strong>`);
});

// ketika nominal add trs keluar keyup
$('#nominal').keyup(function () {
    const maksimalDana = convertToAngka($('#maksNominalTrsKeluar').text());
    if (convertToAngka($(this).val()) > maksimalDana) $(this).val(convertToRupiahInt(maksimalDana));
});

// ketika nominal edit trs keluar keyup
$('#nominalEdit').keyup(function () {
    const maksimalDana = convertToAngka($('#maksNominalTrsKeluarEdit').text());
    if (convertToAngka($(this).val()) > maksimalDana) $(this).val(convertToRupiahInt(maksimalDana));
});
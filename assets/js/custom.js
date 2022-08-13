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

$('.closeEditUserModal').click(function () {
    var selectedRole = $('#inputEditRoleUser option:contains(" (terakhir dipilih)")');
    var textRoleSelected = $('#inputEditRoleUser option:contains(" (terakhir dipilih)")').text().split(' (terakhir dipilih)')[0];
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
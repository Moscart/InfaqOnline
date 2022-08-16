<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Infaq Online</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/css/style.css">
    <link rel="shortcut icon" href="<?= base_url(); ?>assets/img/favicon/<?= $identitas['favicon']; ?>" type="image/x-icon">
    <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="<?= CLIENT_KEY; ?>"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
</head>

<body>
    <nav class="navbar navbar-dark navbar-expand-lg bg-dark py-3">
        <div class="container">
            <a class="navbar-brand" href="<?= base_url(); ?>">LOGO</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link <?= $nav == "home" ? "active" : ""; ?>" aria-current="page" href="<?= base_url(); ?>">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= $nav == "artikel" ? "active" : ""; ?>" href="<?= base_url(); ?>artikel">Artikel</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-warning nav-link text-dark fw-bold fs-7 px-4 text-uppercase ms-lg-4 w-max" href="<?= $this->session->userdata('email') ? base_url() . 'user' : base_url() . 'auth'; ?>"><?= $this->session->userdata('email') ? "Dashboard" : "Login"; ?></a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
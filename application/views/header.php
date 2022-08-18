<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Infak Online</title>
    <link rel="shortcut icon" href="<?= base_url(); ?>assets/img/favicon/<?= $identitas['favicon']; ?>" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0-12/css/all.min.css" integrity="sha512-pn4RwKFKdSvaTRSYO5WIUGz89e1tJvWWUGRIBym1/k467SuMMjKKw/X5TXJYp2+WLmHumHivCJ2JAJppXF9SoA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="<?= base_url(); ?>assets/css/style.css">
    <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="<?= CLIENT_KEY; ?>"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>

<body data-baseurl="<?= base_url(); ?>">
    <nav class="navbar navbar-dark navbar-expand-lg bg-dark py-3">
        <div class="container">
            <a class="navbar-brand" href="<?= base_url(); ?>"><?= $identitas['nama_instansi']; ?></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav ms-auto">
                    <?php if (count($frontendNav) > 0) :
                        foreach ($frontendNav['menu'] as $m) :
                            if (count($m['submenu']) > 0) : ?>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle <?= strtolower($nav) == strtolower($m['title_menu']) ? 'active' : ''; ?>" href=" <?= $m['url_menu']; ?>" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <?= $m['title_menu']; ?>
                                    </a>
                                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                        <?php foreach ($m['submenu'] as $sm) : ?>
                                            <li><a class="dropdown-item" href="<?= $sm['url_submenu']; ?>"><?= $sm['title_submenu']; ?></a></li>
                                        <?php endforeach; ?>
                                    </ul>
                                </li>
                            <?php else : ?>
                                <li class="nav-item">
                                    <a class="nav-link <?= strtolower($nav) == strtolower($m['title_menu']) ? 'active' : ''; ?>" href="<?= $m['url_menu']; ?>"><?= $m['title_menu']; ?></a>
                                </li>
                    <?php endif;
                        endforeach;
                    endif; ?>
                    <li class="nav-item">
                        <a class="btn btn-warning nav-link text-dark fw-bold fs-7 px-4 text-uppercase ms-lg-4 w-max" href="<?= $this->session->userdata('email') ? base_url() . 'user' : base_url() . 'auth'; ?>"><?= $this->session->userdata('email') ? "Dashboard" : "Login"; ?></a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
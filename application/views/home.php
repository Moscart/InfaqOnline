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
            <a class="navbar-brand" href="#">LOGO</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Artikel</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-warning nav-link text-dark fw-bold fs-7 px-4 text-uppercase ms-lg-4 w-max" href="<?= base_url(); ?>auth">Login</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <main>
        <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active banner-container">
                    <img src="https://www.seekpng.com/png/detail/423-4235598_no-image-for-noimage-icon.png" class="d-block w-100 banner-content" alt="...">
                </div>
                <div class="carousel-item banner-container">
                    <img src="https://www.seekpng.com/png/detail/423-4235598_no-image-for-noimage-icon.png" class="d-block w-100 banner-content" alt="...">
                </div>
                <div class="carousel-item banner-container">
                    <img src="https://t3.ftcdn.net/jpg/04/62/93/66/360_F_462936689_BpEEcxfgMuYPfTaIAOC1tCDurmsno7Sp.jpg" class="d-block w-100 banner-content" alt="...">
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
        <div class="container py-5">
            <div class="row">
                <div class="col-md-6 col-12">
                    <div class="card shadow bg-dark border-0 position-relative">
                        <div class="w-max pe-4 mt-4 p-3 rounded-start rounded-pill bg-warning fs-7 fw-bold text-uppercase">
                            Total Infaq
                        </div>
                        <div class="position-absolute text-white end-0 top-0">
                            <div class="row gx-2 me-3">
                                <div class="col">
                                    <div class="bg-warning rounded-pill rounded-top p-1" style="height: 50px;"></div>
                                </div>
                                <div class="col">
                                    <div class="bg-warning rounded-pill rounded-top p-1" style="height: 50px;"></div>
                                </div>
                                <div class="col">
                                    <div class="bg-warning rounded-pill rounded-top p-1" style="height: 50px;"></div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body fw-bold text-muted">
                            Rp<span class="fs-1 text-white">1.000.000</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-12">
                    <h3 class="fw-bold">Infaq Terbaru</h3>
                    <div class="bg-dark my-2 text-white rounded-pill p-3 row">
                        <div class="col-6">20 Agustus 2022 22:23</div>
                        <div class="col-6 text-end ">Rp100.000</div>
                    </div>
                    <div class="bg-dark my-2 text-white rounded-pill p-3 row">
                        <div class="col-6">20 Agustus 2022 22:23</div>
                        <div class="col-6 text-end ">Rp100.000</div>
                    </div>
                    <div class="bg-dark my-2 text-white rounded-pill p-3 row">
                        <div class="col-6">20 Agustus 2022 22:23</div>
                        <div class="col-6 text-end ">Rp100.000</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="bg-dark py-5">
            <div class="container">
                <div class="fs-4 fw-bold text-center mb-4 text-white">ARTIKEL</div>
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
                <a type="button" class="btn btn-warning rounded-pill fs-7 fw-bold text-uppercase py-3 px-5 mt-5 mx-auto d-block w-max" href="<?= base_url(); ?>artikel">Lihat lainnya</a>
            </div>
        </div>
        <div class="container py-5">
            <div class="row gy-5">
                <div class="col-lg-8 col-12">
                    <img src="https://img.freepik.com/premium-vector/love-charity-giving-donation-via-volunteer-team-worked-together-help-collect-donations-poster-banner-flat-design-illustration_2175-2450.jpg?w=2000" class="w-100 rounded-5 shadow" alt="">
                </div>
                <div class="col-lg-4 col-12">
                    <div class="fs-4 fw-bold text-center mb-3">INFAQ</div>
                    <form id="payment-form" method="post" action="<?= site_url() ?>/snap/finish">
                        <div class="input-group mb-3">

                            <span class="input-group-text">Rp</span>
                            <div class="form-floating">
                                <input type="number" class="form-control" min="10000" id="nominal" placeholder="Masukkan Nominal" onkeyup="checkNominal(event)">
                                <label for="nominal">Nominal</label>
                            </div>

                        </div>
                    </form>
                    <div class="row mb-3 g-2">
                        <div class="col-xl-4 col-lg-6 col-md-4 col-6">
                            <input type="radio" class="btn-check" name="list-nominal" id="list-nominal1" value="10000" autocomplete="off" onclick="checkRadio(event)">
                            <label class="btn btn-outline-primary w-100" for="list-nominal1">Rp10.000</label>
                        </div>
                        <div class="col-xl-4 col-lg-6 col-md-4 col-6">
                            <input type="radio" class="btn-check" name="list-nominal" id="list-nominal2" value="15000" autocomplete="off" onclick="checkRadio(event)">
                            <label class="btn btn-outline-primary w-100" for="list-nominal2">Rp15.000</label>
                        </div>
                        <div class="col-xl-4 col-lg-6 col-md-4 col-6">
                            <input type="radio" class="btn-check" name="list-nominal" id="list-nominal3" value="20000" autocomplete="off" onclick="checkRadio(event)">
                            <label class="btn btn-outline-primary w-100" for="list-nominal3">Rp20.000</label>
                        </div>
                        <div class="col-xl-4 col-lg-6 col-md-4 col-6">
                            <input type="radio" class="btn-check" name="list-nominal" id="list-nominal4" value="25000" autocomplete="off" onclick="checkRadio(event)">
                            <label class="btn btn-outline-primary w-100" for="list-nominal4">Rp25.000</label>
                        </div>
                        <div class="col-xl-4 col-lg-6 col-md-4 col-6">
                            <input type="radio" class="btn-check" name="list-nominal" id="list-nominal5" value="50000" autocomplete="off" onclick="checkRadio(event)">
                            <label class="btn btn-outline-primary w-100" for="list-nominal5">Rp50.000</label>
                        </div>
                        <div class="col-xl-4 col-lg-6 col-md-4 col-6">
                            <input type="radio" class="btn-check" name="list-nominal" id="list-nominal6" value="100000" autocomplete="off" onclick="checkRadio(event)">
                            <label class="btn btn-outline-primary w-100" for="list-nominal6">Rp100.000</label>
                        </div>
                    </div>
                    <button type="button" id="pay-button" class="btn btn-warning rounded-pill fs-7 fw-bold w-100 text-uppercase py-3">Lanjutkan Pembayaran</button>
                </div>
            </div>
        </div>
    </main>
    <footer class="navbar navbar-dark bg-dark py-3">
        <div class="container justify-content-center">
            <span class="navbar-text">© <script>
                    document.write(new Date().getFullYear())
                </script> Infaq Online. All Rights Reserved</span>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
    <script type="text/javascript">
        $('#pay-button').click(function(event) {
            let nominal = Number($('#nominal').val());
            $.ajax({
                url: '<?= site_url() ?>/snap/token/' + nominal,
                cache: false,
                success: function(data) {
                    //location = data;
                    console.log('token = ' + data);
                    snap.pay(data, {
                        onSuccess: function(result) {
                            console.log(result);
                            // console.log(result.status_message);
                            // console.log(result);
                            // $("#payment-form").submit();
                        }
                    });
                }
            });
        });

        function checkRadio(event) {
            const nominal = document.getElementById('nominal');
            const listNominal = event.path[0];
            if (nominal.value === listNominal.value) {
                event.path[0].checked = false;
                nominal.value = "";
            } else {
                nominal.value = listNominal.value
            }
        }

        function checkNominal(event) {
            const nominal = event.path[0];
            const radio = [...document.querySelectorAll("[name='list-nominal']")];
            if (parseInt(nominal.value) < 0 && nominal.value !== "") {
                nominal.value = "10000";
            }
            radio.map((e) => {
                if (e.value === nominal.value) {
                    e.checked = true;
                } else {
                    e.checked = false;
                }
            })
        }
    </script>
</body>

</html>
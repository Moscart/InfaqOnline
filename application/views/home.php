<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Infaq Online</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/css/style.css">
</head>

<body>
    <nav class="navbar navbar-dark navbar-expand-lg bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">Navbar</a>
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
                        <a class="nav-link" href="#">Pricing</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Dropdown link
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Action</a></li>
                            <li><a class="dropdown-item" href="#">Another action</a></li>
                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                        </ul>
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
        <div class="bg-light py-5">
            <div class="container">
                <div class="fs-4 fw-bold text-center mb-4">ARTIKEL</div>
                <div class="row gy-4">
                    <div class="col-lg-4 col-12">
                        <div class="card h-100 rounded-4 shadow overflow-hidden">
                            <div class="img-container">
                                <img src="https://t3.ftcdn.net/jpg/04/62/93/66/360_F_462936689_BpEEcxfgMuYPfTaIAOC1tCDurmsno7Sp.jpg" class="img-content" alt="...">
                            </div>
                            <div class="card-body d-flex flex-column p-4">
                                <h5 class="card-title">Card title</h5>
                                <p class="card-text text-muted">Lorem ipsum dolor sit amet consectetur adipisicing elit. Blanditiis suscipit voluptates quibusdam vero eveniet. Sint similique eveniet beatae maiores vitae.</p>
                                <a href="#" class="btn btn-outline-primary d-block rounded-pill mx-5 mt-auto">Selengkapnya</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-12">
                        <div class="card h-100 rounded-4 shadow overflow-hidden">
                            <div class="img-container">
                                <img src="https://t3.ftcdn.net/jpg/04/62/93/66/360_F_462936689_BpEEcxfgMuYPfTaIAOC1tCDurmsno7Sp.jpg" class="img-content" alt="...">
                            </div>
                            <div class="card-body d-flex flex-column p-4">
                                <h5 class="card-title">Card title</h5>
                                <p class="card-text text-muted">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                <a href="#" class="btn btn-outline-primary d-block rounded-pill mx-5 mt-auto">Selengkapnya</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-12">
                        <div class="card h-100 rounded-4 shadow overflow-hidden">
                            <div class="img-container">
                                <img src="https://t3.ftcdn.net/jpg/04/62/93/66/360_F_462936689_BpEEcxfgMuYPfTaIAOC1tCDurmsno7Sp.jpg" class="img-content" alt="...">
                            </div>
                            <div class="card-body d-flex flex-column p-4">
                                <h5 class="card-title">Card title</h5>
                                <p class="card-text text-muted">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                <a href="#" class="btn btn-outline-primary d-block rounded-pill mx-5 mt-auto">Selengkapnya</a>
                            </div>
                        </div>
                    </div>
                </div>
                <button type="button" class="btn btn-warning rounded-pill fs-7 fw-bold text-uppercase py-3 px-5 mt-5 mx-auto d-block">Lihat lainnya</button>
            </div>
        </div>
        <div class="container py-5">
            <div class="row gy-5">
                <div class="col-lg-8 col-12">
                    <img src="https://img.freepik.com/premium-vector/love-charity-giving-donation-via-volunteer-team-worked-together-help-collect-donations-poster-banner-flat-design-illustration_2175-2450.jpg?w=2000" class="w-100 rounded-5 shadow" alt="">
                </div>
                <div class="col-lg-4 col-12">
                    <div class="fs-4 fw-bold text-center mb-3">INFAQ</div>
                    Masukkan Nominal Infaq
                    <div class="input-group mb-3">
                        <span class="input-group-text">Rp</span>
                        <div class="form-floating">
                            <input type="number" class="form-control" min="10000" id="nominal" placeholder="Masukkan Nominal" onkeyup="checkNominal(event)">
                            <label for="nominal">Nominal</label>
                        </div>
                    </div>
                    <div class="row mb-3 g-2">
                        <div class="col-xl-4 col-6">
                            <input type="radio" class="btn-check" name="list-nominal" id="list-nominal1" value="10000" autocomplete="off" onclick="checkRadio(event)">
                            <label class="btn btn-outline-primary w-100" for="list-nominal1">Rp10.000</label>
                        </div>
                        <div class="col-xl-4 col-6">
                            <input type="radio" class="btn-check" name="list-nominal" id="list-nominal2" value="15000" autocomplete="off" onclick="checkRadio(event)">
                            <label class="btn btn-outline-primary w-100" for="list-nominal2">Rp15.000</label>
                        </div>
                        <div class="col-xl-4 col-6">
                            <input type="radio" class="btn-check" name="list-nominal" id="list-nominal3" value="20000" autocomplete="off" onclick="checkRadio(event)">
                            <label class="btn btn-outline-primary w-100" for="list-nominal3">Rp20.000</label>
                        </div>
                        <div class="col-xl-4 col-6">
                            <input type="radio" class="btn-check" name="list-nominal" id="list-nominal4" value="25000" autocomplete="off" onclick="checkRadio(event)">
                            <label class="btn btn-outline-primary w-100" for="list-nominal4">Rp25.000</label>
                        </div>
                        <div class="col-xl-4 col-6">
                            <input type="radio" class="btn-check" name="list-nominal" id="list-nominal5" value="50000" autocomplete="off" onclick="checkRadio(event)">
                            <label class="btn btn-outline-primary w-100" for="list-nominal5">Rp50.000</label>
                        </div>
                        <div class="col-xl-4 col-6">
                            <input type="radio" class="btn-check" name="list-nominal" id="list-nominal6" value="100000" autocomplete="off" onclick="checkRadio(event)">
                            <label class="btn btn-outline-primary w-100" for="list-nominal6">Rp100.000</label>
                        </div>
                    </div>
                    <button type="button" class="btn btn-warning rounded-pill fs-7 fw-bold w-100 text-uppercase py-3">Lanjutkan Pembayaran</button>
                </div>
            </div>
        </div>
    </main>
    <footer class="navbar navbar-dark bg-dark">
        <div class="container justify-content-center">
            <span class="navbar-text">© 2022 Infaq Online. All Rights Reserved</span>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
    <script>
        function checkRadio(event) {
            const nominal = document.getElementById('nominal');
            const listNominal = event.path[0];
            console.log(typeof nominal.value);
            console.log(event.path[0].value);
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
            if (nominal.value < "10000" && nominal.value !== "") {
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
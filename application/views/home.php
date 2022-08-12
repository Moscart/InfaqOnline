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
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Features</a>
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
        <div class="bg-light py-4">
            <div class="container">
                <div class="fs-4 fw-bold text-center mb-4">Artikel</div>
                <div class="row">
                    <div class="col-4">
                        <div class="card h-100 shadow">
                            <div class="img-container">
                                <img src="https://t3.ftcdn.net/jpg/04/62/93/66/360_F_462936689_BpEEcxfgMuYPfTaIAOC1tCDurmsno7Sp.jpg" class="card-img-top" alt="...">
                            </div>
                            <div class="card-body d-flex flex-column p-4">
                                <h5 class="card-title">Card title</h5>
                                <p class="card-text text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Fugiat tempore qui recusandae consequuntur id a ipsum voluptatem fugit quaerat soluta, aperiam ab quam porro iure ipsam doloribus, ratione libero enim?Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                <a href="#" class="btn btn-outline-primary d-block rounded-pill mx-5 mt-auto">Go somewhere</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="card h-100 shadow">
                            <div class="img-container">
                                <img src="https://t3.ftcdn.net/jpg/04/62/93/66/360_F_462936689_BpEEcxfgMuYPfTaIAOC1tCDurmsno7Sp.jpg" class="card-img-top" alt="...">
                            </div>
                            <div class="card-body d-flex flex-column p-4">
                                <h5 class="card-title">Card title</h5>
                                <p class="card-text text-muted">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                <a href="#" class="btn btn-outline-primary d-block rounded-pill mx-5 mt-auto">Go somewhere</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="card h-100 shadow">
                            <div class="img-container">
                                <img src="https://t3.ftcdn.net/jpg/04/62/93/66/360_F_462936689_BpEEcxfgMuYPfTaIAOC1tCDurmsno7Sp.jpg" class="card-img-top" alt="...">
                            </div>
                            <div class="card-body d-flex flex-column p-4">
                                <h5 class="card-title">Card title</h5>
                                <p class="card-text text-muted">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                <a href="#" class="btn btn-outline-primary d-block rounded-pill mx-5 mt-auto">Go somewhere</a>
                            </div>
                        </div>
                    </div>
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
</body>

</html>
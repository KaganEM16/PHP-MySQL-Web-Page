<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kağan TV</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        html {
            font-size: 16px;
        }

        @media (max-width: 600px) {
            html {
                font-size: 14px; /* Responsive tasarım için tanımlandı */
            }
        }
        .box {
            height: 25rem;
            width: 15rem;
        }
        .update-form input {
            margin-bottom: 5px;
        }
        #toast-container {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 1060;
        }
    </style>
</head>
<body class="d-flex flex-column min-vh-100">

    <!-- Header Kısmı ve Butonlar -->
    <nav class="navbar navbar-expand-lg py-4 navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="user.php"><img src="./assets/images/Kağan TV.png" alt="Kağan TV" width="240px"></a>
            <div class="d-flex text-white fs-4 gap-3">
                <?php echo htmlspecialchars($_SESSION['user']['username']); ?>
                <a href="logout.php" class="btn btn-light">Çıkış Yap</a>
            </div>
        </div>
    </nav>

    <!-- Ana Gövde -->
    <div class="container my-5 d-flex flex-column gap-5 flex-grow-1">
        <div class="rox d-flex justify-content-between">
            <div class="box border border-2 border-dark px-3 py-3 d-flex align-items-center flex-column gap-4">
                <h2>A Filmi</h2>
                <img src="./assets/images/A.png" alt="A Filmi Poster">
                <p>Fiyat: 250 TL</p>
                <button class="btn btn-warning add-to-cart" data-name="A Filmi" data-price="250">Sepete Ekle</button>
            </div>
            <div class="box border border-2 border-dark px-3 py-3 d-flex align-items-center flex-column gap-4">
                <h2>B Filmi</h2>
                <img src="./assets/images/B.png" alt="B Filmi Poster">
                <p>Fiyat: 350 TL</p>
                <button class="btn btn-warning add-to-cart" data-name="B Filmi" data-price="350">Sepete Ekle</button>
            </div>
            <div class="box border border-2 border-dark px-3 py-3 d-flex align-items-center flex-column gap-4">
                <h2>C Filmi</h2>
                <img src="./assets/images/C.png" alt="C Filmi Poster">
                <p>Fiyat: 300 TL</p>
                <button class="btn btn-warning add-to-cart" data-name="C Filmi" data-price="300">Sepete Ekle</button>
            </div>
            <div class="box border border-2 border-dark px-3 py-3 d-flex align-items-center flex-column gap-4">
                <h2>D Filmi</h2>
                <img src="./assets/images/D.png" alt="D Filmi Poster">
                <p>Fiyat: 150 TL</p>
                <button class="btn btn-warning add-to-cart" data-name="D Filmi" data-price="150">Sepete Ekle</button>
            </div>
        </div>
        
        <div class="rox d-flex justify-content-between">
            <div class="box border border-2 border-dark px-3 py-3 d-flex align-items-center flex-column gap-4">
                <h2>E Filmi</h2>
                <img src="./assets/images/E.png" alt="E Filmi Poster">
                <p>Fiyat: 550 TL</p>
                <button class="btn btn-warning add-to-cart" data-name="E Filmi" data-price="550">Sepete Ekle</button>
            </div>
            <div class="box border border-2 border-dark px-3 py-3 d-flex align-items-center flex-column gap-4">
                <h2>F Filmi</h2>
                <img src="./assets/images/F.png" alt="F Filmi Poster">
                <p>Fiyat: 100 TL</p>
                <button class="btn btn-warning add-to-cart" data-name="F Filmi" data-price="100">Sepete Ekle</button>
            </div>
            <div class="box border border-2 border-dark px-3 py-3 d-flex align-items-center flex-column gap-4">
                <h2>G Filmi</h2>
                <img src="./assets/images/G.png" alt="G Filmi Poster">
                <p>Fiyat: 50 TL</p>
                <button class="btn btn-warning add-to-cart" data-name="G Filmi" data-price="50">Sepete Ekle</button>
            </div>
            <div class="box border border-2 border-dark px-3 py-3 d-flex align-items-center flex-column gap-4">
                <h2>H Filmi</h2>
                <img src="./assets/images/H.png" alt="H Filmi Poster">
                <p>Fiyat: 200 TL</p>
                <button class="btn btn-warning add-to-cart" data-name="H Filmi" data-price="200">Sepete Ekle</button>
            </div>
        </div>

        <button class="btn btn-warning" id="view-cart">Sepeti Görüntüle</button>        
    </div>

    <!-- Footer -->
    <footer class="bg-dark text-white d-flex justify-content-around py-2 mt-auto ">
        <a href="https://github.com/KaganEM16" class="text-white"><i class="bi bi-github fs-1"></i></a>
        <a href="https://www.youtube.com/@7KaganEM" class="text-white"><i class="bi bi-youtube fs-1"></i></a>
        <a href="#" class="text-white"><i class="bi bi-linkedin fs-1"></i></a>
    </footer>
    <!-- Sepet Modalı -->
    <div class="modal fade" id="cartModal" tabindex="-1" aria-labelledby="cartModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="cartModalLabel">Sepetiniz</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="cart-container">
                    <!-- Sepet içeriği buraya gelecek -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kapat</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Toast Container (Bootstrap Toast için) -->
    <div id="toast-container" aria-live="polite" aria-atomic="true">
        <div class="toast align-items-center text-white bg-primary border-0" id="liveToast" role="alert" aria-live="assertive" aria-atomic="true" data-bs-delay="5000">
            <div class="d-flex">
                <div class="toast-body"></div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="./script1.js?v=<?php echo time(); ?>"></script>
    <script src="./script2.js"></script>
</body>
</html>
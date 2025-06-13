<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kağan TV</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body class="d-flex flex-column min-vh-100">

    <!-- Header Kısmı ve Butonlar -->
    <nav class="navbar navbar-expand-lg py-4 navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php"><img src="./assets/images/Kağan TV.png" alt="Kağan TV"  width="240px"></a>
        </div>
    </nav>

    <!-- Ana Gövde -->
    <div class="container my-5 d-flex flex-column justify-content-center align-items-center">
        <form action="register_process.php" method="POST">
            <div class="mb-3">
                <label for="username" class="form-label">Kullanıcı Adı</label>
                <input type="text" class="form-control" id="username" name="username" placeholder="Kullanıcı Adınızı Giriniz" required>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">E-posta</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="E-Posta Adresinizi Giriniz" required>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Şifre</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Şifrenizi Giriniz" required>
            </div>

            <button type="submit" class="btn btn-primary">Kayıt Ol</button>
        </form>

    </div>

    <!-- Footer -->
    <footer class="bg-dark text-white d-flex justify-content-around py-2 mt-auto ">
        <a href="https://github.com/KaganEM16" class="text-white"><i class="bi bi-github fs-1"></i></a>
        <a href="https://www.youtube.com/@7KaganEM" class="text-white"><i class="bi bi-youtube fs-1"></i></a>
        <a href="#" class="text-white"><i class="bi bi-linkedin fs-1"></i></a>
    </footer>

</body>
</html>
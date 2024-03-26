<!DOCTYPE html>
<html data-bs-theme="light" lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Admin Inventaris</title>
    <link rel="stylesheet" href="<?= base_url('assets/bootstrap/css/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lora">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Noto+Sans:300,400,500,600,700&amp;display=swap">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/css/styles.css') ?>">
</head>

<body>
    <div class="bg-primary py-2">
        <h3 class="fw-semibold text-center">Selamat Datang di Website Saranan Prasarana</h3>
        <h3 class="fw-semibold text-center">SMP Negeri 1 Subang</h3>
    </div>
    <div class="container d-flex flex-column justify-content-center align-items-center align-content-center p-5">
        <div class="bg-body-secondary border rounded p-5 col-4">
            <h4 class="fw-semibold text-center">Lupa Sandi</h4>
            <form action="<?= base_url('auth/forgot-password') ?>" method="post">
                <div class="form-group"><label class="form-label">Username</label><input class="form-control" type="text" name="username"></div>
                <div class="form-group"><label class="form-label">No. Handphone</label><input class="form-control" type="tel" name="no_hp" placeholder="+628xxx"></div>
                <div class="d-grid"><button class="btn btn-primary" type="submit">Kirim</button></div>
            </form>
            <div class="text-center mt-3">
                <a href="<?= base_url('auth/login') ?>">Masuk</a>
            </div>
        </div>
        <p class="text-center">2024 &copy; Kelompok 2 Workshop Pemrograman</p>
    </div>
    <script src="<?= base_url('assets/js/jquery.min.js') ?>"></script>
    <script src="<?= base_url('assets/bootstrap/js/bootstrap.min.js') ?>"></script>
</body>

</html>
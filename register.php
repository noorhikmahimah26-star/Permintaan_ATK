<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Register User ATK</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
</head>

<body>

<div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="card shadow login-card">
        <div class="card-body p-4">

            <h4 class="text-center mb-4 fw-bold">GADGETMART</h4>
            <p class="text-center text-muted mb-3">Registrasi User</p>

            <form action="proses_register.php" method="POST">

                <div class="mb-3">
                    <label class="form-label">Nama Lengkap</label>
                    <input
                        type="text"
                        name="nama"
                        class="form-control"
                        placeholder="Masukkan nama lengkap"
                        required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Username</label>
                    <input
                        type="text"
                        name="username"
                        class="form-control"
                        placeholder="Masukkan username"
                        required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input
                        type="password"
                        name="password"
                        class="form-control"
                        placeholder="Masukkan password"
                        required>
                </div>

                <button type="submit" class="btn btn-danger w-100 mt-2">
                    Daftar
                </button>

            </form>

            <p class="text-center mt-3 register-text">
                Sudah punya akun?
                <a href="login.php">Login di sini</a>
            </p>

        </div>
    </div>
</div>

</body>
</html>
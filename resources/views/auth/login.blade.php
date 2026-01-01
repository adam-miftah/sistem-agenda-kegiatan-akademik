<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon"
    href="data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 512 512%22><path fill=%22%23435ebe%22 d=%22M464 32H48C21.5 32 0 53.5 0 80v320c0 26.5 21.5 48 48 48h416c26.5 0 48-21.5 48-48V80c0-26.5-21.5-48-48-48zm-83.6 290.5c4.8 4.8 4.8 12.6 0 17.4l-40.5 40.5c-4.8 4.8-12.6 4.8-17.4 0L209 267.1l-53.5 53.5c-4.8 4.8-12.6 4.8-17.4 0l-40.5-40.5c-4.8-4.8-4.8-12.6 0-17.4l111.4-111.4c4.8-4.8 12.6-4.8 17.4 0l153.4 153.4z%22/></svg>">
  <title>Login - Sistem Informasi Agenda</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

  <style>
    :root {
      --primary-color: #435ebe;
      --secondary-color: #6c757d;
    }

    body {
      font-family: 'Poppins', sans-serif;
      background-color: #fff;
      height: 100vh;
      overflow: hidden;
    }

    .login-container {
      height: 100vh;
      display: flex;
      width: 100%;
    }

    .login-sidebar {
      background: linear-gradient(135deg, #435ebe 0%, #25396f 100%);
      width: 55%;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      color: white;
      padding: 3rem;
      position: relative;
      overflow: hidden;
    }

    .circle-decoration {
      position: absolute;
      border-radius: 50%;
      background: rgba(255, 255, 255, 0.1);
    }

    .circle-1 {
      width: 300px;
      height: 300px;
      top: -50px;
      left: -50px;
    }

    .circle-2 {
      width: 400px;
      height: 400px;
      bottom: -100px;
      right: -100px;
    }

    .brand-content {
      z-index: 2;
      text-align: center;
    }

    .login-form-section {
      width: 45%;
      display: flex;
      flex-direction: column;
      justify-content: center;
      padding: 4rem;
      background: #fff;
    }

    .form-control {
      padding: 0.8rem 1rem;
      border-radius: 8px;
      border: 1px solid #e0e0e0;
      background-color: #f8f9fa;
      font-size: 0.95rem;
      transition: all 0.3s;
    }

    .form-control:focus {
      background-color: #fff;
      border-color: var(--primary-color);
      box-shadow: 0 0 0 4px rgba(67, 94, 190, 0.1);
    }

    .btn-primary {
      background-color: var(--primary-color);
      border: none;
      padding: 0.8rem;
      border-radius: 8px;
      font-weight: 600;
      letter-spacing: 0.5px;
      box-shadow: 0 4px 12px rgba(67, 94, 190, 0.3);
      transition: transform 0.2s;
    }

    .btn-primary:hover {
      background-color: #364b98;
      transform: translateY(-2px);
    }

    @media (max-width: 992px) {
      .login-sidebar {
        display: none;
      }

      .login-form-section {
        width: 100%;
        padding: 2rem;
      }
    }
  </style>
</head>

<body>

  <div class="login-container">

    <div class="login-sidebar">
      <div class="circle-decoration circle-1"></div>
      <div class="circle-decoration circle-2"></div>

      <div class="brand-content">
        <div class="mb-4 bg-white bg-opacity-25 p-3 rounded-circle d-inline-flex">
          <i class="fas fa-university fa-4x text-white"></i>
        </div>
        <h1 class="fw-bold mb-3 display-5">Agenda Akademik</h1>
        <p class="lead opacity-75">Sistem Informasi Manajemen Kegiatan Kampus yang Terintegrasi, Modern, dan Efisien.
        </p>
      </div>

      <div class="mt-5 text-center opacity-50 small">
        &copy; {{ date('Y') }} Universitas Pamulang. All Rights Reserved.
      </div>
    </div>

    <div class="login-form-section">
      <div class="w-100 mx-auto" style="max-width: 400px;">

        <div class="mb-5 text-center">
          <h2 class="fw-bold text-dark mb-1">Selamat Datang 👋</h2>
          <p class="text-muted">Silakan masukkan akun Anda untuk melanjutkan.</p>
        </div>

        @if($errors->any())
          <div class="alert alert-danger border-0 d-flex align-items-center mb-4" role="alert">
            <i class="fas fa-exclamation-circle me-2"></i>
            <small>{{ $errors->first() }}</small>
          </div>
        @endif

        <form method="POST" action="{{ route('login.process') }}">
          @csrf

          <div class="mb-4">
            <label class="form-label fw-bold small text-secondary">Email Address</label>
            <div class="input-group">
              <span class="input-group-text bg-light border border-end-0 rounded-start-2 text-muted ps-3">
                <i class="far fa-envelope"></i>
              </span>
              <input type="email" name="email" class="form-control border-start-0 ps-2" placeholder="nama@email.com"
                required autofocus>
            </div>
          </div>

          <div class="mb-4">
            <div class="d-flex justify-content-between">
              <label class="form-label fw-bold small text-secondary">Password</label>
            </div>
            <div class="input-group">
              <span class="input-group-text bg-light border border-end-0 rounded-start-2 text-muted ps-3">
                <i class="fas fa-lock"></i>
              </span>
              <input type="password" name="password" id="password" class="form-control border-start-0 ps-2"
                placeholder="Masukkan password Anda" required>
              <button type="button" class="btn btn-light border border-start-0" id="togglePassword"
                style="z-index: 10;">
                <i class="far fa-eye text-muted"></i>
              </button>
            </div>
          </div>

          <div class="mb-4 form-check">
            <input type="checkbox" class="form-check-input" id="remember" name="remember">
            <label class="form-check-label small text-muted" for="remember">Ingat Saya</label>
          </div>

          <button type="submit" class="btn btn-primary w-100 mb-4">
            Masuk Sekarang <i class="fas fa-arrow-right ms-2"></i>
          </button>
        </form>
      </div>
    </div>

  </div>

  <script>
    document.getElementById('togglePassword').addEventListener('click', function (e) {
      const passwordInput = document.getElementById('password');
      const icon = this.querySelector('i');

      if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
      } else {
        passwordInput.type = 'password';
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
      }
    });
  </script>

</body>

</html>
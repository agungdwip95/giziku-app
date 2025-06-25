<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register Giziku</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <style>
        body {
            background: #eaf7f9;
        }

        .container {
            margin-top: 30px;
        }

        form {
            max-width: 400px;
            width: 100%;
            margin: 40px auto;
            background: #ffffff;
            position: relative;
            box-shadow: 0 5px 8px rgba(0, 124, 145, 0.4);
            border-radius: 10px;
        }

        .form-Wrapper::before,
        .form-Wrapper::after {
            content: "";
            background: #ffffff;
            border: 1px solid #b2dfe7;
            position: absolute;
            height: 100%;
            width: 100%;
            top: 3.5px;
            left: 0;
            transform: rotateZ(8deg);
            z-index: -1;
        }

        .form-group {
            padding: 20px 0;
            position: relative;
            margin-bottom: 0;
        }

        .form-control,
        .form-control:focus,
        textarea.form-control,
        input[type="file"].form-control {
            border: none;
            box-shadow: none;
            padding-left: 0;
            border-bottom: 1px solid rgba(0, 124, 145, 0.3);
            border-radius: 0;
            background: transparent;
        }

        .form-group label {
            position: absolute;
            width: 100%;
            left: 0;
            bottom: 0;
            top: 4px;
            color: rgba(0, 124, 145, 0.5);
            pointer-events: none;
        }

        .form-group.focused label {
            color: #F7931E;
        }

        .form-group label::after {
            content: "";
            background-color: #F7931E;
            bottom: 14px;
            height: 2px;
            left: 45%;
            position: absolute;
            visibility: hidden;
            width: 10px;
            transition: 0.3s ease;
        }

        .form-group.focused label::after {
            left: 0;
            width: 100%;
            visibility: visible;
        }

        form h2 {
            color: #007C91;
            text-align: center;
            margin-bottom: 25px;
            font-style: italic;
            background: rgba(0, 124, 145, 0.1);
            padding: 10px 0;
            border-radius: 6px;
        }

        .form-Wrapper {
            padding: 20px 30px;
        }

        .login-logo {
            display: block;
            margin: 20px auto 10px;
            max-width: 100px;
            height: auto;
        }

        button.btn {
            background: #007C91;
            border: none;
            border-radius: 0;
            text-transform: uppercase;
            font-weight: bold;
            width: 180px;
            height: 45px;
            margin: 30px auto;
            display: block;
            color: white;
        }

        button.btn:hover,
        button.btn:focus {
            background: #00657a;
        }

        .slideDown {
            animation: slideDown 1.5s ease;
            visibility: visible !important;
        }

        @keyframes slideDown {
            0% { transform: translateY(-100%); }
            50% { transform: translateY(8%); }
            65% { transform: translateY(-4%); }
            80% { transform: translateY(4%); }
            95% { transform: translateY(-2%); }
            100% { transform: translateY(0%); }
        }

        .register-link {
            text-align: center;
            margin-top: 20px;
        }

        .register-link a {
            color: #007C91;
            font-weight: 500;
        }

        .register-link a:hover {
            text-decoration: underline;
        }

        .toggle-password {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #007C91;
        }

        .error-message {
            color: #dc3545;
            font-size: 0.875rem;
            margin-top: 5px;
            display: block;
        }
    </style>
</head>
<body>
    <div class='container'>
        <div class='row'>
            <div class='col-md-12'>
                <form method="POST" action="/register" class="slideDown" enctype="multipart/form-data">
                    @csrf
                    <img src="{{ asset('img/logo_crop.png') }}" alt="Logo Giziku" class="login-logo">
                    <h2>Register</h2>
                    <div class="form-Wrapper">
                        <div class="form-group not-focused">
                            <input type="text" name="nama" class="form-control" id="nama" value="{{ old('nama') }}" required>
                            <label for="nama">Nama</label>
                            @error('nama')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group not-focused">
                            <input type="file" name="foto" class="form-control" id="foto" accept="image/*">
                            <label for="foto">Foto</label>
                            @error('foto')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group not-focused">
                            <input type="email" name="email" class="form-control" id="email" value="{{ old('email') }}" required>
                            <label for="email">Email</label>
                            @error('email')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group not-focused">
                            <input type="text" name="no_hp" class="form-control" id="no_hp" value="{{ old('no_hp') }}" required>
                            <label for="no_hp">No HP</label>
                            @error('no_hp')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group not-focused">
                            <textarea name="alamat" class="form-control" id="alamat" rows="2">{{ old('alamat') }}</textarea>
                            <label for="alamat">Alamat</label>
                            @error('alamat')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group not-focused position-relative">
                            <input type="password" name="password" class="form-control" id="password" required>
                            <label for="password">Password</label>
                            <i class="fa-solid fa-eye toggle-password" id="togglePassword"></i>
                            @error('password')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group not-focused position-relative">
                            <input type="password" name="password_confirmation" class="form-control" id="password_confirmation" required>
                            <label for="password_confirmation">Konfirmasi Password</label>
                            <i class="fa-solid fa-eye toggle-password" id="togglePasswordConfirm"></i>
                            @error('password_confirmation')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Register</button>
                        <div class="register-link">
                            Sudah punya akun? <a href="/login">Login</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        jQuery(document).ready(function($) {
            $(".form-control").focus(function() {
                $(this).parent().removeClass("not-focused").addClass("focused");
            }).blur(function() {
                if (!$(this).val() && $(this).attr('type') !== 'file') {
                    $(this).parent().removeClass("focused").addClass("not-focused");
                }
            });

            // Inisialisasi status label berdasarkan nilai input
            $(".form-control").each(function() {
                if ($(this).val() && $(this).attr('type') !== 'file') {
                    $(this).parent().removeClass("not-focused").addClass("focused");
                }
            });

            // Toggle Password
            $('#togglePassword').on('click', function () {
                const passwordField = $('#password');
                const type = passwordField.attr('type') === 'password' ? 'text' : 'password';
                passwordField.attr('type', type);
                $(this).toggleClass('fa-eye fa-eye-slash');
            });

            // Toggle Password Confirmation
            $('#togglePasswordConfirm').on('click', function () {
                const confirmField = $('#password_confirmation');
                const type = confirmField.attr('type') === 'password' ? 'text' : 'password';
                confirmField.attr('type', type);
                $(this).toggleClass('fa-eye fa-eye-slash');
            });
        });
    </script>
</body>
</html>
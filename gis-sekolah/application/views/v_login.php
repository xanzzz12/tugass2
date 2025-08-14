<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - GIS Sekolah</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .login-container {
            background: white;
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            width: 100%;
            max-width: 400px;
        }
        .login-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 40px 0;
            text-align: center;
        }
        .login-header h2 {
            margin: 0;
            font-weight: 300;
            font-size: 28px;
        }
        .login-header p {
            margin: 10px 0 0;
            opacity: 0.8;
            font-size: 14px;
        }
        .login-form {
            padding: 40px;
        }
        .form-group {
            margin-bottom: 25px;
            position: relative;
        }
        .form-group label {
            font-weight: 600;
            color: #333;
            margin-bottom: 8px;
            display: block;
        }
        .form-control {
            border: 2px solid #e1e5e9;
            border-radius: 10px;
            padding: 15px 20px;
            font-size: 16px;
            transition: all 0.3s ease;
        }
        .form-control:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
        }
        .btn-login {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            border-radius: 10px;
            color: white;
            padding: 15px 30px;
            font-size: 16px;
            font-weight: 600;
            width: 100%;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        }
        .alert {
            border-radius: 10px;
            border: none;
            margin-bottom: 20px;
        }
        .input-group-text {
            background: transparent;
            border: 2px solid #e1e5e9;
            border-right: none;
            border-radius: 10px 0 0 10px;
        }
        .form-control {
            border-left: none;
            border-radius: 0 10px 10px 0;
        }
        .input-group .form-control:focus {
            box-shadow: none;
            border-color: #667eea;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-header">
            <h2><i class="fas fa-graduation-cap"></i> GIS Sekolah</h2>
            <p>Sistem Informasi Geografis Sekolah</p>
        </div>
        
        <div class="login-form">
            <?php
            echo validation_errors('<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-triangle"></i> ', 
                '<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>');
            
            if ($this->session->flashdata('pesan')) {
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fas fa-exclamation-circle"></i> ' . $this->session->flashdata('pesan') . '
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>';
            }
            ?>

            <?= form_open('login/login', ['class' => 'needs-validation', 'novalidate' => '']); ?>
            
            <div class="form-group">
                <label for="username"><i class="fas fa-user"></i> Username</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                    <input type="text" 
                           name="username" 
                           id="username" 
                           class="form-control" 
                           placeholder="Masukkan username" 
                           value="<?= set_value('username') ?>" 
                           required>
                </div>
            </div>

            <div class="form-group">
                <label for="password"><i class="fas fa-lock"></i> Password</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                    <input type="password" 
                           name="password" 
                           id="password" 
                           class="form-control" 
                           placeholder="Masukkan password" 
                           required>
                </div>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-login">
                    <i class="fas fa-sign-in-alt"></i> Login
                </button>
            </div>

            <?php echo form_close() ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

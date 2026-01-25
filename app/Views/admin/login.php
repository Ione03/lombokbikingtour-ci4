<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - Lombok Biking Tour</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body { background-color: #f8f9fa; }
        .login-container { max-width: 400px; margin-top: 100px; }
        .card { border-radius: 1rem; box-shadow: 0 0.5rem 1rem 0 rgba(0, 0, 0, 0.1); }
        .card-header { background: #f4623a; color: white; border-radius: 1rem 1rem 0 0 !important; text-align: center; }
    </style>
</head>
<body>
    <div class="container login-container">
        <div class="card">
            <div class="card-header">
                <h4 class="mb-0">Admin Login</h4>
            </div>
            <div class="card-body">
                <?php if (session()->getFlashdata('error')): ?>
                    <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
                <?php endif; ?>
                
                <form action="<?= base_url('admin/auth') ?>" method="post">
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" id="username" name="username" required autofocus>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    
                    <div class="form-group">
                        <label>Captcha check: <strong><?= $captcha_question ?></strong></label>
                        <input type="number" class="form-control" name="captcha" placeholder="Answer" required>
                    </div>
                    
                    <button type="submit" class="btn btn-primary btn-block" style="background-color: #f4623a; border-color: #f4623a;">Login</button>
                    <a href="<?= base_url() ?>" class="btn btn-link btn-block text-muted">Back to Site</a>
                </form>
            </div>
        </div>
    </div>
</body>
</html>

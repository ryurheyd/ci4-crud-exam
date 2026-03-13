<!DOCTYPE html>
<html>

<head>
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: #0b0f19;
            font-family: Segoe UI;
            color: #e5e7eb;
        }

        .auth-card {
            width: 400px;
            background: #111827;
            border: 1px solid #2d3748;
            border-radius: 10px;
            padding: 35px;
        }

        .auth-title {
            font-size: 24px;
            font-weight: 600;
            text-align: center;
            margin-bottom: 25px;
        }

        .form-control {
            background: #1f2933;
            border: 1px solid #2d3748;
            color: #e5e7eb;
        }

        .form-control::placeholder {
            color: #94a3b8;
        }

        .form-control:focus {
            background: #1f2933;
            border-color: #3b82f6;
            box-shadow: none;
            color: #e5e7eb;
        }

        .btn-primary {
            background: #3b82f6;
            border: none;
        }

        .btn-primary:hover {
            background: #2563eb;
        }

        .link {
            text-align: center;
            margin-top: 15px;
        }

        .link a {
            color: #94a3b8;
            text-decoration: none;
        }

        .link a:hover {
            color: #e5e7eb;
        }
    </style>
</head>

<body>
    <div class="auth-card">
        <div class="auth-title">
            Register
        </div>

        <?php if (session()->getFlashdata('errors')): ?>
            <div class="alert alert-danger">
                <?php foreach (session()->getFlashdata('errors') as $error): ?>
                    <p><?= $error ?></p>
                <?php endforeach ?>
            </div>
        <?php endif ?>

        <form method="post" action="/register">
            <input type="text" name="name" class="form-control mb-3" placeholder="Full Name" required>
            <input type="email" name="email" class="form-control mb-3" placeholder="Email" required>
            <input type="password" name="password" class="form-control mb-3" placeholder="Password" required>
            <input type="password" name="confirm_password" class="form-control mb-3" placeholder="Confirm Password" required>
            <button class="btn btn-primary w-100">
                Register
            </button>
        </form>

        <div class="link">
            <a href="/login">Back to Login</a>
        </div>
    </div>
</body>

</html>
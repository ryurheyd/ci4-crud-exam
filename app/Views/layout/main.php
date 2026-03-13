<!DOCTYPE html>
<html>

<head>
    <title>Student Management System</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
        rel="stylesheet">

    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js">
    </script>

    <style>
        body {
            background: #0f172a;
            color: #e5e7eb;
            font-family: system-ui;
        }

        .sidebar {
            height: 100vh;
            background: #111827;
            color: #e5e7eb;
            padding: 12px;
            margin-bottom: 8px;
            border-right: 1px solid #1f2937;
        }

        .sidebar h4 {
            font-weight: 600;
            margin-bottom: 20px;
        }

        .sidebar a {
            color: #e5e7eb;
            display: block;
            padding: 10px;
            text-decoration: none;
            border-radius: 6px;
            margin-bottom: 6px;
            transition: 0.2s;
        }

        .sidebar a:hover {
            background: #1f2937;
        }

        .col-10 {
            background: #ffffff;
            color: #1e293b;
            min-height: 100vh;
        }

        .table {
            color: #1e293b;
        }

        .table-dark {
            background: #1f2937;
        }

        .btn-primary {
            background: #3b82f6;
            border: none;
        }

        .btn-primary:hover {
            background: #2563eb;
        }

        .btn-success {
            background: #22c55e;
            border: none;
        }

        .btn-success:hover {
            background: #16a34a;
        }

        .btn-warning {
            background: #f59e0b;
            border: none;
        }

        .btn-danger {
            background: #ef4444;
            border: none;
        }

        .btn-info {
            background: #06b6d4;
            border: none;
        }

        .profile-avatar {
            width: 120px;
            height: 120px;
            object-fit: cover;
            border-radius: 10px;
            border: 3px solid #e5e7eb;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .alert-success {
            background: #22c55e;
            border: none;
            color: white;
        }

        .alert-danger {
            background: #ef4444;
            border: none;
            color: white;
        }

        .footer {
            text-align: center;
            margin-top: 60px;
            color: #94a3b8;
            font-size: 14px;
        }
    </style>

</head>

<body>

<div class="container-fluid">
    <div class="row">
        <div class="col-2 sidebar">
            <h4>Admin Panel</h4>
            <hr>
            <a href="/dashboard">Dashboard</a>
            <a href="/students">Students</a>
            <a href="/profile">Profile</a>
            <a href="/logout">Logout</a>
        </div>

        <div class="col-10 p-4">
            <?php if (session()->getFlashdata('success')): ?>
                <div class="alert alert-success alert-dismissible fade show">
                    <?= session()->getFlashdata('success') ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            <?php endif; ?>

            <?php if (session()->getFlashdata('error')): ?>
                <div class="alert alert-danger alert-dismissible fade show">
                    <?= session()->getFlashdata('error') ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            <?php endif; ?>

            <?= $this->renderSection('content') ?>

            <div class="footer">
                <hr>
                <p class="mb-0">Student Management System</p>
                <p>Developed by Ryu Rhey C. Dizon</p>
            </div>
        </div>
    </div>
</div>

</body>

</html>
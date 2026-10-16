<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PT. Unictive Media Indonesia</title>

    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap"
        rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <style>
        :root {
            --primary: #4f46e5;
            --primary-dark: #4338ca;
            --primary-soft: #eef2ff;
            --bg: #f5f7fb;
            --text: #1f2937;
            --muted: #6b7280;
            --border: #e5e7eb;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: var(--bg);
            color: var(--text);
        }

        /* Navbar */
        .app-navbar {
            background: #fff;
            border-bottom: 1px solid var(--border);
        }

        .app-navbar .brand-icon {
            width: 38px;
            height: 38px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #6366f1, #4f46e5);
            color: #fff;
            border-radius: 10px;
            font-size: 1.1rem;
        }

        .app-navbar .navbar-brand {
            font-weight: 700;
            color: var(--text);
        }

        .app-navbar small {
            color: var(--muted);
        }

        /* Card */
        .app-card {
            background: #fff;
            border: 1px solid var(--border);
            border-radius: 16px;
            box-shadow: 0 4px 24px rgba(17, 24, 39, .05);
        }

        /* Buttons */
        .btn {
            border-radius: 10px;
            font-weight: 600;
            padding: .55rem 1.1rem;
        }

        .btn-sm {
            padding: .35rem .7rem;
        }

        .btn-primary,
        .btn-success {
            background: var(--primary);
            border-color: var(--primary);
        }

        .btn-primary:hover,
        .btn-success:hover {
            background: var(--primary-dark);
            border-color: var(--primary-dark);
        }

        .btn-soft {
            background: var(--primary-soft);
            color: var(--primary);
            border: 0;
        }

        .btn-soft:hover {
            background: #e0e7ff;
            color: var(--primary-dark);
        }

        /* Form */
        .form-label {
            font-weight: 600;
            font-size: .9rem;
        }

        .form-control,
        .input-group-text {
            border-radius: 10px;
            border-color: var(--border);
            padding: .6rem .9rem;
        }

        .input-group>.form-control {
            border-top-left-radius: 0;
            border-bottom-left-radius: 0;
        }

        .input-group>.input-group-text {
            border-top-right-radius: 0;
            border-bottom-right-radius: 0;
            background: #f9fafb;
            color: var(--muted);
        }

        .input-group>.btn {
            border-top-left-radius: 0;
            border-bottom-left-radius: 0;
        }

        .form-control:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 .25rem rgba(79, 70, 229, .12);
        }

        /* Alert */
        .alert {
            border: 0;
            border-radius: 12px;
        }
    </style>
</head>

<body>
    <nav class="navbar app-navbar mb-4 py-3">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center gap-2" href="{{ route('users.index') }}">
                <span class="brand-icon"><i class="bi bi-people-fill"></i></span>
                <span>
                    CRUD User &amp; Hobi<br>
                    <small class="fw-normal">PT. Unictive Media Indonesia</small>
                </span>
            </a>
        </div>
    </nav>

    <div class="container pb-5">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show d-flex align-items-center" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i>
                <div>{{ session('success') }}</div>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

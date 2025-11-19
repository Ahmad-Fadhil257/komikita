<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Komikita</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        .brand-title {
            font-size: 1.4rem;
            font-weight: 700;
            letter-spacing: 1px;
        }
    </style>
</head>
<body class="bg-light">

    <!-- TOP BAR -->
    <nav class="navbar navbar-light bg-white shadow-sm px-3 py-2">
        <div class="container-fluid d-flex align-items-center">

            <!-- Logo -->
            <a class="navbar-brand brand-title" href="/">KOMIKITA</a>

            <!-- Search -->
            <form class="d-flex ms-auto me-3" action="/" method="GET" style="max-width: 350px; width: 100%;">
                <input class="form-control" type="search" placeholder="Cari komik..." name="search">
            </form>

            <!-- Profile Icon -->
            <a href="/profile" class="text-dark" style="font-size: 1.4rem;">
                <i class="bi bi-person-circle"></i>
            </a>

        </div>
    </nav>

    <!-- MAIN CONTENT -->
    <div class="container py-4">
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- ICONS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

</body>
</html>

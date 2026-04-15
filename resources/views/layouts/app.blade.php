<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Maison D'Awa — Gestion des Livraisons</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body { background-color: #F5F0E8; font-family: 'Segoe UI', sans-serif; }
        .navbar { background-color: #C4973A !important; min-height: 90px; border-bottom: 3px solid #8B2E2E; }
        .nav-link { color: white !important; font-weight: 500; padding: 12px 16px !important; }
        .nav-link:hover { background-color: #8B2E2E !important; color: white !important; }
        .btn-primary { background-color: #8B2E2E; border-color: #8B2E2E; }
        .btn-primary:hover { background-color: #6e2424; border-color: #6e2424; }
        .btn-warning { background-color: #C4973A; border-color: #C4973A; color: white; }
        .btn-warning:hover { background-color: #a67e30; color: white; }
        .card { border: 1px solid #C4973A; border-radius: 10px; background-color: white; }
        .card-header { background-color: #8B2E2E; color: #F5F0E8; border-radius: 10px 10px 0 0 !important; }
        .table thead th { background-color: #8B2E2E; color: white; }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg">
    <div class="container">
        <a href="/">
            <img src="{{ asset('logo.svg') }}" alt="Maison D'Awa" height="80" style="background-color: white; border-radius: 50%; padding: 3px;">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navMenu">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item"><a class="nav-link" href="/"><i class="bi bi-house"></i> Accueil</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('clients.index') }}"><i class="bi bi-people"></i> Clients</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('livreurs.index') }}"><i class="bi bi-person-badge"></i> Livreurs</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('colis.index') }}"><i class="bi bi-box"></i> Colis</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('livraisons.index') }}"><i class="bi bi-truck"></i> Livraisons</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('paiements.index') }}"><i class="bi bi-cash-coin"></i> Paiements</a></li>
                @if(auth()->guard('admin')->user()->role === 'admin')
                <li class="nav-item"><a class="nav-link" href="{{ route('utilisateurs.index') }}"><i class="bi bi-people-fill"></i> Utilisateurs</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('clotures.index') }}"><i class="bi bi-calendar-check"></i> Clôtures</a></li>
                @endif
                <li class="nav-item">
                    <form action="{{ route('logout') }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="nav-link btn btn-link" style="color: white !important;">
                            <i class="bi bi-box-arrow-right"></i> Déconnexion
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container mt-4">
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            <i class="bi bi-check-circle"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show">
            <i class="bi bi-exclamation-circle"></i> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif
    @yield('content')
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
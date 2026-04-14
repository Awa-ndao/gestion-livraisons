<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Maison D'Awa — Connexion</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #F5F0E8; font-family: 'Segoe UI', sans-serif; }
        .login-card { max-width: 420px; margin: 80px auto; border: 1px solid #C4973A; border-radius: 10px; background-color: white; }
        .login-header { background-color: #8B2E2E; color: white; border-radius: 10px 10px 0 0; padding: 20px; text-align: center; }
        .btn-primary { background-color: #8B2E2E; border-color: #8B2E2E; }
        .btn-primary:hover { background-color: #6e2424; border-color: #6e2424; }
    </style>
</head>
<body>

<div class="login-card">
    <div class="login-header">
        <img src="/logo.svg" alt="Maison D'Awa" height="80" style="background-color: white; border-radius: 50%; padding: 3px; margin-bottom: 10px;">
        <h5 class="mb-0">Connexion Admin</h5>
    </div>
    <div class="p-4">
        @if($errors->any())
            <div class="alert alert-danger">
                {{ $errors->first() }}
            </div>
        @endif
        <form method="POST" action="/login">
            @csrf
            <div class="mb-3">
                <label class="form-label fw-bold">Email</label>
                <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold">Mot de passe</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Se connecter</button>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
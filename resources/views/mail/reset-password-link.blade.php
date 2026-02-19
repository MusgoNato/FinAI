<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Redefinição de senha</title>

    <link href="https://cdn.jsdelivr.net/npm/daisyui@5/themes.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-base-200 py-10">

    <div class="max-w-md mx-auto bg-base-100 rounded-xl shadow-lg p-8 text-center">

        <h1 class="text-2xl font-bold mb-4">
            🔐 Redefinição de senha
        </h1>

        <p class="text-base-content/70 mb-6">
            Você solicitou a redefinição de senha da sua conta.
            Clique no botão abaixo para continuar.
        </p>

        <a
            href="{{ $link }}"
            class="btn btn-primary btn-wide mb-6"
            target="_blank"
        >
            Redefinir senha
        </a>

        <p class="text-sm text-base-content/60">
            Se você não solicitou essa ação, pode ignorar este e-mail.
        </p>

        <div class="divider"></div>

        <p class="text-xs text-base-content/50">
            Este link é válido por tempo limitado.<br>
            © {{ config('app.name') }}
        </p>

    </div>

</body>
</html>
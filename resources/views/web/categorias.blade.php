<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Pedidos</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            background: #f5f5f5;
            color: #222;
        }

        nav {
            background: #1f2937;
            padding: 14px 20px;
            display: flex;
            gap: 16px;
            flex-wrap: wrap;
        }

        nav a {
            color: #fff;
            text-decoration: none;
            font-weight: 600;
        }

        main {
            max-width: 960px;
            margin: 24px auto;
            padding: 0 16px 40px;
        }

        .card {
            background: #fff;
            border: 1px solid #e5e7eb;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.04);
            margin-top: 20px;
        }

        h2, h3 {
            margin-top: 0;
        }

        form {
            display: grid;
            gap: 12px;
            margin-bottom: 24px;
        }

        label {
            display: block;
            font-weight: 600;
            margin-bottom: 4px;
        }

        input, select, textarea, button {
            padding: 10px 12px;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            font-size: 14px;
        }

        button {
            background: #111827;
            color: #fff;
            border: none;
            cursor: pointer;
            width: fit-content;
        }

        .actions {
            display: flex;
            gap: 10px;
            align-items: center;
            flex-wrap: wrap;
        }

        ul {
            list-style: none;
            padding: 0;
            margin: 0;
            display: grid;
            gap: 12px;
        }

        li {
            background: #f9fafb;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            padding: 12px 14px;
            display: flex;
            justify-content: space-between;
            gap: 12px;
            align-items: center;
            flex-wrap: wrap;
        }

        .alert {
            padding: 12px 14px;
            border-radius: 8px;
            margin-bottom: 16px;
        }

        .alert-success {
            background: #dcfce7;
            color: #166534;
        }

        .alert-error {
            background: #fee2e2;
            color: #991b1b;
        }

        a {
            color: #1f2937;
        }
    </style>
</head>
<body>
    <nav>
        <a href="{{ route('categorias.index') }}">Categorias</a>
        <a href="{{ route('clientes.index') }}">Clientes</a>
        <a href="{{ route('produtos.index') }}">Produtos</a>
        <a href="{{ route('pedidos.index') }}">Pedidos</a>
    </nav>

    <main>
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if (session('error'))
            <div class="alert alert-error">{{ session('error') }}</div>
        @endif

        @yield('conteudo')
    </main>
</body>
</html>
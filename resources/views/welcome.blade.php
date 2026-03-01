<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bukit EON</title>
    <style>
        :root { color-scheme: light; }
        * { box-sizing: border-box; }
        body {
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
            background: #f4f6f8;
            color: #1f2937;
            min-height: 100vh;
            display: grid;
            place-items: center;
            padding: 24px;
        }
        .card {
            width: 100%;
            max-width: 720px;
            background: #ffffff;
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            padding: 32px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.06);
        }
        h1 {
            margin: 0 0 10px;
            font-size: 32px;
        }
        p {
            margin: 0 0 22px;
            line-height: 1.6;
            color: #4b5563;
        }
        .actions {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
        }
        .btn {
            display: inline-block;
            text-decoration: none;
            padding: 10px 16px;
            border-radius: 8px;
            font-weight: 600;
            border: 1px solid #d1d5db;
            color: #111827;
            background: #fff;
        }
        .btn-primary {
            background: #111827;
            color: #fff;
            border-color: #111827;
        }
        .meta {
            margin-top: 24px;
            font-size: 13px;
            color: #6b7280;
        }
    </style>
</head>
<body>
    <main class="card">
        <h1>Bukit EON</h1>
        <p>Index awal project sudah aktif. Halaman ini bisa jadi titik mulai sebelum lanjut ke dashboard atau fitur utama.</p>

        <div class="actions">
            <a class="btn btn-primary" href="{{ url('/') }}">Refresh Halaman</a>
            <a class="btn" href="https://laravel.com/docs" target="_blank" rel="noopener noreferrer">Dokumentasi Laravel</a>
        </div>

        <div class="meta">
            Laravel v{{ Illuminate\Foundation\Application::VERSION }} · PHP v{{ PHP_VERSION }}
        </div>
    </main>
</body>
</html>

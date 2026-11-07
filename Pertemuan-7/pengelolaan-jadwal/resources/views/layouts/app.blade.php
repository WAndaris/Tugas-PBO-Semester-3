<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Jadwal BAAK')</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 820px;
            margin: 30px auto;
            padding: 0 16px;
            color: #222;
        }

        header {
            border-bottom: 2px solid #1F3864;
            margin-bottom: 20px;
            padding-bottom: 8px;
        }

        header a {
            color: #1F3864;
            font-weight: bold;
            text-decoration: none;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 10px;
        }

        th, td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: left;
        }

        th {
            background: #1F3864;
            color: white;
        }

        .disetujui {
            color: #1a7f37;
            font-weight: bold;
        }

        .bentrok {
            color: #c00000;
            font-weight: bold;
        }

        .diajukan {
            color: #b36b00;
            font-weight: bold;
        }

        footer {
            margin-top: 30px;
            font-size: 13px;
            color: #666;
        }
    </style>
</head>

<body>

    <header>
        <a href="{{ route('jadwal.index') }}">Jadwal BAAK</a>
    </header>

    <main>
        @yield('content')
    </main>

    <footer>
       
    </footer>

</body>
</html>
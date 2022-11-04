<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <style>
        * {
            font-family: arial, verdana, hevetica;
        }

        header,
        main,
        footer {
            border: solid 1px #ddd;
            padding: 15px;
            margin: 10px;
        }

        header,
        footer {
            background-color: #eee;
        }

        header {
            display: flex;
        }

        header figure {
            flex: 1;
        }

        header h1 {
            flex: 4;
        }

        .cursiva {
            font-style: italic;
        }

        .logo {
            width: 100px;
        }
    </style>
</head>

<body>
    <header>
        <figure>
            <img class="logo" src="{{ asset('images/logos/logo.png') }}" alt="Logo">
        </figure>
        <h1>{{ config('app.name') }}</h1>
    </header>
    <main>
        <h2>{{ __('Subject') }}: {{ $msg->subject }}</h2>
        <p class="cursiva">De {{ $msg->name }}
            <a href="mailto:{{ $msg->email }}">&lt;{{ $msg->email }}&gt;</a>
        </p>
        <p>{{ $msg->message }}</p>
    </main>
    <footer>
        <p>{{ __('Application to sell online second hand products. Developed using Laravel.') }}</p>
    </footer>
</body>

</html>

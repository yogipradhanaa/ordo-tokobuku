<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'My App')</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    @stack('styles') {{-- Untuk tambahan CSS --}}
</head>
<style>
body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            text-align: center;
        }
        
        nav {
            background-color: #007bff;
            padding: 10px 0;
        }
        
        nav ul {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
            justify-content: center;
        }
        
        nav ul li {
            margin: 0 15px;
        }
        
        nav ul li a {
            text-decoration: none;
            color: white;
            font-size: 16px;
            font-weight: bold;
            padding: 10px 15px;
            display: inline-block;
            transition: background 0.3s;
        }
        
        nav ul li a:hover {
            background: rgba(255, 255, 255, 0.2);
            border-radius: 5px;
        }

        .container {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <nav>
        <ul>
            <li><a href="{{ url('/') }}">Dashboard</a></li>
            <li><a href="{{ url('/books') }}">Books</a></li>
            <li><a href="{{ url('/categories') }}">Categories</a></li>
        </ul>
    </nav>

    <body style="background: white">
        <div class="container mt-5 mb-5">
            @yield('content')
        </div>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
        

        @stack('scripts') {{-- Untuk tambahan JavaScript --}}
    </body>

</html>
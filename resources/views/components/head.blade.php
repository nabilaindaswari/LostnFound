<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.14.1/dist/cdn.min.js"></script>
    <link href="https://api.fontshare.com/v2/css?f[]=satoshi@300,301,400,401,500,501,700,701,900,901&display=swap"
        rel="stylesheet">

    <title>{{$slot}}</title>
    <style>
    body {
        font-family: 'Satoshi', sans-serif;
        background-color: #f3f6ff;
    }

    nav {
        background-color: #0055a6;
        color: #f3f6ff;
    }
    </style>
</head>
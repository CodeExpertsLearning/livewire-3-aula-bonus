<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Our Livewire 3 Store</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-fixed bg-gradient-to-b from-10% to-80% from-purple-800 to-black">
<div class="max-w-7xl mx-auto">
    {{$slot}}
</div>
</body>
</html>

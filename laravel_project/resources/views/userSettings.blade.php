<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Project</title>
    @vite('resources/css/app.css')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
</head>
<body>
    <style>
        *{
            font-family: 'Poppins'
        }
    </style>
    <header class="bg-[#030712] grid grid-cols-12 max-w-full items-center h-20 px-10 sticky inset-x-0">
        <div class="col-span-2">
            <a href="/" class="text-white font-semibold text-2xl">Project.</a>
            
        </div>
        <div class="col-span-10 flex justify-end gap-10">
            <a href="/dashboard" class="text-white font-medium">Dashboard</a>
            <a href="/profile" class="text-white font-medium">Profile</a>
            <a href="/" class="text-white font-medium">Logout</a>
        </div>
    </header>
    <main class="">
    </main>
    
    
</body>
</html>
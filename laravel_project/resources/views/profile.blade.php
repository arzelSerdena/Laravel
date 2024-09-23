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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
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
        <div class="col-span-10 flex justify-end gap-5 items-center">
            <a href="/dashboard" class="text-white font-medium">Dashboard</a>
            <button>
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#fff" class="bi bi-caret-down-fill" viewBox="0 0 16 16">
                    <path d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z"/>
                  </svg>
            </button>
        </div>
    </header>
    <main class="grid grid-cols-12 gap-4 px-10 py-10">
        <div class="col-span-4 row-span-6 border-2 rounded-2xl p-4 bg-white flex flex-col items-center">
            <div class="">
                <img src="https://via.placeholder.com/150" alt="Placeholder Image" class="mb-5 mt-2 rounded-full w-32 h-32">
            </div>
            <h3 class="font-semibold">Demo Name</h3>
            <h4 class="text-xs text-center">Lorem ipsum dolor sit amet consectetur adipisicing elit</h4>
            <div class="flex items-center mt-4 gap-1 hover:underline hover:ease-in-out">
                <a href="" class="text-[10px] ">Edit Profile</a>
                <svg xmlns="http://www.w3.org/2000/svg" width="9" height="9" fill="currentColor" class="bi bi-pencil translate-y-[-1px]" viewBox="0 0 16 16">
                    <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325"/>
                  </svg>
            </div>
        </div>
        <div class="col-span-8 row-span-5 border-2 rounded-2xl p-4 bg-white flex items-center justify-center">
            <p class="text-xs text-[#71717a]">Nothing to show here.</p>
        </div>
        <div class="col-start-5 col-span-8 row-span-10 border-2 rounded-2xl p-4 bg-white flex items-center justify-center">
            <p class="text-xs text-[#71717a]">Nothing to show here</p>
        </div>
    </main>
    
    
    
</body>
</html>
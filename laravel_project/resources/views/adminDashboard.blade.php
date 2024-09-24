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
    <style>
        * {
            font-family: 'Poppins', sans-serif;
        }
        .headerHiddenDiv {
            opacity: 0;
            max-height: 0;
            overflow: hidden;
            transition: opacity 0.2s ease, max-height 0.2s ease;
        }

        .headerToggle.active + .headerHiddenDiv,
        .headerToggle:hover + .headerHiddenDiv {
            opacity: 1;
            max-height: 1000px;
        }

        .headerToggle.active svg,
        .headerToggle:hover svg {
            transform: rotate(180deg);
        }

        .headerToggle svg {
            transition: transform 0.2s ease;
        }
    </style>
</head>
<body >
    <header class="bg-[#030712] ">
        <div class="grid grid-cols-12 items-center h-20 px-10 sticky inset-x-0 max-w-[1200px] m-auto">
            <div class="col-span-2">
                <a href="/" class="text-white font-semibold text-2xl">Project.</a>
                
            </div>
            <div class="col-span-10 flex justify-end gap-5 items-center">
                <a href="/dashboard" class="text-white font-medium">Dashboard</a>
                <button class="headerToggle">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#fff" class="bi bi-caret-down-fill" viewBox="0 0 16 16">
                        <path d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z"/>
                    </svg>
                </button>
                <div class="text-[#030712] text-sm absolute top-[60px] flex flex-col bg-white p-5 z-50 rounded-xl gap-2 shadow-2xl headerHiddenDiv">
                    <a href="/profile" class="font-medium">Profile</a>
                    <a href="/userSettings" class="font-medium">Settings</a>
                    <a href="/" class="font-medium">Logout</a>
                </div>
            </div>
        </div>
    </header>
    <main class="max-w-[1200px] m-auto">
        <div class="flex justify-center min-h-screen px-10 pt-20 ">
            <div class="text-center">
                <h1 class="text-5xl font-bold uppercase p-2 text-[#030712]">Welcome, Admin!</h1>
                <p class="text-[#030712]">A aspernatur soluta atque ab itaque fuga veritatis inventore accusamus ex consectetur temporibus dicta laboriosam minima suscipit, nam dolorem! In, nemo necessitatibus.</p>
            </div>
        </div>
    </main>
    <script>
        const headerToggles = document.querySelectorAll(".headerToggle");
        const headerHiddenDiv = document.querySelector(".headerHiddenDiv");

        headerToggles.forEach((headerToggle) => {
            headerToggle.addEventListener("click", (event) => {
                event.stopPropagation();
                headerToggle.classList.toggle("active");
                headerHiddenDiv.classList.toggle("opacity-100");
                headerHiddenDiv.classList.toggle("max-h-[1000px]");
            });
        });

        document.addEventListener("click", () => {
            headerToggles.forEach((headerToggle) => {
                headerToggle.classList.remove("active");
            });
            headerHiddenDiv.classList.remove("opacity-100");
            headerHiddenDiv.classList.remove("max-h-[1000px]");
        });
    </script>
    
    
    
</body>
</html>
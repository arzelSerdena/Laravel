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
<body>
    
    <header class="bg-[#030712] grid grid-cols-12 max-w-full items-center h-20 px-10 sticky inset-x-0">
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
    </header>
    <main class="p-10">
        <div class="grid grid-cols-12 border-2 rounded-2xl p-5 h-screen">
            <div class="col-span-3 flex flex-col gap-2">
                <a href="" class="text-sm font-medium">Edit Profile</a>
                <a href="" class="text-xs font-medium pl-5">Update Avatar</a>
                <a href="" class="text-xs font-medium  pl-5">Update Name</a>
                <a href="" class="text-xs font-medium  pl-5">Update Bio</a>
                <a href="" class="text-sm font-medium ">Privacy & Security</a>
                <a href="" class="text-xs font-medium  pl-5">Change Password</a>
                <a href="" class="text-xs font-medium  pl-5">Change Email</a>
                <a href="" class="text-sm font-medium text-red-700">Delete Account</a>
            </div>
            <div class="border-l-2 col-span-9 pl-5">
                <div id="editProfile">
                    <h3>Edit Profile</h3>
                    <h6 id="updateAvatar">Update Avatar</h6>
                    <h6 id="updateName">Update Name</h6>
                    <h6 id="updateBio">Update Bio</h6>
                </div>
                <div id="privacyAndSecurity"></div>
                    <h3>Privacy & Security</h3>
                    <h6 id="updateAvatar">Change Password</h6>
                    <h6 id="updateName">Change Email</h6>
                    
                <div id="deleteAccount"></div>
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
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
    <main class="p-10 max-w-[1200px] m-auto">
        <div class="grid grid-cols-12 border-2 rounded-2xl p-5 h-screen">
            <div class="col-span-2 flex flex-col gap-2">
                <a href="" class="text-sm font-medium">Edit Profile</a>
                <a href="" class="text-xs font-medium pl-5">Update Avatar</a>
                
                <a href="" class="text-xs font-medium  pl-5">Update Name</a>
                <a href="" class="text-xs font-medium  pl-5">Update Bio</a>
                <a href="" class="text-sm font-medium ">Privacy & Security</a>
                <a href="" class="text-xs font-medium  pl-5">Change Password</a>
                <a href="" class="text-xs font-medium  pl-5">Change Email</a>
                <a href="" class="text-sm font-medium text-red-700">Delete Account</a>
            </div>
            <div class="border-l-2 col-span-10 pl-5 h-full">
                <div id="editProfile" class="mb-5">
                    <h3 class="font-semibold">Edit Profile</h3>
                    {{-- <h6 id="updateAvatar" class="text-sm font-medium">Update Avatar</h6> --}}
                    <div class="flex pl-3 items-center gap-5">
                        <img src="https://via.placeholder.com/150" alt="Placeholder Image" class="mb-5 mt-2 rounded-full w-24 h-24">
                        <div class="">
                            <button class="text-xs border border-[#03071288] rounded-lg py-1 px-3 mb-3 hover:border-[#030712] hover:bg-[#030712] hover:text-white ease-in duration-100">Update Avatar</button>
                            <div class="text-[10px] text-gray-600 flex flex-col gap-[1px]">
                                <p>File size limit: 2MB.</p>
                            <p>Supported file formats: JPG, PNG.</p>
                            <p>For best results, use a square image (recommended size: 512x512px).</p>
                            </div>
                        </div>
                    </div>
                    {{-- <h6 id="updateName" class="text-sm font-medium">Update Name</h6> --}}
                    <div class="flex mb-3 pl-3">
                        <label for="" class="text-sm font-medium">Name</label>
                        <input type="text" placeholder="Demo Name" class="border border-[#03071288] rounded-md ml-3 text-xs pl-2 w-full">
                    </div>
                    {{-- <h6 id="updateBio" class="text-sm font-medium">Update Bio</h6> --}}
                    <div class="flex pl-3">
                        <label for="" class="mr-8 text-sm font-medium">Bio</label>
                        <div class="w-full">
                            <textarea name="" id="" cols="10" rows="5" placeholder="Use this space to tell others about yourself, your interests, or expertise." class="border border-[#03071288] rounded-md text-xs pl-2 w-full"></textarea>
                            <p class="text-[10px] text-gray-600">Max length: 150 characters.</p>
                        </div>
                    </div>
                    
                </div>
                <div id="privacyAndSecurity" class="mb-5">
                    <h3 class="font-semibold">Privacy & Security</h3>
                    <h6 id="updateAvatar" class="text-sm font-medium">Change Password</h6>
                    <div class="grid grid-cols-12 px-3">
                        <label for="" class="text-xs font-medium text-nowrap col-span-2">New password</label>
                        <input type="text" placeholder="Demo Name" class="border border-[#03071288] rounded-md mb-1 ml-3 text-xs pl-2 w-full col-span-10">
                        <div class="text-[10px] text-gray-600 pl-5 mb-2 col-start-3 col-span-10">
                            <ul class="">
                                <li>Minimum 8 characters, including at least 1 uppercase letter, 1 lowercase letter, 1 number, and 1 special character (e.g., !, @, #, $).</li>
                                <li>Avoid common words or sequences like "12345" or "password".</li>
                            </ul>
                        </div>
                        <label for="" class="text-xs font-medium text-nowrap col-span-2">Confirm Password</label>
                        <input type="text" placeholder="Demo Name" class="border border-[#03071288] rounded-md ml-3 text-xs pl-2 w-full mb-1 col-span-10">
                        <p class="text-[10px] text-gray-600 pl-5 mb-2 col-start-3 col-span-10">Passwords must match.</p>
                        <button class="col-start-3 col-span-3 text-xs border  rounded-lg py-1.5 ml-3 px-3 text-nowrap mb-3 border-[#030712] bg-[#030712] text-white ease-in duration-100">Change password</button>
                    </div>
                    
                    <h6 id="updateName" class="text-sm font-medium">Change Email</h6>
                    <div class="grid grid-cols-12 px-3">
                        <label for="" class="text-xs font-medium text-nowrap col-span-2 mb-2">New email</label>
                        <input type="text" placeholder="Demo Name" class="border border-[#03071288] rounded-md mb-2 ml-3 text-xs pl-2 w-full col-span-10">
                        
                        <label for="" class="text-xs font-medium text-nowrap col-span-2">Confirm email</label>
                        <input type="text" placeholder="Demo Name" class="border border-[#03071288] rounded-md ml-3 text-xs pl-2 w-full mb-1 col-span-10">
                        <p class="text-[10px] text-gray-600 pl-5 mb-2 col-start-3 col-span-10">Emails must match.</p>
                        <button class="col-start-3 col-span-3 text-xs border  rounded-lg py-1.5 ml-3 px-3 text-nowrap mb-3 border-[#030712] bg-[#030712] text-white ease-in duration-100">Change email</button>
                    </div>
                </div>
                <div id="deleteAccount">
                    <h3 class="text-red-700 font-semibold ">Delete Account</h3>
                    <p class="text-[10px] mb-2 text-justify">Deleting your account is permanent and cannot be undone. All your data, including profile information, settings, and content, will be permanently removed. You will lose access to your account and any associated services. Please ensure you have downloaded any important data before proceeding.</p>
                    <button class="text-xs border  rounded-lg py-1.5 px-3 text-nowrap mb-3 border-red-700 bg-red-700 text-white ease-in duration-100">Delete Account</button>
                </div>
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
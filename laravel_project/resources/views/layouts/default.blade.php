<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Project')</title>
    @vite('resources/css/app.css')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
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
    @yield('content')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
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

        function previewImage(event) {
            const image = document.getElementById('avatarImage');
            const file = event.target.files[0];
            
            if (file) {
                const reader = new FileReader();
    
                reader.onload = function(e) {
                    image.src = e.target.result;
                };
    
                reader.readAsDataURL(file);
            }
        }
    </script>
</body>
</html>
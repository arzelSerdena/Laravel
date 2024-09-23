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
<body class="bg-[#4b5563]">
    <style>
        *{
            font-family: 'Poppins'
        }
    </style>
    
    <main class="flex items-center justify-center min-h-screen bg-[#d1d5db]">
        <div class="bg-[#f3f4f6] w-[350px] rounded-2xl shadow-lg">
            <form action="/submit" method="POST" class="flex flex-col px-8 py-10">
                <h2 class="text-2xl font-bold mb-6 text-center">Register</h2>
    
                <!-- Name Field -->
                <label for="name" class="text-[#030712] text-sm font-medium">Name</label>
                <input type="text" id="name" name="name" placeholder="Full Name"
                    class="border rounded-lg p-2 mb-4 focus:outline-none focus:ring-1 focus:ring-[#030712] text-xs">
    
                <!-- Email Field -->
                <label for="email" class="text-[#030712] text-sm font-medium">Email</label>
                <input type="email" id="email" name="email" placeholder="Email" 
                    class="border rounded-lg p-2 mb-4 focus:outline-none focus:ring-1 focus:ring-[#030712] text-xs">
    
                <!-- Password Field -->
                <label for="password" class="text-[#030712] text-sm font-medium">Password</label>
                <input type="password" id="password" name="password" placeholder="Password" 
                    class="border rounded-lg p-2 mb-4 focus:outline-none focus:ring-1 focus:ring-[#030712] text-xs">
    
                <!-- Confirm Password Field -->
                <label for="confirm-password" class="text-[#030712] text-sm font-medium">Confirm Password</label>
                <input type="password" id="confirm-password" name="confirm-password" placeholder="Confirm Password" 
                    class="border rounded-lg p-2 mb-4 focus:outline-none focus:ring-1 focus:ring-[#030712] text-xs">
    
                <!-- Register Button -->
                <button type="submit" class="bg-[#030712] text-white font-semibold py-2 rounded-lg hover:bg-[#111827] transition duration-300 my-3">
                    Register
                </button>
                <hr class="mb-5 mt-4 border-[#37415135]">
    
                <!-- Login Link -->
                <p class="text-xs text-center text-[#030712]">
                    Already have an account? 
                    <a href="/login" class="text-[#111827] font-semibold hover:underline">Login</a>
                </p>
            </form>
        </div>
    </main>
    
    
    
    
    
</body>
</html>
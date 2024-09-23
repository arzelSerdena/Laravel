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
            <form action="/submit" method="POST" class="flex flex-col px-8 py-10 ">
                <h2 class="text-2xl font-bold mb-6 text-center">Login</h2>
                
                
                <!-- Email Field -->
                <label for="email" class="text-[#030712] text-sm font-medium">Email</label>
                <input type="email" id="email" name="email" placeholder="Email" 
                    class="border rounded-lg p-2 mb-4 focus:outline-none focus:ring-1 focus:ring-[#030712] text-xs">
    
                <!-- Password Field -->
                <label for="password" class="text-[#030712] text-sm font-medium">Password</label>
                <input type="password" id="password" name="password" placeholder="Password" 
                    class="border rounded-lg p-2 mb-4 focus:outline-none focus:ring-1 focus:ring-[#030712] text-xs">
    
                <!-- Remember Me and Forgot Password -->
                <div class="flex items-center justify-between mb-4">
                    <label class="inline-flex items-center text-[#030712]">
                        <input type="checkbox" class="form-checkbox h-3 w-3 text-[#111827]">
                        <span class="ml-2 text-xs">Remember Me</span>
                    </label>
                    <a href="#" class="text-xs text-[#111827] font-semibold hover:underline">Forgot Password?</a>
                </div>
    
                <!-- Login Button -->
                <button type="submit" class="bg-[#030712] text-white font-semibold py-2 rounded-lg hover:bg-[#111827] transition duration-300 my-3">
                    Login
                </button>
                <hr class="mb-5 mt-4 border-[#37415135]">
    
                <!-- Register Link -->
                <p class="text-xs text-center text-[#030712]">
                    Don't have an account? 
                    <a href="/register" class="text-[#111827] font-semibold hover:underline">Register</a>
                </p>
            </form>
        </div>
    </main>
    
    
    
    
</body>
</html>
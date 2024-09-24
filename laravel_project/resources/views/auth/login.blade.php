@extends('layouts.default')
@section('title', "Login")
@section("content")

<div class="bg-[#4b5563]">
    <main class="flex items-center justify-center min-h-screen bg-[#d1d5db]">
        <div class="bg-[#f3f4f6] w-[350px] rounded-2xl shadow-lg">
            <form action="{{route("login.post")}}" method="POST" class="flex flex-col px-8 py-10 ">
                @csrf
                <h2 class="text-2xl font-bold mb-6 text-center">Login</h2>
                
                <!-- Email Field -->
                <label for="email" class="text-[#030712] text-sm font-medium">Email</label>
                <input type="email" id="email" name="email" placeholder="Email" required
                    class="border rounded-lg p-2 mb-4 focus:outline-none focus:ring-1 focus:ring-[#030712] text-xs">
                    
                    <!----error message--->
                    @if ($errors->has('email'))
                    <span>{{$errors->first('email')}}</span>
                        
                    @endif
    
                <!-- Password Field -->
                <label for="password" class="text-[#030712] text-sm font-medium">Password</label>
                <input type="password" id="password" name="password" placeholder="Password" 
                    class="border rounded-lg p-2 mb-4 focus:outline-none focus:ring-1 focus:ring-[#030712] text-xs">

                    <!----error message--->
                    @if ($errors->has('password'))
                    <span>{{$errors->first('password')}}</span>
                        
                    @endif
    
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
                <hr class="mb-3 mt-2 border-[#37415135]">
    
                <!-- Register Link -->
                <p class="text-xs text-center text-[#030712]">
                    Don't have an account? 
                    <a href="/register" class="text-[#111827] font-semibold hover:underline">Register</a>
                </p>
            </form>
        </div>
    </main>
</div>
@endsection
@extends('layouts.default')
@section('title', "Register")
@section("content")

<div class="bg-[#4b5563]">
    <main class="flex items-center justify-center min-h-screen bg-[#d1d5db]">
            @if(session()->has("success"))
            <div class="col-span-12 border border-green-800 bg-green-400 text-white text-sm p-3 text-center">
                {{session()->get('success')}}
            </div>
            @endif
            @if(session()->has("error"))
            <div class="col-span-12 border border-red-800 bg-red-400 text-white text-sm p-3 text-center">
                {{session()->get('error')}}
            </div>
            @endif
        <div class="bg-[#f3f4f6] w-[350px] rounded-2xl shadow-lg">
            <form action="{{route("register.post")}}" enctype="multipart/form-data" method="POST" class="flex flex-col px-8 py-10">
                @csrf
                <h2 class="text-2xl font-bold mb-6 text-center">Register</h2>

                <div class="relative w-20 h-20 rounded-full overflow-hidden border border-slate-300 self-center mb-3">
                    <label for="avatar" class="absolute inset-0 grid content-end cursor-pointer">
                        <span class="bg-white/50 pb-2 pt-0.5 flex justify-center translate-y-1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="#03071277" class="bi bi-camera-fill text-center" viewBox="0 0 16 16">
                                <path d="M10.5 8.5a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0"/>
                                <path d="M2 4a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2h-1.172a2 2 0 0 1-1.414-.586l-.828-.828A2 2 0 0 0 9.172 2H6.828a2 2 0 0 0-1.414.586l-.828.828A2 2 0 0 1 3.172 4zm.5 2a.5.5 0 1 1 0-1 .5.5 0 0 1 0 1m9 2.5a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0"/>
                            </svg>
                        </span>
                    </label>
                    <input type="file" id="avatar" name="avatar" hidden onchange="previewImage(event)" value="{{ $errors->has('avatar') ? '' : old('avatar') }}"/>
                    <img id="avatarImage" src="{{ asset('storage/avatars/default.png') }}" alt="Placeholder Image" class="rounded-full w-20 h-20 object-cover">
                </div>
                <!----error message--->
                @if ($errors->has('avatar'))
                <span class="mt-1  text-red-700 text-xs font-medium">{{$errors->first('avatar')}}</span>
                    
                @endif
                
    
                <!-- Name Field -->
                <label for="name" class="text-[#030712] text-sm font-medium">Name</label>
                <input type="text" id="name" name="name" placeholder="Full Name" value="{{ $errors->has('name') ? '' : old('name') }}"
                    class="border rounded-lg p-2 focus:outline-none focus:ring-1 focus:ring-[] text-xs">

                    <!----error message--->
                    @if ($errors->has('name'))
                    <span class="mt-1  text-red-700 text-xs font-medium">{{$errors->first('name')}}</span>
                        
                    @endif
    
                <!-- Email Field -->
                <label for="email" class="text-[#030712] text-sm font-medium mt-4">Email</label>
                <input type="email" id="email" name="email" placeholder="Email" value="{{ $errors->has('email') ? '' : old('email') }}"
                    class="border rounded-lg p-2 focus:outline-none focus:ring-1 focus:ring-[#030712] text-xs">

                    <!----error message--->
                    @if ($errors->has('email'))
                    <span class="mt-1  text-red-700 text-xs font-medium">{{$errors->first('email')}}</span>
                        
                    @endif
    
                <!-- Password Field -->
                <label for="password" class="text-[#030712] text-sm font-medium mt-4">Password</label>
                <input type="password" id="password" name="password" placeholder="Password" 
                    class="border rounded-lg p-2 focus:outline-none focus:ring-1 focus:ring-[#030712] text-xs">

                    <!----error message--->
                    @if ($errors->has('password'))
                    <span class="mt-1  text-red-700 text-xs font-medium">{{$errors->first('password')}}</span>
                        
                    @endif
    
                <!-- Confirm Password Field -->
                <!-- Confirm Password Field -->
<label for="password_confirmation" class="text-[#030712] text-sm font-medium mt-4">Confirm Password</label>
<input type="password" id="password_confirmation" name="password_confirmation" placeholder="Confirm Password" 
    class="border rounded-lg p-2 mb-4 focus:outline-none focus:ring-1 focus:ring-[#030712] text-xs">

    
                <!-- Register Button -->
                <button type="submit" class="bg-[#030712] text-white font-semibold py-2 rounded-lg hover:bg-[#111827] transition duration-300 mb-3">
                    Register
                </button>
                <hr class="mb-3 mt-2 border-[#37415135]">
    
                <!-- Login Link -->
                <p class="text-xs text-center text-[#030712]">
                    Already have an account? 
                    <a href="/login" class="text-[#111827] font-semibold hover:underline">Login</a>
                </p>
            </form>
        </div>
    </main>
    <script>
        
    </script>
    
</div>
@endsection
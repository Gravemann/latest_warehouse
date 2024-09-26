<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reset Password</title>
    <link rel="preconnect" href="https://rsms.me/">
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
    <style>
        :root {
            font-family: 'Inter', sans-serif;
        }

        @supports (font-variation-settings: normal) {
            :root {
                font-family: 'Inter var', sans-serif;
            }
        }
    </style>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>


<body class="antialiased bg-black w-full min-h-screen text-slate-300 py-4">
    <div class="max-w-lg mx-auto my-10  p-8 rounded-xl shadow  bg-white/10">
        <h1 class="text-4xl font-medium text-center">Password Reset</h1>
        {{-- <p class="text-slate-500 text-center">Enter your email address</p> --}}
        {{-- @if (session('status'))
            <p class="text-slate-300 text-center">{{ session('status') }}</p>
        @endif --}}
        <form action="{{ route('password.update') }}" method="POST" class="my-10">
            @csrf
            <div class="flex flex-col space-y-5">
                <input  name="token" type="hidden" value="{{ $token }}">
                @error("token")
                    <p class="text-red-500">{{ $message }}</p>
                @enderror
                <label for="email">
                    <p class="font-medium text-slate-300 pb-2">Email address</p>
                    <input id="email" name="email" type="email" class="w-full py-3 border border-slate-200 rounded-lg px-3 focus:outline-none focus:border-slate-500 hover:shadow text-black" value="{{ $email }}">
                    @error("email")
                        <p class="text-red-500">{{ $message }}</p>
                    @enderror
                </label>
                <label for="password">
                    <p class="font-medium text-slate-300 pb-2">Password</p>
                    <input id="password" name="password" type="password" class="w-full py-3 border border-slate-200 rounded-lg px-3 focus:outline-none focus:border-slate-500 hover:shadow text-black" placeholder="Enter email address">
                    @error("password")
                        <p class="text-red-500">{{ $message }}</p>
                    @enderror
                </label>
                <label for="password_confirmation">
                    <p class="font-medium text-slate-300 pb-2">Password confirmation</p>
                    <input id="password_confirmation" name="password_confirmation" type="password" class="w-full py-3 border border-slate-200 rounded-lg px-3 focus:outline-none focus:border-slate-500 hover:shadow text-black" placeholder="Enter email address">
                    @error("password_confirmation")
                        <p class="text-red-500">{{ $message }}</p>
                    @enderror
                </label>
                <button class="w-full py-3 font-medium text-white bg-indigo-600 hover:bg-indigo-500 rounded-lg border-indigo-500 hover:shadow inline-flex space-x-2 items-center justify-center">                      
                    <span>Reset</span>
                </button>
            </div>
        </form>
    </div>
</body>
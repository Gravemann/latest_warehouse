<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>
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
        <h1 class="text-4xl font-medium text-center">Register your account</h1>
        <form action="{{ route('register') }}" method="POST" class="my-10">
            @csrf
            <div class="flex flex-col space-y-5">
                <label for="name">
                    <p class="font-medium text-slate-300 pb-2">Name</p>
                    <input id="name" name="name" type="text" class="w-full py-3 border border-slate-200 rounded-lg px-3 focus:outline-none focus:border-slate-500 hover:shadow text-black" placeholder="Enter your name">
                    @error('name')
                        <p class="text-red-500">{{ $message }}</p>
                    @enderror
                </label>
                <label for="email">
                    <p class="font-medium text-slate-300 pb-2">Email address</p>
                    <input id="email" name="email" type="email" class="w-full py-3 border border-slate-200 rounded-lg px-3 focus:outline-none focus:border-slate-500 hover:shadow text-black" placeholder="Enter email address">
                    @error('email')
                        <p class="text-red-500">{{ $message }}</p>
                    @enderror
                </label>
                <label for="password">
                    <p class="font-medium text-slate-300 pb-2">Password</p>
                    <input id="password" name="password" type="password" class="w-full py-3 border border-slate-200 rounded-lg px-3 focus:outline-none focus:border-slate-500 hover:shadow text-black" placeholder="Enter your password">
                    @error('password')
                        <p class="text-red-500">{{ $message }}</p>
                    @enderror
                </label>
                <label for="password_confirmation">
                    <p class="font-medium text-slate-300 pb-2">Confirm password</p>
                    <input id="password_confirmation" name="password_confirmation" type="password" class="w-full py-3 border border-slate-200 rounded-lg px-3 focus:outline-none focus:border-slate-500 hover:shadow text-black" placeholder="Re-enter your password">
                    @error('password_confirmation')
                        <p class="text-red-500">{{ $message }}</p>
                    @enderror
                </label>
                <button class="w-full py-3 font-medium text-white bg-indigo-600 hover:bg-indigo-500 rounded-lg border-indigo-500 hover:shadow inline-flex space-x-2 items-center justify-center">
                      <span>Register</span>
                </button>
                <p class="text-center">Already have an account? <a href="{{ route('login.view') }}" class="text-indigo-600 font-medium inline-flex space-x-1 items-center"><span>Sign in </span><span><svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                  </svg></span></a></p>
            </div>
        </form>
    </div>
    
</body>

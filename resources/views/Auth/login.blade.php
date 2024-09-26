<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
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
        <h1 class="text-4xl font-medium text-center">Login</h1>
        <p class="text-slate-500 text-center">Sign in your account</p>

        <div class="my-5">
            <button class="w-full text-center py-3 my-3 border flex space-x-2 items-center justify-center border-slate-200 rounded-lg text-slate-300 hover:bg-indigo-600 hover:border-none hover:shadow transition duration-150">
                <img src="https://www.svgrepo.com/show/355037/google.svg" class="w-6 h-6" alt=""> <span>Login with Google</span>
            </button>
        </div>
        @if (session('status'))
            <p class="text-green-600 text-center">{{ session('status') }}</p>
        @endif
        @error('fail')
            <p class="text-red-500 text-center">{{ $message }}</p>
        @enderror
        <form action="{{ route('login') }}" method="POST" class="my-10">
            @csrf
            <div class="flex flex-col space-y-5">
                <label for="email">
                    <p class="font-medium text-slate-300 pb-2">Email address</p>
                    <input id="email" name="email" type="email" class="w-full py-3 border border-slate-200 rounded-lg px-3 focus:outline-none focus:border-slate-500 hover:shadow text-black" placeholder="Enter email address">
                    @error("email")
                        <p class="text-red-500">{{ $message }}</p>
                    @enderror
                </label>
                <label for="password">
                    <p class="font-medium text-slate-300 pb-2">Password</p>
                    <input id="password" name="password" type="password" class="w-full py-3 border border-slate-200 rounded-lg px-3 focus:outline-none focus:border-slate-500 hover:shadow text-black" placeholder="Enter your password">
                    @error("password")
                        <p class="text-red-500">{{ $message }}</p>
                    @enderror
                </label>
                <div class="flex flex-row justify-between">
                    <div>
                        <label for="remember" class="">
                            <input type="checkbox" name="remember" class="w-4 h-4 border-slate-200 focus:bg-indigo-600">
                            Remember me
                        </label>
                    </div>
                    <div>
                        <a href="{{ route('password.request') }}" class="font-medium text-indigo-600">Forgot Password?</a>
                    </div>
                </div>
                <button class="w-full py-3 font-medium text-white bg-indigo-600 hover:bg-indigo-500 rounded-lg border-indigo-500 hover:shadow inline-flex space-x-2 items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15m3 0l3-3m0 0l-3-3m3 3H9" />
                      </svg>                      
                      <span>Login</span>
                </button>
                <p class="text-center">Not registered yet? <a href="{{ route('register.view') }}" class="text-indigo-600 font-medium inline-flex space-x-1 items-center"><span>Register now </span><span><svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                  </svg></span></a></p>
            </div>
        </form>
    </div>
    
</body>
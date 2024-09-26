@include('include.header')

<body class="antialiased bg-black w-full min-h-screen text-slate-300 py-4">
    <div class="max-w-lg mx-auto my-10 bg-white/10 p-8 rounded-xl shadow">
        <h1 class="text-4xl font-medium text-center">Verification success</h1>
        <p class="text-indigo-400 text-center">{{ session('email') }}</p>
        <p class="text-slate-500 text-center pb-3">has been successfully confirmed. Now you can sign-in</p>
            <div class="flex flex-col space-y-5">
                <a href="{{ route('login') }}" class="w-full py-3 font-medium text-white bg-indigo-600 hover:bg-indigo-500 rounded-lg border-indigo-500 hover:shadow inline-flex space-x-2 items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                      </svg>
                      <span>Sing in</span>
                </a>
            </div>
    </div>
</body>
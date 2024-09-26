@include('include.header')

<body class="antialiased bg-black w-full min-h-screen text-slate-300 py-4">
    <div class="max-w-lg mx-auto my-10 bg-white/10 p-8 rounded-xl shadow">
        @if (! session('message'))
            <h1 class="text-4xl font-medium text-center">Verification mail sent</h1>
        @endif
        <h1 class="text-4xl font-medium text-center">{{ session('message') }}</h1>
        <p class="text-slate-500 text-center">
            A confirmation mail @if (! session('email'))has already been sent @else has been sent to @endif 
        </p>
        @if (session('email'))
            <p class="text-indigo-400 text-center">{{ session('email') }}</p> 
        @endif
        
        <p class="text-slate-500 text-center pb-3">Check your email and click on the confirmation link to proceed</p>
            <div class="flex flex-col space-y-5">
                <form action="{{ route('verification.send') }}" method="POST" >
                    @csrf
                    <button class="w-full py-3 font-medium text-white bg-indigo-600 hover:bg-indigo-500 rounded-lg border-indigo-500 hover:shadow inline-flex space-x-2 items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                          </svg>                      
                          <span>Resend</span>
                    </button>
                </form>
                <a href="{{ route('logout') }}" class="w-full py-3 font-medium text-white bg-indigo-600 hover:bg-indigo-500 rounded-lg border-indigo-500 hover:shadow inline-flex space-x-2 items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75" />
                      </svg>                      
                      <span>Logout</span>
                </a>
            </div>
    </div>
    
</body>
<div id="menu" class="bg-white/10 col-span-3 rounded-lg p-4">
    <h1 class="font-bold text-lg lg:text-3xl bg-gradient-to-br from-white via-white/50 to-transparent bg-clip-text text-transparent">Watch Warehouse<span class="text-indigo-400">.</span></h1>
    <p class="text-slate-400 text-sm mb-2">Welcome back,</p>
    <div class="flex justify-between">
        <a href="#" class="flex flex-col space-y-2 md:space-y-0 md:flex-row mb-5 items-center md:space-x-1 hover:bg-white/10 group transition duration-150 ease-linear rounded-lg group w-full py-3 px-2">
            <div>
                {{-- <img class="rounded-full w-10 h-10 relative object-cover" src="https://img.freepik.com/free-photo/no-problem-concept-bearded-man-makes-okay-gesture-has-everything-control-all-fine-gesture-wears-spectacles-jumper-poses-against-pink-wall-says-i-got-this-guarantees-something_273609-42817.jpg?w=1800&t=st=1669749937~exp=1669750537~hmac=4c5ab249387d44d91df18065e1e33956daab805bee4638c7fdbf83c73d62f125" alt=""> --}}
                {!! auth()->user()->profile_image->image_svg !!}
            </div>
            <div>
                <p class="font-medium group-hover:text-indigo-400 leading-4">{{ auth()->user()->name }}</p>
                <span class="text-xs text-slate-400">{{ auth()->user()->email }}</span>
            </div>
        </a>
        <a href="{{ route('logout') }}" class="flex flex-col space-y-2 md:space-y-0 md:flex-row mb-5 items-center md:space-x-2 group transition duration-150 ease-linear rounded-lg w-fit hover:text-indigo-400" title="Logout">
            <component-logout></component-logout>
        </a>
    </div>
    <hr class="my-2 border-slate-700">
    <div id="menu" class="flex flex-col space-y-2 my-5">
        <a href="{{ route('brands.main') }}" class="hover:bg-white/10 transition duration-150 ease-linear rounded-lg py-3 px-2 group">
            <div class="relative flex flex-col space-y-2 md:flex-row md:space-y-0 space-x-2 items-center">
                <div>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 group-hover:text-indigo-400">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9.568 3H5.25A2.25 2.25 0 003 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 005.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 009.568 3z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 6h.008v.008H6V6z" />
                      </svg>   

                </div>
                <div>
                    <p class="font-bold text-base lg:text-lg text-slate-200 leading-4 group-hover:text-indigo-400">Brands</p>
                <p class="text-slate-400 text-sm hidden md:block">Brands overview</p>
                </div>
                {{-- <div class="absolute -top-3 -right-3 md:top-0 md:right-0 px-2 py-1.5 rounded-full bg-indigo-800 text-xs font-mono font-bold">{{ $brands->count() }}</div> --}}

            </div>
        </a>
        <a href="{{ route('products.main') }}" class="hover:bg-white/10 transition duration-150 ease-linear rounded-lg py-3 px-2 group">
            <div class="relative flex flex-col space-y-2 md:flex-row md:space-y-0 space-x-2 items-center">
                <div>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 group-hover:text-indigo-400">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 11.25v8.25a1.5 1.5 0 01-1.5 1.5H5.25a1.5 1.5 0 01-1.5-1.5v-8.25M12 4.875A2.625 2.625 0 109.375 7.5H12m0-2.625V7.5m0-2.625A2.625 2.625 0 1114.625 7.5H12m0 0V21m-8.625-9.75h18c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125h-18c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z" />
                      </svg> 

                </div>
                <div>
                    <p class="font-bold text-base lg:text-lg text-slate-200 leading-4 group-hover:text-indigo-400">Products</p>
                <p class="text-slate-400 text-sm hidden md:block">Manage products</p>
                </div>
                {{-- <div class="absolute -top-3 -right-3 md:top-0 md:right-0 px-2 py-1.5 rounded-full bg-indigo-800 text-xs font-mono font-bold">23</div> --}}

            </div>
        </a>
        <a href="{{ route('clients.main') }}" class="hover:bg-white/10 transition duration-150 ease-linear rounded-lg py-3 px-2 group">
            <div class="flex flex-col space-y-2 md:flex-row md:space-y-0 space-x-2 items-center">
                <div>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 group-hover:text-indigo-400">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                      </svg>  

                </div>
                <div>
                    <p class="font-bold text-base lg:text-lg text-slate-200 leading-4 group-hover:text-indigo-400">Clients</p>
                <p class="text-slate-400 text-sm hidden md:block">Know you clients</p>
                </div>
                
            </div>
        </a>
        <a href="{{ route('orders.main') }}" class="hover:bg-white/10 transition duration-150 ease-linear rounded-lg py-3 px-2 group">
            <div class="flex flex-col space-y-2 md:flex-row md:space-y-0 space-x-2 items-center">
                <div>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 group-hover:text-indigo-400">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
                      </svg>
                        
                </div>
                <div>
                    <p class="font-bold text-base lg:text-lg text-slate-200 leading-4 group-hover:text-indigo-400">Orders</p>
                <p class="text-slate-400 text-sm hidden md:block">List of your orders</p>
                </div>
                
            </div>
        </a>
    </div>
    <p class="text-sm text-center text-gray-600"> &copy; 2023 Timur Golubev</p>
</div>
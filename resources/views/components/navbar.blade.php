<nav class="sm:ml-64 flex justify-end items-center shadow-2xl min-h-[60px] px-5 md:px-20 gap-3">
    <div class="flex items-center gap-3">
        <div class="flex flex-col items-end">
            <span>{{ Auth::user()->name }}</span>
            <span class="text-sm font-bold text-blue-green">{{ Auth::user()->profile->label() }}</span>
        </div>
        <div class="icon-profile">
            <span class="rounded-full text-blue-green p-3 font-bold border-2 border-blue-green">JD</span>
        </div>
    </div>
    <button data-drawer-target="default-sidebar" data-drawer-toggle="default-sidebar" aria-controls="default-sidebar"
            type="button"
            class="border-2 p-2 border-blue-green rounded-md sm:hidden ">
        <span class="sr-only">Open sidebar</span>
        <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
            <path clip-rule="evenodd" fill-rule="evenodd"
                  d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"></path>
        </svg>
    </button>
</nav>
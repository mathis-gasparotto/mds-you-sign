<nav x-data="{ open: true }" class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
    <!-- Primary Navigation Menu -->
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight ">
            {{ __('Utilisateur') }}
        </h2>
    </x-slot>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->



                <!-- Navigation Links -->
                @if(session()->get('role') == 'admin')
                <div class=" space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link :href="route('list-account')" :active="request()->routeIs('list-account')">
                        {{ __('Liste') }}
                    </x-nav-link>
                </div>

                    <div class=" space-x-8 sm:-my-px sm:ml-10 sm:flex">
                        <x-nav-link :href="route('register-account')" :active="request()->routeIs('register-account')">
                            {{ __(" Création") }}
                        </x-nav-link>
                    </div>

                @endif

            </div>
        </div>
    </div>
</nav>

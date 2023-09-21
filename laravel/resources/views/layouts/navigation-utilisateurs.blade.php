<nav x-data="{ open: false }" class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->



                <!-- Navigation Links -->
                @if(session()->get('role') == 'admin')
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link :href="route('list-account')" :active="request()->routeIs('list-account')">
                        {{ __('Liste') }}
                    </x-nav-link>
                </div>

                    <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                        <x-nav-link :href="route('register-account')" :active="request()->routeIs('register-account')">
                            {{ __(" Création") }}
                        </x-nav-link>
                    </div>

                @endif
            </div>
        </div>
    </div>
</nav>

@if(session()->get('role') == 'admin')
    <form method="POST" action="{{ route('register-account-qR7sT2xY8wP5vA1iB9eD3') }}" style="padding: 5px 5px;">
        @csrf

        <!-- first_name -->
        <div>
            <x-input-label for="first_name" :value="__('Prénom')" />
            <x-text-input id="first_name" class="block mt-1 w-full" type="text" name="first_name"  required autofocus autocomplete="first_name" />
            <x-input-error :messages="$errors->get('first_name')" class="mt-2" />
        </div>
        <!-- last_name -->
        <div>
            <x-input-label for="last_name" :value="__('Nom')" />
            <x-text-input id="last_name" class="block mt-1 w-full" type="text" name="last_name"  required autofocus autocomplete="last_name" />
            <x-input-error :messages="$errors->get('last_name')" class="mt-2" />
        </div>
        <!-- role -->
        <div>
        <x-input-label for="role" :value="__('Role')" />
            <select name="role" id="role" class="border-gray-300 dark:border-gray-700 block mt-1 w-full dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                <option disabled selected value="" > Selectioner une option</option>
                <option value="admin">Admin</option>
                <option value="teacher">Professeur</option>
                <option value="student">Étudiant</option>
            </select>
        <x-input-error :messages="$errors->get('role')" class="mt-2" />
        </div>


        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email"  required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Mot de passe')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password"

            />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirmation du Mot de passe')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">


            <x-primary-button class="ml-4">
                {{ __('Creer un compte') }}
            </x-primary-button>
        </div>
    </form>
@else
<div>
   HTTP 401 : Création de comptes non autorisés
</div>
@endif

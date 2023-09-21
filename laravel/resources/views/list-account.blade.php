<x-app-layout>
    @include('layouts.navigation-utilisateurs')


    <div class="w-full py-10 sm:px-12 px-3">
        <table class="w-full text-white ">
            <thead>
            <tr class="text-left">
                <th class="text-left">Nom</th>
                <th class="text-left">Email</th>
                <th class="text-left">Statut</th>
                <th class="text-center">Action</th>
            </tr>
            </thead>

            @foreach( $users as $user)
                @php
                     $showModalUserDelete = $errors->userDeletion->isNotEmpty() &&  old('id') == $user->id;
                     $showModalUserUpdate = $errors->userUpdate->isNotEmpty() &&  old('id') == $user->id;
                @endphp
                <tbody>
                <tr class="text-left">
                    <td class="text-left">
                        {{$user->first_name}} <br>{{$user->last_name}}
                    </td>
                    <td class="text-left py-5">{{$user->email}} </td>
                    <td>
                        @if($user->role === 'student')
                            Élève
                        @else
                            Professeur
                        @endif
                    </td>
                    <td class="text-center">

                       <button >

                            <x-danger-button
                                x-data=""
                                x-on:click.prevent="$dispatch('open-modal', 'confirm-user-update-{{$user->id}}')"
                            >
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                </svg>
                            </x-danger-button>
                            <x-modal name="confirm-user-update-{{$user->id}}" :show="$showModalUserUpdate" focusable>
                                <div class="p-3">
                                <header>
                                    <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                        {{ __('Informations du profile') }}
                                    </h2>

                                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                        {{ __("Mettez à jour les informations de profil et les adresses e-mail de votre compte.") }}
                                    </p>
                                </header>


                                <form method="post" action="{{ route('list-account.update') }}" class="mt-6 space-y-6">
                                    @csrf
                                    @method('patch')

                                    <div>

                                        <x-text-input id="id" name="id" type="text" class="mt-1 block w-full hidden" :value="old('id', $user->id)" required autofocus autocomplete="name" />
                                        <x-input-label for="first_name" :value="__('Prénom')" />
                                        <x-text-input id="first_name" name="first_name" type="text" class="mt-1 block w-full" :value="old('first_name', $user->first_name)" required autofocus autocomplete="first_name" />
                                        <x-input-error class="mt-2" :messages="$errors->get('first_name')" />
                                       </div>
                                    <div>
                                        <x-input-label for="last_name" :value="__('Nom')" />
                                        <x-text-input id="last_name" name="last_name" type="text" class="mt-1 block w-full" :value="old('last_name', $user->last_name)" required autofocus autocomplete="last_name" />
                                        <x-input-error class="mt-2" :messages="$errors->get('last_name')" />
                                    </div>
                                    <div>
                                        <x-input-label for="email" :value="__('Email')" />
                                        <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="email" />
                                        <x-input-error class="mt-2" :messages="$errors->get('email')" />
                                    </div>
                                    <div>
                                        <x-input-label for="role" :value="__('Role')" />
                                        <select name="role" id="role" class="border-gray-300 dark:border-gray-700 block mt-1 w-full dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                                            <option value="student" {{ $user->role == 'student' ? 'selected' : '' }}>Étudiant</option>
                                            <option value="teacher" {{ $user->role == 'teacher' ? 'selected' : '' }}>Professeur</option>
                                            <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                                        </select>
                                        <x-input-error :messages="$errors->get('role')" class="mt-2" />
                                    </div>
                                    <div>
                                        <x-input-label for="classe_id" :value="__('Classe')" />
                                        <select name="classe_id" id="classe_id" class="border-gray-300 dark:border-gray-700 block mt-1 w-full dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">@
                                            @foreach($classes as $classe)
                                                <option value="{{$classe->id}}" {{ $classe->id == $user->classe_id ? 'selected' : '' }}>
                                                    {{$classe->name}}
                                                </option>
                                            @endforeach
                                        </select>
                                        <x-input-error :messages="$errors->get('role')" class="mt-2" />
                                    </div>



                                    <div class="flex items-center gap-4">
                                        <x-primary-button>{{ __('Enregistrer') }}</x-primary-button>

                                        @if (session('status') === 'profile-updated')
                                            <p
                                                x-data="{ show: true }"
                                                x-show="show"
                                                x-transition
                                                x-init="setTimeout(() => show = false, 2000)"
                                                class="text-sm text-gray-600 dark:text-gray-400"
                                            >{{ __('Enregistré.') }}</p>
                                        @endif
                                    </div>
                                </form>
                                </div>
                            </x-modal>
                        </button>
                        <button>
                                <x-danger-button
                                    x-data=""
                                    x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion-{{$user->id}}')"
                                > <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                                        <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z"/>
                                    </svg></x-danger-button>
                                <x-modal name="confirm-user-deletion-{{$user->id}}"  :show="$showModalUserDelete" focusable>

                                    <form method="post" action="{{ route('list-account.destroy') }}" class="p-6">
                                        @csrf
                                        @method('delete')
                                        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                            {{ __('Êtes-vous sûr de vouloir supprimer votre compte?') }}
                                        </h2>

                                        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                            {{ __('Une fois votre compte supprimé, toutes ses ressources et données seront définitivement supprimées. Veuillez saisir votre mot de passe pour confirmer que vous souhaitez supprimer définitivement votre compte.') }}
                                        </p>
                                        <div class="mt-6">
                                            <x-input-label for="password" value="{{ __('Mot de Passe') }}" class="sr-only" />

                                            <x-text-input
                                                id="password"
                                                name="password"
                                                type="password"
                                                class="mt-1 block w-3/4"
                                                placeholder="{{ __('Mot de Passe') }}"
                                            />

                                            <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
                                            <x-text-input
                                                id="id"
                                                name="id"
                                                type="text"
                                                class="mt-1 block w-3/4 hidden"
                                                placeholder="{{ __('id') }}"
                                                value="{{$user->id}}"
                                            />
                                        </div>

                                        <div class="mt-6 flex justify-end">
                                            <x-secondary-button x-on:click="$dispatch('close')">
                                                {{ __('Annuler') }}
                                            </x-secondary-button>

                                            <x-danger-button class="ml-3">
                                                {{ __('Supprimer le compte') }}
                                            </x-danger-button>
                                        </div>
                                    </form>
                                </x-modal>
                        </button>
                    </td>
                </tr>
                </tbody>
            @endforeach

        </table>

    </div>
</x-app-layout>

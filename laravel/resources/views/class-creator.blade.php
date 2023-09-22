<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight ">
            {{ __('Classes') }}
        </h2>
    </x-slot>
    <div class="w-full py-6 sm:px-12 px-3">
        <div class="text-center w-full pb-6">
        <button class="w-full">
            <x-warning-button
                x-data=""
                class=" "
                x-on:click.prevent="$dispatch('open-modal', 'confirm-class-create')"
            >
                <p class="text-center">
               Créer une classe
                </p>
            </x-warning-button>
            <x-modal name="confirm-class-create" :show="$errors->classeCreation->isNotEmpty()" focusable>
                <div class="p-3">
                    <header>
                        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                            {{ __('Créer une classe') }}
                        </h2>
                    </header>
                    <form method="post" action="{{ route('class-creator.create') }}" class="mt-6 space-y-6">
                        @csrf
                        @method('put')

                        <div>
                            <x-input-label for="name" :value="__('Nom')" />
                            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full"   required autofocus autocomplete="name" />
                            <x-input-error class="mt-2" :messages="$errors->get('name')" />
                        </div>
                        <div>
                            <x-text-input
                                id="password"
                                name="password"
                                type="password"
                                class="mt-1 block w-full"
                                placeholder="{{ __('Mot de Passe') }}"
                            />
                            <x-input-error :messages="$errors->classeCreation->get('password')" class="mt-2" />
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
        </div>
        <table class="w-full text-white ">
            <thead>
            <tr class="text-center">
                <th class="text-left">Nom</th>
                <th class="text-left">Date de création</th>
                <th class="text-left">Date de MAJ</th>
                <th class="text-center">Action</th>
            </tr>
            </thead>
            @foreach( $classes as $classe)
                @php
                    print(request('id',''));
                    $showModalClasseDelete = $errors->userDeletion->isNotEmpty() &&  old('id') == $classe->id;
                     $showModalClasseUpdate = $errors->classeDeletion->isNotEmpty() &&  old('id') == $classe->id;
                @endphp
                <tbody class="py-12">
                <tr class="text-left py-">
                    <td class="text-left">
                        {{$classe->name}}
                    </td>
                    <td class="text-ledt py-5">
                        {{$classe->created_at}}
                    </td>
                    <td class="text-ledt py-5">
                        {{$classe->updated_at}}
                    </td>
                    <td class="text-center py-5">
                        <button>
                            <x-warning-button
                                x-data=""
                                x-on:click.prevent="$dispatch('open-modal', 'confirm-class-update-{{$classe->id}}')"
                            >
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                </svg>
                            </x-warning-button>
                            <x-modal name="confirm-class-update-{{$classe->id}}" :show="$showModalClasseUpdate" focusable>
                               <div class="p-3">
                                <header>
                                    <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                        {{ __('Informations la classe') }}
                                    </h2>

                                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                        {{ __("Mettez à jour les informations de la classe ") }}
                                    </p>
                                </header>
                                <form method="post" action="{{ route('class-creator.update') }}"  class="mt-6 space-y-6">
                                    @csrf
                                    @method('patch')
                                    <div>
                                        <x-input-label for="name" :value="__('Nom')" />
                                        <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $classe->name)" required autofocus autocomplete="name" />
                                        <x-text-input id="id" name="id" type="text" class="mt-1 block w-full hidden" :value="old('id', $classe->id)" required autofocus autocomplete="name" />
                                        <x-input-error class="mt-2" :messages="$errors->get('name')" />
                                    </div>
                                    <div>
                                        <x-text-input
                                            id="password"
                                            name="password"
                                            type="password"
                                            class="mt-1 block w-full"
                                            placeholder="{{ __('Mot de Passe') }}"
                                        />
                                        <x-input-error :messages="$errors->classeDeletion->get('password')" class="mt-2" />
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
                                x-on:click.prevent="$dispatch('open-modal', 'confirm-classe-deletion-{{$classe->id}}')"
                            > <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                                    <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z"/>
                                </svg></x-danger-button>
                            <x-modal name="confirm-classe-deletion-{{$classe->id}}" :show="$showModalClasseDelete" focusable>
                                <form method="post" action="{{ route('class-creator.destroy') }}" class="p-6">
                                    @csrf
                                    @method('delete')

                                    <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                        {{ __('Êtes-vous sûr de vouloir supprimer cette classe?') }}
                                    </h2>

                                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                        {{ __('Une fois la classe supprimée, toutes ses ressources et dépendances seront définitivement supprimées. Veuillez saisir votre mot de passe pour confirmer que vous souhaitez supprimer définitivement cette classe.') }}
                                    </p>

                                    <div class="mt-6">
                                        <x-input-label for="password" value="{{ __('Password') }}" class="sr-only" />

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
                                            value="{{$classe->id}}"
                                        />
                                    </div>
                                    <div class="mt-6 flex justify-end">
                                        <x-secondary-button x-on:click="$dispatch('close')">
                                            {{ __('Annuler') }}
                                        </x-secondary-button>

                                        <x-danger-button class="ml-3">
                                            {{ __('Supprimer la classe') }}
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

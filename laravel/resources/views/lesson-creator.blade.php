<x-app-layout>
    <div class="w-full py-10 sm:px-12 px-3">
        <div class="text-center w-full pb-6">
        <button class="w-full">
            <x-danger-button
                x-data=""
                class=" "
                x-on:click.prevent="$dispatch('open-modal', 'confirm-class-create')"
            >
                <p class="text-center">
                    Creer une lesson
                </p>
            </x-danger-button>
            <x-modal name="confirm-class-create" :show="$errors->lessonCreation->isNotEmpty()" focusable>
                <div class="p-3">
                    <header>
                        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                            {{ __('Creer une lesson') }}
                        </h2>
                    </header>
                    <form method="post" action="{{ route('lesson-creator.create') }}" class="mt-6 space-y-6">
                        @csrf
                        @method('put')

                        <div>
                            <x-input-label for="label" :value="__('Label')" />
                            <x-text-input id="label" name="label" type="text" class="mt-1 block w-full"  required autofocus autocomplete="label" />
                            <x-input-error class="mt-2" :messages="$errors->get('label')" />
                        </div>
                        <div>
                            <x-input-label for="start_at" :value="__('Début')" />
                            <x-text-input id="start_at" name="start_at" type="date" class="mt-1 block w-full"  required autofocus autocomplete="start_at" />
                            <x-input-error class="mt-2" :messages="$errors->get('start_at')" />
                        </div>
                        <div>
                            <x-input-label for="end_at" :value="__('Fin')" />
                            <x-text-input id="end_at" name="end_at" type="date" class="mt-1 block w-full" required autofocus autocomplete="end_at" />
                            <x-input-error class="mt-2" :messages="$errors->get('end_at')" />
                        </div>
                        <div>
                            <x-input-label for="room" :value="__('Salle de classe')" />
                            <x-text-input id="room" name="room" type="text" class="mt-1 block w-full"  required autofocus autocomplete="room" />
                            <x-input-error class="mt-2" :messages="$errors->get('room')" />
                        </div>
                        <div>
                            <x-input-label for="user_id" :value="__('Professeur')" />
                            <select name="user_id" id="user_id" class="border-gray-300 dark:border-gray-700 block mt-1 w-full dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                                <option disabled selected > Selectioner une option</option>
                                @foreach($teachers as $teacher)
                                    <option value="{{$teacher->id}}">
                                        {{$teacher->first_name}}&nbsp;{{$teacher->last_name}}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->lessonCreation->get('user_id')" class="mt-2" />
                        </div>
                        <div>
                            <x-text-input
                                id="password"
                                name="password"
                                type="password"
                                class="mt-1 block w-full"
                                placeholder="{{ __('Mot de Passe') }}"
                            />
                            <x-input-error :messages="$errors->lessonCreation->get('password')" class="mt-2" />
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
                <th class="text-left">Label de Cours</th>
                <th class="text-left">Date</th>
                <th class="text-left">Salle</th>
                <th class="text-left">Professeur</th>
                <th class="text-center">Action</th>
            </tr>
            </thead>
            @foreach( $lessons as $lesson)
                @php
                    $showModalLesson = $errors->lessonUpdate->isNotEmpty() &&  old('id') == $lesson->id;
                     $showModalLessonDelete = $errors->userDeletion->isNotEmpty() &&  old('id') == $lesson->id;
                @endphp

                <tbody class="py-12">
                <tr class="text-left py-">
                    <td class="text-left">
                        {{$lesson->label}}

                    </td>
                    <td class="text-ledt py-5">
                        de {{$lesson->start_at}} à {{$lesson->end_at}}
                    </td>
                    <td class="text-ledt py-5">
                        {{$lesson->room}}
                    </td>
                    <td class="text-ledt py-5">
                       {{$lesson->teacher->first_name}} &nbsp; {{$lesson->teacher->last_name}}
                    </td>
                    <td class="text-center py-5">
                        <button>
                            <x-danger-button
                                x-data=""
                                x-on:click.prevent="$dispatch('open-modal', 'confirm-lesson-update-{{$lesson->id}}')"
                            >
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                </svg>
                            </x-danger-button>
                            <x-modal name="confirm-lesson-update-{{$lesson->id}}" :show="$showModalLesson" focusable>
                                <div class="p-3">
                                    <header>
                                        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                            {{ __('Informations la lesson') }}
                                        </h2>

                                        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                            {{ __("Mettez à jour les informations de la lesson ") }}
                                        </p>
                                    </header>
                                    <form method="post" action="{{ route('lesson-creator.update') }}"  class="mt-6 space-y-6">
                                        @csrf
                                        @method('patch')
                                        <div>
                                            <x-input-label for="label" :value="__('Label')" />
                                            <x-text-input id="label" name="label" type="text" class="mt-1 block w-full" :value="old('name', $lesson->label)" required autofocus autocomplete="label" />
                                            <x-input-error class="mt-2" :messages="$errors->get('label')" />
                                            <x-text-input id="id" name="id" type="text" class="mt-1 block w-full hidden" :value="old('id', $lesson->id)" required autofocus autocomplete="id" />
                                        </div>
                                        <div>
                                            <x-input-label for="start_at" :value="__('Début')" />
                                            <x-text-input id="start_at" name="start_at" type="date" class="mt-1 block w-full" :value="old('start_at', $lesson->start_at)" required autofocus autocomplete="start_at" />
                                            <x-input-error class="mt-2" :messages="$errors->get('start_at')" />
                                        </div>
                                        <div>
                                            <x-input-label for="end_at" :value="__('Fin')" />
                                            <x-text-input id="end_at" name="end_at" type="date" class="mt-1 block w-full" :value="old('end_at', $lesson->end_at)" required autofocus autocomplete="end_at" />
                                            <x-input-error class="mt-2" :messages="$errors->get('end_at')" />
                                        </div>
                                        <div>
                                            <x-input-label for="room" :value="__('Salle de classe')" />
                                            <x-text-input id="room" name="room" type="text" class="mt-1 block w-full" :value="old('room', $lesson->room)" required autofocus autocomplete="room" />
                                            <x-input-error class="mt-2" :messages="$errors->get('room')" />
                                        </div>
                                        <div>
                                            <x-input-label for="user_id" :value="__('Professeur')" />
                                            <select required name="user_id"  id="user_id" class="border-gray-300 dark:border-gray-700 block mt-1 w-full dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">

                                                @foreach($teachers as $teacher)
                                                    <option value="{{$teacher->id}}" {{ $teacher->id == $lesson->teacher->id ? 'selected' : '' }}>
                                                        {{$teacher->first_name}}&nbsp;{{$teacher->last_name}}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div>
                                            <x-input-label for="classe_id" :value="__('Classe associée')" />
                                            <select name="classe_id" id="classe_id" class="border-gray-300 dark:border-gray-700 block mt-1 w-full dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">@
                                                @foreach($classes as $classe)
                                                    <option value="{{$classe->id}}"
{{--                                                        {{ $classe->id == $user->classe_id ? 'selected' : '' }}--}}
                                                    >
                                                        {{$classe->name}}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div>
                                            <x-text-input
                                                id="password"
                                                name="password"
                                                type="password"
                                                class="mt-1 block w-full"
                                                placeholder="{{ __('Mot de Passe') }}"
                                            />
                                            <x-input-error :messages="$errors->lessonUpdate->get('password')" class="mt-2" />
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
                                x-on:click.prevent="$dispatch('open-modal', 'confirm-lesson-deletion-{{$lesson->id}}')"
                            > <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                                    <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z"/>
                                </svg></x-danger-button>
                            <x-modal name="confirm-lesson-deletion-{{$lesson->id}}" :show="$showModalLessonDelete" focusable>
                                <form method="post" action="{{ route('lesson-creator.destroy') }}" class="p-6">
                                    @csrf
                                    @method('delete')

                                    <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                        {{ __('Êtes-vous sûr de vouloir supprimer cette lesson?') }}
                                    </h2>

                                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                        {{ __('Une fois la lesson supprimée, toutes ses ressources et dépendances seront définitivement supprimées. Veuillez saisir votre mot de passe pour confirmer que vous souhaitez supprimer définitivement cette lesson.') }}
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
                                            value="{{$lesson->id}}"
                                        />
                                    </div>

                                    <div class="mt-6 flex justify-end">
                                        <x-secondary-button x-on:click="$dispatch('close')">
                                            {{ __('Annuler') }}
                                        </x-secondary-button>

                                        <x-danger-button class="ml-3">
                                            {{ __('Supprimer la lesson') }}
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

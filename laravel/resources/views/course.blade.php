<x-app-layout>
    @if(  $users->count() > 0)
    <x-slot name="header">


        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ $users[0]->lesson->label }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <div>

                        <div class="w-full py-10">
                            <button >

                                <x-danger-button
                                    x-data=""
                                    x-on:click.prevent="$dispatch('open-modal', 'confirm-qr-generate')"
                                >
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                        <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                        <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                    </svg>
                                </x-danger-button>
                                <x-modal name="confirm-qr-generate" focusable>
                                    <div class="p-3">
                                        <header>
                                            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                                {{ __('Code QR') }}&nbsp;{{ $users[0]->lesson->label }}
                                            </h2>

                                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                                {{ $users[0]->lesson->start_at }} <br>
                                                {{ $users[0]->lesson->start_at }} - {{ $users[0]->lesson->end_at }}
                                            </p>
                                        </header>
                                        {{$qrcode}}
                                    </div>
                                </x-modal>
                            </button>
                            <table class="w-full">
                                <thead>
                                <tr class="text-left">
                                    <th class="text-left">Nom</th>
                                    <th class="text-left">Email</th>
                                    <th class="text-left">Statut</th>
                                </tr>
                                </thead>

                                @foreach( $users as $user)
                                    <tbody>
                                    <tr class="text-left">
                                        <th class="text-left">
                                            {{$user->user->first_name}} - {{$user->user->last_name}}
                                            <br>
                                            @if($user->signed == true)
                                                Signé le {{$user->updated_at}}
                                            @else
                                                Non Signé
                                            @endif
                                        </th>
                                        <td class="text-left py-5">{{$user->user->email}} </td>
                                        <td class="text-left">  @if($user->signed == true)
                                                Présent
                                            @else
                                                Absent
                                            @endif
                                        </td>
                                    </tr>
                                    </tbody>
                                @endforeach

                            </table>

                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
    @endif
</x-app-layout>

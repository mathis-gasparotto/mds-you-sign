<x-app-layout>
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
</x-app-layout>

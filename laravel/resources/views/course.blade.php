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
                            <div class="flex justify-between">
                                <x-warning-button
                                    x-data=""
                                    x-on:click.prevent="$dispatch('open-modal', 'confirm-qr-generate')"
                                >
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-qr-code" viewBox="0 0 16 16">
                                        <path d="M2 2h2v2H2V2Z"/>
                                        <path d="M6 0v6H0V0h6ZM5 1H1v4h4V1ZM4 12H2v2h2v-2Z"/>
                                        <path d="M6 10v6H0v-6h6Zm-5 1v4h4v-4H1Zm11-9h2v2h-2V2Z"/>
                                        <path d="M10 0v6h6V0h-6Zm5 1v4h-4V1h4ZM8 1V0h1v2H8v2H7V1h1Zm0 5V4h1v2H8ZM6 8V7h1V6h1v2h1V7h5v1h-4v1H7V8H6Zm0 0v1H2V8H1v1H0V7h3v1h3Zm10 1h-1V7h1v2Zm-1 0h-1v2h2v-1h-1V9Zm-4 0h2v1h-1v1h-1V9Zm2 3v-1h-1v1h-1v1H9v1h3v-2h1Zm0 0h3v1h-2v1h-1v-2Zm-4-1v1h1v-2H7v1h2Z"/>
                                        <path d="M7 12h1v3h4v1H7v-4Zm9 2v2h-3v-1h2v-1h1Z"/>
                                    </svg>
                                </x-warning-button>
                                <x-modal name="confirm-qr-generate" focusable>
                                    <div class="p-3">
                                        <header>
                                            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                                {{ __('Code QR') }}&nbsp;{{ $users[0]->lesson->label }}
                                            </h2>

                                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                                {{ substr($users[0]->lesson->start_at, 0, 10) }} <br>
                                                {{ substr($users[0]->lesson->start_at, 10, 12) }} - {{ substr($users[0]->lesson->end_at, 10, 15) }}
                                            </p>
                                        </header>
                                        <div id="qrcode" class="flex justify-center py-4">
                                            {{$qrcode}}
                                        </div>

                                    </div>
                                </x-modal>

                          Étudiant présent  {{ $users->where('signed', 1)->count() }} /{{$users->count()}}

                            </div>
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
                                               <p class="text-green-500"> Présent </p>
                                            @else
                                                <p class="text-red-700"> Absent </p>
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
        <script>
            function updateQRCode() {
                fetch("{{ route('qrcodeupdate',['id' => $lesson->id]) }}")
                    .then(response => response.json())
                    .then(data => {
                        console.log( data);
                        document.getElementById('qrcode').innerHTML=data;
                    })
                    .catch(error => {
                        console.error('Erreur lors de la requête AJAX :', error);
                    });
                     }

            // Appelez la fonction updateQRCode toutes les 15 secondes
            setInterval(updateQRCode, 7000); // 15000 millisecondes = 15 secondes
        </script>
</x-app-layout>

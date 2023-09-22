<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    @if(session()->get('role') == 'teacher')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @if($lessons->count() > 0)
                    <div class="text-center underline"> Cours </div>
                    <div>

                        <div class="card py-10">
                            @foreach( $lessons as $lesson)
                                <div class="card py-10 flex justify-center text-center">

                                    <a href={{ route('course', ['id' => $lesson->id]) }}>
                                        {{substr($lesson->start_at, 0, 10) }} <br>
                                        {{$lesson->label}} <br>
                                        <span>   {{substr($lesson->start_at, 10, 11) }} - {{substr($lesson->end_at, 10, 11) }} </span>
                                        <br>

                                        <span>{{$lesson->users->count()}} étudiants </span>

                                        <br>
                                    </a>
                                </div>
                            @endforeach

                        </div>

                    </div>
                    @else
                    <div class="text-center"> Vous n'avez pas de cours prévus</div>
                    @endif

                </div>
            </div>
        </div>
    </div>
    @elseif(session()->get('role') == 'admin')

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        @if($lessons->count() > 0)
                            <div class="text-center underline"> Cours </div>
                            <div>

                                <div class="card py-10">
                                    @foreach( $lessons as $lesson)
                                        <div class="card py-10 ">
                                            <a href={{ route('course', ['id' => $lesson->id]) }}>
                                                {{$lesson->label}}
                                                <span>   {{$lesson->start_at}} - {{$lesson->end_at}} </span>
                                                <span> nb etu {{$lesson->users->count()}} </span>
                                                <span> classe </span>
                                                <br>
                                            </a>
                                        </div>
                                    @endforeach

                                </div>

                            </div>
                        @else
                            <div class="text-center"> Admin</div>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    @endif
</x-app-layout>

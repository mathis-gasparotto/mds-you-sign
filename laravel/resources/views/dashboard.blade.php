<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

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
                    <div class="text-center"> Vous n'avez pas de cours prévus</div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</x-app-layout>

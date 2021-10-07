<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="m-auto w-4/5 py-24">
                    <div class="text-center">
                        <h1 class="text-5xl uppercase bold">
                            CARS
                        </h1>
                    </div>
                    <div class="pt-10">
                        <a 
                            href="/cars/create" 
                            class="border-b-2 pb-2 border-dotted itallic text-gray-500">
                            Add a new car &rarr;
                        </a>
                    </div>
                    <div class="w-5/6 py-10">
                        @foreach ($cars as $carInfo) 
                        <div class="m-auto">
                            <div class="float-right">
                                <a 
                                    href="/cars/{{ $carInfo['id'] }}/edit" 
                                    class="border-b-2 pb-2 border-dotted itallic text-green-500">
                                    Edit car &rarr;
                                </a>
                                <form action="/cars/{{ $carInfo['id'] }}" class="pt-3" method="POST">
                                    @csrf
                                    @method('delete')
                                    <button 
                                        type="submit"
                                        class="border-b-2 pb-2 border-dotted italic text-red-500">
                                            Delete &rarr;
                                    </button>
                                </form>
                            </div>
                            <span class="uppercase text-blue-500 font-bold text-xs italic">
                                Founded : {{ $carInfo['founded'] }}
                            </span>
                            <h2 class="text-gray-700 text-5xl hover:text-gray-500">
                                   <a href="/cars/{{ $carInfo['id'] }}">
                                    {{ $carInfo['name'] }}
                                   </a>
                            </h2>
                            <p class=" text-lg text-gray-700 py-6">
                                {{ $carInfo['description'] }}
                            </p>
                            <hr class="mt-4 mb-8">
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

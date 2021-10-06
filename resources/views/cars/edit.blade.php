<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
           
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="m-auto w-4/8 py-24">
                    <div class="text-center">
                        <h1 class="text-5xl uppercase bold">
                            Update car
                        </h1>
                    </div>
                    <div class="text-right text-green-500">
                        <a 
                        href="/cars" 
                        class="border-b-2 pb-2 border-dotted itallic text-green-500">
                        Go To Previous Page &rarr;
                    </a>
                    </div>
                </div>
                
                <div class="flex justify-center pt-20">
                    <form action="/cars/{{ $EditData->id }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="block">
                            <input 
                                type="text"
                                class="block shadow-5xl mb-10 p-2 w-80 italic placeholder-gray-400"
                                name="name"
                                value="{{ $EditData->name }}">
                
                                <input 
                                    type="text"
                                    class="block shadow-5xl mb-10 p-2 w-80 italic placeholder-gray-400"
                                    name="founded"
                                    value="{{ $EditData->founded }}">
                
                                <input 
                                    type="text"
                                    class="block shadow-5xl mb-10 p-2 w-80 italic placeholder-gray-400"
                                    name="description"
                                    value="{{ $EditData->description }}">
                
                                <button type="submit" class="bg-green-500 block shadow-5xl mb-10 p-2 w-80 uppercase font-bold">
                                    Submit
                                </button>
                        </div>
                    </form>
                </div>
                
            </div>
        </div>
    </div>
</x-app-layout>

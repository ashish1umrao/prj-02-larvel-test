<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
           
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="float-right">
                    <a 
                        href="/cars" 
                        class="border-b-2 pb-2 border-dotted itallic text-green-500">
                        Show Cars List &rarr;
                    </a>
                </div>
                <x-jet-welcome />
            </div>
        </div>
    </div>
</x-app-layout>

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
                            {{ $car['name'] }}
                        </h1>
                    </div>
                    <div class="w-5/6 py-10">
                        <div class="m-auto">
                            <span class="uppercase text-blue-500 font-bold text-xs italic">
                                Founded : {{ $car['founded'] }}
                            </span>
                            <p class=" text-lg text-gray-700 py-6">
                                {{ $car['description'] }}
                            </p>
                            <ul>

                                <table class="table-auto">
                                    <tr class="bg-blue-100">
                                        <td class="w-1/4 border-4 border-grey-500">
                                            Models
                                        </td>
                                        <td class="w-1/4 border-4 border-grey-500">
                                            Engines
                                        </td>
                                        <td class="w-1/4 border-4 border-grey-500">
                                            Production Date
                                        </td>
                                    </tr>
                                    @forelse ($car->CarModels as $carInfo)
                                    <tr>
                                        <td class="border-4 border-grey-500">
                                            {{ $carInfo['model_name'] }}
                                        </td>
                                        <td class="border-4 border-grey-500">

                                            @foreach ($car->engines as $engInfo)
                                                @if ($carInfo->id == $engInfo->model_id)
                                                        {{ $engInfo['engine_name'] }}
                                                @endif
                                            @endforeach
                                        </td>
                                        <td class="border-4 border-grey-500">
                                            {{ date('d-m-Y'),strtotime($car->productionDate->created_at) }}
                                        </td>
                                    </tr>
                                       
                                    @empty
                                        <p>No Cars Models Found</p>
                                    @endforelse
                                </table>

                                <p class="text-left">
                                    Product Types:

                                    @forelse ($car->products as $product)
                                        {{ $product->name }}
                                    @empty
                                        <p>No Data Found</p>
                                    @endforelse

                                </p>

                            </ul>
                            <hr class="mt-4 mb-8">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

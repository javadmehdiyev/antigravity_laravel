<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Browse Cars') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">
                <!-- Filters Sidebar -->
                <div class="lg:col-span-1">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Filter</h3>
                        <form action="{{ route('cars.index') }}" method="GET">
                            <div class="space-y-4">
                                <div>
                                    <label for="make" class="block text-sm font-medium text-gray-700">Make</label>
                                    <input type="text" name="make" id="make" value="{{ request('make') }}" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                </div>
                                <div>
                                    <label for="model" class="block text-sm font-medium text-gray-700">Model</label>
                                    <input type="text" name="model" id="model" value="{{ request('model') }}" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                </div>
                                <div>
                                    <label for="min_price" class="block text-sm font-medium text-gray-700">Min Price</label>
                                    <input type="number" name="min_price" id="min_price" value="{{ request('min_price') }}" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                </div>
                                <div>
                                    <label for="max_price" class="block text-sm font-medium text-gray-700">Max Price</label>
                                    <input type="number" name="max_price" id="max_price" value="{{ request('max_price') }}" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                </div>
                                <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    Apply Filters
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Car Grid -->
                <div class="lg:col-span-3">
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        @forelse($cars as $car)
                            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg group">
                                <div class="w-full h-48 bg-gray-200 aspect-w-1 aspect-h-1 overflow-hidden relative">
                                    @if($car->images->count() > 0)
                                        <img src="{{ Storage::url($car->images->first()->image_path) }}" alt="{{ $car->make }}" class="w-full h-full object-center object-cover group-hover:opacity-75 transition duration-150 ease-in-out">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center bg-gray-300 text-gray-500">No Image</div>
                                    @endif
                                    <div class="absolute top-2 right-2 bg-indigo-600 text-white text-xs font-bold px-2 py-1 rounded">
                                        {{ $car->year }}
                                    </div>
                                </div>
                                <div class="p-4">
                                    <h3 class="text-lg font-semibold text-gray-900">
                                        <a href="{{ route('cars.show', $car) }}" class="hover:underline">
                                            {{ $car->make }} {{ $car->model }}
                                        </a>
                                    </h3>
                                    <div class="mt-2 flex items-center justify-between">
                                        <p class="text-xl font-bold text-indigo-600">${{ number_format($car->price) }}</p>
                                        <p class="text-sm text-gray-500">{{ number_format($car->mileage) }} mi</p>
                                    </div>
                                    <div class="mt-4 flex items-center text-sm text-gray-500">
                                        <span class="truncate">{{ $car->transmission }} • {{ $car->fuel_type }}</span>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-span-full text-center py-12 text-gray-500">
                                No cars found matching your criteria.
                            </div>
                        @endforelse
                    </div>

                    <div class="mt-6">
                        {{ $cars->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

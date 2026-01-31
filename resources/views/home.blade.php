<x-app-layout>
    <div class="relative bg-gray-900 overflow-hidden">
        <div class="absolute inset-0">
            <img class="w-full h-full object-cover opacity-50" src="https://images.unsplash.com/photo-1492144534655-ae79c964c9d7?ixlib=rb-1.2.1&auto=format&fit=crop&w=1950&q=80" alt="Hero Background">
            <div class="absolute inset-0 bg-gray-900 mix-blend-multiply"></div>
        </div>
        <div class="relative max-w-7xl mx-auto py-24 px-4 sm:py-32 sm:px-6 lg:px-8">
            <h1 class="text-4xl font-extrabold tracking-tight text-white sm:text-5xl lg:text-6xl">Find Your Dream Car</h1>
            <p class="mt-6 text-xl text-gray-300 max-w-3xl">Browse thousands of premium pre-owned vehicles. Sell your car with ease. The best experience on the market.</p>
            <div class="mt-10 max-w-sm sm:flex sm:max-w-none">
                <div class="space-y-4 sm:space-y-0 sm:mx-auto sm:inline-grid sm:grid-cols-2 sm:gap-5">
                    <a href="{{ route('cars.index') }}" class="flex items-center justify-center px-4 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-indigo-700 bg-white hover:bg-gray-50 sm:px-8"> Browse Cars </a>
                    <a href="{{ route('cars.create') }}" class="flex items-center justify-center px-4 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 sm:px-8"> Sell Your Car </a>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl font-extrabold tracking-tight text-gray-900 mb-8">Featured Listings</h2>
        <div class="grid grid-cols-1 gap-y-10 gap-x-6 sm:grid-cols-2 lg:grid-cols-3 xl:gap-x-8">
            @foreach($featuredCars as $car)
                <div class="group relative">
                    <div class="w-full min-h-80 bg-gray-200 aspect-w-1 aspect-h-1 rounded-md overflow-hidden group-hover:opacity-75 lg:h-80 lg:aspect-none">
                        @if($car->images->count() > 0)
                            <img src="{{ Storage::url($car->images->first()->image_path) }}" alt="{{ $car->make }} {{ $car->model }}" class="w-full h-full object-center object-cover lg:w-full lg:h-full">
                        @else
                            <div class="w-full h-full flex items-center justify-center bg-gray-300 text-gray-500">No Image</div>
                        @endif
                    </div>
                    <div class="mt-4 flex justify-between">
                        <div>
                            <h3 class="text-sm text-gray-700">
                                <a href="{{ route('cars.show', $car) }}">
                                    <span aria-hidden="true" class="absolute inset-0"></span>
                                    {{ $car->year }} {{ $car->make }} {{ $car->model }}
                                </a>
                            </h3>
                            <p class="mt-1 text-sm text-gray-500">{{ number_format($car->mileage) }} miles</p>
                        </div>
                        <p class="text-sm font-medium text-gray-900">${{ number_format($car->price) }}</p>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="mt-12 text-center">
             <a href="{{ route('cars.index') }}" class="text-indigo-600 hover:text-indigo-500 font-medium">View all cars &rarr;</a>
        </div>
    </div>
</x-app-layout>

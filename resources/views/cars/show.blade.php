<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $car->year }} {{ $car->make }} {{ $car->model }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="lg:grid lg:grid-cols-2 lg:gap-x-8 lg:items-start">
                <!-- Image Gallery -->
                <div class="flex flex-col-reverse">
                    <div class="hidden mt-6 w-full max-w-2xl mx-auto sm:block lg:max-w-none">
                        <div class="grid grid-cols-4 gap-6" aria-orientation="horizontal" role="tablist">
                            @foreach($car->images as $image)
                                <button class="relative h-24 bg-white rounded-md flex items-center justify-center text-sm font-medium uppercase text-gray-900 cursor-pointer hover:bg-gray-50 focus:outline-none focus:ring focus:ring-offset-4 focus:ring-opacity-50" role="tab" type="button">
                                    <span class="sr-only">Image {{ $loop->iteration }}</span>
                                    <span class="absolute inset-0 rounded-md overflow-hidden">
                                        <img src="{{ Storage::url($image->image_path) }}" alt="" class="w-full h-full object-center object-cover">
                                    </span>
                                </button>
                            @endforeach
                        </div>
                    </div>

                    <div class="w-full aspect-w-4 aspect-h-3">
                         @if($car->images->count() > 0)
                            <img src="{{ Storage::url($car->images->first()->image_path) }}" alt="{{ $car->make }}" class="w-full h-full object-center object-cover sm:rounded-lg">
                        @else
                             <div class="w-full h-full flex items-center justify-center bg-gray-300 text-gray-500 rounded-lg h-96">No Image Available</div>
                        @endif
                    </div>
                </div>

                <!-- Car Info -->
                <div class="mt-10 px-4 sm:px-0 sm:mt-16 lg:mt-0">
                    <h1 class="text-3xl font-extrabold tracking-tight text-gray-900">{{ $car->make }} {{ $car->model }}</h1>
                    
                    <div class="mt-3">
                        <h2 class="sr-only">Product information</h2>
                        <p class="text-3xl text-indigo-600">${{ number_format($car->price) }}</p>
                    </div>

                    <div class="mt-6">
                        <h3 class="sr-only">Description</h3>
                        <div class="text-base text-gray-700 space-y-6">
                            <p>{{ $car->description }}</p>
                        </div>
                    </div>

                    <div class="mt-8 border-t border-gray-200 pt-8">
                        <h3 class="text-sm font-medium text-gray-900">Details</h3>
                        <div class="mt-4 prose prose-sm text-gray-500">
                            <ul role="list">
                                <li><strong>Year:</strong> {{ $car->year }}</li>
                                <li><strong>Mileage:</strong> {{ number_format($car->mileage) }} miles</li>
                                <li><strong>Transmission:</strong> {{ $car->transmission }}</li>
                                <li><strong>Fuel Type:</strong> {{ $car->fuel_type }}</li>
                            </ul>
                        </div>
                    </div>
                    
                    <div class="mt-8 border-t border-gray-200 pt-8">
                        <h3 class="text-sm font-medium text-gray-900">Seller Info</h3>
                         <div class="mt-4">
                            <p class="text-gray-600">Posted by: <span class="font-semibold">{{ $car->user->name }}</span></p>
                            <p class="text-gray-500 text-sm">Member since {{ $car->user->created_at->format('M Y') }}</p>
                         </div>
                    </div>

                    @auth
                        @if(Auth::id() === $car->user_id)
                             <div class="mt-10 flex space-x-4">
                                <a href="{{ route('cars.edit', $car) }}" class="flex-1 bg-indigo-600 border border-transparent rounded-md py-3 px-8 flex items-center justify-center text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-50 focus:ring-indigo-500">Edit Listing</a>
                                <form action="{{ route('cars.destroy', $car) }}" method="POST" class="flex-1" onsubmit="return confirm('Are you sure?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="w-full bg-red-600 border border-transparent rounded-md py-3 px-8 flex items-center justify-center text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">Delete Listing</button>
                                </form>
                            </div>
                        @else
                            <div class="mt-10">
                                <button type="button" class="w-full bg-indigo-600 border border-transparent rounded-md py-3 px-8 flex items-center justify-center text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Contact Seller</button>
                            </div>
                        @endif
                    @else
                        <div class="mt-10">
                             <a href="{{ route('login') }}" class="w-full bg-gray-600 border border-transparent rounded-md py-3 px-8 flex items-center justify-center text-base font-medium text-white hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">Log in to Contact Seller</a>
                        </div>
                    @endauth
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

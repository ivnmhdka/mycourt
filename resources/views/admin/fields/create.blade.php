<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add New Field') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                <form action="{{ route('admin.fields.store') }}" method="POST">
                    @csrf

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Field Name -->
                            <div class="mb-4">
                                <label for="name" class="block text-gray-700 text-sm font-bold mb-2">
                                    Field Name
                                </label>
                                <input type="text" name="name" id="name" value="{{ old('name') }}"
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline focus:border-blue-500 transition duration-150 ease-in-out"
                                    required autofocus>
                                @error('name')
                                    <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Category -->
                            <div class="mb-4">
                                <label for="category" class="block text-gray-700 text-sm font-bold mb-2">
                                    Category
                                </label>

                                <select name="category" id="category"
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight
                                        focus:outline-none focus:shadow-outline focus:border-blue-500 transition">
                                    <option value="" disabled selected>-- Select Category --</option>
                                    <option value="Futsal" {{ old('category') == 'Futsal' ? 'selected' : '' }}>Futsal</option>
                                    <option value="Badminton" {{ old('category') == 'Badminton' ? 'selected' : '' }}>Badminton</option>
                                    <option value="Basketball" {{ old('category') == 'Basketball' ? 'selected' : '' }}>Basketball</option>
                                </select>

                                @error('category')
                                    <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Price per Hour -->
                            <div class="mb-4">
                                <label for="price_per_hour" class="block text-gray-700 text-sm font-bold mb-2">
                                    Price per Hour
                                </label>
                                <input type="number" name="price_per_hour" id="price_per_hour"
                                    value="{{ old('price_per_hour') }}"
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline focus:border-blue-500 transition duration-150 ease-in-out"
                                    required>
                                @error('price_per_hour')
                                    <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Image Path -->
                            <div class="mb-4">
                                <label for="image_path" class="block text-gray-700 text-sm font-bold mb-2">
                                    Image URL
                                </label>
                                <input type="url" name="image_path" id="image_path"
                                    value="{{ old('image_path', $field->image_path ?? '') }}"
                                    placeholder="https://example.com/image.jpg"
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline focus:border-blue-500 transition duration-150 ease-in-out">
                                @error('image_path')
                                    <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <hr class="my-6 border-gray-200">

                        <h3 class="font-semibold text-lg text-gray-800 mb-4">
                            Field Description
                        </h3>

                        <div class="grid grid-cols-1 gap-6">
                            <!-- Description -->
                            <div class="mb-4">
                                <label for="description" class="block text-gray-700 text-sm font-bold mb-2">
                                    Description
                                </label>
                                <textarea name="description" id="description" rows="4"
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline focus:border-blue-500 transition duration-150 ease-in-out">{{ old('description') }}</textarea>
                                @error('description')
                                    <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="flex items-center justify-end mt-6">
                            <a href="{{ route('admin.fields.index') }}"
                                class="text-gray-600 hover:text-gray-900 mr-4 transition duration-150 ease-in-out">
                                Cancel
                            </a>
                            <button type="submit"
                                class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-lg shadow-md hover:shadow-lg focus:outline-none focus:shadow-outline transition duration-150 ease-in-out">
                                Create Field
                            </button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>

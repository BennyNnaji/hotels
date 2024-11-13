@extends('admin.layouts.content')

@section('content')
    <section class="">
        <h2 class="text-2xl font-semibold text-gray-700 mb-6">Update Contact Information</h2>
        @if ($errors->any())
            <div class="mb-4">
                <div class="bg-red-100 text-red-700 px-4 py-2 rounded">
                    <strong>Whoops!</strong> There were some problems with your input.<br>
                    <ul class="list-disc pl-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif
        <!-- Display success message if available -->
        @if (session('success'))
            <div class="bg-green-100 text-green-700 p-4 rounded mb-6">
                {{ session('success') }}
            </div>
        @endif
        <div class="w-4/5 mx-auto p-6 elevation-2 bg-white rounded-lg">



            <form action="{{ route('admin.contact.update', $contact->id) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')



                <!-- Phone Field -->
                <div>
                    <label for="phone" class="block font-medium text-gray-700 mb-1">Phone</label>
                    <div class="flex items-center border rounded px-3 py-2 @error('phone') border-red-500 @enderror">
                        <i class="fas fa-phone-alt text-gray-400 mr-2"></i>
                        <input type="text" name="phone" id="phone"
                            class="w-full border-none focus:border-none outline-none focus:outline-none focus:ring-0"
                            value="{{ old('phone', $contact->phone) }}" placeholder="Phone Number" />
                    </div>
                    @error('phone')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email Field -->
                <div>
                    <label for="email" class="block font-medium text-gray-700 mb-1">Email</label>
                    <div class="flex items-center border rounded px-3 py-2 @error('email') border-red-500 @enderror">
                        <i class="fas fa-envelope text-gray-400 mr-2"></i>
                        <input type="email" name="email" id="email"
                            class="w-full border-none focus:border-none outline-none focus:outline-none focus:ring-0"
                            value="{{ old('email', $contact->email) }}" placeholder="Email Address" />
                    </div>
                    @error('email')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Address Field -->
                <div>
                    <label for="address" class="block font-medium text-gray-700 mb-1">Address</label>
                    <div class="flex items-center border rounded px-3 py-2 @error('address') border-red-500 @enderror">
                        <i class="fas fa-map-marker-alt text-gray-400 mr-2"></i>
                        <input type="text" name="address" id="address"
                            class="w-full border-none focus:border-none outline-none focus:outline-none focus:ring-0"
                            placeholder="Full Address" value="{{ old('address', $contact->address) }}">
                    </div>
                    @error('address')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <!-- Map Field -->
                <div>
                    <label for="map" class="block font-medium text-gray-700 mb-1">Map Src attribute</label>
                    <small class=" italic text-bold text-red-500">NB: Only the value of SRC attribute of < iframe > is needed </small>
                    <div class="flex items-center border rounded px-3 py-2 @error('map') border-red-500 @enderror">
                        <i class="fas fa-map-marker-alt text-gray-400 mr-2"></i>
                        <input type="text" name="map" id="map"
                            class="w-full border-none focus:border-none outline-none focus:outline-none focus:ring-0"
                            placeholder="Full map" value="{{ old('map', $contact->map) }}">
                    </div>
                    @error('map')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Facebook Field -->
                <div>
                    <label for="facebook" class="block font-medium text-gray-700 mb-1">Facebook</label>
                    <div class="flex items-center border rounded px-3 py-2 @error('facebook') border-red-500 @enderror">
                        <i class="fab fa-facebook-f text-gray-400 mr-2"></i>
                        <input type="text" name="facebook" id="facebook"
                            class="w-full border-none focus:border-none outline-none focus:outline-none focus:ring-0"
                            value="{{ old('facebook', $contact->facebook) }}" placeholder="Facebook URL" />
                    </div>
                    @error('facebook')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Instagram Field -->
                <div>
                    <label for="instagram" class="block font-medium text-gray-700 mb-1">Instagram</label>
                    <div class="flex items-center border rounded px-3 py-2 @error('instagram') border-red-500 @enderror">
                        <i class="fab fa-instagram text-gray-400 mr-2"></i>
                        <input type="text" name="instagram" id="instagram"
                            class="w-full border-none focus:border-none outline-none focus:outline-none focus:ring-0"
                            value="{{ old('instagram', $contact->instagram) }}" placeholder="Instagram URL" />
                    </div>
                    @error('instagram')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Twitter Field -->
                <div>
                    <label for="twitter" class="block font-medium text-gray-700 mb-1">Twitter</label>
                    <div class="flex items-center border rounded px-3 py-2 @error('twitter') border-red-500 @enderror">
                        <i class="fab fa-twitter text-gray-400 mr-2"></i>
                        <input type="text" name="twitter" id="twitter"
                            class="w-full border-none focus:border-none outline-none focus:outline-none focus:ring-0"
                            value="{{ old('twitter', $contact->twitter) }}" placeholder="Twitter URL" />
                    </div>
                    @error('twitter')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- WhatsApp Field -->
                <div>
                    <label for="whatsapp" class="block font-medium text-gray-700 mb-1">WhatsApp</label>
                    <div class="flex items-center border rounded px-3 py-2 @error('whatsapp') border-red-500 @enderror">
                        <i class="fab fa-whatsapp text-gray-400 mr-2"></i>
                        <input type="text" name="whatsapp" id="whatsapp"
                            class="w-full border-none focus:border-none outline-none focus:outline-none focus:ring-0"
                            value="{{ old('whatsapp', $contact->whatsapp) }}" placeholder="WhatsApp Number" />
                    </div>
                    @error('whatsapp')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Submit Button -->
                <div class="mt-6">
                    <button type="submit"
                        class="px-6 py-2 bg-primary text-white font-semibold rounded hover:bg-primary-dark">
                        Update Contact Information
                    </button>
                </div>
            </form>
        </div>
    </section>
@endsection

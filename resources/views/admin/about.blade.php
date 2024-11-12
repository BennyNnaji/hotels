@extends('admin.layouts.content')

@section('content')
    <div class="container mx-auto p-6">
        <h2 class="text-3xl font-semibold mb-6">Edit About Us</h2>

        @if (session('success'))
            <div class="bg-green-200 p-4 rounded-lg mb-4">{{ session('success') }}</div>
        @endif
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

        <!-- Form for About Us, Mission, Vision -->
        <form action="{{ route('admin.about.update') }}" method="POST" enctype="multipart/form-data"
            class="bg-white rounded-lg p-6">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="about_us" class="block text-gray-700 font-semibold">About Us</label>
                <textarea id="about_us" name="about_us" class=" summernote w-full border mt-2 p-2 rounded">{{ old('about_us', $about->about_us) }}</textarea>
                @error('about_us')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="about_us_image" class="block text-gray-700 font-semibold">About Us Image</label>
                <input type="file" id="about_us_image" name="about_us_image" class="w-full border mt-2 p-2 rounded">
                @error('about_us_image')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>
            @if ($about->about_us_image)
                <img src="{{ Storage::url($about->about_us_image) }}" alt="About Image" class=" h-52 w-52 rounded-lg my-4">
            @endif

            <div class="mb-4">
                <label for="mission" class="block text-gray-700 font-semibold">Mission</label>
                <textarea id="mission" name="mission" class="w-full border mt-2 p-2 rounded">{{ old('mission', $about->mission) }}</textarea>
                @error('mission')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="vision" class="block text-gray-700 font-semibold">Vision</label>
                <textarea id="vision" name="vision" class="w-full border mt-2 p-2 rounded">{{ old('vision', $about->vision) }}</textarea>
                @error('vision')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <!-- Amenities Section -->
            <h3 class="text-xl font-semibold mt-6">Amenities</h3>
            <div id="amenities-container">
                @foreach (old('amenities', $about->amenities ?? []) as $index => $amenity)
                    <div class="border-2 border-red-200 p-4 rounded-lg my-2">
                        <div class="mb-4 amenity-item">

                            <label for="icon_{{ $index }}" class="block text-gray-600">Icon</label>
                            <input type="text" name="amenities[{{ $index }}][icon]"
                                value="{{ $amenity['icon'] ?? '' }}" class="w-full border mt-2 p-2 rounded">
                            @error("amenities.$index.icon")
                                <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror

                            <label for="title_{{ $index }}" class="block text-gray-600 mt-4">Title</label>
                            <input type="text" name="amenities[{{ $index }}][title]"
                                value="{{ $amenity['title'] ?? '' }}" class="w-full border mt-2 p-2 rounded">
                            @error("amenities.$index.title")
                                <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror

                            <label for="description_{{ $index }}"
                                class="block text-gray-600 mt-4">Description</label>
                            <textarea name="amenities[{{ $index }}][description]" class="w-full border mt-2 p-2 rounded">{{ $amenity['description'] ?? '' }}</textarea>
                            @error("amenities.$index.description")
                                <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                        </div>
                        <button type="button" onclick="removeField(this)">🗑️</button>
                    </div>
                    <hr class="my-3">
                @endforeach
            </div>
            <button type="button" onclick="addAmenityField()" class="bg-accent text-white py-2 px-4 rounded">Add
                Amenity</button>

            <!-- Team Section -->
            <h3 class="text-xl font-semibold mt-6">Meet Our Team</h3>
            <div id="team-container">
                @foreach (old('team', $about->team ?? []) as $index => $teamMember)
                    <div class="border-2 border-blue-200 p-4 rounded-lg my-2">
                        <div class="mb-4 pb-4 team-item">
                            <label for="name_{{ $index }}" class="block text-gray-600">Name</label>
                            <input type="text" name="team[{{ $index }}][name]"
                                value="{{ $teamMember['name'] ?? '' }}" class="w-full border mt-2 p-2 rounded">
                            @error("team.$index.name")
                                <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror

                            <label for="role_{{ $index }}" class="block text-gray-600 mt-4">Role</label>
                            <input type="text" name="team[{{ $index }}][role]"
                                value="{{ $teamMember['role'] ?? '' }}" class="w-full border mt-2 p-2 rounded">
                            @error("team.$index.role")
                                <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror

                            <label for="image_{{ $index }}" class="block text-gray-600 mt-4">Image</label>
                            <input type="file" name="team[{{ $index }}][image]"
                                class="w-full border mt-2 p-2 rounded">
                            @error("team.$index.image")
                                <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                            @if (!empty($teamMember['image']))
                                <img src="{{ Storage::url($teamMember['image']) }}"
                                    alt="{{ $teamMember['name'] }}'s image" class=" h-24 w-24  rounded-full my-4">
                            @else
                                <p class="text-gray-500">No image available for {{ $teamMember['name'] }}</p>
                            @endif


                            <label for="description_{{ $index }}"
                                class="block text-gray-600 mt-4">Description</label>
                            <textarea name="team[{{ $index }}][description]" class="w-full border mt-2 p-2 rounded">{{ $teamMember['description'] ?? '' }}</textarea>
                            @error("team.$index.description")
                                <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                        </div>
                        <button type="button" onclick="removeField(this)">🗑️</button>
                    </div>
                    <hr class="my-3">
                @endforeach
            </div>
            <button type="button" onclick="addTeamMemberField()" class="bg-accent text-white py-2 px-4 rounded">Add Team
                Member</button>

            <!-- Save Button -->
            <button type="submit" class="bg-primary text-white py-2 px-6 mt-6 rounded hover:bg-primaryDark">Save
                Changes</button>
        </form>
    </div>

    <script>
        function addAmenityField() {
            const container = document.getElementById('amenities-container');
            const newIndex = container.children.length;
            const newField = document.createElement('div');
            newField.classList.add('mb-4', 'amenity-item', 'border-b', 'pb-4', 'relative');
            newField.innerHTML = `
                <label class="block text-gray-400 text-lg">Icon</label>
                <input type="text" name="amenities[${newIndex}][icon]" class="w-full mt-2 px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary" placeholder="Enter amenity icon">
                <p class="text-red-500 text-sm" style="display:none;" id="error-icon-${newIndex}"></p>
    
                <label class="block text-gray-400 text-lg">Title</label>
                <input type="text" name="amenities[${newIndex}][title]" class="w-full mt-2 px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary" placeholder="Enter amenity title">
                <p class="text-red-500 text-sm" style="display:none;" id="error-title-${newIndex}"></p>
    
                <label class="block text-gray-400 text-lg">Description</label>
                <textarea name="amenities[${newIndex}][description]" class="w-full mt-2 px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary" placeholder="Enter amenity description"></textarea>
                <p class="text-red-500 text-sm" style="display:none;" id="error-description-${newIndex}"></p>
    
                <button type="button" class="absolute top-0 right-0 text-red-500" onclick="removeField(this)">🗑️</button>
            `;
            container.appendChild(newField);
        }

        function addTeamMemberField() {
            const container = document.getElementById('team-container');
            const newIndex = container.children.length;
            const newField = document.createElement('div');
            newField.classList.add('mb-4', 'team-item', 'border-b', 'pb-4', 'relative');
            newField.innerHTML = `
                <label class="block text-gray-400 text-lg">Name</label>
                <input type="text" name="team[${newIndex}][name]" class="w-full mt-2 px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary" placeholder="Enter team member name">
                <p class="text-red-500 text-sm" style="display:none;" id="error-name-${newIndex}"></p>
    
                <label class="block text-gray-400 text-lg">Role</label>
                <input type="text" name="team[${newIndex}][role]" class="w-full mt-2 px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary" placeholder="Enter team member role">
                <p class="text-red-500 text-sm" style="display:none;" id="error-role-${newIndex}"></p>
    
                <label class="block text-gray-400 text-lg">Description</label>
                <textarea name="team[${newIndex}][description]" class="w-full mt-2 px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary" placeholder="Enter team member description"></textarea>
                <p class="text-red-500 text-sm" style="display:none;" id="error-description-${newIndex}"></p>
    
                <label class="block text-gray-400 text-lg">Image</label>
                <input type="file" name="team[${newIndex}][image]" class="w-full mt-2 px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary">
                <p class="text-red-500 text-sm" style="display:none;" id="error-image-${newIndex}"></p>
    
                <button type="button" class="absolute top-0 right-0 text-red-500" onclick="removeField(this)">🗑️</button>
            `;
            container.appendChild(newField);
        }

        function removeField(button) {
            const fieldContainer = button.parentNode;
            fieldContainer.remove();
        }
    </script>
@endsection

@extends('admin.layouts.content')

@section('content')
    <div class="container mx-auto py-8">
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <h1 class="text-2xl font-bold text-gray-700 mb-4">General setting</h1>
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

            <!-- General setting Form -->
            <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Name -->
                <div class="mb-4">
                    <label for="name" class="block text-gray-700 font-semibold">Hotel Name</label>
                    <input type="text" name="name" id="name" value="{{ old('name', $setting->name) }}"
                        class="w-full mt-2 px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary">
                    @error('name')
                        <p class="text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Logo -->
                <div class="mb-4">
                    <label for="logo" class="block text-gray-700 font-semibold">Logo</label>
                    <input type="file" name="logo" id="logo" class="w-full mt-2">
                    @error('logo')
                        <p class="text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                @if ($setting->logo)
                    <div>
                        <img src="{{ Storage::url($setting->logo) }}" alt="Logo" class="  w-20 h-20 rounded-lg">
                    </div>
                @endif

                <!-- Favicon -->
                <div class="mb-4">
                    <label for="favicon" class="block text-gray-700 font-semibold">Favicon</label>
                    <input type="file" name="favicon" id="favicon" class="w-full mt-2">
                    @error('favicon')
                        <p class="text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>
                @if ($setting->favicon)
                    <div>
                        <img src="{{ Storage::url($setting->favicon) }}" alt="favicon" class="  w-10 h-10 rounded-lg">
                    </div>
                @endif

                <!-- Hero Background Image -->
                <div class="mb-4">
                    <label for="hero_background" class="block text-gray-700 font-semibold">Hero Background Image</label>
                    <input type="file" name="hero_background" id="hero_background" class="w-full mt-2">
                    @error('hero_background')
                        <p class="text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>
                @if ($setting->hero_background)
                    <div>
                        <img src="{{ Storage::url($setting->hero_background) }}" alt="hero_background"
                            class="  w-40 h-40 rounded-lg">
                    </div>
                @endif

                <!-- Hero Header -->
                <div class="mb-4">
                    <label for="hero_header" class="block text-gray-700 font-semibold">Hero Header</label>
                    <input type="text" name="hero_header" id="hero_header"
                        value="{{ old('hero_header', $setting->hero_header) }}"
                        class="w-full mt-2 px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary">
                    @error('hero_header')
                        <p class="text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Hero Subheader -->
                <div class="mb-4">
                    <label for="hero_subheader" class="block text-gray-700 font-semibold">Hero Subheader</label>
                    <textarea name="hero_subheader" id="hero_subheader"
                        class="summernote mt-2 px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary">{{ old('hero_subheader', $setting->hero_subheader) }}</textarea>

                    @error('hero_subheader')
                        <p class="text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Button 1 Text and Link -->
                <div class="mb-4">
                    <label for="button1_text" class="block text-gray-700 font-semibold">Button 1 Text</label>
                    <input type="text" name="button1_text" id="button1_text"
                        value="{{ old('button1_text', $setting->button1_text) }}"
                        class="w-full mt-2 px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary">
                    @error('button1_text')
                        <p class="text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="button1_link" class="block text-gray-700 font-semibold">Button 1 Link</label>
                    <input type="text" name="button1_link" id="button1_link"
                        value="{{ old('button1_link', $setting->button1_link) }}"
                        class="w-full mt-2 px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary">
                    @error('button1_link')
                        <p class="text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Button 2 Text and Link -->
                <div class="mb-4">
                    <label for="button2_text" class="block text-gray-700 font-semibold">Button 2 Text</label>
                    <input type="text" name="button2_text" id="button2_text"
                        value="{{ old('button2_text', $setting->button2_text) }}"
                        class="w-full mt-2 px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary">
                    @error('button2_text')
                        <p class="text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="button2_link" class="block text-gray-700 font-semibold">Button 2 Link</label>
                    <input type="text" name="button2_link" id="button2_link"
                        value="{{ old('button2_link', $setting->button2_link) }}"
                        class="w-full mt-2 px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary">
                    @error('button2_link')
                        <p class="text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit" class="px-6 py-2 bg-primary text-white rounded-lg hover:bg-primaryDark">
                    Save setting
                </button>
            </form>

            <!-- Highlights Form -->
            <div class="mt-10">
                <h2 class="text-xl font-bold text-gray-700 mb-4">Highlights</h2>
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
                <form action="{{ route('admin.settings.updateHighlights') }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div id="highlights-container">
                        @if (old('highlights', $setting->highlights))
                            @foreach (old('highlights', $setting->highlights) as $highlight)
                                <div class="mb-4 highlight-item border-b pb-4 space-y-4 relative">
                                    <!-- Delete Icon -->
                                    <button type="button" onclick="removeHighlightField(this)"
                                        class="absolute top-0 right-0 text-red-500 hover:text-red-700">
                                        <i class="fas fa-trash"></i>
                                    </button>

                                    <label for="" class="block text-gray-400 text-lg">Title</label>
                                    <input type="text" name="highlights[{{ $loop->index }}][title]"
                                        value="{{ $highlight['title'] ?? '' }}"
                                        class="w-full mt-2 px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary"
                                        placeholder="Enter highlight title">

                                    <label for="" class="block text-gray-400 text-lg">Description</label>
                                    <textarea name="highlights[{{ $loop->index }}][description]]"
                                        class=" w-full mt-2 px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary">{{ $highlight['description'] ?? '' }}</textarea>
                                </div>
                            @endforeach
                        @else
                            <div class="mb-4 highlight-item border-b pb-4 relative">
                                <!-- Delete Icon for the initial field -->
                                <button type="button" onclick="removeHighlightField(this)"
                                    class="absolute top-0 right-0 text-red-500 hover:text-red-700">
                                    <i class="fas fa-trash"></i>
                                </button>

                                <label for="" class="block text-gray-400 text-lg">Title</label>
                                <input type="text" name="highlights[0][title]"
                                    class="w-full mt-2 px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary"
                                    placeholder="Enter highlight title">

                                <label for="" class="block text-gray-400 text-lg">Description</label>
                                <textarea name="highlights[0][description]"
                                    class=" w-full mt-2 px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary"></textarea>
                            </div>
                        @endif
                    </div>

                    <!-- Button to add new highlight fields -->
                    <button type="button" onclick="addHighlightField()"
                        class="px-4 py-2 mt-2 text-white bg-accent rounded-lg hover:bg-accentDark">
                        Add Highlight
                    </button>

                    <!-- Submit button -->
                    <button type="submit" class="px-6 py-2 mt-4 bg-primary text-white rounded-lg hover:bg-primaryDark">
                        Save Highlights
                    </button>
                </form>
            </div>
        </div>
    </div>


    <script>
        function addHighlightField() {
            const container = document.getElementById('highlights-container');
            const newIndex = container.children.length;
            const newField = document.createElement('div');
            newField.classList.add('mb-4', 'highlight-item', 'border-b', 'pb-4', 'relative');
            newField.innerHTML = `
                <!-- Delete Icon for dynamically added fields -->
                <button type="button" onclick="removeHighlightField(this)" 
                        class="absolute top-0 right-0 text-red-500 hover:text-red-700">
                    <i class="fas fa-trash"></i>
                </button>
    
                <label for="" class="block text-gray-400 text-lg">Title</label>
                <input type="text" name="highlights[${newIndex}][title]" 
                       class="w-full mt-2 px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary"
                       placeholder="Enter highlight title">
    
                <label for="" class="block text-gray-400 text-lg">Description</label>
                <textarea name="highlights[${newIndex}][description]" 
                          class="w-full mt-2 px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary" ></textarea>
            `;
            container.appendChild(newField);
        }

        function removeHighlightField(button) {
            // Remove the parent highlight item
            button.closest('.highlight-item').remove();
        }
    </script>
@endsection

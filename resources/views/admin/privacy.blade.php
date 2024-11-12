@extends('admin.layouts.content')

@section('content')
    <div class="container mx-auto py-10">
        <h1 class="text-3xl font-semibold text-gray-800 mb-6">Update Privacy Policy</h1>

        <!-- Success message -->
        @if(session('status'))
            <div class="mb-4 p-4 bg-green-100 border border-green-300 text-green-800 rounded">
                {{ session('status') }}
            </div>
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

        <!-- Form for updating privacy -->
        <form action="{{ route('admin.privacy.update', $page->id) }}" method="POST" class=" bg-white p-5 rounded-lg">
            @csrf
            @method('PUT')
            
            <div class="mb-6">
                <label for="content" class="  block text-gray-700 font-medium">Privacy Policy</label>
                <textarea name="content" id="content" rows="10" 
                          class="summernote w-full mt-2 p-4 border rounded-md @error('content') border-red-500 @enderror"
                          placeholder="Enter privacy policy">{{ old('content', $page->content ?? '') }}</textarea>

                <!-- Error message for privacy -->
                @error('content')
                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit"
                    class="px-4 py-2 bg-primary text-white font-semibold rounded-md hover:bg-primaryDark transition-colors duration-200">
                Update Privacy
            </button>
        </form>
    </div>
@endsection

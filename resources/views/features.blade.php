@extends('layout/content')
@section('content')
    <div class="container mx-auto py-8 px-5">

        <!-- Features Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8 w-10/12 mx-auto">
            @foreach ($features as $feature)
                <a href="{{ route('featuresDetails', $feature->id) }}">
                    <div class="bg-white rounded-lg elevation-5 overflow-auto">
                        <!-- Feature Title -->
                        <div class="p-4">
                            <h3 class="text-xl font-semibold text-gray-800 mb-2">{{ $feature->title }}</h3>
                            <p class="text-gray-600 text-sm">{{ Str::limit(strip_tags($feature->description), 200, '...') }}</p>
                        </div>

                    </div>
                </a>
            @endforeach
        </div>
        <!-- Pagination -->
        <div>
            {{ $features->links() }}
        </div>
    </div>
@endsection

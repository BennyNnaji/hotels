@extends('admin.layouts.content')

@section('content')
    <div class="container mx-auto">
        <h2 class="text-2xl font-semibold mb-4">Newsletter Subscribers</h2>
        <table id="myTable" class="min-w-full bg-white shadow-md rounded my-6 p-3">
            <thead>
                <tr>
                    <th class="px-6 py-3 border-b-2 border-gray-300 text-left leading-4 text-blue-500">S/N</th>
                    <th class="px-6 py-3 border-b-2 border-gray-300 text-left leading-4 text-blue-500">Email</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($subscribers as $subscriber)
                    <tr>
                        <td class="px-6 py-4 border-b border-gray-200 text-gray-700">{{ $loop->iteration }}</td>
                        <td class="px-6 py-4 border-b border-gray-200 text-gray-700">{{ $subscriber }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

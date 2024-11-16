 @extends('admin.layouts.content')

 @section('content')
     <div class="flex flex-col lg:flex-row p-6 space-y-6 lg:space-y-0 lg:space-x-6 w-full">
         <!-- Main Dashboard Section -->
         <div class="flex-1 grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6 md:w-3/4">

             <!-- Total Rooms -->
             <div class="bg-gradient-to-r from-indigo-500 to-blue-500 p-6 rounded-lg shadow-lg text-white flex items-center">
                 <i class="fas fa-hotel text-3xl mr-4"></i>
                 <div>
                     <h2 class="text-lg font-semibold">Total Rooms</h2>
                     <p class="mt-2 text-3xl font-bold">{{ $totalRooms }}</p>
                 </div>
             </div>

             <!-- Booked Rooms -->
             <div class="bg-gradient-to-r from-green-400 to-teal-500 p-6 rounded-lg shadow-lg text-white flex items-center">
                 <i class="fas fa-door-open text-3xl mr-4"></i>
                 <div>
                     <h2 class="text-lg font-semibold">Booked Rooms</h2>
                     <p class="mt-2 text-3xl font-bold">{{ $bookedRooms }}</p>
                 </div>
             </div>

             <!-- Vacant Rooms -->
             <div
                 class="bg-gradient-to-r from-yellow-400 to-orange-500 p-6 rounded-lg shadow-lg text-white flex items-center">
                 <i class="fas fa-bed text-3xl mr-4"></i>
                 <div>
                     <h2 class="text-lg font-semibold">Vacant Rooms</h2>
                     <p class="mt-2 text-3xl font-bold"> {{ $totalRooms - $bookedRooms }}</p>
                 </div>
             </div>

             <!-- Total Reservations -->
             <div
                 class="bg-gradient-to-r from-purple-500 to-pink-500 p-6 rounded-lg shadow-lg text-white flex items-center">
                 <i class="fas fa-calendar-alt text-3xl mr-4"></i>
                 <div>
                     <h2 class="text-lg font-semibold"> Reservations </h2>
                     <p class="mt-2 text-3xl font-bold">{{ $totalReservations }}</p>

                 </div>
             </div>
             <!-- Booked Rooms (Now) -->
             <div class="bg-gradient-to-r from-red-500 to-orange-600 p-6 rounded-lg shadow-lg text-white flex items-center">
                 <i class="fas fa-bed text-3xl mr-4"></i>
                 <div>
                     <h2 class="text-lg font-semibold">Total Check In today </h2>
                     <p class="mt-2 text-3xl font-bold">{{ $totalCheckIns }}</p>
                 </div>
             </div>

             <!-- Booked Rooms (This Month) -->
             <div class="bg-gradient-to-r from-blue-500 to-cyan-600 p-6 rounded-lg shadow-lg text-white flex items-center">
                 <i class="fas fa-calendar-check text-3xl mr-4"></i>
                 <div>
                     <h2 class="text-lg font-semibold">Total Booked Rooms </h2>
                     <p class="mt-2 text-3xl font-bold">{{ $totalBooksThisMonth }}</p>
                     <p class="text-sm">This Month</p>
                 </div>
             </div>



             <!-- Total Reservations (This Month) -->
             <div
                 class="bg-gradient-to-r from-purple-600 to-pink-600 p-6 rounded-lg shadow-lg text-white flex items-center">
                 <i class="fas fa-calendar-plus text-3xl mr-4"></i>
                 <div>
                     <h2 class="text-lg font-semibold">Total Reservations </h2>
                     <p class="mt-2 text-3xl font-bold">{{ $totalReservationsThisMonth }}</p>
                     <p class="text-sm">This Month</p>
                 </div>
             </div>

             <!-- New Customers -->
             <div class="bg-gradient-to-r from-green-500 to-teal-700 p-6 rounded-lg shadow-lg text-white flex items-center">
                 <i class="fas fa-users text-3xl mr-4"></i>
                 <div>
                     <h2 class="text-lg font-semibold">New Customers</h2>
                     <p class="mt-2 text-3xl font-bold">{{ $newGuestsThisMonth }}</p>
                     <p class="text-sm">This Month</p>
                 </div>
             </div>

             <!-- Room Occupancy Rate -->
             <div class="bg-gradient-to-r from-red-600 to-pink-700 p-6 rounded-lg shadow-lg text-white flex items-center">
                 <i class="fas fa-chart-line text-3xl mr-4"></i>
                 <div>
                     <h2 class="text-lg font-semibold">Room Occupancy</h2>
                     <p class="mt-2 text-3xl font-bold">{{ round($occupancyPercent, 2) }}%</p>
                     <p class="text-sm">Occupancy Rate</p>
                 </div>
             </div>



             <!-- Recent Reservations -->
             <div class=" col-span-1 md:col-span-2 lg:col-span-3 bg-white p-6 rounded-lg shadow-lg overflow-x-auto">
                 <h2 class="text-lg font-semibold text-gray-700">Recent Reservations</h2>
                 <table id="myTable" class="w-full mt-4">
                     <thead>
                         <tr class="text-left border-b">
                             <th class="py-2">S/N </th>
                             <th class="py-2">Guest Name</th>
                             <th class="py-2">Room Type</th>
                             <th class="py-2">Check-in</th>
                             <th class="py-2">Check-out</th>
                             <th class="py-2">Status</th>
                             <th class="py-2">Action</th>
                         </tr>
                     </thead>
                     <tbody>
                         @foreach ($reservations as $reservation)
                             <tr class="text-gray-700 divide-y-2">
                                 <td class="py-2">{{ $loop->iteration }}</td>
                                 <td class="py-2">{{ $reservation->fullName }}</td>
                                 <td class="py-2">{{ $reservation->roomType }}</td>
                                 <td class="py-2">{{ \Carbon\Carbon::parse($reservation->checkIn)->format('M j, y') }}
                                 </td>
                                 <td class="py-2">{{ \Carbon\Carbon::parse($reservation->checkOut)->format('M j, y') }}
                                 </td>
                                 <td class="py-2">
                                     <span
                                         class="px-2 py-1 rounded-lg 
                                 @if ($reservation->status == 'active') bg-green-100 text-green-800
                               @elseif($reservation->status == 'canceled') bg-red-100 text-red-800
                                @elseif($reservation->status == 'pending') bg-gray-100 text-gray-500
                                @elseif($reservation->status == 'completed') bg-black text-white
                               @elseif($reservation->status == 'timed out') bg-yellow-100 text-yellow-800 @endif">
                                         {{ ucfirst($reservation->status) }}
                                     </span>
                                 </td>

                                 <td class="py-2">
                                     <a href="{{ route('admin.reservations.show', $reservation->id) }}"
                                         class="text-blue-500"><i class="fas fa-eye"></i></a>
                                     <a href="{{ route('admin.reservations.edit', $reservation->id) }}"
                                         class="text-yellow-500 hover:underline mx-2"><i class="fas fa-edit"></i></a>

                                 </td>
                             </tr>
                         @endforeach


                     </tbody>

                 </table>
             </div>
             <!-- Events List -->
             <div class="col-span-1 md:col-span-2 lg:col-span-3 bg-white p-6 rounded-lg shadow-lg overflow-x-auto">
                 <h2 class="text-lg font-semibold text-gray-700">Events</h2>
                 <table id="Table" class="w-full mt-4 ">
                     <thead>
                         <tr class="text-left border-b">
                             <th class="py-2">S/N</th>
                             <th class="py-2">Title</th>
                             <th class="py-2">Date</th>
                             <th class="py-2">Action</th>
                         </tr>
                     </thead>
                     <tbody>
                         @foreach ($events as $event)
                             @php
                                 $isPastEvent = \Carbon\Carbon::parse($event->date)->isPast();
                             @endphp
                             <tr
                                 class="text-gray-700 divide-y-2
                    {{ $isPastEvent ? 'bg-gray-100' : '' }}">
                                 <td class="py-2">{{ $loop->iteration }}</td>
                                 <td class="py-2">{{ $event->title }}</td>
                                 <td class="py-2">{{ \Carbon\Carbon::parse($event->date)->format('M j, Y') }}</td>

                                 <td class="py-2">
                                     <a href="{{ route('admin.events.show', $event->id) }}" class="text-blue-500"><i
                                             class="fas fa-eye"></i></a>
                                     <a href="{{ route('admin.events.edit', $event->id) }}"
                                         class="text-yellow-500 hover:underline mx-2"><i class="fas fa-edit"></i></a>
                                 </td>
                             </tr>
                         @endforeach
                     </tbody>
                 </table>
             </div>


         </div>

         <!-- Quick Links / Navigation -->
         <div class="md:w-1/4 bg-white p-6 rounded-lg shadow-lg">
             <h2 class="text-lg font-semibold text-gray-700 mb-4">Quick Links</h2>
             <ul class="space-y-3">
                 <li>
                     <a href="{{ route('admin.rooms.index') }}" class="flex items-center text-primary font-semibold">
                         <i class="fas fa-bed mr-2"></i> Manage Rooms
                     </a>
                 </li>
                 <li>
                     <a href="{{ route('admin.reservations.index') }}"
                         class="flex items-center text-primary font-semibold">
                         <i class="fas fa-calendar-check mr-2"></i> View Reservations
                     </a>
                 </li>
                 <li>
                     <a href="{{ route('admin.events.index') }}" class="flex items-center text-primary font-semibold">
                         <i class="fas fa-calendar-alt mr-2"></i> Manage Events
                     </a>
                 </li>
                 <li>
                     <a href="{{ route('admin.blogs.index') }}" class="flex items-center text-primary font-semibold">
                         <i class="fas fa-pen mr-2"></i> Blog Management
                     </a>
                 </li>
             </ul>
         </div>
     </div>
 @endsection

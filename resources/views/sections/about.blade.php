 <div class="container mx-auto px-6 lg:px-16 py-5">
     <div class="text-center">
         <h2 class="text-4xl font-bold text-gray-800 mb-4">About Oriental Hotel</h2>
         <p class="text-lg text-gray-600">Where elegance meets comfort and every guest is treated like family.</p>
     </div>

     <div class="mt-10 flex flex-col md:flex-row items-center md:space-x-8">
         <!-- Image -->
         <div class="w-full md:w-1/2 mb-8 md:mb-0" data-aos="zoom-in-up">
             <img src="{{ Storage::url($about->about_us_image) }}" alt="Hotel Interior"
                 class="w-full rounded-lg shadow-lg">
         </div>

         <!-- Text Content -->
         <div class="w-full md:w-1/2" data-aos="zoom-in-up"> 
             <p class="text-gray-700 text-lg leading-relaxed">{{ Str::limit(strip_tags($about->about_us ), 500, '...')}} </p>

         </div>
     </div>
 </div>

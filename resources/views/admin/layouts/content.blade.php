@include('admin.layouts.topbar')
<section class="flex">
    @include('admin.layouts.sidebar')
    <div class="flex-1 p-6 md:ml-52 mt-20">
        @yield('content')
    </div>
</section>


</body>

</html>

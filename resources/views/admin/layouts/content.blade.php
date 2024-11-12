@include('admin.layouts.topbar')
<section class="flex">
    @include('admin.layouts.sidebar')
    <div class="p-6 md:ml-52 mt-20 w-full bg-gray-200 min-h-screen">
        @yield('content')
    </div>
</section>
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>

<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>

<!-- DataTables Responsive JS -->
<script src="https://cdn.datatables.net/responsive/2.4.1/js/dataTables.responsive.min.js"></script>


<script>
    window.Laravel = {
        successMessage: "{{ session('success') }}",
        errorMessage: "{{ session('error') }}",
        infoMessage: "{{ session('info') }}",
        warningMessage: "{{ session('warning') }}"
    };

    $(document).ready(function() {
        $('#myTable').DataTable({
            responsive: true,
            paging: true,
            searching: true,
            stripeClasses: ['bg-gray-50', 'bg-white'],
            autoWidth: false
        });
    });
    $(document).ready(function() {
        $('#Table').DataTable({
            responsive: true,
            paging: true,
            searching: true,
            stripeClasses: ['bg-gray-50', 'bg-white'],
            autoWidth: false
        });
    });
</script>
</body>

</html>

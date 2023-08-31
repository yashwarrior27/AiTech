<div id="scroll-to-top"><i class="fa fa-arrow-up fa-fw"></i></div>
</body>
<script src="{{asset('assets/js/jquery.min.js')}}" ></script>
<script src="{{asset('assets/frontend/js/bootstrap.min.js')}}"></script>
<script src="{{asset('assets/js/toastr.min.js')}}"></script>
<script src="{{asset('assets/frontend/js/scrollIt.min.js')}}"></script>
<script src="{{asset('assets/frontend/js/jquery.countTo.js')}}"></script>
<script src="{{asset('assets/frontend/js/owl.carousel.min.js')}}"></script>
<script  src="{{asset('assets/frontend/js/ani.js')}}"></script>
<script src="{{asset('assets/frontend/js/main.js')}}"></script>
<script src="{{asset('assets/frontend/js/roadmap.js')}}"></script>
<script src="{{asset('assets/js/web3.min.js')}}"></script>
<script src="{{asset('assets/frontend/js/d3.v3.min.js')}}"></script>
<script src="{{asset('assets/js/app.js?').time()}}"></script>
<script src="{{asset('assets/frontend/js/datatable.jquery.js')}}"></script>
<script>
    $(document).ready( function () {
    $('#datatable').DataTable(
        {order: [[0, 'desc']]}
    );
    $('.innertable').DataTable();
   } );
</script>
@yield('script')

@if (Session::has('success'))
 <script>
     toastr.success("{{Session::get('success')}}");
 </script>
@endif

</html>

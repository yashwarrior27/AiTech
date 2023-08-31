
     <script src="{{asset('assets/js/jquery.min.js')}}" ></script>
    <script src="{{asset('assets/frontend/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('assets/js/toastr.min.js')}}"></script>
    <script src="{{asset('assets/frontend/js/scrollIt.min.js')}}"></script>
    <script src="{{asset('assets/frontend/js/jquery.countTo.js')}}"></script>
    <script src="{{asset('assets/frontend/js/owl.carousel.min.js')}}"></script>
    <script  src="{{asset('assets/frontend/js/ani.js')}}"></script>
    <script src="{{asset('assets/frontend/js/main.js')}}"></script>
    <script src="{{asset('assets/frontend/js/roadmap.js')}}"></script>
    <script src="{{asset('assets/js/phonenumber.min.js')}}"></script>
    <script src="{{asset('assets/js/web3.min.js')}}"></script>
   <script src="{{asset('assets/js/login-register.js')}}"></script>
<script>

            $(document).ready(function() {
                $('#loading-image').hide();
              var owl = $('.owl-carousel');
              owl.owlCarousel({
                margin: 20,
                nav: true,
                loop: true,
                autoplay:true,
    autoplayTimeout:3000,
    autoplayHoverPause:true,
     smartSpeed:1000,
                responsive: {
                  0: {
                    items: 1
                  },
                  600: {
                    items: 2
                  },
                  1000: {
                    items:4
                  }
                }
              });

            })

          </script>
		  {{-- <script type="text/javascript">
    $(window).on('load', function() {
        $('#timer').modal('show');
    });
</script> --}}

{{-- <script>

var deadline = new Date("june 20, 2023 15:30:00").getTime();

var x = setInterval(function() {

var now = new Date().getTime();
var t = deadline - now;

var days = Math.floor(t / (1000 * 60 * 60 * 24));
var hours = Math.floor((t%(1000 * 60 * 60 * 24))/(1000 * 60 * 60));
var minutes = Math.floor((t % (1000 * 60 * 60)) / (1000 * 60));
var seconds = Math.floor((t % (1000 * 60)) / 1000);
console.log("days", t, deadline)
document.getElementById("day").innerHTML =days ;
document.getElementById("hour").innerHTML =hours;
document.getElementById("minute").innerHTML = minutes;
document.getElementById("second").innerHTML =seconds;
if (t < 0) {
		clearInterval(x);
		document.getElementById("demo").innerHTML = "TIME UP";
		document.getElementById("day").innerHTML ='0';
		document.getElementById("hour").innerHTML ='0';
		document.getElementById("minute").innerHTML ='0' ;
		document.getElementById("second").innerHTML = '0'; }
}, 1000);
</script> --}}

    </html>

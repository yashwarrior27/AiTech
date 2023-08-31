@extends('FrontendDashboard.layouts.app')
@section('content')
<section class="dashbord_contaner">

	<h3>Dashboard</h3>
<div class="row">
<div class="col-md-8">
<div class="row">
<div class="col-md-6 mb-3 pr-md-2">
<div class="white_box h100">
<h5>3X Meter</h5>

<div class="row align-items-center">
<div class="col-5">
<div class="chart-area"></div>
</div>
<div class="col-7">
<h6>Total Package</h6>
<h5>$ {{isset($Incomes)?$Incomes['total_package']:'0'}}</h5>
</div>
</div>

</div>
</div>
<div class="col-md-6 mb-3 pl-md-2">
<div class="white_box h100">
<ul class="progressbar">

    @if (isset($Booster))

    @for ($i=1;$i<=3;$i++)
    <li  class="@if ($Booster['direct_count']>=$i)
         active
    @endif" >Direct {{$i}}</li>
    @endfor
    @else
    <li>Direct 1</li>
    <li>Direct 2</li>
    <li>Direct 3</li>
    @endif
      </ul>
<h5 class="text-center mt-4">Booster @if (isset($Booster) && $Booster['booster']<=1)
    Expiring In
    @elseif (isset($Booster) && $Booster['booster']==2)
    Activated
    @else
    Expired
     @endif
    </h5>
 <div id="clockdiv" class=" @if (isset($Booster) && $Booster['booster']>1)
    d-none
     @endif" class="mt-3" >
<div class="t_box" >
	<span class="days" id="day"></span>
	<div class="smalltext">Days</div>
</div>
<div class="t_box">
	<span class="hours" id="hour"></span>
	<div class="smalltext">Hours</div>
</div>
<div class="t_box">
	<span class="minutes" id="minute"></span>
	<div class="smalltext">Minutes</div>
</div>
<div class="t_box">
	<span class="seconds" id="second"></span>
	<div class="smalltext">Seconds</div>
</div>
</div>
</div>
</div>
</div>

<div class="row row_p">
<div class="col-xl-4 col-sm-6">
<div class="white_box mb-3 box_icon">
<i class="fa fa-coins b_icon"></i>
 <label class="mb-0">Total AITP Token</label>
 <h5 class="mb-0 ml-auto">{{isset($Incomes)?$Incomes['aitp_token']:'0'}}</h5>
 </div>
 </div>
<div class="col-xl-4 col-sm-6">
<div class="white_box mb-3 box_icon ">
<i class="fa fa-directions b_icon"></i>
 <label class="mb-0">Active Direct</label>
 <h5 class="mb-0 ml-auto">{{isset($data)?$data['active_direct']:'0'}}</h5>
 </div>
 </div>
<div class="col-xl-4 col-sm-6">
 <div class="white_box mb-3 box_icon">
 <i class="fa fa-directions b_icon"></i>
 <label class="mb-0">Inactive Direct</label>
 <h5 class="mb-0 ml-auto">{{isset($data)?$data['inactive_direct']:'0'}}</h5>
 </div>
 </div>
<div class="col-xl-4 col-sm-6">
 <div class="white_box mb-3 box_icon">
 <i class="fa fa-user-friends b_icon"></i>
 <label class="mb-0">Team Size</label>
 <h5 class="mb-0 ml-auto">{{isset($Teams)?$Teams['total_team']:'0'}}</h5>
 </div>
 </div>
<div class="col-xl-4 col-sm-6">
 <div class="white_box mb-3 box_icon">
 <i class="fa fa-user-friends b_icon"></i>
 <label class="mb-0">Active Team</label>
 <h5 class="mb-0 ml-auto">{{isset($Teams)?$Teams['total_active']:'0'}}</h5>
 </div>
 </div>
<div class="col-xl-4 col-sm-6">
 <div class="white_box mb-3 box_icon">
 <i class="fa fa-user-friends b_icon"></i>
 <label class="mb-0">Inactive Team</label>
 <h5 class="mb-0 ml-auto">{{isset($Teams)?$Teams['total_inactive']:'0'}}</h5>
 </div>
 </div>
<div class="col-xl-4 col-sm-6">
 <div class="white_box mb-3 box_icon">
 <i class="fa fa-gift b_icon"></i>
 <label class="mb-0"> Daily ROI Income</label>
 <h5 class="mb-0 ml-auto">$ {{isset($Incomes)?$Incomes['roi_income']:'0'}}</h5>
 </div>
 </div>
<div class="col-xl-4 col-sm-6">
 <div class="white_box mb-3 box_icon">
 <i class="fa fa-gift b_icon"></i>
 <label class="mb-0">Daily Level Income</label>
 <h5 class="mb-0 ml-auto">$ {{isset($Incomes)?$Incomes['level_income']:'0'}}</h5>
 </div>
 </div>
<div class="col-xl-4 col-sm-6">
 <div class="white_box mb-3 box_icon">
 <i class="fa fa-gift b_icon"></i>
 <label class="mb-0">Daily Rank Income</label>
 <h5 class="mb-0 ml-auto">$ {{isset($Incomes)?$Incomes['reward_income']:'0'}}</h5>
 </div>
 </div>

</div>
</div>
<div class="col-md-4">
	<div class="white_box profile_box">
	<div class="profile_img">
	  <img class="img" src="{{url("assets/images/profile_images/{$data['profile_image']}")}}">
	</div>

	<ul>
	  <li><span>Sponsor ID</span><h6>{{$data['parent_id']??'-'}}</h6></li>
	  <li><span>Referral ID</span><h6>{{$data['register_id']??'-'}}</h6></li>
      <li><span>Referral Link</span><h6 class="text-break " id="copy-link">{{ substr(url("/register/{$data['register_id']}"),0,25)}}... <i class="fa fa-clipboard" aria-hidden="true" style="font-size: 20px"></i></h6>
    </li>
	  <li><span>Total Income</span><h6>$ {{$Incomes['total_income']??'-'}}</h6></li>
    <li><span>Total Team Business</span><h6>$ {{$Teams['total_business']??'-'}}</h6></li>
	</ul>
    <span class="d-none" id="refer_link">{{url("/register/{$data['register_id']}")}}</span>
	</div>
</div>
</div>
<!-- Modal -->
<!-- <div class="modal fade" id="telegrammodal">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-body text-center">
      <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
        <img src="{{asset('assets/frontend/img/logo.png')}}" class="img-fluid mb-3" alt="aitechpro logo" >
       <h3 class="mb-1">Join Our Telegram Group</h3>
       <h3 class="mb-3">For latest Updates</h3>
      <a href="#" onclick="openTelegramLink()" class="d-none d-md-block"><h5 style="text-decoration:underline;">Ai TechPro Official <img src="{{asset('assets/frontend/img/telegram.png')}}" class="img-fluid" style="width:8%;filter: drop-shadow(0px 0px 3px #29b6f6);" alt="telegram"></h5>
      </a>
      <h5 class="d-md-none" style="text-decoration:underline;" id="telegram-link">https://t.me/Aitechproofficial<img src="{{asset('assets/frontend/img/telegram.png')}}" class="img-fluid" style="width:8%;filter: drop-shadow(0px 0px 3px #29b6f6);" alt="telegram"></h5>
      <span class="d-none" id="telegram_link">https://t.me/Aitechproofficial</span>
      </div>

    </div>
  </div>
</div> -->
</section>
@endsection
@section('script')
<!-- <script>
  $(document).ready(function(){
    $('#telegrammodal').modal('show');
  });
</script> -->
<script>
    var width = 100,
     height = 100;

   var outerRadius = width / 3;
   var innerRadius = 30;

   var data = [{{isset($Incomes)?$Incomes['income_percent']:'0'}}];
   var pie = d3.layout.pie().value(function(d) {
     return d;
   });

   var endAng = function(d) {
     return (d / 100) * Math.PI * 2;
   };

   var bgArc = d3.svg
     .arc()
     .innerRadius(innerRadius)
     .outerRadius(outerRadius)
     .startAngle(0)
     .endAngle(Math.PI * 2);

   var dataArc = d3.svg
     .arc()
     .innerRadius(innerRadius)
     .outerRadius(outerRadius)
     .cornerRadius(15)
     .startAngle(0);

   var svg = d3
     .select('.chart-area')
     .append("svg")
     .attr("preserveAspectRatio", "xMinYMin meet")
     .attr("viewBox", "0 0 100 100")
     .attr("class" ,"shadow")
     .classed("svg-content", true);

   var path = svg
     .selectAll("g")
     .data(pie(data))
     .enter()
     .append("g")
     .attr("transform", "translate(" + width / 2 + "," + height / 2 + ")");

   path
     .append("path")
     .attr("d", bgArc)
     .style("stroke-width", 5)
     .attr("fill", "rgba(255,255,255,0.1)");

   path
     .append("path")
     .attr("fill", "#cc0fe5")
     .transition()
     .ease("ease-in-out")
     .duration(750)
     .attrTween("d", arcTween);

   path
     .append("text")
     .attr("fill", "#fff")
     .attr("font-size","1em")
     .attr("tex-anchor", "middle")
     .attr("x", -17)
     .attr("y", 8)
     .transition()
     .ease("ease-in-out")
     .duration(750)
     .attr("fill", "#fff")
     .text(data+'%');

   function arcTween(d) {
     var interpolate = d3.interpolate(d.startAngle, endAng(d.data));
     return function(t) {
       d.endAngle = interpolate(t);
       return dataArc(d);
     };
   }
 </script>


 <script>

 var deadline = new Date(0);
 deadline=deadline.setUTCSeconds({{isset($Booster)?$Booster['booster_time']:0}});

 var x = setInterval(function() {

 var now = new Date().getTime();
 var t = deadline - now;
 console.log(t);
 if(t>0)
 {
    var days = Math.floor(t / (1000 * 60 * 60 * 24));
 var hours = Math.floor((t%(1000 * 60 * 60 * 24))/(1000 * 60 * 60));
 var minutes = Math.floor((t % (1000 * 60 * 60)) / (1000 * 60));
 var seconds = Math.floor((t % (1000 * 60)) / 1000);
 document.getElementById("day").innerHTML =days ;
 document.getElementById("hour").innerHTML =hours;
 document.getElementById("minute").innerHTML = minutes;
 document.getElementById("second").innerHTML =seconds;
 }

 else {
         clearInterval(x);
        //  document.getElementById("demo").innerHTML = "TIME UP";
         document.getElementById("day").innerHTML =0;
         document.getElementById("hour").innerHTML =0;
         document.getElementById("minute").innerHTML =0;
         document.getElementById("second").innerHTML = 0; }
 }, 1000);

 function copyToClipboard(text) {
  var tempInput = document.createElement("input");
  tempInput.value = text;
  document.body.appendChild(tempInput);
  tempInput.select();
  tempInput.setSelectionRange(0, 99999); 
  document.execCommand("copy");
  document.body.removeChild(tempInput);
}


 $('#copy-link').on('click', function (e) {
var copyGfGText = document.getElementById("refer_link").innerHTML;
 (async () => {
try {
  await copyToClipboard(copyGfGText);
  toastr.success('Link copied to clipboard');
} catch (err) {
  toastr.error('Failed to copy: ', err);
}
})()
});
$('#copy-link').on('click', function (e) {
var copyGfGText = document.getElementById("refer_link").innerHTML;
 (async () => {
try {
  await copyToClipboard(copyGfGText);
  toastr.success('Link copied to clipboard');
} catch (err) {
  toastr.error('Failed to copy: ', err);
}
})()
});
$('#telegram-link').on('click', function (e) {
var copyGfGText = document.getElementById("telegram_link").innerHTML;
 (async () => {
try {
  await copyToClipboard(copyGfGText);
  toastr.success('Link copied to clipboard');
} catch (err) {
  toastr.error('Failed to copy: ', err);
}
})()
});
 </script>
 <script>
   function openTelegramLink() {
  var telegramLink = 'https://t.me/Aitechproofficial';

  // Check if the device has the Telegram app installed
  if (typeof webkit !== 'undefined' && typeof webkit.messageHandlers !== 'undefined' && typeof webkit.messageHandlers.openURL !== 'undefined') {
    webkit.messageHandlers.openURL.postMessage(telegramLink);
  } else {
    // Fallback: Open the Telegram link in a new tab or window
    window.open(telegramLink, '_blank');
  }
}
 </script>
@endsection

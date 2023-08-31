@include('Frontend.layouts.header')
<body>
    <video class="video_wrap" playsinline="playsinline" autoplay="autoplay" muted="muted" loop="loop">
                            <source src="{{asset('assets/frontend/video.mp4')}}" type="video/mp4">
    </video>

    <div class="logib_part " >
        <div class="container">
          <div class="row align-items-end">

            <div class="col-md-6 m-auto">

               <div class="card2">

                   <ul class="nav nav-pills mb-4" id="pills-tab" role="tablist">
                       <li class="nav-item text-center">
                         <a class="nav-link  btl @if (request()->segment(1)=='login')
                            active
                         @endif" id="pills-login-tab" data-toggle="pill" href="#pills-login" role="tab" aria-controls="pills-login" aria-selected="true">Login</a>
                       </li>
                       <li class="nav-item text-center ml-auto">
                         <a class="nav-link btr @if (request()->segment(1)=='register')
                            active
                         @endif" id="pills-register-tab" data-toggle="pill" href="#pills-register" role="tab" aria-controls="pills-register" aria-selected="false">Register</a>
                       </li>

                     </ul>
                     <div class="tab-content" id="pills-tabContent">
                       <div class="tab-pane fade @if (request()->segment(1)=='login')
                        show active
                     @endif" id="pills-login" role="tabpanel" aria-labelledby="pills-login-tab">

                             <div class="form-group mt-5">
                           <button class="btn btn2  btn-block" id="login">Connect Wallet</button>

                         </div>

                       </div>
                       <div class="tab-pane fade @if (request()->segment(1)=='register')
                        show active
                     @endif" id="pills-register" role="tabpanel" aria-labelledby="pills-register-tab">

                     <form method="POST" id="register" >
                          <div class="form-group">
                        <div class="row">
                          <div class="col-md-3 col-4  mb-2">
                              <label>Country Code </label>
                                <select class="form-select bg-dark text-white rounded country_code" id="country_code" name="country_code" >
                                    <option value="" selected>+ Code</option>

                                    @if (isset($countries)&&count($countries)>0)

                                    @foreach ( $countries as $key=>$value )
                                    <option value="{{$value->id}}-{{$value->phonecode}}"@if ($value->id==99)
                                       selected
                                    @endif>+ {{$value->phonecode}}</option>
                                    @endforeach

                                    @endif

                                  </select>

                            </div>
                            <div class="col-md-9 col-8  pl-0">
                              <label>Mobile Number</label>
                                <input id="phone" type="text" class="form-control" name="phone"  autocomplete="phone" autofocus  onkeydown="javascript: return ['Backspace','Delete','ArrowLeft','ArrowRight'].includes(event.code) ? true : !isNaN(Number(event.key)) && event.code!=='Space'"
                                 placeholder="Enter Mobile Number" >
                                 <span class="text-danger" id="phone-err"></span>

                            </div>
                        </div>
                       </div>

                             <div class="form-group">
                             <label>Referral Code </label>
                             <input id="referral_no" type="text" class="form-control @error('referral_no') is-invalid @enderror" name="referral_code" placeholder="Enter Referral Code" value="{{$referral_id??''}}">
                             <span class="text-danger" id="referral-err"></span>
       </div>
                             <div class="form-group">
                           <button class="btn btn2  btn-block">Register</button>
                         </div>
                     </form>

                       </div>

                      </div>

               </div>


           </div>
           </div>
       </div>
       </div>
    <div id="scroll-to-top"><i class="fa fa-arrow-up fa-fw"></i></div>

    </body>
@include('Frontend.layouts.footer')

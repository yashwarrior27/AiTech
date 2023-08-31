@extends('FrontendDashboard.layouts.app')
@section('content')
<section class="dashbord_contaner">
    <h3>Profile</h3>
    <div class="row">
    <div class="col-md-8">
    <div class="white_box  box_icon mb-3 h100">
        <form method="post" action="{{url("/profile/update")}}" id="profile">

            @csrf
                <div class="mb-3">
                    <label class="form-label">Name</label>
                    <input type="text" class="form-control" placeholder="Name" aria-label="Name" name="name" value="{{old('name',$user->name??'')}}" onkeydown="truncateInputValue(this, 20)">
                    <span class="text-danger" id="name-err">
                        @error('name')
                       {{$message}}
                        @enderror
                    </span>

                </div>
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="text" class="form-control" placeholder="Email" aria-label="email" name="email" value="{{old('email',$user->email??'')}}">
                    <span class="text-danger" id="email-err">
                    @error('email')
                  {{$message}}
                    @enderror</span>
                </div>
                <div class="row mb-3">

                    <div class="col-md-3 col-4  mb-2">
                        <label class=" d-none d-sm-block">Country Code </label>
                        <label class="d-block d-sm-none ">Code</label>
                          <select class="form-select bg-transparent text-white rounded country_code" id="country_code" name="country_code" >
                              <option value="" selected>+ Code</option>

                              @if (isset($countries)&&count($countries)>0)

                              @foreach ( $countries as $key=>$value )
                              <option value="{{$value->id}}-{{$value->phonecode}}"@if(isset($user) && $user->country_id==$value->id)
                                selected
                                @elseif ($value->id==99)
                                 selected
                              @endif
                              >+ {{$value->phonecode}}</option>
                              @endforeach

                              @endif

                            </select>
                            @error('phone')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                      </div>
                      <div class="col-md-9 col-8  pl-0">
                        <label>Mobile Number <span class="text-danger">*</span></label>
                          <input id="phone" type="text" class="form-control" name="phone"  autocomplete="phone" onkeydown="javascript: return ['Backspace','Delete','ArrowLeft','ArrowRight'].includes(event.code) ? true : !isNaN(Number(event.key)) && event.code!=='Space'"
                           placeholder="Enter Mobile Number" value="{{old('phone',$user->phone??'')}}" >
                           <span class="text-danger" id="phone-err">
                            @error('country_code')
                            {{$message}}
                            @enderror
                           </span>
                      </div>
                </div>

                <div class="m-3 mt-5 text-center">
                 <button type='submit' class="btn btn_in ">Update</button>
                </div>
        </form>

    </div>

    </div>

    <div class="col-md-4">
        <div class="white_box profile_box">
        <div class="profile_img" >
            <form action="{{url('/profile/image-upload')}}" id="image-upload"  enctype="multipart/form-data" method="POST">
                @csrf
            <input type="file" name="profile_image" onchange="document.getElementById('image-upload').submit()" accept="image/*" id="profile_image" hidden>
           <label for="profile_image" class="images"><img class="img"  src="{{url("assets/images/profile_images/{$user->profile_image}")}}" >
            <i class="fa fa-camera"></i></label>
        </form>
        </div>

        <ul>
          <li><span>Sponsor ID</span><h6>{{$user->parent->register_id}}</h6></li>
          <li><span>Referral ID</span><h6>{{$user->register_id}}</h6></li>
          <li><span>Referral Link</span><h6 class="text-break" id="copy-link">{{ substr(url("/register/{$user->register_id}"),0,25)}}... <i class="fa fa-clipboard" aria-hidden="true" style="font-size: 20px"></i></h6>
            </li>
        </ul>
          <span class="d-none" id="refer_link">{{url("/register/$user->register_id")}}</span>
        </div>
    </div>
    </div>
    </section>
@endsection
@section('script')
<script>
    function truncateInputValue(input, maxLength) {
            if (input.value.length > maxLength) {
              input.value = input.value.substr(0, maxLength);
            }
          }
</script>
<script src="{{asset('assets/js/phonenumber.min.js')}}"></script>
<script src="{{asset('assets/js/profile.js')}}"></script>

@endsection

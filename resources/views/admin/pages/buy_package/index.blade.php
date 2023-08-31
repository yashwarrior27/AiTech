@extends('admin.layouts.main')
@section('content')

<div class="row justify-content-center">

<div class="col-10 ">
 <div class="card border-bottom border-primary">
    <div class="card-body p-0 p-3">
        <div class="row">
            <div class="col-7">

                <h3 class="m-0">{{$title ?? 'title'}}</h3>
            </div>
             <div class="col-5 text-center" style="align-self: center;">
                 <h5 class="m-0"><span class="badge bg-success">{{isset($package_status) && $package_status==0?'Package already activated.':''}}</span></h5>
             </div>
        </div>
    </div>
 </div>
</div>

<div class="col-8 my-4 py-4">
    <div class="card border-bottom border-primary">
        <div class="card-body">
    <form @if (!isset($user))
    action="{{url('/admin/buy-package/wallet-address')}}" method="POST"
    @endif  class="validate-form" >
        @csrf
        <div class="mb-3">
          <label for="wallet_address" class="form-label">Wallet Address</label>
          <input type="text" class="form-control" id="wallet_address" name="wallet_address" placeholder="Enter Wallet Address" required autofocus value="{{old('wallet_address',isset($user)?$user->wallet_address:'')}}" onchange="document.getElementById('wallet-err').classList.add('d-none');" @if (isset($user))
            disabled
          @endif>
          <span class="text-danger" id="wallet-err">
              @error('wallet_address')
                {{$message}}
              @enderror
          </span>
        </div>
        <button type="submit" class="btn btn-primary btn-sm" @if (isset($user))
        disabled
      @endif>Submit</button>
      </form>
</div>
    </div>
</div>
<div class="col-4 my-4 py-4 {{!isset($packages)?'d-none':''}}">
    <div class="card border-bottom border-primary pb-1">
        <div class="card-body">
            <form action="{{url("/admin/buy-package/purchase").(isset($user)?'/'.$user->id:'')}}" method="POST">
                @csrf
                <div class="mb-3">
            <label for="package" class="form-label">Packages</label>
            <select class="form-select rounded w-100 p-1 " name="package" id="package" @if (isset($package_status) && $package_status==0 )
            disabled
          @endif >
              @if (isset($packages) && count($packages)>0)
              @foreach ($packages as $key => $package)
                  <option value="{{$package->id}}"> {{$package->invest_amount}}$ Package (Roi {{$package->monthly_roi}}%)</option>
              @endforeach
              @endif
            </select>
            <span class="text-danger">
                @error('package')
                {{$message}}
                @enderror
            </span>
        </div>
            <button type="submit" class="btn btn-primary btn-sm" @if (isset($package_status) && $package_status==0 )
            disabled
          @endif >Buy</button>
            </form>
        </div>
    </div>
</div>
<div class="col-12 my-1 {{!isset($user)?'d-none':''}}">
    <div class="card border-bottom border-success">
        <div class="card-body">
    <form>
        <div class="row">
            <div class="col-4 mb-2">
                <label for="register_id" class="form-label">Register ID</label>
          <input type="text" class="form-control" id="register_id" value="{{$user->register_id??'-'}}" disabled >
            </div>
            <div class="col-4 mb-2">
                <label for="name" class="form-label">Name</label>
          <input type="text" class="form-control" id="name" value="{{$user->name??'-'}}" disabled >
            </div>
            <div class="col-4 mb-2">
                <label for="Phone" class="form-label">Mobile No.</label>
          <input type="text" class="form-control" id="Phone" value="{{$user->phone??'-'}}" disabled >
            </div>
            <div class="col-4 mb-2">
                <label for="email" class="form-label">Email</label>
          <input type="text" class="form-control" id="email" value="{{$user->email??'-'}}" disabled >
            </div>
        </div>
      </form>
</div>
    </div>
</div>
</div>
@endsection

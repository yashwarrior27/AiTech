@extends('FrontendDashboard.layouts.app')
@section('content')
<section class="dashbord_contaner">

	<h3>Package</h3>
<div class="white_box mb-3">


    <form id="package-purchase" method="POST">


        <div class="row mt-2 p-2">
            <div class="col-sm-4 my-2">
                <select class="form-select  bg-transparent text-white rounded w-100 p-1 " name="package" id="package" @if (isset($package_status) && $package_status==0 )
                  disabled
                @endif >
                    @if (isset($packages) && count($packages)>0)

                    @foreach ($packages as $key => $package)
                        <option value="{{$package->id}}-{{$package->invest_amount}}">{{$package->invest_amount}}$ Package (Roi {{$package->monthly_roi}}%)</option>
                    @endforeach
                    @endif
                  </select>
            </div>
            <div class="col-sm-4 my-2">
                <select class="form-select   bg-transparent text-white rounded w-100 p-1" name="currency" id="Token" @if (isset($package_status) && $package_status==0 )
                disabled
              @endif >
                    <option value='' selected>Select Currency</option>
                    @if (isset($curriences) && count($curriences)>0)
                    @foreach ($curriences as $key => $curriency)
                        <option value="{{$curriency->id}}">{{$curriency->name}}</option>
                    @endforeach
                    @endif
                  </select>
            </div>
            <div class="col-sm-4 my-2">
                <button type="submit" class="btn btn_in" id="package-buy" @if (isset($package_status) && $package_status==0 )
                disabled
              @endif  >Purchase</button>
                <button type="submit" class="btn btn_in d-none" id="approved-allowence" @if (isset($package_status) && $package_status==0 )
                disabled
              @endif
              >Approve</button>
            </div>
        </div>
    </form>
</div>
<div class="white_box mb-3">
<h5 class="mb-3">Package History</h5>
<table class="table " id="datatable">
    <thead>
      <tr>
        <th>SNo.</th>
        <th>Package ID</th>
        <th>Currency</th>
        <th>Amount</th>
        <th>Date</th>
        <th>Booster</th>
        <th>Fastrack</th>
        <th>Status</th>
      </tr>
    </thead>
    <tbody>
        @if (count($packageHistory)>0)

        @foreach ($packageHistory as $item => $value)
        <tr>
            <td>{{++$item??'-'}}</td>
            <td>{{$value->package->id??"-"}}</td>
            <td>{{$value->metaTransection->currency->name??'-'}}</td>
            <td>${{$value->package->invest_amount??'-'}}</td>
            <td>{{date('Y-m-d',strtotime($value->created_at))}}</td>
            <td>@if ($value->booster_status==0)
                  Pending
                @elseif($value->booster_status==1)
                Active
                @else
                Expired
            @endif</td>
            <td>@if ($value->fastrack_status==0)
                Pending
              @elseif($value->fastrack_status==1)
              Active
              @else
              Expired
          @endif</td>
            <td>{{$value->status==1?'Active':'Expired'??'-'}}</td>
          </tr>
        @endforeach
        @endif
    </tbody>
  </table>
</div>
</section>
@endsection
@section('script')

@if (isset($package_status))
<script>
    @if ($package_status==0)
    $('#package-buy').removeAttr('id');
    @endif
sessionStorage.package_status={{$package_status}};
</script>
@endif

@endsection

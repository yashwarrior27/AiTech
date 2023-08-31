@extends('FrontendDashboard.layouts.app')
@section('styles')
<link rel="stylesheet" href="{{asset('assets/frontend/css/custom-pagination.css')}}">
@endsection
@section('content')
<section class="dashbord_contaner">

    <h3>Daily Income</h3>
    <div class="white_box mb-3">
    <table class="table " id="datatable">
        <thead>
          <tr>
            <th class="d-none"></th>
            <th>SNo.</th>
            <th>Package Id</th>
            <th>Amount</th>
            <th>Date </th>
          </tr>
        </thead>
        <tbody>
            @if (isset($results))

            @foreach ($results as $key=>$value)
            <tr>
                <td class="d-none">{{$value->id??'-'}}</td>
                <td>{{$key+$results->firstItem()??'-'}}</td>
                <td>{{$value->packageUser->package_id??'-'}}</td>
                <td>{{'$ '.$value->amount??'-'}}</td>
                <td>{{date('Y-m-d',strtotime($value->created_at))??'-'}}</td>

              </tr>
            @endforeach

            @endif

        </tbody>
      </table>
      <div class="d-flex justify-content-end mt-3 mx-3" >{!!$results->links()!!}</div>
    </div>
    </section>

@endsection

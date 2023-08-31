@extends('FrontendDashboard.layouts.app')
@section('content')
<section class="dashbord_contaner">

	<h3>Direct Teams</h3>
<div class="white_box mb-3">
<table class="table innertable" >
    <thead>
      <tr>
        <th>SNo.</th>
        <th>Register ID</th>
        <th>Name</th>
        <th>Mobile No.</th>
        <th>Team Business</th>
      </tr>
    </thead>
    <tbody>

        @if (isset($totaldirects) && count($totaldirects)>0)

        @foreach ($totaldirects as $key => $value )
        <tr>
            <td>{{$key+1??'-'}}</td>
            <td>{{$value['direct']->register_id??'-'}}</td>
            <td>{{$value['direct']->name??'-'}}</td>
            <td>{{$value['direct']->phone??'-'}}</td>
            <td>{{$value['teambusiness']??'-'}}</td>
          </tr>
        @endforeach
        @endif
    </tbody>
  </table>
</div>


</section>
@endsection

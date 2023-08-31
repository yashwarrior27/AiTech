@extends('FrontendDashboard.layouts.app')
@section('content')
<section class="dashbord_contaner">

	<h3>Rewards</h3>
<div class="white_box mb-3">
<table class="table" id="datatable">
    <thead>
      <tr>
          <th class="d-none"></th>
        <th>SNo.</th>
        <th>Reward Id</th>
        <th>Amount</th>
        <th>Date</th>
        <th>Status</th>
      </tr>
    </thead>
    <tbody>

        @if (isset($results))

        @foreach ($results as $key => $value )
        <tr>
            <td class="d-none">{{$value->id??'-'}}</td>
            <td>{{$key+1??'-'}}</td>
            <td>{{$value->rewardIncome->id??'-'}}</td>
            <td>{{'$ '.$value->rewardIncome->reward_amount??'-'}}</td>
            <td>{{date('Y-m-d',strtotime($value->created_at))??'-'}}</td>
            <td>{{$value->status==1?'Active':'In-active'??'-'}}</td>
          </tr>
        @endforeach
        @endif
    </tbody>
  </table>
</div>


</section>
@endsection

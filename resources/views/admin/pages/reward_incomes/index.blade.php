@extends('admin.layouts.main')
@section('content')

<div class="row justify-content-center">

<div class="col-10 ">
 <div class="card border-bottom border-primary">
    <div class="card-body p-0 p-3">
        <div class="row">
            <div class="col-10">

                <h3 class="m-0">{{$title ?? 'title'}}</h3>
            </div>
        </div>
    </div>
 </div>
</div>
<div class="col-12 mt-5">
    <div class="card border-bottom border-primary">
        <div class="card-body">
            <div class="table-responsive pb-2">
            <table class="table table-striped  table-hover table-borderless pt-3 " id="myTable">
                <thead class="">
                  <tr>
                    <th class="d-none"></th>
                    <th scope="col" class="text-center"> SrNo.</th>
                    <th scope="col" class="text-center">Register Id</th>
                    <th scope="col" class="text-center">Amount</th>
                    <th scope="col" class="text-center">Reward Amount</th>
                    <th scope="col" class="text-center">Date</th>
                  </tr>
                </thead>
                <tbody>
                    @if (isset($results))
                    @foreach ($results->cursor() as $key => $item)
                    <tr><th class="d-none">{{$item?->id??'-'}}</th>
                        <th scope="row" class="text-center">{{$key+1??'-'}}</th>
                        <td class="text-center">{{$item?->User?->register_id??'-'}}</td>
                        <td class="text-center">{{'$ '.$item?->amount??'-'}}</td>
                        <td class="text-center">{{'$ '.$item?->RewardIncome?->rewardIncome?->reward_amount??'-'}}</td>
                        <td class="text-center">{{date('Y-m-d',strtotime($item?->created_at))??'-'}}</td>
                      </tr>
                    @endforeach
                @endif
                </tbody>
              </table>
            </div>
        </div>
    </div>
</div>
</div>
@endsection

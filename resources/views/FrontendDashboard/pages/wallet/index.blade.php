@extends('FrontendDashboard.layouts.app')
@section('styles')
<link rel="stylesheet" href="{{asset('assets/frontend/css/custom-pagination.css')}}">
@endsection
@section('content')
<section class="dashbord_contaner">
    <h3>Wallet</h3>

    <div class="row ">
    <div class="col-sm-4 mb-3">
    <div class="white_box h100 box_icon">
    <i class="fa fa-hand-holding-usd b_icon"></i>
    <label>Total Income</label>
        <h5>$ {{isset($Incomes)?$Incomes['total_income']:'0'}}</h5>
    </div>
    </div>
    <div class="col-sm-4 mb-3">
    <div class="white_box h100 box_icon">
    <i class="fa fa-dollar-sign b_icon"></i>
    <label>Available Balance</label>
        <h5 id='available'>$ {{isset($Incomes)?(float)$Incomes['available_income']:'0'}}</h5>
    <div class="text-right">
        <button type="button" class="btn btn_in" id="withdrawal">Withdraw</button>
    </div>
    </div>
    </div>
    </div>
    </div>
    <div class="white_box mb-3">
    <h5 class="mb-3">Wallet History</h5>
    <table class="table" id="datatable">
        <thead>
          <tr>
              <th class="d-none"></th>
            <th>SNo.</th>
            <th>Type</th>
            <th>Amount</th>
            <th>Date</th>
          </tr>
        </thead>
        <tbody>
            @if (isset($results))

            @foreach ($results as $key=>$value)
            <tr>
                <td class="d-none">{{$value->id??'-'}}</td>
                <td>{{$key+$results->firstItem()??'-'}}</td>
                <td>
                    @if ($value->trans==1)
                    {{$value->packageUser->package->id.' (ROI) '}}
                    @elseif($value->trans==3)
                    {{$value->LevelIncome->level_income_id.' Level '}}
                    @elseif($value->trans==5)
                    {{$value->RewardIncome->rewardIncome->id.' Reward '}}
                    @else
                    {{'withdrawal '}}
                    @endif
                </td>
                <td>{{'$ '.$value->amount??'-'}}
                @if ($value->trans!=7)
                <span class="text-success"> cr</span>
                @else
                <span class="text-danger"> dr</span>
                @endif
                </td>
                <td>{{date('Y-m-d',strtotime($value->created_at))}}</td>
              </tr>

            @endforeach

            @endif

        </tbody>
      </table>
      <div class="d-flex justify-content-end mt-3 mx-3" >{!!$results->links()!!}</div>
    </div>

    <div class="white_box mb-3 mt-3">
        <h5 class="mb-3">Withdrawal History</h5>
        <table class="table innertable">
            <thead>
              <tr>

                <th>SNo.</th>
                <th>Currency</th>
                <th>Amount</th>
                <th>Status</th>
                <th>Date</th>
              </tr>
            </thead>
            <tbody>
                @if (isset($withdrawals))

                @foreach ($withdrawals as $key=>$value)
                <tr>

                    <td>{{$key+1??'-'}}</td>
                    <td>{{$value->currency->name??'-'}}</td>
                    <td>{{'$ '.$value->amount??'-'}}
                    <td class="text-capitalize">{{$value->status??'-'}}</td>
                    <td>{{date('Y-m-d',strtotime($value->created_at))}}</td>
                  </tr>
                @endforeach
                @endif
            </tbody>
          </table>
        </div>

    <div class="modal fade" id="withdrawalmodal" tabindex="-1">
        <div class="modal-dialog">
          <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
              <h4 class="modal-title">Withdrawal <span class="text-muted" style="font-size: 15px">{{env('Withdrawal_per',5)}}% withdrawal-fees</span> </h4>
              <button type="button" class="close" data-dismiss="modal">×</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <form action="" id="wdt">
                    <div class="form-group">
                        <label class="form-label">Amount</label>
                        <input type="text" id="wdamt" class="form-control" name="amount" 
                        placeholder="Minimun 20 $">
                        <span id="wd-amt-err" class="text-danger"></span>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button class="btn btn_in" id="wd-sbt" type="submit" disabled>Submit</button>
                          <a href="#" class="btn btn-danger p-2 px-3 mx-2" data-dismiss="modal">Close</a>
                    </div>
                </form>
             </div>

          </div>
        </div>
      </div>
    </section>
@endsection
@section('script')
@if (isset($Incomes))
<script>
    sessionStorage.setItem('amt',btoa('{{$Incomes['available_income']}}'));
</script>
@endif
@endsection

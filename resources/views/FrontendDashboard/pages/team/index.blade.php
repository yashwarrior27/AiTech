@extends('FrontendDashboard.layouts.app')

@section('content')
<section class="dashbord_contaner">
    <h3>Team</h3>

    <div class="row ">
    <div class="col-sm-3 mb-3">
    <div class="white_box h100 box_icon">
    <i class="fa fa-users b_icon"></i>
    <label>Total Team</label>
        <h5 class="text-center">{{isset($total_team)?$total_team:'-'}}</h5>

    </div>
    </div>

    <div class="col-sm-3 mb-3">
        <div class="white_box h100 box_icon">
        <i class="fa fa-check b_icon"></i>
        <label>Total Active</label>
            <h5 class="text-center">{{isset($total_active)?$total_active:'-'}}</h5>

        </div>
        </div>
        <div class="col-sm-3 mb-3">
            <div class="white_box h100 box_icon">
            <i class="fa fa-times b_icon"></i>
            <label>Total Inactive</label>
                <h5 class="text-center">{{isset($total_inactive)?$total_inactive:'-'}}</h5>

            </div>
            </div>
            <div class="col-sm-3 mb-3">
                <div class="white_box h100 box_icon">
                <i class="fa fa-dollar-sign b_icon"></i>
                    <label>Total Business</label>
                    <h5 class="text-center">{{isset($total_business)?'$ '.$total_business:'-'}}</h5>

                </div>
                </div>
    </div>
    </div>
    <div class="white_box mb-3">
    <h5 class="mb-3">Team History</h5>
    <table class="table " id="datatable">
        <thead>
          <tr>
             <th class="d-none"></th>
            <th>Level</th>
            <th>Team Size</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
            @if (isset($levels))
             @php
                 $c=20;
             @endphp
            @foreach ($levels as $key=>$value)
            <tr>
                <td class="d-none">{{$c--??'-'}}</td>
                <td>{{$key+1??'-'}}</td>
                <td>{{$value['level']??'-'}}</td>
                <td><button class="btn btn_in" @if ($value['level']==0)
                 disabled
                 @else
                 data-toggle="modal" data-target="#teamdata{{$key}}"
                @endif>View</button></td>
              </tr>
              </div>
            @endforeach

            @endif

        </tbody>
      </table>
    </div>

    @if (isset($levels))

    @foreach ($levels as $key=>$value)

    <div class="modal fade" id="teamdata{{$key}}">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
              <h4 class="modal-title">Team Data</h4>
              <button type="button" class="close" data-dismiss="modal">×</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <table class="table innertable">
                    <thead>
                      <tr>
                        <th scope="col">SNo.</th>
                        <th scope="col">Parent ID</th>
                        <th scope="col">Register ID</th>
                        <th scope="col">Total Package</th>
                      </tr>
                    </thead>
                    <tbody>

                        @php
                            $i=0;
                        @endphp
                        @foreach ($value['team'] as $key1 => $team)
                        <tr>
                        <th scope="row">{{++$i??'-'}}</th>
                        <td>{{$team->parent->register_id??'-'}}</td>
                        <td>{{$team->register_id??'-'}}</td>
                        <td>{{'$ '.$team->Allpackages->sum('invest_amount')??'-'}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                  </table>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
              </div>
          </div>
        </div>
      </div>

    @endforeach
    @endif
    </section>
@endsection


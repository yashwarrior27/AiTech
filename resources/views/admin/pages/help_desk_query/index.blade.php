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
                    <th scope="col" class="text-center">Subject</th>
                    <th scope="col" class="text-center">Email</th>
                    <th scope="col" class="text-center">Image</th>
                    <th scope="col" class="text-center">Message</th>
                    <th scope="col" class="text-center">Date</th>
                    <th scope="col" class="text-center">Status</th>
                  </tr>
                </thead>
                <tbody>
                    @if (isset($results))
                    @foreach ($results as $key => $item)
                    <tr><th class="d-none">{{$item->id??'-'}}</th>
                        <th scope="row" class="text-center">{{$key+1??'-'}}</th>
                        <td class="text-center">{{$item->user->register_id??'-'}}</td>
                        <td class="text-center">{{$item->subject??'-'}}</td>
                        <td class="text-center">{{$item->email??'-'}}</td>
                        <td class="text-center"><a href="{{url('/assets/images/helpdesk').'/'.$item->image??''}}" download>
                            <img src="{{url('/assets/images/helpdesk').'/'.$item->image??''}}" alt="" class="img-fluid">
                        </a></td>
                        <td class="text-center text-break">{{$item->message??'-'}}</td>
                        <td class="text-center">{{date('Y-m-d',strtotime($item->created_at))??'-'}}</td>
                        <td class="text-center">
                            @if($item->status=='0')
                            <a href='{{url("/admin/helpdesk-status/{$item->id}")}}' class="btn btn-danger btn-sm">Pending</a>
                            @else
                            <a type="button" class="btn btn-success btn-sm text-white">Resolved</a>
                            @endif
                        </td>  
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

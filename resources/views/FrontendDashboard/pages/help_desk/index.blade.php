@extends('FrontendDashboard.layouts.app')
@section('content')
<section class="dashbord_contaner">

	<h3>Help Desk</h3>

<div class="white_box my-3">
    <form action="{{url('/help_desk/create')}}" method="POST" enctype="multipart/form-data" >
        @csrf
        <div class="form-group">
          <label for="subject">Subject</label>
          <input type="text" class="form-control" id="subject" placeholder="Subject" name="subject"  autofocus required value="{{old('subject')}}">
          @error('subject')
          <span class="text-danger">{{$message}}</span>
        @enderror
        </div>
        <div class="form-group">
          <label for="email">Email</label>
          <input type="email" class="form-control" id="email" placeholder="Email" name="email"  autofocus required value="{{old('email')}}">
          @error('email')
          <span class="text-danger">{{$message}}</span>
        @enderror
        </div>

        <div class="form-group">
            <label for="image">Image</label>
            <input type="file" class="form-control" id="image" name="image" accept="image/*">
            @error('image')
            <span class="text-danger">{{$message}}</span>
          @enderror
          </div>

        <div class="form-group">
            <label for="message">Message</label>
            <textarea class="form-control" id="message" rows="3" name="message" placeholder="Message" required >{{old('message')}}</textarea>
            @error('message')
            <span class="text-danger">{{$message}}</span>
          @enderror
          </div>

        <button type="submit" class="btn btn-sm px-3 py-2 ">Submit</button>
      </form>

</div>


</section>

<section class="dashbord_contaner pt-1">

	<h3>Queries History</h3>
<div class="white_box mb-3">
<table class="table" id="datatable">
    <thead>
      <tr>
          <th class="d-none"></th>
        <th>SrNo.</th>
        <th>Subject</th>
        <th>Email</th>
        <th>Image</th>
        <th>Message</th>
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
            <td>{{$value->subject??'-'}}</td>
            <td>{{$value->email??'-'}}</td>
            <td>@if (!empty($value->image))
              <a href="{{url('/assets/images/helpdesk').'/'.$value->image??''}}" download>
                <img src="{{url('/assets/images/helpdesk').'/'.$value->image??''}}" alt="" class="img-fluid w-50">
            </a>
            @else
            -
            @endif
           </td>
            <td>{{$value->message??'-'}}</td>
            <td>{{date('Y-m-d',strtotime($value->created_at))??'-'}}</td>
            <td>{!!$value->status=='0'?'<span class="badge bg-danger">Pending</span>':'<span class="badge bg-success">Resolved</span>'!!}</td>
          </tr>
        @endforeach
        @endif
    </tbody>
  </table>
</div>


</section>
@endsection

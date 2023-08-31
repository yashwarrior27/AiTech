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
                    <th scope="col" class="text-center"> Wallet Address</th>
                    <th scope="col" class="text-center">Name</th>
                    <th scope="col" class="text-center">Email</th>
                    <th scope="col" class="text-center">Country Code</th>
                    <th scope="col" class="text-center">Mobile No.</th>
                    <th scope="col" class="text-center">Register ID</th>
                    <th scope="col" class="text-center">Sponsor ID</th>
                    <th scope="col" class="text-center">Register Date</th>
                    <th scope="col" class="text-center">Status</th>
                    <th scope="col" class="text-center">Action</th>
                  </tr>
                </thead>
                <tbody>
                    @if (isset($results))
                    @foreach ($results->cursor() as $key => $item)
          
                    <tr><th class="d-none">{{$item?->id??'-'}}</th>
                        <th scope="row" class="text-center">{{$key+1??'-'}}</th>
                        <td class="text-center">{{$item?->wallet_address??'-'}}</td>
                        <td class="text-center">{{$item?->name??'-'}}</td>
                        <td class="text-center">{{$item?->email??'-'}}</td>
                        <td class="text-center">{{'+ '.$item?->countrycode?->phonecode." ({$item?->countrycode?->name})"??'-'}}</td>
                        <td class="text-center">{{$item?->phone??'-'}}</td>
                        <td class="text-center">{{$item?->register_id??'-'}}</td>
                        <td class="text-center">{{$item?->parent?->register_id??'-'}}</td>
                        <td class="text-center">{{date('Y-m-d',strtotime($item?->created_at))??'-'}}</td>
                        <td class="text-center"><a href="{{url("/admin/userstatus/{$item?->id}")}}">{!!$item?->status==1?'<span class="badge bg-success">Active</span>':'<span class="badge bg-danger">De-active</span>'!!}</a></td>
                        <td><div class="d-flex justify-content-center">
                          <button class="btn p-0" data-bs-toggle="modal" data-bs-target="#wallet_address{{$item->id}}">
                            <i class='bx bxs-message-square-edit text-info fs-2'></i></button>
                          </div></td>
                      </tr>
                  
                   <!-- Modal -->
                      <div class="modal fade" id="wallet_address{{$item->id}}" tabindex="-1" aria-labelledby="{{$item->id}}Label" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="{{$item->id}}Label">Wallet Address</h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                              <form action="{{url("/admin/update-wallet/{$item->id}")}}" method="POST">
                                @csrf
                                <div class="mb-3">
                                  <label for="wallet_address" class="form-label">New Wallet Address</label>
                                  <input type="text" class="form-control text-lowercase" id="wallet_address" required placeholder="New Wallet Address" name="wallet_address{{$item->id}}" value="{{old("wallet_address$item->id")}}" autofocus oninput="this.value = this.value.toLowerCase()" >
                                  <span class="text-danger">
                                    @error('wallet_address'.$item->id)
                                   {{$message}}
                                 @enderror
                                  </span>
                                  
                                </div>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                              <button type="submit" class="btn btn-primary">Save changes</button>
                            </form>
                            </div>
                          </div>
                        </div>
                      </div>
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
@section('script')
@if (count($errors)>0)
<script>
  $(document).ready(function(){
      $('#{{array_keys($errors->toArray())[0]}}').modal('show');
  });
</script>
@endif
@endsection
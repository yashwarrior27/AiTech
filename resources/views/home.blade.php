@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-8">
            <div class="card">
                <div class="body">
                    <form id="package-purchase" method="POST">


                        <div class="row mt-2 p-2">
                            <div class="col-5">
                                <select class="form-select" name="package" id="package" >
                                    @if (isset($packages) && count($packages)>0)

                                    @foreach ($packages as $key => $package)
                                        <option value="{{$package->id}}-{{$package->invest_amount}}">{{$package->invest_amount}}$ Package (Roi {{$package->monthly_roi}}%)</option>
                                    @endforeach
                                    @endif
                                  </select>
                            </div>
                            <div class="col-5">
                                <select class="form-select" name="currency" id="Token">
                                    <option value='' selected>Select Currency</option>
                                    @if (isset($curriences) && count($curriences)>0)
                                    @foreach ($curriences as $key => $curriency)
                                        <option value="{{$curriency->id}}">{{$curriency->name}}</option>
                                    @endforeach
                                    @endif
                                  </select>
                            </div>
                            <div class="col-2">
                                <button type="submit" class="btn btn-success" id="package-buy">Purchase</button>
                                <button type="submit" class="btn btn-success d-none" id="approved-allowence">Approved</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

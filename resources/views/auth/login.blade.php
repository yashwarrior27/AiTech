@extends('layouts.app')

@section('content')

<div class="container-xxl">
    <div class="row justify-content-center mt-4">
        <div class="col-4">
            <div class="authentication-wrapper authentication-basic container-p-y">
                <div class="authentication-inner">
                  <!-- Register -->
                  <div class="card">
                    <div class="card-body">
                      <!-- Logo -->
                      <div class="row justify-content-center">
                     <div class="col-6 text-center">
                        <img src="{{asset('admin_assets/logo.png')}}"  class="img-fluid" alt="">
                        </div>
                    </div>
                      <!-- /Logo -->
                      <h4 class="mb-2 mt-4">Welcome to Admin Panel 👋</h4>
                      <p class="mb-4">Please sign-in to your account and start the adventure</p>

                      <form id="formAuthentication" class="mb-3 validate-form" action="{{url('/admin/login')}}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="wallet_address" class="form-label">Wallet Address</label>
                            <input id="wallet_address" type="password" class="form-control @error('wallet_address') is-invalid @enderror" name="wallet_address" value="{{ old('wallet_address') }}" required autocomplete="wallet_address" placeholder="Enter Wallet Address" autofocus>

                                          @error('wallet_address')
                                              <span class="invalid-feedback" role="alert">
                                                  <strong>{{ $message }}</strong>
                                              </span>
                                          @enderror
                          </div>
                        <div class="mb-3">
                          <button class="btn btn-primary d-grid w-100" type="submit">Sign in</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
        </div>
    </div>

    </div>
@endsection

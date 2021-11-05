@extends('layouts.app')

@section('content')
<div class="container">
  @if ($errors->any())
    <div class="alert alert-danger" role="alert">
        <ul>
          @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
          @endforeach
        </ul>
    </div>
  @endif
  @if (session("status"))
      <div class="alert alert-success" role="alert">
        <strong>{{ session("status") }}</strong>
      </div>
  @endif
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-header">Profile</div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <form action="{{ route("profile.update") }}" method="post" enctype="multipart/form-data">
                              <div class="row mb-3">
                                <div class="col-12">
                                  <h1 class="text-center">{{ $user->name }}</h1>
                                  <div class="text-center">
                                      <img src="{{ $user->avatar ? Storage::url($user->avatar) : 'http://ssl.gstatic.com/accounts/ui/avatar_2x.png' }}"
                                          class="avatar img-circle img-thumbnail" alt="avatar"
                                          style="border-radius: 50%;width: 100px;height: 100px;object-fit: cover;">
                                      <h6>Upload a different photo...</h6>
                                      <input type="file" class="text-center center-block file-upload" name="avatar">
                                  </div>
                                </div>
                              </div>
                                @csrf
                                <div class="form-group row">
                                    <label for="name"
                                        class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                                    <div class="col-md-6">
                                        <input id="name" type="text"
                                            class="form-control @error('name') is-invalid @enderror" name="name"
                                            value="{{ old('name') ? old('name') : $user->name }}" required autocomplete="name" autofocus>

                                        @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="email"
                                        class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                    <div class="col-md-6">
                                        <input id="email" type="email"
                                            class="form-control" value="{{ $user->email }}" disabled>           
                                    </div>
                                </div>
                                <div class="justify-content-center row">
                                  <button type="submit" class="btn btn-primary">Update</button>
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

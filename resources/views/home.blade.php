@extends('layouts.app')

<link rel="stylesheet" href="{{ URL::asset('/assets/css/style.css') }}">
@section('content')
<div class="container">
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

                    <form method="POST" action="{{ route('file.store') }}"  enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputEmail1">File Name</label>
                            <input type="text" name="name"  id="in" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder=""> 
                          </div> 
                          <br> 
                          <div class="form-group">
                                <div class="file-drop-area">
                                    <span class="choose-file-button">Choose files</span>
                                    <span class="file-message">or drag and drop files here</span>
                                    <input class="file-input" name="file" type="file" multiple>
                                </div>
                            </div>
                        <br>
                        <button type="submit" class="btn btn-primary">Upload</button>
                      </form>

                      {{-- <form method="POST" action="{{ route('file.store') }}"  enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email address</label>
                            <input type="text" name="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="">
                            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                          </div> 
                          <br> 
                        <div class="form-group">
                          <label for="exampleFormControlFile1">Example file input</label>
                          <input type="file" name="file" class="form-control-file" id="exampleFormControlFile1">
                        </div>
                        <br>
                        <button type="submit" class="btn btn-primary">Upload</button>
                      </form> --}}
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="{{ URL::asset('/assets/js/script.js') }}"></script>
@endsection

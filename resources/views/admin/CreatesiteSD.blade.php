@extends('layouts.admin')

@section ( 'title') 
{{ $pageTitle }}

@stop

@section('content') 


  <!-- Page Heading -->
  <h1 class="h3 mb-4 text-gray-800">{{ $pageTitle }}</h1>
  <hr>
  <div class="row">
    <div class="col-md-12">
      @if ($errors->any())
        <div class="alert alert-danger">
            <ul style="margin-bottom: 5px;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
      @endif
    
       <form class="row" method="post" action="{{ route('admin.storeSD') }}">

        @csrf

        <div class="col-md-8">
          <div class="form-group">
              <label for="site_name">Site Name</label>
              <input type="text" class="form-control" id="site_name" aria-describedby="emailHelp" placeholder="Site Name" name="site_name" value="{{ old('site_name') }}">
          </div>
          <div class="form-group">
              <label for="site_tagline">Site Tagline</label>
              <input type="text" class="form-control" id="site_tagline" aria-describedby="emailHelp" placeholder="Site Tagline" name="site_tagline" value="{{ old('site_tagline') }}">
          </div>
          <div class="form-group">
              <label for="larapost">Site Short About</label>
              <textarea class="col-md-12"   placeholder="worite your word..." name="short_about" >{{ old('short_about') }}</textarea>
          </div>
          <div class="form-group">
            <button class="btn btn-primary">Submit</button>
            <a href="{{ route('admin.SiteDetails') }}" class="btn btn-secondary">Back</a>
          </div>
        </div>
         
       </form>

    </div>
  </div>

  

@endsection

@extends('layouts.admin')

@section ( 'title') 
{{ $pageTitle }}

@stop

@section('content') 


  <!-- Page Heading -->
  <h2 class="h3 mb-4 text-gray-800">Add Social Link</h2>
  <hr>
  <div class="row container" style="margin-bottom: 20px;">
    <form class="col-md-12" method="post" action="{{ route('admin.socialLinks') }}">
      @csrf
      <div class="row ">
        <div class="form-group col-md-3">
          <input type="text" class="form-control form-control-user @error('s_title') is-invalid @enderror"  placeholder="title" value="{{ old('s_title') }}" name="s_title">
        </div>
        <div class="form-group col-md-3">
          <input type="text" class="form-control form-control-user @error('fa_class') is-invalid @enderror"  placeholder="fa class" value="{{ old('fa_class') }}" name="fa_class">
        </div>
        <div class="form-group col-md-3">
          <input type="text" class="form-control form-control-user @error('url') is-invalid @enderror"  placeholder="url" value="{{ old('url') }}" name="url">
        </div>
        <div class="form-group col-md-3" >
          <button class="btn btn-success">Submit</button>
        </div>
      </div>

    </form>
    <hr>
    <br><br>
    
  </div>
  <h1 class="h3 mb-4 text-gray-800">All Social Links</h1>
  <hr>
  <br>
  <div class="row ">
    
    <div class="col-md-12">
      <table class="table">
        <thead class="thead-dark">
          <tr>
            <th scope="col">Id</th>
            <th scope="col">Title</th>
            <th scope="col">Url</th>
            <th scope="col">Fa Icon</th>
            <th scope="col">Edit</th>
            <th scope="col">Delete</th>
          </tr>
        </thead>
        <tbody>
          @foreach( $socialLinks as $socialLink)
          <tr>
            <td> {{ $socialLink->id }} </td>
            <td> {{ $socialLink->title }} </td>
            <td> {{ $socialLink->url }} </td>
            <td> {{ $socialLink->fa_class }} </td>
            <td><a href="{{ route('admin.slEdit', $socialLink->id) }}" class="btn btn-success">Edit</a></td>
            <td><a href="{{ route('admin.slDelete', $socialLink->id) }}" class="btn btn-danger">Delete</a></td>
          </tr>
          @endforeach
          
        </tbody>
      </table>

    </div>

  </div>

  

@endsection

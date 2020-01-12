@extends('layouts.admin')

@section ( 'title') 
{{ $pageTitle }}

@stop

@section('content') 


  <!-- Page Heading -->
  <h2 class="h3 mb-4 text-gray-800">Add Category</h2>
  <hr>
  <div class="row container" style="margin-bottom: 20px;">
    <form class="col-md-12" method="post" action="{{ route('admin.catUpdate', $category->id) }}">
      @csrf
      <div class="row ">
        <div class="form-group col-md-8">
          <input type="text" class="form-control form-control-user @error('cat_name') is-invalid @enderror"  placeholder="Enter Category Name.." value="{{ $category->category_name }}" name="cat_name">
        </div>
        <div class="form-group col-md-4" >
          <button class="btn btn-success">Submit</button>
        </div>
      </div>


    </form>
    <hr>
    <br><br>
    
  </div>
  <h1 class="h3 mb-4 text-gray-800">All Categories</h1>
  <hr>
  <br>
  <div class="row ">
    
    <div class="col-md-12">
      <table class="table">
        <thead class="thead-dark">
          <tr>
            <th scope="col">Id</th>
            <th scope="col">Category Name</th>
            <th scope="col">Created At</th>
            <th scope="col">Created By</th>
            <th scope="col">Edit</th>
            <th scope="col">Delete</th>
          </tr>
        </thead>
        <tbody>
          @foreach( $categories as $category)
          <tr>
            <td> {{ $category->id }}</td>
            <td> {{ $category->category_name }}</td>
            <td> {{ date('d-m-Y', strtotime( $category->created_at)) }}</td>
            <td>{{ $category->user->name }}</td>
            <td><a href="{{ route('admin.catEdit', $category->id) }}" class="btn btn-success">Edit</a></td>
            <td><a href="{{ route('admin.catDelete', $category->id) }}" class="btn btn-danger">Delete</a></td>
          </tr>
          @endforeach
          
        </tbody>
      </table>

    </div>

  </div>

  

@endsection

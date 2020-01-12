@extends('layouts.admin')

@section ( 'title') 
{{ $pageTitle }}

@stop

@section('content') 


  <!-- Page Heading -->
  <h1 class="h3 mb-4 text-gray-800">All Trash Comments</h1>
  <hr>
  <br>
  <div class="row ">
    
    <div class="col-md-12">
      <table class="table">
        <thead class="thead-dark">
          <tr>
            <th scope="col">Id</th>
            <th scope="col">comment</th>
            <th scope="col">Created At</th>
            <th scope="col">Created By</th>
            <th scope="col">Restore</th>
          </tr>
        </thead>
        <tbody>
          @foreach( $tComments as $tComment)
          <tr>
            <td> {{ $tComment->id }}</td>
            <td> {{ $tComment->content }}</td>
            <td> {{ date('d-m-Y', strtotime( $tComment->created_at)) }}</td>
            <td>{{ $tComment->user->name }}</td>
            <td><a href="{{ route('admin.commentR', $tComment->id) }}" class="btn btn-success">Restore</a></td>
          </tr>
          @endforeach
          
        </tbody>
      </table>

    </div>

  </div>

  

@endsection

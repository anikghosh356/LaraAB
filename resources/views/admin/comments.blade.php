@extends('layouts.admin')

@section ( 'title') 
{{ $pageTitle }}

@stop

@section('content') 


  <!-- Page Heading -->
  <h1 class="h3 mb-4 text-gray-800">All Comments</h1>
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
            <th scope="col">view</th>
            <th scope="col">Delete</th>
          </tr>
        </thead>
        <tbody>
          @foreach( $comments as $comment)
          <tr>
            <td> {{ $comment->id }}</td>
            <td> {{ $comment->content }}</td>
            <td> {{ date('d-m-Y', strtotime( $comment->created_at)) }}</td>
            <td>{{ $comment->user->name }}</td>
            <td><a href="{{ route('post', $comment->post->post_slug.'#commentsArea') }}" class="btn btn-success">view</a></td>
            <td><a href="{{ route('admin.dComment', $comment->id) }}" class="btn btn-danger">Delete</a></td>
          </tr>
          @endforeach
          
        </tbody>
      </table>

    </div>

  </div>

  

@endsection

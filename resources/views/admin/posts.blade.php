@extends('layouts.admin')

@section ( 'title') 
{{ $pageTitle }}

@stop

@section('content') 


  <!-- Page Heading -->
  <h1 class="h3 mb-4 text-gray-800">All Posts <small> <a href="{{ route('admin.create') }}" class="btn btn-primary">Create post</a></small></h1>
  <hr>
  <div class="row">
    
    <div class="col-md-12">
      <table class="table">
        <thead class="thead-dark">
          <tr>
            <th scope="col">ID</th>
            <th scope="col">Title</th>
            <th scope="col">Created At</th>
            <th scope="col">Category</th>
            <th scope="col">Edit</th>
            <th scope="col">Delete</th>
          </tr>
        </thead>
        <tbody>
          @foreach($posts as $post)
          <tr>
            <th >{{ $post->id }}</th>
            <td>{{ $post->post_title }}</td>
            <td>{{ date('d-m-Y', strtotime( $post->created_at)) }}</td>
            <td>{{ $post->category->category_name }}</td>
            <td><a href="{{ route('admin.edit', $post->id) }}" class="btn btn-success">Edit</a></td>
            <td>
              <!-- Button trigger modal -->
              <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deletepost{{ $post->id }}">
                Delete
              </button>

              <!-- Modal -->
              <div class="modal fade" id="deletepost{{ $post->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Are you sure?</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      delete this post..!!
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      <form method="post" action="{{ route('admin.delete', $post->id) }}">
                        @csrf
                        <button type="submit" class="btn btn-danger">Delete</button>
                      </form>
                      
                    </div>
                  </div>
                </div>
              </div>
            </td>
          </tr>
          @endforeach
          
        </tbody>
      </table>

    </div>

  </div>

  

@endsection

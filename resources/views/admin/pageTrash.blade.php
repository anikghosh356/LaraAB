@extends('layouts.admin')

@section ( 'title') 
{{ $pageTitle }}

@stop

@section('content') 


  <!-- Page Heading -->
  <h1 class="h3 mb-4 text-gray-800">Trash Page <small> <a href="{{ route('admin.pageCreate') }}" class="btn btn-primary">Create Page</a></small></h1>
  <hr>
  <div class="row">
    
    <div class="col-md-12">
      <table class="table">
        <thead class="thead-dark">
          <tr>
            <th scope="col">ID</th>
            <th scope="col">Title</th>
            <th scope="col">Created At</th>
            <th scope="col">Created By</th>
            <th scope="col">Restore</th>
            <th scope="col">Delete</th>
          </tr>
        </thead>
        <tbody>
          @foreach($pages as $page)
          <tr>
            <th >{{ $page->id }}</th>
            <td>{{ $page->page_name }}</td>
            <td>{{ date('d-m-Y', strtotime( $page->created_at)) }}</td>
            <td>{{ $page->user->name }}</td>
            <td><a href="{{ route('admin.pageRestore', $page->id) }}" class="btn btn-success">Restore</a></td>
            <td>
              <!-- Button trigger modal -->
              <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deletepost{{ $page->id }}">
                Delete
              </button>

              <!-- Modal -->
              <div class="modal fade" id="deletepost{{ $page->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Are you sure?</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      delete this page..!!
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      <form method="post" action="{{ route('admin.ppDelete', $page->id) }}">
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

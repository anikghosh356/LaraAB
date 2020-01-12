@extends('layouts.admin')

@section ( 'title') 
{{ $pageTitle }}

@stop

@section('content') 


  <!-- Page Heading -->
  <h1 class="h3 mb-4 text-gray-800">Create New Page</h1>
  <hr>
  @if ($errors->any())
    <div class="alert alert-danger">
        <ul style="margin-bottom: 5px;">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
  @endif

  <form class="row" style=" margin-bottom: 20px;" method="post" action="{{ route('admin.pageStore') }}" enctype="multipart/form-data">
    @csrf
  	<div class="col-md-8">
  		<div class="form-group">
			<label for="page_name">Page Name</label>
		    <input type="text" class="form-control" id="page_name" aria-describedby="emailHelp" placeholder="Page Name " name="page_name" value="{{ old('page_name') }}">
		</div>
		<div class="form-group">
		    <label for="larapost">Post Body</label>
		    <textarea id="larapost"  placeholder="worite your word..." name="page_content" >
		    	{{ old('page_content') }}
		    </textarea>
		</div>
  	</div>	


  	<div class="col-md-4" style="overflow: hidden;margin-top: 30px;margin-bottom: 30px;">
  		
  		
      
  	</div>	
  	<div class="col-md-12">
      <button class="btn btn-primary">Submit</button>
  		<a class="btn btn-secondary" href="{{ route('admin') }}">Cancel</a>
  	</div>	
  </form>

@endsection

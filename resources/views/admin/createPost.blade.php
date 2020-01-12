@extends('layouts.admin')

@section ( 'title') 
{{ $pageTitle }}

@stop

@section('content') 


  <!-- Page Heading -->
  <h1 class="h3 mb-4 text-gray-800">Create New Post</h1>
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

  <form class="row" style=" margin-bottom: 20px;" method="post" action="{{ route('admin.store') }}" enctype="multipart/form-data">
    @csrf
  	<div class="col-md-8">
  		<div class="form-group">
			<label for="post_title">Post Title</label>
		    <input type="text" class="form-control" id="post_title" aria-describedby="emailHelp" placeholder="Post Title" name="post_title" value="{{ old('post_title') }}">
		</div>
		<div class="form-group">
		    <label for="larapost">Post Body</label>
		    <textarea id="larapost"  placeholder="worite your word..." name="post_content" >
		    	{{ old('post_content') }}
		    </textarea>
		</div>
  	</div>	


  	<div class="col-md-4" style="overflow: hidden;margin-top: 30px;margin-bottom: 30px;">
  		<div class="row">
  			<div class="input-group col-md-11">
			  <select class="custom-select" id="category" name="post_category">
          @foreach($categories as $category)
			    <option value="{{ $category->id }}">{{ $category->category_name }}</option>
          @endforeach
			  </select>
			  <div class="input-group-append">
			    <label class="input-group-text" for="category">Options</label>
			  </div>
			</div>
  		</div>
  		<div class="row" style="margin-top: 10px;">
        <div class="input-group col-md-11">
            <label for="tags" class="">Tags</label>
            <input type="text" data-role="tagsinput"  id="tags" style="display: none;" name="tags" value="{{ old('tags') }}">
        </div>

      </div>
      <div class="row" style="margin:10px auto;">
        <div class="form-group col-md-12">
          <label for="post_thumbnail">Post Thumbnail</label>
          <input type="file" class="form-control-file" id="post_thumbnail" onchange="readURL(this);" name="post_thumbnail">
        </div>
        <div class="col-md-12">
          <img src="{{ asset('img/no_thumbnail.jpg') }}" id="thumbpre" style="width: 100%; max-height: 500px; overflow: hidden;">
        </div>
      </div>
  		
  	</div>	
  	<div class="col-md-12">
      <button class="btn btn-primary">Submit</button>
  		<a class="btn btn-secondary" href="{{ route('admin') }}">Cancel</a>
  	</div>	
  </form>

@endsection

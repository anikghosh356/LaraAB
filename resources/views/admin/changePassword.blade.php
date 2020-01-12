@extends('layouts.admin')

@section ( 'title') 
DashBoard
@stop

@section('content') 


  <!-- Page Heading -->
  <h1 class="h3 mb-4 text-gray-800">Change Your password</h1>
  <hr>
  <div class="row">
  	<div class="col-md-13">
  		<form method="post" action="{{ route('admin.changePassword') }}">
  			@csrf
  			 <div class="form-group">
			    <label for="oldPassword">Old Password</label>
			    <input type="password" class="form-control @error('oldPassword') is-invalid @enderror" id="oldPassword" placeholder="enter your old password" name="oldPassword" required>
			  </div>
			  <h4>create new password</h4>
			  <hr>
			  <div class="form-group">
			    <label for="newpasswordA">Create new password</label>
			    <input type="password" class="form-control @error('password') is-invalid @enderror" id="newpasswordA" placeholder="Create new password" name="password" required>
			  </div>
			  <div class="form-group">
			    <label for="newpasswordB">Re-enter password</label>
			    <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" id="newpasswordB" placeholder="Re-enter password" name="password_confirmation"  required>
			  </div>
			  <button type="submit" class="btn btn-primary">Change</button>
  		</form>
  	</div>
  </div>

@endsection
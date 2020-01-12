@extends('layouts.admin')

@section ( 'title') 
DashBoard
@stop

@section('content') 


  <!-- Page Heading -->
  <h1 class="h3 mb-4 text-gray-800">Profile Actions</h1>
  <hr>
  <div class="row">
  	<div class="col-md-13">
  		<a href="{{ route('admin.changePassword') }}" class="btn btn-success">Change Password</a>
  	</div>
  </div>

@endsection

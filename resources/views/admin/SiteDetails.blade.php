@extends('layouts.admin')

@section ( 'title') 
{{ $pageTitle }}

@stop

@section('content') 


  <!-- Page Heading -->
  <h1 class="h3 mb-4 text-gray-800">{{ $pageTitle }}</h1>
  <hr>
  <div class="row">
    
   @if($siteDetails != '')
   

   <table class="table">
     <tbody>
       <tr>
         <th>Site Name:-</th>
         <td>{{ $siteDetails->site_name }}</td>
       </tr>
       <tr>
         <th>Site Tagline:-</th>
         <td>{{ $siteDetails->site_tagline }}</td>
       </tr>
       <tr>
         <th>Site Short About:-</th>
         <td>{{ $siteDetails->short_about }}</td>
       </tr>
       <tr>
         <th>Edit Details:-</th>
         <td><a href="{{ route('admin.editSD') }}" class="btn btn-primary">Edit</a></td>
       </tr>
     </tbody>
   </table>


    @else
    <div class="col-md-12">
      
      <div class="alert alert-primary" role="alert">
        Insert Your site details
      </div>
    <p><a href="{{ route('admin.CreatesiteSD') }}" class="btn btn-primary">Add Site Details</a></p>

    </div>
    
   @endif

  </div>

  

@endsection

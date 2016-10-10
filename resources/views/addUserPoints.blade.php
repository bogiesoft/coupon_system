@extends('layouts.app')

@section('style')
	@parent
	<style>
		.alert {
			display: none;
		} 
	</style>
@endsection

@section('content')
	@if(count($users) != 0)
		<div class="container">
		    <div class="row bg-default">
		    	<div class="alert alert-success" role="alert">
				  <strong>Points has been successfully added!</strong>
				</div>
				<div class="alert alert-danger" role="alert">
				  <strong>Something went wrong.</strong> Please try again.
				</div>
		        <div class="col-md-12">
		        	
				  <h1>Add User Points</h1>
				  <table class="table">
					  <thead>
					    <tr>
					      <th>#</th>
					      <th>Name</th>
					      <th>Email</th>
					      <th>Points to be added</th>
					      <th></th>
					      <th></th>
					    </tr>
					  </thead>
					  <tbody>
					  	@foreach($users as $count => $user)
					    <tr>
					      <th scope="row">{{ $count+1 }}</th>
					      <td>{{ $user->name }}</td>
					      <td>{{ $user->email }}</td>
					      <td><input type="text" data-user-id="{{ $user->id }}"></td>
					      <td><button type="submit" class="btn btn-primary" onclick="addUserPoints(this)" data-id="{{ $user->id }}" data-name="{{ $user->name }}">Add Points</button></td>
					      <td></td>
					    </tr>
					    @endforeach
					  </tbody>
					</table>
				</div>
		    </div>
		</div>
	@else
		<div class="container">
		    <div class="row">
		        <div class="col-md-12">
					<div class="alert alert-warning" role="alert">
					  <strong>Sorry, </strong> no user has been registered.
					</div>
				</div>
			</div>
		</div>
	@endif		
@endsection

@section('script')
	@parent
	<script>

		var storeUserPoints = "{{ route('redeems.store') }}";

		function addUserPoints(element){
		 	var id = $(element).attr('data-id');
		 	var point_change = $('[data-user-id="'+id+'"]').val();
		 	var csrf_token = $('.token').val();
		 	$.ajaxSetup({
			    headers: {
			        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			    }
			});
			$.ajax({
			  method: "POST",
			  url: storeUserPoints,
			  data: {user_id: id, point_change: point_change}, 
			  success: function(data){
			  	if(data == 'success') {
			  		$(".alert-success").fadeTo(2000, 500).slideUp(500, function(){
					    $(".alert-success").slideUp(500);
					});
			  	}else{
					$(".alert-danger").fadeTo(2000, 500).slideUp(500, function(){
					    $(".alert-danger").slideUp(500);
					});
			  	}
			  	
			  } 
			});
	    }


	</script>
@endsection
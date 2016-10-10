@extends('layouts.app')

@section('style')
	@parent

@endsection

@section('content')
	@if(count($reports) != 0 &&  count($users) != 0)
		<div class="container">
		    <div class="row bg-default">
		        <div class="col-md-12">
				  <h1>User Report</h1>
				  <table class="table">
					  <thead>
					    <tr>
					      <th>#</th>
					      <th>User ID</th>
					      <th>Name</th>
					      <th>Current Points</th>
					    </tr>
					  </thead>
					  <tbody>
					  	@foreach($reports as $count => $report)
					    <tr>
					      <td>{{ $count+1 }}</td>
					      <td>{{ $report->user_id }}</td>
					      @foreach($users as $c => $user)
					      	@if($user->id == $report->user_id)
					      		<td>{{ $user->name }}</td>
				      		@endif
					      @endforeach
					      <td>{{ $report->points }}</td>
					      
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
					  <strong>Sorry, </strong> no record of any user.
					</div>
				</div>
			</div>
		</div>
	@endif		
@endsection

@section('script')
	@parent

@endsection
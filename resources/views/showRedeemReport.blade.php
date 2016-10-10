@extends('layouts.app')

@section('style')
	@parent

@endsection

@section('content')
	@if(count($redeems) != 0)
		<div class="container">
		    <div class="row bg-default">
		        <div class="col-md-12">
				  <h1>Redeem Report</h1>
				  <table class="table">
					  <thead>
					    <tr>
					      <th>#</th>
					      <th>User ID</th>
					      <th>Points Changed</th>
					      <th>Created At</th>
					    </tr>
					  </thead>
					  <tbody>
					  	@foreach($redeems as $count => $redeem)
					    <tr>
					      <td>{{ $count+1 }}</td>
					      <td>{{ $redeem->user_id }}</td>
					      <td>{{ $redeem->point_change }}</td>
					      <td>{{ $redeem->created_at }}</td>
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
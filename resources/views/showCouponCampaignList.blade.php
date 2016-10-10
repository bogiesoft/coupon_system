@extends('layouts.app')

@section('style')
	@parent

@endsection

@section('content')
	@if(count($couponCampaigns) != 0)
		<div class="container">
		    <div class="row bg-default">
		        <div class="col-md-12">
				  <h1>All Coupons</h1>
				  <table class="table">
					  <thead>
					    <tr>
					      <th>#</th>
					      <th>Name</th>
					      <th>Code Initial</th>
					      <th>Type</th>
					      <th>Max Uses (or Points Needed)</th>
					      <th></th>
					      <th>Code</th>
					    </tr>
					  </thead>
					  <tbody>
					  	@foreach($couponCampaigns as $count => $couponCampaign)
					    <tr>
					      <th scope="row">{{ $count+1 }}</th>
					      <td>{{ $couponCampaign->name }}</td>
					      <td>{{ $couponCampaign->codechar }}</td>
					      
					      @if($couponCampaign->type  == 'maxuse')
					      <td>Max Uses</td>
					      <td>{{ $couponCampaign->maxuse }}</td>
					      @else
					      <td>Points</td>
					      <td>{{ $couponCampaign->points }}</td>
					      @endif
					      <td><button type="submit" class="btn btn-primary" onclick="getCode(this)" data-id="{{ $couponCampaign->id }}" data-codechar="{{ $couponCampaign->codechar }}">Get Code</button></td>
					      <td class="code" data-campaign-id="{{ $couponCampaign->id }}"></td>
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
					  <strong>Sorry, </strong> no coupon campaign has been created.
					</div>
				</div>
			</div>
		</div>
	@endif	
@endsection

@section('script')
	@parent
	<script>

		var generateCode = "{{ route('generatecode') }}";

		function getCode(element){
		 	var id = $(element).attr('data-id');
		 	var codechar = $(element).attr('data-codechar');
			$.ajax({
			  method: "GET",
			  url: generateCode+'?id='+id+'&codechar='+codechar,
			  success: function(data){
			  	$('[data-campaign-id="'+id+'"]').text(data);
			  } 
			});
	    }

	</script>
@endsection
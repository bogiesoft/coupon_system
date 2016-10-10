@extends('layouts.app')

@section('style')
	@parent

@endsection

@section('content')

	<div class="container">
	    <div class="row bg-default">
	    	<!-- if error data is passed show error alert -->
	    	@if(!empty(session("error")))
	    		<div class="alert alert-danger" role="alert">
				  <strong>Unable to redeem this code</strong> {{ session("error") }}
				</div>
	    	@endif
	    	@if(!empty(session("success")))
	    		<div class="alert alert-success" role="alert">
				  <strong>Success.</strong> {{ session("success") }}
				</div>
	    	@endif
	        <div class="col-md-12">
			  <h1>Redeem Coupon</h1>
			  <form action="{{ route('stocks.checkstock') }}" method="post">
				  <div class="form-group">
				    <label for="codeInput">Coupon Code</label>
				    <input type="text" class="form-control" id="codeInput" name="code" placeholder="Coupon Code">
				  </div>
				  <button type="submit" class="btn btn-primary">Redeem</button>
				  <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
	    		  <input type="hidden" name="_token" value="{{ csrf_token() }}">
    		  </form>
			</div>
	    </div>
	</div>
@endsection

@section('script')
	@parent
	<script>
		// $(".alert").alert()
		// function press(){
		// 	$(".alert").fadeTo(2000, 500).slideUp(500, function(){
		// 	    $(".alert").slideUp(500);
		// 	});
		// }
		$( document ).ready(function() {

			if($(".alert").length) {
				$(".alert").fadeTo(2000, 500).slideUp(500, function(){
				    $(".alert").slideUp(500);
				});
			}
		})

	</script>
@endsection
<!-- <!DOCTYPE html>
<html lang="en">
<head>
	<link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-md-12">
			  <h1>Create Coupon Campaign</h1>
			  <form action="{{ route('campaigns.store') }}" method="post">
			    <div class="form-group row">
			      <label for="inputName" class="col-sm-3 col-form-label">Coupon Campaign Name</label>
			      <div class="col-sm-7">
			        <input type="text" class="form-control" id="inputName" name="name" placeholder="Name">
			      </div>
			    </div>
			    <fieldset class="form-group row">
			      <legend class="col-form-legend col-sm-3">Coupon Type</legend>
			      <div class="col-sm-9">
			        <div class="form-check">
			          <label class="form-check-label">
			            <input class="form-check-input" type="radio" name="type" id="maxuse_radio" value="maxuse_selected" checked>
			            Max Use <input type="text" name="maxuse">​​​​​​​​​​​​​​​​​​​​​​​​​​​​​​​​
			          </label>
			        </div>
			        <div class="form-check">
			          <label class="form-check-label">
			            <input class="form-check-input" type="radio" name="type" id="points_radio" value="points_selected">
			            Points <input type="text" name="points">​​​​​​​​​​​​​​​​​​​​​​​​​​​​​​​​
			          </label>
			        </div>
			      </div>
			    </fieldset>
			    <button type="submit" class="btn btn-primary">Submit</button>
			    <input type="hidden" name="_token" value="{{ csrf_token() }}">
			  </form>
			</div>
		</div>
	</div>

	<script src="{{ asset('js/jquery-3.1.1.min.js') }}"></script>
	<script src="https://www.atlasestateagents.co.uk/javascript/tether.min.js"></script>
	<script src="{{ asset('bootstrap/js/bootstrap.min.js') }}"></script>

</body>
</html> -->

@extends('layouts.app')

@section('style')
	@parent

@endsection

@section('content')
<div class="container">
    <div class="row bg-default">
    	@if(!empty($error))
        	<div class="alert alert-danger" role="alert">
			  <strong>Unable to generate coupon code.</strong> Please try again
			</div>
		@endif
        <div class="col-md-12">
			
		  <h1>Create Coupon Campaign</h1>
		  <form class="form-validate" action="{{ route('campaigns.store') }}" method="post">
		    <div class="form-group row">
		      <label for="inputName" class="col-sm-3 col-form-label">Coupon Campaign Name: </label>
		      <div class="col-sm-7 validate-group">
		        <input type="text" class="form-control" id="inputName" name="name" placeholder="Name">
		      </div>
		    </div>
		    <div class="form-group row">
		      	<label for="inputName" class="col-sm-3 col-form-label">Type: </label>
			    <div class="col-sm-7">
				    <label class="custom-control custom-radio">
					  <input id="maxuse_radio" name="type" type="radio" class="custom-control-input" value="maxuse">
					  <span class="custom-control-indicator"></span>
					  <span class="custom-control-description">
					  	Max Uses
					  	<input type="text" name="maxuse_amount">​​​​​​​​​​​​​​​​​​​​​​​​​​​​​​​​
					  </span>
					</label>
					<label class="custom-control custom-radio">
					  <input id="points_radio" name="type" type="radio" class="custom-control-input" value="points">
					  <span class="custom-control-indicator"></span>
					  <span class="custom-control-description">
					  	Points 
					  	<input type="text" name="points_amount">​​​​​​​​​​​​​​​​​​​​​​​​​​​​​​​​
					  </span>
					</label>
				</div>
			</div>


		    <button type="submit" class="btn btn-primary">Submit</button>
		    <input type="hidden" name="_token" value="{{ csrf_token() }}">
		  </form>
		</div>
    </div>
</div>
@endsection

@section('script')
	@parent

	<script>
		$(document).ready(function() {
		  $(".form-validate").validate({
		    rules: {
		      name: {
		        required: true
		      },
		      type: {
		        required: true
		      },
		      maxuse_amount:{
		        digits: true,
		      },
		      points_amount:{
		        digits: true,
		      }
		    },
		    errorPlacement: function(error, element) {
		      if (element.attr('id') == 'maxuse_radio' || element.attr('id') == 'points_radio') {
		        $box = element.parent().parent().parent();
		        $box.find('.radio').addClass('has-error');
		      } else {
		        $box = element.parent().parent().parent();
		        $box.find('.radio').removeClass('has-error');
		      }
		    }
		  });
		});
	</script>
@endsection


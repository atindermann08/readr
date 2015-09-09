@extends('layouts.default')

@section('content')
  <div class="row">
    <div class="col-md-6 col-md-offset-3">
      <h3>Update Password</h3>
      <hr />
      {{-- @include('layouts.partials._errors') --}}
			<form class="form-horizontal" role="form" method="POST" action="{{ url('/password/change') }}">
				<input type="hidden" name="_token" value="{{ csrf_token() }}">

				<div class="form-group">
					<label class="col-md-4 control-label">Current Password</label>
					<div class="col-md-6">
						<input type="password" class="form-control" name="current_password" value="{{ old('email') }}">
					</div>
				</div>
        <div class="form-group">
          <label class="col-md-4 control-label">New Password</label>
          <div class="col-md-6">
            <input type="password" class="form-control" name="new_password" value="{{ old('email') }}">
          </div>
        </div>
        <div class="form-group">
					<label class="col-md-4 control-label">Confirm New Password</label>
					<div class="col-md-6">
						<input type="password" class="form-control" name="confirm_new_password" value="{{ old('email') }}">
					</div>
				</div>
				<div class="form-group">
					<div class="col-md-6 col-md-offset-4">
						<button type="submit" class="btn btn-primary">
							Update Password
						</button>
					</div>
				</div>
			</form>
		</div>
	</div>
@endsection

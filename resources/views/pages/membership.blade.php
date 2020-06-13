@extends('layouts.app')
@section('content')
<div class="container mt-5 body-text">
<div>
<h3 class="pt-5">Membership Level</h3>
<p>You have selected the <strong> Free Membership</strong> membership level </p>
<p>The price for membership is <strong> $0.00 </strong> now.</p>
<hr>
<h3>Account Information </h3>
</div>
</div>
<div class="container">
<form method="POST" action="{{ route('submit-membership') }}">
  @csrf
<div class="form-group">

  <label>User Name</label>
  <input name="name" type="text" required="" class="form-control">
  </div>

  <div class="form-group">
    <label>Email address</label>
    <input type="email" class="form-control" id="email" placeholder="Enter email">
  </div>

  <div class="form-group">
    <label>Your Password</label>
    <input name="password" type="password" class="form-control" required="">
  </div>

  <div class="form-group">
    <label for="password-confirm">Confirm Password</label>
    <input id="password-confirm" name="password_confirmation" type="password" class="form-control"
           required="">
  </div>

  <hr>
  <button type="submit" class="btn submit-btn">Submit & Confirm</button>
</form>
</div>


@endsection()

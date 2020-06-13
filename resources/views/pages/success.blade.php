@extends('layouts.app')
@section('content')



    <h1 class="d-flex justify-content-center my-style custom-f">You have successfully booked this slot!</h1>

    <a href="{{ route('home') }}" class="text-center">Go Back</a>

@endsection()

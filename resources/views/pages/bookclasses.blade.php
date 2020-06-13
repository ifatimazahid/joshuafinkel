@extends('layouts.app')
@section('content')
<div>
    <div class="row">
        <div class="col-sm-12">
<img class="my-cover img-fluid" src="{{ asset('images/cover.png') }}" alt="">
</div>
</div>
</div>
<div class="container-fluid my-book-slot mt-5">
<h1 class="pt-5 text-white align-center d-flex justify-content-center" style="font-size:45px; font-weight:bold">BOOK A SLOT</h1>

<div class="row">
    <div class="col-sm-6 mt-5 ">
        <div class="d-flex justify-content-center mb-3">
    <img class="my-image" src="{{ asset('public/images/logo.png') }}" alt="">
    </div>
    <a class="my-link d-flex justify-content-center" href="/products"><p>FREE ONLINE AUDITION WORKOUT CLASS</p></a>
    <a class="my-link2 d-flex justify-content-center" href="/products"> SELECT OPTION</a>
    </div>
    <div class="col-sm-6 mt-5">
    <h1 class="text-white" style="font-size: 65px; line-height: 65px;" > <strong> Book Your Free Class Now</strong></h1>
    <h3 class="p-2 w-75 text-white d-flex justify-content-center" style="background-color:#FEC801">Limited Slot Available</h3>
    <p class="text-white hi">To help give back so we can all stay creative and moving forward, I’m offering a free class once a week.</p>
<p class="text-white hi">This is a great chance to fill in the blanks in your audition material or plan for things upcoming, or work on auditions you have during this time.</p>
<p class="text-white hi">Get a consult on material choices,  a great chance to build monologues, songs, roles, scenes, film/tv/commercial/voice over copy etc.</p>
<p><strong class="text-white hi">NINE 10 minute work sessions per class.</strong></p>
<p><strong class="text-white hi">Saturday mornings on Zoom from 10:30am-Noon.</strong></p>
<p><strong class="text-white hi">Zoom meeting room link will be given when you confirm your free enrollment.</strong></p>
<p class="text-white hi">Click here to sign up for YOUR free slot!</p>
<p class="text-white hi">Need additional help?</p>
<p class="text-white hi">Click on the extra links to have Joshua help get you material or help you edit the material or track.</p>

</div>

</div>
</div>

@endsection()

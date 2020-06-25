@extends('layouts.app')
@section('content')

    <div class="container-fluid mt-5">
        <div class="row">
            <div class="col-sm-8">
                <div class="d-flex justify-content-center">
                    <img class="my-plogo" src="{{ asset('public/images/logo.png') }}" alt="">
                </div>
            </div>
            <div class="col-sm-4">
                <form method="post">
                <h1 class="mt-5">{{ $products[0]->title }}</h1>
                <p><span class="text-muted" style="text-decoration:line-through">$10.00 </span><span
                            class="s-num">{{ $products[0]->product_details->price }}</span></p>
                <p>Joshua is offering a</p>
                <h4 class="font-weight-bold">FREE AUDITION WORKOUT CLASS through JUNE 14, 2020</h4>
                <h4 class="font-weight-bold">SATURDAY MORNINGS: 10:30am-Noon (Pacific Standard Time)</h4>
                <h4 class="font-weight-bold">{{ $products[0]->product_details->description }}</h4>
                {{--<h6>{{ $product->description }}</h6>--}}
                {{--<h6>{{ $details[0]->price }}</h6>--}}
                <ul class="text-muted bullets-list">
                    <li>10 minute work slots</li>
                    <li>9 slots available per class</li>
                    <li>Bring in any piece you want to work on!</li>
                    <ul class="bullets-list">
                        <li>Songs (you provide your own musical track to sing to on your end)</li>
                        <li>Monologues (Contemporary or Classical)Scenes or Sides</li>
                        <li>Portions of a Role you are working on</li>
                        <li>Original Material (Cabaret/1 person show or Story telling)</li>
                    </ul>

                </ul>
                <p>Need help with material or supplies?</p>
                <h4 class="font-italic font-weight-bold">Joshua offers additional services:</h4>
                <ul class="text-muted bullets-list">
                    <li>$5.00/sheet music or monologue he provides payable via <span
                                class="font-weight-bold">Paypal</span></li>
                    <li>$10.00/editing of musical cut or monologue via <span class="font-weight-bold">Paypal</span></li>
                </ul>

                {{--Display slots here--}}
                    <table class="table container table-hover">
                        <thead class="custom-d">
                        <tr>
                            <th scope="col">Title</th>
                            <th scope="col">Date</th>
                            <th scope="col">Time</th>
                            <th scope="col">Slots</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(!isset($user))
                            @foreach($products[0]->slots as $slot)
                                <tr>
                                    {{--<th scope="row">1</th>--}}
                                    <td>{{ $slot->title }}</td>
                                    <td>{{ $slot->slot_details['date'] }}</td>
                                    <td>{{ $slot->slot_details['time'] }}</td>
                                    <td><input type="radio" name="slot" value="{{ $slot->id }}"></td>
                                </tr>
                            @endforeach
                        @elseif(isset($user))
                            @if(count($slots <= 0))
                                <tr>
                                    <th scope="row">There are no slots</th>
                                </tr>
                                    @elseif(isset($slots))
                            @foreach($slots as $slot)
                                <tr>
                                    {{--<th scope="row">1</th>--}}
                                    <td>{{ $slot->title }}</td>
                                    <td>{{ $slot->slot_details['date'] }}</td>
                                    <td>{{ $slot->slot_details['time'] }}</td>
                                    <td><input type="radio" name="slot" value="{{ $slot->id }}"></td>
                                </tr>
                            @endforeach
                                @endif
                        @endif
                        </tbody>
                    </table>

                <button type="button" class="btn-primary onSubmit">Book Now
                </button>
                </form>
            </div>
        </div>


    </div>

@endsection()

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $(document).on('click', '.onSubmit', function () {
            var token = $('meta[name="csrf-token"]').attr('content');
            var id = $("input[name='slot']:checked").val();
            var APP_URL = {!! json_encode(url('/')) !!}

           console.log(APP_URL);

           if (id == null){
               alert('Please select a slot to book!')
           } else if (id != null) {
               $.ajax({
                   method: 'POST',
                   url: "{{ route('book') }}",
                   data: {
                       id: id,
                       _token: token
                   },
                   cache: false,
                   success: function (result) {
                       if (result == 1){
                          alert('You have successfully booked this slot!')
                           return location.reload();
                       }  else if (result == 2){

                           alert('You need to register first!');
{{--                           window.location = "{{ route('register') }}";--}}
//                            window.location.href = "http://localhost:8080/joshuafinkel/register?id=" + id;
                           window.location.href = "https://joshuafinkel.digimines.website/register?id=" + id;
                       } else if (result == 3){
                           alert('You have already booked this slot!');
                           return location.reload();
                       }
                   },
                   error: function () {
                       console.log("AJAX error");
                   }
               });
           }
        });

    });

</script>
@extends('layouts.app')
@section('content')



<h1 class="d-flex justify-content-center custom-f">Booked Slots</h1>
<table class="table container table-hover custom-t">
  <thead class="custom-d">
    <tr>
      {{--<th scope="col">#</th>--}}
      <th scope="col">Title</th>
      <th scope="col">Date</th>
      <th scope="col">Time</th>
      <th scope="col">Cancel</th>
    </tr>
  </thead>
  <tbody>
  @if(isset($slots))
  @foreach($slots as $slot)
    <tr>
      {{--<th scope="row">1</th>--}}
      <td>{{ $slot->title }}</td>
      <td>{{ $slot->slot_details['date'] }}</td>
      <td>{{ $slot->slot_details['time'] }}</td>
      <td><a href="{{ route('cancel', ['id' => $slot->id] )}}">Cancel</a></td>
    </tr>
  @endforeach
    @else
    <tr><td scope="row">There are no booked slots</td></tr>
    @endif
  </tbody>
</table>
				
			


@endsection()
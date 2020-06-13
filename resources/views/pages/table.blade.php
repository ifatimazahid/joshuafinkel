@extends('layouts.app')
@section('content')



<h1 class="d-flex justify-content-center my-style custom-f">All Slots</h1>
<table class="table container table-hover custom-t">
  <thead class="custom-d">
    <tr>
      <th scope="col">#</th>
      <th scope="col">Title</th>
      <th scope="col">Date</th>
      <th scope="col">Time</th>
    </tr>
  </thead>
  <tbody>
  @foreach($slots as $slot)
    <tr>
      <th scope="row">1</th>
      <td>{{ $slot->title }}</td>
      <td>{{ $slot->slot_details['date'] }}</td>
      <td>{{ $slot->slot_details['time'] }}</td>
      <td><a href="{{ route('products', ['id' => $slot->id] )}}">View Details</a></td>
    </tr>
  @endforeach
  </tbody>
</table>
				
			


@endsection()
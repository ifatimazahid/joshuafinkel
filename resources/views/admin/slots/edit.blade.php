@extends('admin.layouts.app')

@section('title')
    {{ $slot->name }} <small>{{ $title }}</small>
@endsection

@section('content')
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($slot, ['route' => ['admin.slots.update', $slot->id], 'method' => 'patch', 'files' => true]) !!}

                        @include('admin.slots.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection
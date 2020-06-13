@extends('admin.layouts.app')

@section('title')
    {{ $product->name }} <small>{{ $title }}</small>
@endsection

@section('content')
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($product, ['route' => ['admin.products.update', $product->id], 'method' => 'patch', 'files' => true]) !!}

                        @include('admin.products.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection
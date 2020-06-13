@extends('admin.layouts.app')

@section('title')
    {{ $company->name }} <small>{{ $title }}</small>
@endsection

@section('content')
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($company, ['route' => ['admin.companies.update', $company->id], 'method' => 'patch', 'files' => true]) !!}

                        @include('admin.companies.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection
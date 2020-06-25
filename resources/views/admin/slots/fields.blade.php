<!-- Product Field -->
{{--<div class="form-group col-sm-6">--}}
    {{--{!! Form::label('product_id', 'Product Id:') !!}--}}
    {{--{!! Form::hidden('product_id', isset($product_id) ? $product_id: null, ['class' => 'form-control', 'placeholder'=>'Enter Title']) !!}--}}
{{--</div>--}}

<!-- Title Field -->
<div class="form-group col-sm-6">
    {!! Form::label('title', 'Title:') !!}
    {!! Form::text('title', null, ['class' => 'form-control', 'placeholder'=>'Enter title']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('product_id', 'Product ID:') !!}
    {!! Form::text('product_id', null, ['class' => 'form-control', 'placeholder'=>'Enter product_id', 'required' => 'required']) !!}
</div>


<!-- Date Field -->
<div class="form-group col-sm-6">
    {!! Form::label('date', 'Date:') !!}
    {!! Form::text('date', null, ['class' => 'form-control', 'placeholder'=>'Enter date']) !!}
</div>

<!-- Time Field -->
<div class="form-group col-sm-6">
    {!! Form::label('time', 'Time:') !!}
    {!! Form::text('time', null, ['class' => 'form-control', 'placeholder'=>'Enter time']) !!}
</div>

<!-- Description Field -->
<div class="form-group col-sm-6">
    {!! Form::label('description', 'Description:') !!}
    {!! Form::text('description', null, ['class' => 'form-control', 'placeholder'=>'Enter description']) !!}
</div>

<!-- Price Field -->
<div class="form-group col-sm-6">
    {!! Form::label('price', 'Price:') !!}
    {!! Form::text('price', null, ['class' => 'form-control', 'placeholder'=>'Enter price']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    @if(!isset($slot))
        {!! Form::submit(__('Save And Add Translations'), ['class' => 'btn btn-primary', 'name'=>'translation']) !!}
    @endif
    {!! Form::submit(__('Save And Add More'), ['class' => 'btn btn-primary', 'name'=>'continue']) !!}
    <a href="{!! route('admin.slots.index') !!}" class="btn btn-default">Cancel</a>
</div>
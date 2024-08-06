<!-- User Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('user_id', 'Khách hàng:') !!}
    {!! Form::select('user_id', $customers, null, ['class' => 'form-control']) !!}
</div>

<!-- Product Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('product_id', 'Sản phẩm:') !!}
    {!! Form::select('product_id', $products, null, ['class' => 'form-control']) !!}
</div>

<!-- Points Field -->
<div class="form-group col-sm-6">
    {!! Form::label('points', 'Điểm:') !!}
    {!! Form::text('points', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('customerPoints.index') }}" class="btn btn-light">Cancel</a>
</div>
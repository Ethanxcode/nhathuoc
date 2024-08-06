<!-- User Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('user_id', 'Khách hàng:') !!}
    {!! Form::select('user_id', $customers, isset($customerGift['user_id']) ? $customers[$customerGift['user_id']] :
    null, ['class'
    =>
    'form-control'])
    !!}
</div>

<!-- Gift Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('gift_id', 'Quà tặng:') !!}
    {!! Form::select('gift_id', $gifts, isset($customerGift['gift_id']) ? $gifts[$customerGift['gift_id']] : null,
    ['class' =>
    'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('customerGifts.index') }}" class="btn btn-light">Cancel</a>
</div>
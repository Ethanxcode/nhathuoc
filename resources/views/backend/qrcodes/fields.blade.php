<!-- Qr Code Field -->
<div class="form-group col-sm-6">
    {!! Form::label('qr_code', 'Qr Code:') !!}
    {!! Form::text('qr_code', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Image Field -->
<div class="form-group col-sm-6">
    {!! Form::label('image', 'Image:') !!}
    {!! Form::text('image', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Product Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('product_id', 'Sản phẩm:') !!}
    {!! Form::select('product_id', $products, isset($qrcode['product_id']) ? $qrcode['product_id'] : '', ['class' =>
    'form-control']) !!}
</div>

<!-- Status Field -->
<div class="form-group col-sm-6">
    {!! Form::label('status', 'Trạng thái:') !!}
    {!! Form::select('status', array(0 => 'Không hoạt đông', 1 => 'Hoạt động'),null, ['class' => 'form-control']) !!}
</div>

@push('scripts')
<script type="text/javascript">
$('#begined_at').datetimepicker({
    format: 'YYYY-MM-DD HH:mm:ss',
    useCurrent: true,
    sideBySide: true
})
</script>
@endpush


@push('scripts')
<script type="text/javascript">
$('#ended_at').datetimepicker({
    format: 'YYYY-MM-DD HH:mm:ss',
    useCurrent: true,
    sideBySide: true
})
</script>
@endpush



<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('qrcodes.index') }}" class="btn btn-light">Cancel</a>
</div>
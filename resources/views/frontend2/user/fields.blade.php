<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Họ và tên:') !!}
    {!! Form::text('name', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Email Field -->
<div class="form-group col-sm-6">
    {!! Form::label('email', 'Email:') !!}
    {!! Form::email('email', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255, 'readonly']) !!}
</div>

@push('scripts')
<script type="text/javascript">
$('#email_verified_at').datetimepicker({
    format: 'YYYY-MM-DD HH:mm:ss',
    useCurrent: true,
    sideBySide: true
})
</script>
@endpush

<!-- Password Field -->
<div class="form-group col-sm-6">
    {!! Form::label('password', 'Mật khẩu:') !!}
    {!! Form::password('password', ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Password Field -->
<div class="form-group col-sm-6">
    {!! Form::label('password_confirmation', 'Xác nhận mật khẩu:') !!}
    {!! Form::password('password_confirmation', ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Phone Field -->
<div class="form-group col-sm-6">
    {!! Form::label('phone', 'Điện thoại:') !!}
    {!! Form::text('phone', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Phone Field -->
<div class="form-group col-sm-6">
    {!! Form::label('address', 'Địa chỉ:') !!}
    {!! Form::text('address', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Nha thuoc Field -->
<div class="form-group col-sm-6">
    {!! Form::label('nha_thuoc_id', 'Chọn nhà thuốc:') !!}
    {!! Form::select('nha_thuoc_id', $nhathuoc, isset($user->nha_thuoc_id) ? $user->nha_thuoc_id : null,
    ['class' =>
    'form-control']) !!}
</div>
{!! Form::hidden('user_id', auth()->user()->id, array('id' => 'user_id')) !!}


<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('info') }}" class="btn btn-light">Cancel</a>
</div>
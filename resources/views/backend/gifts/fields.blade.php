<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Tên quà:') !!}
    {!! Form::text('name', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Value Field -->
<div class="form-group col-sm-6">
    {!! Form::label('value', 'Giá trị:') !!}
    {!! Form::text('value', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Gift Type Field -->
<div class="form-group col-sm-6">
    {!! Form::label('gift_type', 'Loại quà:') !!}
    {!! Form::select('gift_type', $gift_types, isset($gift) ? $gift->type_id : '',['class' => 'form-control']) !!}
</div>

<!-- Status Field -->
<div class="form-group col-sm-6">
    {!! Form::label('status', 'Trạng thái:') !!}
    {!! Form::select('status', array(0 => 'Không hoạt động', 1 => 'Hoạt động'), null, ['class' => 'form-control']) !!}
</div>

<!-- User Id Field -->
<div class="form-group col-sm-12">
    {!! Form::label('client_id', 'Nhà cung cấp:') !!}
    {!! Form::select('client_id', $client, isset($gift) ? $gift->client_id : '',['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('gifts.index') }}" class="btn btn-light">Cancel</a>
</div>
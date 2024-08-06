<!-- Name Field -->
<div class="form-group col-sm-12">
    {!! Form::label('name', 'Tên loại:') !!}
    {!! Form::text('name', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Status Field -->
<div class="form-group col-sm-12">
    {!! Form::label('status', 'Trạng thái:') !!}
    {!! Form::select('status', array(0 => 'Không hoạt động', 1 => 'Hoạt động'), null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('giftTypes.index') }}" class="btn btn-light">Cancel</a>
</div>
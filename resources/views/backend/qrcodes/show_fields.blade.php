<!-- Qr Code Field -->
<div class="form-group">
    {!! Form::label('qr_code', 'Qr Code:') !!}
    <p>{{ $qrcode->qr_code }}</p>
</div>

<!-- Image Field -->
<div class="form-group">
    {!! Form::label('image', 'Image:') !!}
    <p>{{ $qrcode->image }}</p>
</div>

<!-- Product Id Field -->
<div class="form-group">
    {!! Form::label('product_id', 'Product Id:') !!}
    <p>{{ $qrcode->product_id }}</p>
</div>

<!-- Begined At Field -->
<div class="form-group">
    {!! Form::label('begined_at', 'Begined At:') !!}
    <p>{{ $qrcode->begined_at }}</p>
</div>

<!-- Ended At Field -->
<div class="form-group">
    {!! Form::label('ended_at', 'Ended At:') !!}
    <p>{{ $qrcode->ended_at }}</p>
</div>

<!-- Status Field -->
<div class="form-group">
    {!! Form::label('status', 'Status:') !!}
    <p>{{ $qrcode->status }}</p>
</div>


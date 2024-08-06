<!-- User Id Field -->
<div class="form-group">
    {!! Form::label('user_id', 'User Id:') !!}
    <p>{{ $customerClientPoint->user_id }}</p>
</div>

<!-- Client Id Field -->
<div class="form-group">
    {!! Form::label('client_id', 'Client Id:') !!}
    <p>{{ $customerClientPoint->client_id }}</p>
</div>

<!-- Total Points Field -->
<div class="form-group">
    {!! Form::label('total_points', 'Total Points:') !!}
    <p>{{ $customerClientPoint->total_points }}</p>
</div>


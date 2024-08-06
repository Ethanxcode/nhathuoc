<!-- Name Field -->
<div class="form-group">
    <div class="row">
        <div class="col-sm-12 col-md-1">{!! Form::label('full_name', 'Name:') !!}</div>
        <div class="col-sm-12 col-md-10">{{ $users->name }}</div>
    </div>
</div>

<!-- Email Field -->
<div class="form-group">
    <div class="row">
        <div class="col-sm-12 col-md-1">{!! Form::label('email', 'Email:') !!}</div>
        <div class="col-sm-12 col-md-10">{{ $users->email }}</div>
    </div>
</div>

<!-- Phone Field -->
<div class="form-group">
    <div class="row">
        <div class="col-sm-12 col-md-1">{!! Form::label('phone', 'Phone:') !!}</div>
        <div class="col-sm-12 col-md-10">{{ $users->phone }}</div>
    </div>
</div>


<!-- Phone Field -->
<div class="form-group">
    <div class="row">
        <div class="col-sm-12 col-md-1">{!! Form::label('address', 'Address:') !!}</div>
        <div class="col-sm-12 col-md-10">{{ $users->address }}</div>
    </div>
</div>


<!-- Created At Field -->
<div class="form-group">
    <div class="row">
        <div class="col-sm-12 col-md-1">{!! Form::label('member', 'Created At:') !!}</div>
        <div class="col-sm-12 col-md-10">{{ $users->created_at }}</div>
    </div>
</div>

<!-- Updated At Field -->
<div class="form-group">
    <div class="row">
        <div class="col-sm-12 col-md-1">{!! Form::label('member', 'Updated At:') !!}</div>
        <div class="col-sm-12 col-md-10">{{ $users->updated_at }}</div>
    </div>
</div>
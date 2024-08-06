<!-- Uid Field -->
<div class="form-group">
    <div class="row">
        <div class="col-sm-12 col-md-1">{!! Form::label('user_id', 'User:') !!}</div>
        <div class="col-sm-12 col-md-10">{{ $resources->user_id }}</div>
    </div>    
</div>

<!-- File Name Field -->
<div class="form-group">
    <div class="row">
        <div class="col-sm-12 col-md-1">{!! Form::label('file_name', 'File Name:') !!}</div>
        <div class="col-sm-12 col-md-10">{{ $resources->file_name }}</div>
    </div>    
</div>

<!-- Content Type Field -->
<div class="form-group">
    <div class="row">
        <div class="col-sm-12 col-md-1">{!! Form::label('content_type', 'Content Type:') !!}</div>
        <div class="col-sm-12 col-md-10">{{ $resources->content_type }}</div>
    </div>    
</div>

<!-- Title Field -->
<div class="form-group">
    <div class="row">
        <div class="col-sm-12 col-md-1">{!! Form::label('title', 'Title:') !!}</div>
        <div class="col-sm-12 col-md-10">{{ $resources->title }}</div>
    </div>    
</div>


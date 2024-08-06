<!-- Product Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('product_name', 'Tên sản phẩm:') !!}
    {!! Form::text('product_name', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Sku Field -->
<div class="form-group col-sm-6">
    {!! Form::label('sku', 'Sku:') !!}
    {!! Form::text('sku', null, ['class' => 'form-control']) !!}
</div>

<!-- Price Field -->
<div class="form-group col-sm-6">
    {!! Form::label('price', 'Giá:') !!}
    {!! Form::text('price', null, ['class' => 'form-control']) !!}
</div>

<!-- Qrcode Qty Field -->
<div class="form-group col-sm-6">
    {!! Form::label('qrcode_qty', 'Số lượng QRCode:') !!}
    {!! Form::text('qrcode_qty', null, ['class' => 'form-control']) !!}
</div>

<!-- Points Field -->
<div class="form-group col-sm-6">
    {!! Form::label('points', 'Điểm quy đổi:') !!}
    {!! Form::text('points', null, ['class' => 'form-control']) !!}
</div>

<!-- User Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('client_id', 'Nhà cung cấp:') !!}
    {!! Form::select('client_id', $clients, isset($product['client_id']) ? $product['client_id'] : '', ['class' =>
    'form-control']) !!}
</div>

<!-- Description Field -->
<div class="form-group col-sm-12">
    {!! Form::label('description', 'Mô tả:') !!}
    {!! Form::textarea('description', null, ['id' => 'description', 'class' => 'form-control','maxlength' =>
    255,'maxlength'
    => 255]) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('products.index') }}" class="btn btn-light">Cancel</a>
    <a href="{{ route('products.index') }}" class="btn btn-danger btn-generate-qrcode">Generate QRCode</a>
</div>
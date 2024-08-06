@extends('layouts.app')
@section('title')
Edit Product
@endsection
@section('content')
<section class="section">
    <div class="section-header">
        <h3 class="page__heading m-0">Edit Product</h3>
        <div class="filter-container section-header-breadcrumb row justify-content-md-end">
            <a href="{{ route('products.index') }}" class="btn btn-primary">Back</a>
        </div>
    </div>
    <div class="content">
        @include('stisla-templates::common.errors')
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body ">
                            {!! Form::model($product, ['route' => ['products.update', $product->id], 'method' =>
                            'patch']) !!}
                            <div class="row">
                                @include('backend.products.fields')
                            </div>

                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('scripts')
<script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    CKEDITOR.replace(document.getElementById('description'));
});
</script>
@endsection
@extends('frontend2.layouts.app')
@section('content')
<div class="container wapper-content-account">
    <section class="section">
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="text-center">&nbsp;</h3>
                            <div class="row">
                                <div class="col-lg-2 col-md-2 col-sm-2 text-center">
                                    <img src="{{URL::asset('web/images/account.png')}}" class="icon-account" />
                                </div>
                                <div class="col-lg-10 col-md-10 col-sm-10">
                                    <label class="account-page-title">Cập nhật thông tin</label>
                                    <div class="content">
                                        @include('stisla-templates::common.errors')
                                        <div class="section-body">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="card">
                                                        <div class="card-body card-body-update">
                                                            {!! Form::model($user, ['route' => ['info.update',
                                                            $user->id], 'method' => 'patch']) !!}
                                                            <div class="row">
                                                                @include('frontend2.user.fields')
                                                            </div>

                                                            {!! Form::close() !!}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $('.btn-primary').click(function(e){
                e.preventDefault();
                let user_id = $('#user_id').val();
                
                let _name = $('#name').val();
                let _password = $('#password').val();
                let _password_confirm = $('#password_confirmation').val();
                let phone = $('#phone').val();
                let nha_thuoc_id = $('#nha_thuoc_id').val();
                let address = $('#address').val();

                let _token = $('._token');
                let data = {
                    user_id: user_id,
                    nha_thuoc_id: nha_thuoc_id,
                    name: _name,
                    password: _password,
                    phone: phone,
                    address: address,
                    _token: "{{ csrf_token() }}"
                }

                if(_password_confirm!=_password){
                    alert('Mật khẩu không giống nhau.');
                    return false;
                }

                let url = "{{ route('info.update') }}";

                $.ajax({
                    url: url,
                    type: "POST",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: data,
                    success: function(data) {
                        result = JSON.parse(data);
                        if(result.gt == 1){
                            alert('Cập nhât dữ liệu thành công.');
                            window.location.href = "{{route('home')}}";
                        }else{
                            alert('Cập nhât dữ liệu không thành công.');
                        }
                    }
                });
            });
        });
    </script>
@endsection
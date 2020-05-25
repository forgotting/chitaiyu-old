<div class="modal fade" style="margin-top: 8%" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">請輸入您的密碼</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                {!! Form::hidden('id', Request::route('id')) !!}
                <div class="form-group row">
                    <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('密碼') }}</label>

                    <div class="col-md-6">
                        {!! Form::password('password', null, ['class' => 'form-control', 'autocomplete' => 'current-password']) !!}
                        <span class="invalid-feedback alert-danger" role="alert">
                            <strong id="alertMsg"></strong>
                        </span>
                    </div>
                </div>

                <div class="form-group row mb-0">
                    <div class="col-md-8 offset-md-4">
                        <button type="button" class="btn btn-info" id="loginSubmit">送出</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

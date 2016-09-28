<div class="panel-body">
    <div class="row">
        <div class="col-md-12">
            <form action="{{ url('/store') }}" method="POST" class="form-horizontal">
                {!! csrf_field() !!}
                <div class="hidden-xs-down hidden-sm-down hidden-md-down col-lg-1">
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-9">
                    <div class="form-group input">
                        <label class="control-label col-sm-3 col-md-3" for="name">Your name:</label>
                        <div class="col-sm-9 col-md-9">
                            <input type="text" class="form-control input" id="name" name="name"
                                   placeholder="Enter your name" value="{{ old('name') }}" required>
                        </div>
                    </div>
                    <div class="form-group input">
                        <label class="control-label col-sm-3 col-md-3" for="email">E-mail:</label>
                        <div class="col-sm-9 col-md-9">
                            <input type="email" class="form-control input" id="email" name="email"
                                   placeholder="Enter e-mail" value="{{ old('email') }}" required>
                        </div>
                    </div>
                    <div class="form-group input">
                        <label class="control-label col-sm-3 col-md-3" for="homepage">Your homepage:</label>
                        <div class="col-sm-9 col-md-9">
                            <input type="url" class="form-control input" id="homepage" name="homepage"
                                   placeholder="Enter your homepage" value="{{ old('homepage') }}">
                        </div>
                    </div>
                    <div class="form-group input">
                        <label class="control-label col-sm-3 col-md-3" for="captcha">Captcha:</label>
                        <div class="col-sm-9 col-md-9">
                            {!! captcha_image_html('ExampleCaptcha') !!}
                            <input type="text" id="CaptchaCode" name="CaptchaCode" required>
                        </div>
                    </div>
                    <div class="form-group input">
                        <label class="control-label col-sm-3 col-md-3" for="message">Message:</label>
                        <div class="col-sm-9 col-md-9">
                            <textarea class="form-control input" id="message" name="message"
                                   placeholder="Enter message" required>{{ old('message') }}</textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-xs-4 col-sm-5 col-md-5 col-lg-6"></div>
                            <div class="col-xs-7 col-sm-6 col-md-4 col-lg-4 text-center btn-group">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <button type="submit" class="btn btn-default">
                                    <i class="fa fa-edit"></i> Save</button>
                                <a href="{{ url('/') }}" class="btn btn-default">
                                    <i class="fa fa-close fa-fw"></i> Close
                                </a>
                            </div>
                            <div class="col-xs-1 col-sm-1 col-md-3 col-lg-2"></div>
                        </div>
                    </div>
                    <div class="hidden-xs-down hidden-sm-down hidden-md-down col-lg-2">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
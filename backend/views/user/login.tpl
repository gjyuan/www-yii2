{extends file="layouts/base.tpl"}
{block name="header"}
    <link rel="stylesheet" type="text/css" href="{fe static='css/main/user/login.css'}"/>
{/block}
{block name="content"}
<div class="login">
    <div class="logo">
        <img src="{fe static="css/image/login_logo.png"}" alt="" />
    </div>
    <div class="content">
        <!--用户登录-->
        <form class="form-vertical login-form">
            <h3 class="form-title">用户登录</h3>
            <div class="alert alert-error hide">
                <button class="close" data-dismiss="alert"></button>
                <span>Enter any username and password.</span>
            </div>
            <div class="control-group">
                <label class="control-label visible-ie8 visible-ie9">用户邮箱</label>
                <div class="controls">
                    <div class="input-icon left">
                        <i class="icon-user"></i>
                        <input class="form-control m-wrap" type="text" placeholder="用户邮箱" name="userName" id="userName"/>
                    </div>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label visible-ie8 visible-ie9">密码</label>
                <div class="controls">
                    <div class="input-icon left">
                        <i class="icon-lock"></i>
                        <input class="form-control m-wrap" type="password" placeholder="密码" name="password" id="password"/>
                    </div>
                </div>
            </div>
            <div class="form-actions">
                <label class="checkbox">
                   <input class="form-checkbox-input" type="checkbox" name="remember" value="1"/>记住密码
                </label>
                <button type="button" class="btn btn-success btn-sm pull-right" id="login_btn">
                    登录<i class="m-icon-white m-icon-swapright"></i>
                </button>
            </div>
            <div class="forget-password">
                <a href="javascript:void(0)" id="forget-password">忘记密码?</a>
                <a href="javascript:void(0);" id="register-btn" class="pull-right">注册</a>
            </div>
        </form>
        <!--用户找回密码-->
        <form class="form-vertical forget-form" action="index.html">
            <h3 class="">Forget Password ?</h3>
            <p>Enter your e-mail address below to reset your password.</p>
            <div class="control-group">
                <div class="controls">
                    <div class="input-icon left">
                        <i class="icon-envelope"></i>
                        <input class="m-wrap placeholder-no-fix" type="text" placeholder="Email" name="email" />
                    </div>
                </div>
            </div>
            <div class="form-actions">
                <button type="button" id="back-btn" class="btn">
                    <i class="m-icon-swapleft"></i> Back
                </button>
                <button type="submit" class="btn green pull-right">
                    Submit <i class="m-icon-swapright m-icon-white"></i>
                </button>
            </div>
        </form>
        <!--用户注册-->
        <form class="form-vertical register-form" action="index.html">
            <h3 class="">Sign Up</h3>
            <p>Enter your account details below:</p>
            <div class="control-group">
                <label class="control-label visible-ie8 visible-ie9">Username</label>
                <div class="controls">
                    <div class="input-icon left">
                        <i class="icon-user"></i>
                        <input class="m-wrap placeholder-no-fix" type="text" placeholder="Username" name="username"/>
                    </div>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label visible-ie8 visible-ie9">Password</label>
                <div class="controls">
                    <div class="input-icon left">
                        <i class="icon-lock"></i>
                        <input class="m-wrap placeholder-no-fix" type="password" id="register_password" placeholder="Password" name="password"/>
                    </div>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label visible-ie8 visible-ie9">Re-type Your Password</label>
                <div class="controls">
                    <div class="input-icon left">
                        <i class="icon-ok"></i>
                        <input class="m-wrap placeholder-no-fix" type="password" placeholder="Re-type Your Password" name="rpassword"/>
                    </div>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label visible-ie8 visible-ie9">Email</label>
                <div class="controls">
                    <div class="input-icon left">
                        <i class="icon-envelope"></i>
                        <input class="m-wrap placeholder-no-fix" type="text" placeholder="Email" name="email"/>
                    </div>
                </div>
            </div>
            <div class="control-group">
                <div class="controls">
                    <label class="checkbox">
                        <input type="checkbox" name="tnc"/> I agree to the <a href="#">Terms of Service</a> and <a href="#">Privacy Policy</a>
                    </label>
                    <div id="register_tnc_error"></div>
                </div>
            </div>
            <div class="form-actions">
                <button id="register-back-btn" type="button" class="btn">
                    <i class="m-icon-swapleft"></i>  Back
                </button>
                <button type="submit" id="register-submit-btn" class="btn green pull-right">
                    Sign Up <i class="m-icon-swapright m-icon-white"></i>
                </button>
            </div>
        </form>
    </div>
    <div class="copyright">
        2017 &copy;qqyuan.com.
    </div>
</div>
{/block}
{block name="footer"}
{/block}


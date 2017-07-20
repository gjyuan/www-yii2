{assign var=body_class value="login"}
{extends file="layouts/nomenu_base.tpl"}
{block name="header"}
    <link rel="stylesheet" type="text/css" href="{fe static='plugins/bootstrap/css/bootstrap-switch.min.css'}"/>
    <link rel="stylesheet" type="text/css" href="{fe static='css/main/user/login.css'}"/>
{/block}
{block name="content"}
    <!-- BEGIN LOGO -->
    <div class="logo">
        <a href="index.html">
            <img src="{fe static="css/img/login_logo.png"}" alt="" /> </a>
    </div>
    <!-- END LOGO -->
    <!-- BEGIN LOGIN -->
    <div class="content">
        <!-- BEGIN LOGIN FORM -->
        <form class="login-form" action="index.html" method="post">
            <h3 class="form-title font-green">用户登录</h3>
            <div class="alert alert-danger display-hide">
                <button class="close" data-close="alert"></button>
                <span> Enter any username and password. </span>
            </div>
            <div class="form-group">
                <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
                <label class="control-label visible-ie8 visible-ie9">用户邮箱</label>
                <input class="form-control form-control-solid placeholder-no-fix" type="text" autocomplete="off" placeholder="用户邮箱" name="userName" id="userName"/>
            </div>
            <div class="form-group">
                <label class="control-label visible-ie8 visible-ie9">密码</label>
                <input class="form-control form-control-solid placeholder-no-fix" type="password" autocomplete="off" placeholder="密码" name="passWord" id="passWord"/>
            </div>
            <div class="form-actions">
                <div class="pull-right">
                    <button type="button" class="btn green" id="login_btn">登 录</button>
                </div>
                <label class="check mt-checkbox mt-checkbox-outline">
                    <input type="checkbox" name="remember" value="1" />记住密码
                    <span></span>
                </label>
            </div>
            <div class="login-options">
                <a href="javascript:void(0);" id="register-btn" class="">注册</a>
                <a href="javascript:void(0);" id="forget-password" class="pull-right">忘记密码</a>
            </div>
        </form>
        <!-- END LOGIN FORM -->
        <!-- BEGIN FORGOT PASSWORD FORM -->
        <form class="forget-form" action="index.html" method="post">
            <h3 class="font-green">Forget Password ?</h3>
            <p> Enter your e-mail address below to reset your password. </p>
            <div class="form-group">
                <input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="Email" name="email" /> </div>
            <div class="form-actions">
                <button type="button" id="back-btn" class="btn green btn-outline">Back</button>
                <button type="submit" class="btn btn-success uppercase pull-right">Submit</button>
            </div>
        </form>
        <!-- END FORGOT PASSWORD FORM -->
        <!-- BEGIN REGISTRATION FORM -->
        <form class="register-form" action="" method="post">
            <h3 class="font-green">注册</h3>
            <p class="hint">输入注册信息</p>
            <div class="form-group">
                <label class="control-label visible-ie8 visible-ie9">邮箱</label>
                <input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="邮箱" name="r_email"/>
            </div>
            <div class="form-group">
                <label class="control-label visible-ie8 visible-ie9">密码</label>
                <input class="form-control placeholder-no-fix" type="password" autocomplete="off" id="register_password" placeholder="密码" name="r_password" />
            </div>
            <div class="form-group">
                <label class="control-label visible-ie8 visible-ie9">确认密码</label>
                <input class="form-control placeholder-no-fix" type="password" autocomplete="off" placeholder="确认密码" name="r_rpassword" />
            </div>

            <p class="hint">个人信息</p>
            <div class="form-group">
                <label class="control-label visible-ie8 visible-ie9">姓名</label>
                <input class="form-control placeholder-no-fix" type="text" placeholder="姓名" name="r_fullname" />
            </div>
            <div class="form-group">
                <label class="control-label visible-ie8 visible-ie9">电话</label>
                <input class="form-control placeholder-no-fix" type="text" placeholder="手机号码(必填)" name="r_mobile" />
            </div>
            <div class="form-group">
                <label class="control-label visible-ie8 visible-ie9">性别</label>
                <input name="r_gender" type="checkbox" class="make-switch" checked data-size="large" data-on-text="男" data-off-text="女" data-on-color="primary" data-off-color="danger">
            </div>

            <div class="form-group margin-top-20 margin-bottom-20">
                <label class="mt-checkbox mt-checkbox-outline">
                    <input type="checkbox" name="remember" value="1" />
                    <input type="checkbox" name="tnc" />我已经阅读并同意
                    <a href="javascript:;">网站服务条例 </a>
                    <span></span>
                </label>
                <div id="register_tnc_error"> </div>
            </div>
            <div class="form-actions">
                <button type="button" id="register-back-btn" class="btn green btn-outline">返回</button>
                <button type="button" id="register_btn" class="btn btn-success pull-right">立即注册</button>
            </div>
        </form>
        <!-- END REGISTRATION FORM -->
    </div>
    <div class="copyright"> 2014 © Metronic. Admin Dashboard Template. </div>
{/block}
{block name="footer"}
    <script type="text/javascript">
        Common.addSysncJs("{fe static='plugins/bootstrap/js/bootstrap-switch.min.js'}");
    </script>
{/block}


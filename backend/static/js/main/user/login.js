$('.make-switch').bootstrapSwitch();
$('#forget-password').click(function () {
    $('.login-form').hide();
    $('.forget-form').show();
});
$('#register-btn').click(function () {
    $('.login-form').hide();
    $('.register-form').show();
});
$("#login_btn").click(function () {
    var userName = $("#userName").val();
    var passwd = $("#passWord").val();
    Common.cajax("/api/user/userCheck",{userName:userName,passwd:passwd},{
        success: function (data,msg) {
            window.location.href="/";
        },
        error: function (data,msg) {
            alert(msg);
        }
    })
});
$("#register_btn").click(function () {
    var formData = $(".register-form").serializeArray();
    var r_email='',r_passwd = '',r_rpasswd='',r_fullname='',r_mobile='';
    for(var i=0;i<formData.length;i++){
         eval(formData[i]['name']+"='"+formData[i]['value']+"'");
    }
    if(r_email.length>0 && r_fullname)
    var r_gender = $("input[name=r_gender]").bootstrapSwitch("state") ? 1 : 2;
    var data = {userName:r_userName,password:r_passwd,rpassword:r_rpasswd,name:r_fullname,gender:r_gender,mobile:r_mobile};
    Common.cajax('/api/user/register',data,{
        success:function (data,msg) {
            alert("success");
        },
        error:function (data,msg) {
            alert(msg);
        }
    })
});


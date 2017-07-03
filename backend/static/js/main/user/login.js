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
    var passwd = $("#password").val();
    Common.cajax("/api/user/userCheck",{userName:userName,passwd:passwd},{
        success: function (data,msg) {
            window.location.href="/";
        },
        error: function (data,msg) {
            alert(msg);
        }
    })
});
<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
    <meta http-equiv=Content-Type content="text/html;charset=utf-8"/>
    <title>99远</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta content="" name="description" />
    <meta content="" name="author" />
    <script type="text/javascript">document.domain="qqyuan.com"</script>
    <link rel="stylesheet" type="text/css" href="{fe static='plugins/font-awsome/css/font-awesome.min.css'}"/>
    <link rel="stylesheet" type="text/css" href="{fe static='plugins/simple-line-icons/simple-line-icons.min.css'}"/>
    <link rel="stylesheet" type="text/css" href="{fe static='plugins/morris/css/morris.css'}"/>
    <link rel="stylesheet" type="text/css" href="{fe static='plugins/bootstrap/css/bootstrap.min.css'}"/>
    <link rel="stylesheet" type="text/css" href="{fe static='css/common/components.min.css'}"/>
    <link rel="stylesheet" type="text/css" href="{fe static='css/common/plugins.min.css'}"/>
    <link rel="stylesheet" type="text/css" href="{fe static='css/common/default.min.css'}"/>
    <link rel="stylesheet" type="text/css" href="{fe static='css/common/layout.min.css'}"/>
    {block name="header"}{/block}
</head>
<body class='{$body_class|default:""}'>
    {widget name="backend\widgets\Header"}
    <div class="clearfix"> </div>
    <div class="page-container">
        {widget name="backend\widgets\LeftMenu"}
        {block name='content'}{/block}
    </div>
    {widget name="common\widgets\LoadJs"}
    <script type="text/javascript" src="{fe static='js/common/labjs.min.js'}"></script>
    <script type="text/javascript">
        $LAB.script(
            "{fe static='js/common/jquery.min.js'}",
            "{fe static='js/common/common.js'}"
        ).wait(function () {
            Common.addPreloadJs([
                "{fe static='plugins/bootstrap/js/bootstrap.min.js'}",
                "{fe static='js/common/app.js'}"
            ]);
            Common.addJs([
                "{fe static='plugins/jquery/js/quick-sidebar.min.js'}",
                "{fe static='plugins/jquery/js/jquery.slimscroll.min.js'}",
                "{fe static='plugins/bootstrap/js/bootstrap-hover-dropdown.min.js'}",
                "{fe static='plugins/morris/js/morris.min.js'}",
                "{fe static='js/common/layout.min.js'}"
            ]);
            loadTplJs();
            Common.initJs();
        });
    </script>
    {block name="footer"}{/block}

</body>
</html>
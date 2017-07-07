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
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link rel="stylesheet" type="text/css" href="{fe static='css/common/font-awesome.min.css'}"/>
    <link rel="stylesheet" type="text/css" href="{fe static='plugins/bootstrap/css/bootstrap.min.css'}"/>
    <link rel="stylesheet" type="text/css" href="{fe static='css/common/components.min.css'}"/>
    {block name="header"}{/block}
</head>
<body class='{$body_class|default:""}'>
    {block name='content'}{/block}
    <script type="text/javascript" src="{fe static='js/common/labjs.min.js'}"></script>
    <script type="text/javascript">
        $LAB.script("{fe static='js/common/jquery.min.js'}").wait()
            .script("{fe static='js/common/common.js'}").wait()
            .script("{fe static='plugins/bootstrap/js/bootstrap.min.js'}");

    </script>
    {widget name="common\widgets\LoadJs"}
    {block name="footer"}{/block}
</body>
</html>
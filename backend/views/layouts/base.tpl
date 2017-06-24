<!DOCTYPE HTML>
<!--[if lt IE 7]><html class="no-js lt-ie9 lt-ie8 lt-ie7"><![endif]-->
<!--[if IE 7]><html class="no-js lt-ie9 lt-ie8"><![endif]-->
<!--[if IE 8]><html class="no-js lt-ie9"><![endif]-->
<!--[if gt IE 8]><!--><html class="no-js"><!--<![endif]-->
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta content="yes" name="apple-mobile-web-app-capable"/>
    <meta content="yes" name="apple-touch-fullscreen"/>
    <meta content="telephone=no,email=no" name="format-detection"/>
    <title>链家网</title>
    <script type="text/javascript">document.domain="qqyuan.com"</script>
    <link rel="stylesheet" href="{fe static='plugins\bootstrap\css\bootstrap.min.css'}">
    <link rel="stylesheet" href="{fe static='css/base/common.css'}">
    {block name="header"}{/block}
</head>
<body>
    <div class="content">
        {block name='content'}{/block}
    </div>
    <script type="text/javascript" src="{fe static='js/common/labjs.min.js'}"></script>
    <script type="text/javascript">
        $LAB.script("{fe static='js/common/jquery.min.js'}").wait()
            .script("{fe static='plugins/bootstrap/js/bootstrap.min.js'}");
    </script>
    {widget name="common\widgets\LoadJs"}
    {block name="footer"}{/block}
</body>
</html>
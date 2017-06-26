<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv=Content-Type content="text/html;charset=utf-8">
    <meta http-equiv=X-UA-Compatible content="IE=edge,chrome=1">
    <title>99远</title>
    <script type="text/javascript">document.domain="qqyuan.com"</script>
    <link rel="stylesheet" type="text/css" href="{fe static='css\common\common.css'}"/>
    <link rel="stylesheet" type="text/css" href="{fe static='plugins\bootstrap\css\bootstrap.min.css'}"/>
    {block name="header"}{/block}
</head>
<body>
    <div class="content">
        {block name='content'}{/block}
    </div>
    <script type="text/javascript" src="{fe static='js/common/labjs.min.js'}"></script>
    <script type="text/javascript">
        $LAB.script("{fe static='js/common/jquery.min.js'}").wait()
            .script("{fe static='plugins/bootstrap/js/tether.min.js'}").wait()
            .script("{fe static='plugins/bootstrap/js/bootstrap.min.js'}");
    </script>
    {widget name="common\widgets\LoadJs"}
    {block name="footer"}{/block}
</body>
</html>
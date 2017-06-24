{extends file="layouts/base.tpl"}
{block name="content"}
    backbackbackbackbackbackbackbackback
{/block}
{block name="footer"}
    <script type="text/javascript">
        $LAB.script("{fe static='js/base/underscore-min.js'}").wait(function(){
            console.log($);
        });
    </script>
{/block}


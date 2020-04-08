lib.calc = TEXT
lib.calc {
    current = 1
    prioriCalc = 1
}

plugin.tx_timeline_pi1 {
    settings {
        jquery = {$plugin.tx_timeline_pi1.settings.jquery}
        layout = {$plugin.tx_timeline_pi1.settings.layout}
        year = {$plugin.tx_timeline_pi1.settings.year}
        back_color = {$plugin.tx_timeline_pi1.settings.back_color}
        fore_color = {$plugin.tx_timeline_pi1.settings.fore_color}
        customCSS = {$plugin.tx_timeline_pi1.settings.customCSS}
    }
}


[globalString = LIT:{$plugin.tx_timeline_pi1.settings.customCSS} = /.+/]
page.includeCSS.file = {$plugin.tx_timeline_pi1.settings.customCSS}
[else]
page.includeCSS.file = EXT:timeline/Resources/Public/Css/timeline.css
[global]
[globalVar = LIT:1 = {$plugin.tx_timeline_pi1.settings.jquery}]
page.includeJSFooter.file = EXT:timeline/Resources/Public/Js/jquery.js
[global]
#page.includeJSFooter.file = EXT:timeline/Resources/Public/Js/timeline.js
page.footerData.10 = TEXT
page.footerData.10.value (
    <script type="text/javascript">
        $('ul.timeline').each(function () {
            var classes = $(this).attr('class').split(" ");
            classes.forEach(function ($var) {
                if ($var.startsWith("col")) {
                    $var = $var.replace("col", "");
                    $('ul.timeline1 li.work div.relative').css("background-color", $var);
                    $('ul.timeline1 li.work div.content').css("background-color", $var);
                    $('ul.timeline1 li.work div.relative span.circle').css("background-color", $var);
                    $('ul.timeline2 li div.timeline-panel h4').css("color", $var);
                    $('ul.timeline3').css("border-left", "4px solid " + $var);
                }
                if($var.startsWith("foreCol")) {
                    $var = $var.replace("foreCol", "");
                    $('ul.timeline1 li.work div.content').css("color", $var);
                    $('ul.timeline1 li.work div.relative').css("color", $var);
                    $('ul.timeline2 li div.timeline-panel h4').css("background-color", $var);
                }
            });
        });
    </script>
)
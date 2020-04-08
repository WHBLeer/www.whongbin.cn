var classes = $('ul.timeline').attr('class').split(" ");
classes.forEach(function($var) {
    if($var.startsWith("col")) {
        $('ul.timeline')
    }
});

$('ul.timeline').each(function () {
    var classes = $(this).attr('class').split(" ");
    classes.forEach(function ($var) {
        if ($var.startsWith("col")) {
            $var = $var.replace("col", "");
            $('ul.timeline li.work div.relative').css("background-color", $var);
            $('ul.timeline li.work div.content').css("background-color", $var);
            $('ul.timeline li.work div.relative span.circle').css("background-color", $var);
        }
    });
});
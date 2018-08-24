(function($)
{
    $(document).ready(function()
    {
        var $container = $(".stats.counter-web__text");
        $container.load("../../../stats.php");
        var refreshId = setInterval(function()
        {
            $container.load('../../../stats.php');
        }, 15000);
    });
})(jQuery);
(function($) {
    "use strict";
    $.Workload = function(settings) {
        var config = {
            url: '',
        };

        if (settings) {
            $.extend(config, settings);
        }

        $(document).on('click', '.dAssigneeList .item', function() {
            var current = $(this).data('value');
			var task = $(this).data('item');
			var master = $('.fluid.list[data-id="' + current + '"]');
            $('[data-parent="' + task + '"]').remove();
			
            var data = {
                task: task,
                id: current,
                action: "getWorkload"
            };
            var callback = function(json) {
                $(master).html(json.html).transition('fadeIn');
            };
            $.get(config.url + "/helper.php", data, callback, "json");
        });

        $('#dProjectList').on('click', '.item', function() {
            var filter = $(this).data('value');
            filterList(filter);
        });

        //Work filter function
        function filterList(value) {
            var list = $(".fluid.list").children('.item');
            $(list).fadeOut("fast");
            if (value === "all") {
                $(".fluid.list").children('.item').each(function() {
                    $(this).show();
                });
            } else {
                $(".fluid.list").children(".item[data-filter*=" + value + "]").each(function() {
                    $(this).delay(200).show();
                });
            }
        }
    };
})(jQuery);
(function($) {
    "use strict";
    $.Budget = function(settings) {
        var config = {
            url: '',
            lang: {
                budget: '',
				spent: '',
            }
        };

        if (settings) {
            $.extend(config, settings);
        }

        $("#dProjectList").on('click', '.item', function() {
			var id = $(this).data('value');
            var data = {
				id: id,
                action: "loadBudgetReport"
            };
            var callback = function(json) {
                $("#results").html(json.html).transition('fadeIn');
				$("#budget").html(config.lang.budget);
				$("#bamount").html(json.budget);
				$("#spent").html(config.lang.spent);
				$("#samount").html(json.expense + ' ' + json.spent);
            };
			$.get(config.url + "/helper.php", data, callback, "json");
		});
		
    };
})(jQuery);
(function($) {
    "use strict";
    $.reportsTime = function(settings) {
        var config = {
            url: '',
        };

        if (settings) {
            $.extend(config, settings);
        }

        $(document).on('click', 'a.showDetails', function() {
			var id = $(this).data("id");
			$("#details_" + id).slideDown(150);
			$("#dWrap").slideUp(150);
		});

        $(document).on('click', 'a.hideDetailst', function() {
			var id = $(this).data("id");
			$("#details_" + id).slideUp(150);
			$("#dWrap").slideDown(150);
		});
		
        $("#dSort").on('click', 'a.button', function() {
			$("#results").addClass('loading');
			$("#dSort a.button").removeClass('active');
			$(this).addClass('active');
			var type = $(this).data('type');
            var data = {
				type: type,
                action: "loadTimeReports"
            };
            var callback = function(json) {
                $("#results").html(json.html).removeClass('loading');
            };
			$.get(config.url + "/helper.php", data, callback, "json");
		});
		
    };
})(jQuery);
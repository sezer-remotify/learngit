(function($) {
    "use strict";
    $.Reports = function(settings) {
        var config = {
            url: '',
            lang: {
                months: '',
            }
        };

        if (settings) {
            $.extend(config, settings);
        }

        $("#payment_chart").addClass('loading');
        $.ajax({
            type: 'GET',
            url: config.url + "/helper.php",
            dataType: 'json',
			data:{action:"getPaymentsChart"}
        }).done(function(json) {
            var months = config.lang.months;
            var data = json.data;
            var labels = json.label.map(function(v) {
                return v + '';
            });
            var colors = json.color.map(function(v) {
                return v + '';
            });
            json.legend.map(function(v) {
                return $("#legend").append(v);
            });
            Morris.Line({
                element: 'payment_chart',
                data: data,
                xkey: 'm',
                ykeys: labels,
                labels: labels,
                lineWidth: 4,
                pointSize: 5,
                lineColors: colors,
				//gridTextFamily: "wSans",
				gridTextColor: "rgba(0,0,0,0.6)",
				fillOpacity: '.75',
                hideHover: 'auto',
                smooth: true,
                resize: true,
                xLabelFormat: function(x) {
                    var month = months[x.getMonth()];
                    return month;
                },
                dateFormat: function(x) {
                    var month = months[new Date(x).getMonth()];
                    return month;
                }
            });
            $("#payment_chart").removeClass('loading');
        });
    };
})(jQuery);
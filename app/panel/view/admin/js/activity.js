(function($) {
    "use strict";
    $.Activity = function(settings) {
        var config = {
            url: '',
            lang: {
                removeText: "Remove",
                saveText: "Save Record",
                editText: "Edit Record",
                monthsFull: '',
                monthsShort: '',
                weeksFull: '',
                weeksShort: '',
                weeksMed: '',
                weeksSmall: '',
                today: "Today",
                now: "Now",
                canBtn: "Cancel",
                clear: "Clear",
                ok: "OK",
                dateformat: "dd MMMM yyyy",
                catLabel: "Category Name",
            }
        };

        if (settings) {
            $.extend(config, settings);
        }

		function addDays(date, days, format) {
			var result = new Date(date);
			result.setDate(result.getDate() + days);
			var d = new Date(result);
			if(format === "long") {
				return ('0' + d.getDate()).slice(-2) + ' ' + config.lang.monthsShort[d.getMonth()] + ' ' + d.getFullYear();
			} else {
				return d.getFullYear() + '/' + ('0' + (d.getMonth()+1)).slice(-2) + '/' + ('0' + d.getDate()).slice(-2);
			}
		}

        function getRecords(date) {
            var data = {
                action: "getFullActivity",
                date: date.replace(/\//g, "-")
            };
            var callback = function(json) {
                setTimeout(function() {
                    $("#acData").html(json.html).removeClass('loading');
                }, 500);
            };
            $.get(config.url + "/helper.php", data, callback, "json");
        }
		
        $('#mNow').wDate({
            months: config.lang.monthsFull,
            short_months: config.lang.monthsShort,
            days_of_week: config.lang.weeksFull,
            short_days: config.lang.weeksShort,
            days_min: config.lang.weeksSmall,
            selected_format: 'DD, mmmm d',
            month_head_format: 'mmmm yyyy',
            format: 'mm/dd/yyyy',
            clearBtn: true,
            todayBtn: true,
            cancelBtn: true,
            clearBtnLabel: config.lang.clear,
            cancelBtnLabel: config.lang.canBtn,
            okBtnLabel: config.lang.ok,
            todayBtnLabel: config.lang.today,
        }).on('datechanged', function(event) {
			$("#acData").addClass('loading');
			var date = new Date(event.date);
			var day = date.getDate();
			var month = config.lang.monthsFull[date.getMonth()];
			var year = date.getFullYear();
			var formatted = month + ' ' + day + ', ' + year;
			
			var t = year + '/' + month + '/' + day;
			var d = addDays(t, 0);
			getRecords(d);
			
			var element = $("span", this);
			$(element).html(formatted);
			$("#prev").attr('data-date', addDays(formatted, -7));
			$("#next").attr('data-date', addDays(formatted, 7));
		});
		
        $(document).on('click', '#prev, #next', function() {
            $("#acData").addClass('loading');
            var text = $(this).attr('data-date');
			$("#mNow span").text(addDays(text, 0, "long"));

            if ($(this).attr('id') === "next") {
				$(this).attr("data-date", addDays(text, 1));
				$("#prev").attr('data-date', addDays(text,  -1));
            } else {
                $(this).attr("data-date", addDays(text, -1));
				$("#next").attr('data-date', addDays(text,  1));
            }
			
            getRecords(text);
        });
		 
    };
})(jQuery);
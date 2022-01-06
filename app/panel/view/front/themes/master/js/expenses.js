(function($) {
    "use strict";
    $.Expense = function(settings) {
        var config = {
            url: '',
            is_edit: true,
            pid: '',
            weekstart: '',
            lang: {
                removeText: "Remove",
                saveText: "Save Record",
                editText: "Edit Record",
                today: "Today",
                monthsFull: '',
                monthsShort: '',
                weeksShort: '',
            }
        };

        if (settings) {
            $.extend(config, settings);
        }

        $('[data-toggle]').click(function() {
            $('#wojo_form').trigger("reset");
            $('#mCreated').calendar('set date', new Date());
            $('#expForm input[name=id]').remove();
			$("button[name=dosubmit]").text(config.lang.saveText);
        });

        function getRecords(date) {
            var data = {
                action: "getExpRecordWeekly",
                id: config.pid,
				currency: config.currency,
                date: date
            };
            var callback = function(json) {
                setTimeout(function() {
                    $("#expWeekly").html(json.html).removeClass('loading');
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
			$("#expWeekly").addClass('loading');
			var date = new Date(event.date);
			var day = date.getDate();
			var month = config.lang.monthsFull[date.getMonth()];
			var year = date.getFullYear();
			var formatted = month + ' ' + day + ', ' + year;
			
			var t = year + '/' + month + '/' + day;
			var d = addDays(t, 0);
			getRecords(d);
			
			var element = $("a span", this);
			$(element).html(formatted);
			$("#prev").attr('data-date', addDays(formatted, -7));
			$("#next").attr('data-date', addDays(formatted, 7));
		});
        
		function addDays(date, days) {
			var result = new Date(date);
			result.setDate(result.getDate() + days);
			var d = new Date(result);
			return d.getFullYear() + '/' + ('0' + (d.getMonth()+1)).slice(-2) + '/' + ('0' + d.getDate()).slice(-2);
		}
		
        $("#expnav").on('click', '#prev, #next', function() {
            $("#expWeekly").addClass('loading');
            var text = $(this).attr('data-date');
            if ($(this).attr('id') === "next") {
                $(this).attr("data-date", addDays(text, 7));
                $("#prev").attr('data-date', addDays(text,  -7));
            } else {
                $(this).attr('data-date', addDays(text, -7));
                $("#next").attr('data-date', addDays(text, 7));
            }
            getRecords(text);
        });

    };
})(jQuery);
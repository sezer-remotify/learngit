(function($) {
    "use strict";
    $.Time = function(settings) {
        var config = {
            url: '',
            is_edit: true,
            pid: '',
            weekstart: '',
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
            }
        };

        if (settings) {
            $.extend(config, settings);
        }

        $('#showTimeForm').click(function() {
            $(this).hide();
            $('#timeForm').css("display", "block").transition("fadeIn", {
                duration: 200
            });
        });

        $('#hideTimeForm').click(function() {
            $('#timeForm').transition("fadeOut", {
                duration: 200,
                complete: function() {
                    $(this).hide();
                    $('#showTimeForm').show();
					$('#wojo_form').trigger("reset");
					$('#timeForm input[name=id]').remove();
					$("button[name=dosubmit]").text(config.lang.saveText);
                }
            });
        });

        function getRecords(date) {
            var data = {
                action: "getTimeRecordWeekly",
                id: config.pid,
                date: date
            };
            var callback = function(json) {
                setTimeout(function() {
                    $("#timeWeekly").html(json.html).removeClass('loading');
                }, 500);
            };
            $.get(config.url + "/helper.php", data, callback, "json");
        }

        //Edit Timerecord
        $('#timeHolder').on('click', '.is_edit', function() {
            var id = $(this).data('id');
            $.get(config.url + "/helper.php", {
                action: "editTimeRecord",
                id: id
            }, function(json) {
                if (json.type === "success") {
                    $("#timeForm").slideDown().addClass('loading');
                    $('html').animate({
                        scrollTop: $("#timeForm").offset().top
                    }, 600);

                    var row = json.data;
                    $("#showTimeForm").hide();
                    $("#timeForm input[name=title]").val(row.title);
                    $("#timeForm textarea[name=description]").val(row.description);

                    $("#elButton").find("span").text(json.short_date);
                    $("#elButton").attr("value", json.short_date);
                    $("input[name=created]").val(json.input_date);
					
                    var uList = $("#mUserList").find("[data-value='" + row.user_id + "']");
                    $("input[name=user_id]").val(row.user_id);
                    uList.addClass('selected');
                    $("[data-dropdown='#mUserList']").find('span').text(uList.data('html'));

                    var jList = $("#mJobList").find("[data-value='" + row.job_id + "']");
                    $("input[name=job_id]").val(row.job_id);
                    jList.addClass('selected');
                    $("[data-dropdown='#mJobList']").find('span').text(jList.data('html'));
					
                    $('#timeForm input[name=hours]').val(row.hours);
					$("#mBillable").prop('checked', row.is_billable ? true : false);

                    $("button[name=dosubmit]").text(config.lang.editText);
                    $('<input />', {
                        type: 'hidden',
                        name: 'id',
                        value: id
                    }).appendTo("#wojo_form");
                    $("#timeForm").removeClass('loading');
                }

            }, "json");
        });
				
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
			$("#timeWeekly").addClass('loading');
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
		
        $("#timenav").on('click', '#prev, #next', function() {
            $("#timeWeekly").addClass('loading');
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
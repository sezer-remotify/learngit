(function($) {
    "use strict";
    $.reportsTasks = function(settings) {
        var config = {
            url: '',
            weekstart: 0,
            lang: {
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
                from: '',
                to: '',
            }
        };

        if (settings) {
            $.extend(config, settings);
        }

        function getObjects(data, callback) {
            $.get(config.url + "/helper.php", data, callback, "json");
        }

        function getTypes(type, element) {
            var data = {
                type: type,
                action: "getTaskReports"
            };
            var callback = function(json) {
                $(element).html(json.html).transition('fadeIn', {duration: 200});
				$("select[name=labels]").wSelect();
            };
            getObjects(data, callback);
        }

        //Project Categories
        $("select[name=project_id]").on('change', function() {
            switch ($(this).val()) {
                case "category":
                    getTypes('category', '#project_id');
                    break;

                case "company":
                    getTypes('company', '#project_id');
                    break;

                case "selected":
                    getTypes('projects', '#project_id');
                    break;

                default:
                    $("#project_id").html('');
                    break;
            }
        });

        //Assignee
        $("select[name=assign_id]").on('change', function() {
            switch ($(this).val()) {
                case "users":
                    getTypes('users', '#assign_id');
                    break;

                default:
                    $("#assign_id").html('');
                    break;
            }
        });

        //Task List
        $("select[name=tasklist_id]").on('change', function() {
            switch ($(this).val()) {
                case "selected":
                    getTypes('tasklist', '#tasklist_id');
                    break;

                default:
                    $("#tasklist_id").html('');
                    break;
            }
        });

        //Label List
        $("select[name=label_id]").on('change', function() {
            switch ($(this).val()) {
                case "selected":
                    getTypes('labels', '#label_id');
                    break;

                default:
                    $("#label_id").html('');
                    break;
            }
        });

        //Due date
        $("select[name=duedate_id]").on('change', function() {
            switch ($(this).val()) {
                case "selected":
                    var d = new Date();
                    var today = (d.getMonth() + 1) + "/" + d.getDate() + "/" + d.getFullYear();

                    var calendar =
                        $('<div class="wojo icon input"> <i class="calendar icon"></i>' +
                            '<input type="text" value="' + today + '" name="duedate_select" id="duedate_select">' +
                            '</div>');
                    $("#duedate_id").html(calendar);
                    $("#duedate_select").wDate({
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
                    });
                    break;

                case "range":
                    var range =
                        $('<div class="wojo icon input">' +
                            '<i class="icon calendar"></i>' +
                            '<input name="duedate_from" type="text" placeholder="' + config.lang.from + '" readonly id="duedate_from">' +
                            '<input name="duedate_to" type="text" placeholder="' + config.lang.to + '" readonly id="duedate_to">' +
                            '<i class="icon calendar"></i> ' +
                            '</div>');

                    $("#created_id").html(range);
                    $('#duedate_from').wDate({
                        weekStart: config.weekstart,
                        rangeTo: $('#duedate_to'),
                    });
                    $('#duedate_to').wDate({
                        weekStart: config.weekstart,
                        rangeFrom: $('#duedate_from'),
                    });

                    break;

                default:
                    $("#duedate_id").html('');
                    break;
            }
        });

        //Created by
        $("select[name=createdby_id]").on('change', function() {
            switch ($(this).val()) {
                case "users":
                    getTypes('createddby', '#createdby_id');
                    break;

                default:
                    $("#createdby_id").html('');
                    break;
            }
        });

        //Created date
        $("select[name=created_id]").on('change', function() {
            switch ($(this).val()) {
                case "selected":
                    var calendar =
                        $('<div class="wojo icon input"> <i class="calendar icon"></i>' +
                            '<input type="text" value="" name="created_select" id="created_select">' +
                            '</div>');
                    $("#created_id").html(calendar);
                    $("#created_select").wDate({
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
                    });
                    break;

                case "range":
                    var range =
                        $('<div class="wojo icon input">' +
                            '<i class="icon calendar"></i>' +
                            '<input name="created_from" type="text" placeholder="' + config.lang.from + '" readonly id="created_from">' +
                            '<input name="created_to" type="text" placeholder="' + config.lang.to + '" readonly id="created_to">' +
                            '<i class="icon calendar"></i> ' +
                            '</div>');

                    $("#created_id").html(range);
                    $('#created_from').wDate({
                        weekStart: config.weekstart,
                        rangeTo: $('#created_to'),
                    });
                    $('#created_to').wDate({
                        weekStart: config.weekstart,
                        rangeFrom: $('#created_from'),
                    });
                    break;

                default:
                    $("#created_id").html('');
                    break;
            }
        });

        //Completed by
        $("select[name=completedby_id]").on('change', function() {
            switch ($(this).val()) {
                case "users":
                    getTypes('completedby', '#completedby_id');
                    break;

                default:
                    $("#completedby_id").html('');
                    break;
            }
        });

        //Completed date
        $("select[name=completed_id]").on('change', function() {
            switch ($(this).val()) {
                case "selected":
                    var calendar =
                        $('<div class="wojo icon input"> <i class="calendar icon"></i>' +
                            '<input type="text" value="" name="completed_select" id="completed_select">' +
                            '</div>');
                    $("#completed_id").html(calendar);
                    $("#completed_select").wDate({
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
                    });

                    break;

                case "range":
                    var range =
                        $('<div class="wojo icon input">' +
                            '<i class="icon calendar"></i>' +
                            '<input name="completed_from" type="text" placeholder="' + config.lang.from + '" readonly id="completed_from">' +
                            '<input name="completed_to" type="text" placeholder="' + config.lang.to + '" readonly id="completed_to">' +
                            '<i class="icon calendar"></i> ' +
                            '</div>');

                    $("#completed_id").html(range);
                    $('#completed_from').wDate({
                        weekStart: config.weekstart,
                        rangeTo: $('#completed_to'),
                    });
                    $('#completed_to').wDate({
                        weekStart: config.weekstart,
                        rangeFrom: $('#completed_from'),
                    });
                    break;

                default:
                    $("#completed_id").html('');
                    break;
            }
        });

        //Submit Form
        $("button[name=run]").on('click', function() {
            var button = $(this);
            $(button).addClass('loading');
            var callback = function(json) {
                $("#results").html(json.html).transition('fadeIn');
                $(button).removeClass('loading');
            };
            $.get(config.url + "/helper.php", $("#task_form").serialize(), callback, "json");
        });

    };
})(jQuery);
(function($) {
    "use strict";
    $.Tasks = function(settings) {
        var config = {
            url: '',
            surl: '',
            lang: {
                removeText: "Remove",
                jobHours: "hours of",
                timeEst: "Time Estimation",
                updateTask: "Update Task",
                showHistory: "Show History of Changes",
                hideHistory: "Hide History of Changes",
                btnmAdd: "Add Coment",
                btnmUpd: "Update Comment"
            }
        };

        if (settings) {
            $.extend(config, settings);
        }

        function updateStatus(data, callback) {
            $.post(config.url + "/helper.php", data, callback, "json");
        }

        function resetEditor() {
            var $el = $('.is_editor');
            $el.trumbowyg('destroy');
            $el.html('Write a comment...');
            $("#cButtons").hide();
            $el.data("active", false);
            $('button[name=doComments]').attr('data-id', 0);
        }

        //Comments Add
        $('.is_editor').on("click", function() {
            var is_editor = $(this).data("active");
            if (!is_editor) {
                $(this).trumbowyg({
                    svgPath: false,
                    prefix: 'basic trumbowyg-',
                    hideButtonTexts: true,
                    autogrow: true,
                    btns: [
                        ['formatting'],
                        ['strong', 'em', 'del'],
                        ['unorderedList', 'orderedList'],
                        ['removeformat'],
                        ['fullscreen']
                    ]
                });

                $('button[name=doComments]').attr('data-id', 0).text(config.lang.btnmAdd);
                $("#cButtons").show();
                $(this).data("active", true);
            }
        });

        $('#cCancel').click(function() {
            resetEditor();
        });

        $('button[name=doComments]').click(function() {
            var $button = $(this);
            var id = $button.data('id');
            var content = $('.is_editor').trumbowyg('html');
            if (content) {
                $button.addClass('loading').prop('disabled', true);
                $.post(config.url + "/controller.php", {
                    action: "processMessage",
                    pid: config.pid,
                    type_id: $.url().segment(-1),
                    body: content,
                    discname: '',
                    taskname: config.taskname,
                    type: "task",
                    parent_id: 0,
                    id: id
                }, function(json) {
                    if (json.type === "success") {
                        setTimeout(function() {
                            if (id) {
                                $("#item_" + id).replaceWith(json.html).transition('fadeIn');
                            } else {
                                $("#dComments").prepend(json.html).transition('fadeIn');
                            }

                            $button.removeClass('loading').prop('disabled', false);
                            resetEditor();
                        }, 200);
                    }

                }, 'json');
            }
        });

        //Comment Update
        $('#dComments').on("click", '.editMessage', function() {
            var id = $(this).data('id');
            var $el = $('.is_editor');
            $el.attr("data-active", true);
            var data = {
                iaction: "getMessageBody",
                id: id
            };
            var callback = function(json) {
                if (json.type === "success") {
                    $el.trumbowyg({
                        svgPath: false,
                        prefix: 'basic trumbowyg-',
                        hideButtonTexts: true,
                        autogrow: true,
                        btns: [
                            ['formatting'],
                            ['strong', 'em', 'del'],
                            ['unorderedList', 'orderedList'],
                            ['removeformat'],
                            ['fullscreen']
                        ]
                    }).trumbowyg('html', json.body);
                    $('button[name=doComments]').attr('data-id', id).text(config.lang.btnmUpd);
                    $("#cButtons").show();

                }
            };
            updateStatus(data, callback);
            $('html, body').animate({
                scrollTop: $(".is_editor").offset().top
            }, 300);
        });

        //task history
        $('#showHistory').click(function() {
            var $this = $(this);
            $($this).html(config.lang.showHistory + '<i class="icon spinning spinner circles"></i>');
            if ($("#tHistory").is(":hidden")) {
                $.get(config.url + "/helper.php", {
                    type: "task_id",
                    action: "getTaskHistory",
                    id: $.url().segment(-1)
                }, function(data) {
                    $("#tHistory").html(data);
                    $($this).html(config.lang.hideHistory + '<i class="icon chevron black up"></i>');
                    $("#tHistory").slideDown();
                });
            } else {
                $("#tHistory").slideUp();
                $($this).html(config.lang.showHistory + '<i class="icon chevron black down"></i>');
            }
        });

        $('input[name=job_hours]').keyup(function() {
            $('button[name=set]').prop('disabled', this.value === "" ? true : false);
        });

        $('button[name=set]').click(function() {
            var hours = $('input[name=job_hours]').val();
            var $jobel = $('select[name=job_id]').find(":selected");
            var job = $jobel.text();
            var job_id = $jobel.val();
            $("#dJobHours").text('(' + hours + ' ' + config.lang.jobHours + ' ' + job + ')');
            var data = {
                iaction: "taskUpdateJob",
                pid: config.pid,
                id: $.url().segment(-1),
                job_id: job_id,
                taskname: config.taskname,
                cat: job,
                job_hours: hours
            };
            updateStatus(data);
        });

        $('#removeJob').click(function() {
            $("#dJobHours").text(config.lang.timeEst);
            var data = {
                iaction: "taskUpdateJob",
                taskname: config.taskname,
                pid: config.pid,
                cat: "",
                id: $.url().segment(-1),
                job_id: 0,
                job_hours: 0
            };
            updateStatus(data);
        });

        //Complete task
        $('.is_completed').on('change', function() {
            var data = {
                iaction: "completeTask",
                taskname: config.taskname,
                id: $.url().segment(-1),
                pid: config.pid
            };
            var callback = function(json) {
                if (json.type === "success") {
                    $("#taskProgress").html(json.html).transition('fadeIn');
                }
            };
            updateStatus(data, callback);
        });

        $('#dTaskList').on('click', '.item', function() {
            var data = {
                iaction: "taskUpdateList",
                pid: config.pid,
                name: $(this).data('name'),
                taskname: config.taskname,
                id: $.url().segment(-1),
                task_list_id: $(this).data('value')
            };
            updateStatus(data);
        });

        $('#dAssignList').on('click', '.item', function() {
            var data = {
                iaction: "taskUpdateAssignee",
                name: $(this).data('html'),
                taskname: config.taskname,
                pid: config.pid,
                id: $.url().segment(-1),
                assigned_id: $(this).data('value')
            };
            var callback = function(json) {
                $("#dAvatar").attr('src', json.avatar).fadeIn();
            };
            updateStatus(data, callback);
        });

        $('#dLabelList').on('change', 'input', function() {
            var labels = $('#dLabelList input:checked').map(function() {
                return this.value;
            }).get().join(',');
            var data = {
                iaction: "taskUpdateLabels",
                id: $.url().segment(-1),
                labels: labels
            };
            updateStatus(data);
        });
        $("input[name='due_date']").on("change", function() {
            var data = {
                iaction: "taskDueDateSatatus",
                taskname: config.taskname,
                pid: config.pid,
                id: $.url().segment(-1),
                duedate: $(this).val()
            };
            updateStatus(data);
        });

        $('input[name=is_hidden]').on('change', function() {
            var data = {
                iaction: "taskHiddenSatatus",
                pid: config.pid,
                id: $.url().segment(-1),
                status: $(this).is(':checked') ? 1 : 0
            };
            updateStatus(data);
        });

        $('input[name=is_priority]').on('change', function() {
            var data = {
                iaction: "taskPrioritySatatus",
                pid: config.pid,
                id: $.url().segment(-1),
                status: $(this).is(':checked') ? 1 : 0
            };
            updateStatus(data);
        });

        $('#subscList').on('change', 'input', function() {
            var data = {
                iaction: "taskSubscribersStatus",
                uid: $(this).val(),
                id: $.url().segment(-1),
                status: $(this).is(':checked') ? 1 : 0
            };
            updateStatus(data);
        });
    };
})(jQuery);
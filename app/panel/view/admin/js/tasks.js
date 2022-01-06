(function($) {
    "use strict";
    $.Tasks = function(settings) {
        var config = {
            url: '',
            surl: '',
            lang: {
                removeText: "Remove",
                jobHours: "hours of",
                updateTask: "Update Task"
            }
        };

        $(document).on('touchmove', function() {
            return true;
        });

        if (settings) {
            $.extend(config, settings);
        }

        $('input[name=job_hours]').on("keypress keyup blur", function(event) {
            $(this).val($(this).val().replace(/[^0-9\.]/g, ''));
            if ((event.which !== 46 || $(this).val().indexOf('.') !== -1) && (event.which < 48 || event.which > 57)) {
                event.preventDefault();
            } else {
                $('button[name=set]').prop('disabled', this.value === "" ? true : false);
            }
        });

        $('button[name=set]').click(function() {
            var hours = $('input[name=job_hours]').val();
            var job = $('select[name=job_id]').find(":selected").text();
            $("#jobrate").text('(' + hours + ' ' + config.lang.jobHours + ' ' + job + ')');
        });

        $('#removeJob').click(function() {
            $('input[name=job_hours]').val('');
            $('button[name=set]').prop('disabled', true);
            $("#jobrate").text('');
        });

        $('#subscList').on('change', 'input', function(e) {
            var names = $(e.delegateTarget).find(':checkbox:checked').map(function(v, i) {
                return $(i).data('name');
            }).get().join(", ");

            $('#subList').text(names);
        });

        $('#showTaskForm').click(function() {
            $(this).hide();
            $('#taskForm').css("display", "block").transition("fadeIn", {
                duration: 200
            });
        });

        $('#hideTaskForm').click(function() {
            $('#taskForm').transition("fadeOut", {
                duration: 200,
                complete: function() {
                    $(this).hide();
                    $('#showTaskForm').show();
                }
            });
        });

        $('[data-toggle]').click(function() {
            $('#wojo_form').trigger("reset");
            $('#taskForm input[name=id]').remove();
        });

        //Remove temp file
        $(document).on('click', '.removeit', function() {
            var id = $(this).attr("data-id");
            $("#uploadFile_" + id).transition("scaleOut", {
                duration: 200,
                complete: function() {
                    $(this).remove();
                }
            });
        });

        //Toggle hidden from clients
        $('#taskHolder').on('change', '.is_hidden', function() {
            var id = $(this).val();
            var status = $(this).prop('checked') ? 1 : 0;
            $("#eHidden_" + id).children('.icon').toggleClass('positive negative');
            $.post(config.url + "/helper.php", {
                iaction: "taskHidden",
                id: id,
                active: status
            });
        });

        //Toggle task priority
        $('#taskHolder').on('change', '.is_priority', function() {
            var id = $(this).val();
            var status = $(this).prop('checked') ? 1 : 0;
            if (status) {
                $("#ePriority_" + id).prepend('<i class="icon warning sign"></i>');
            } else {
                $("#ePriority_" + id).find('.icon').remove();
            }
            $.post(config.url + "/helper.php", {
                iaction: "taskPriority",
                id: id,
                active: status
            });
        });

        //Filter Tasks
        $(document).on('click', '.filterable li', function() {
            var count = 0;
            var id = $(this).data("id");

            if ($(this).parent().attr('id') === "taskListData") {
                $(this).toggleClass('active');
                $("#tItem_" + id).toggle();
            } else {
                $('.filterable li').not(this).removeClass('active');
                $(this).toggleClass('active');
                var filter = $(this).children().attr('data-name');
                var is_active = $(this).hasClass("active");
                $(".wojo.divided.sortable li").each(function() {
                    if (is_active) {
                        if ($(this).attr('data-tags').search(new RegExp(filter, "i")) < 0) {
                            $(this).fadeOut();
                        } else {
                            $(this).fadeIn();
                            count++;
                        }
                    } else {
                        $(this).show();
                    }
                });
            }
        });

        //Sort Task
        var initList = {
            ghostClass: "ghost",
            group: "master",
            handle: ".handle",
            animation: 600,
            onStart: function(ui) {
                $(ui.item).css({
                    "width": "auto"
                });
            },
            onUpdate: function(ui) {
                var items = this.toArray();
                var id = $(ui.item).parent().attr('data-id');
                $.post(config.url + "/helper.php", {
                    iaction: "updateTasks",
                    items: items,
                    id: id,
                    add: "false"
                });

            },
            onAdd: function(ui) {
                var position = $(ui.item).parent();
                var id = $(ui.item).parent().attr('data-id');
                var items = [];
                $(position).children().each(function() {
                    items.push($(this).data("id"));
                });

                $.post(config.url + "/helper.php", {
                    iaction: "updateTasks",
                    id: id,
                    items: items,
                    add: "true"
                });
            }

        };
        $(".sortable.divided").sortables(initList);

        //Sort Task Lists
        $("#taskListData").sortables({
            handle: ".handle",
            ghostClass: "ghost",
            animation: 600,
            onUpdate: function() {
                var items = this.toArray();
                $.post(config.url + "/helper.php", {
                    iaction: "updateTaskList",
                    items: items,
                    id: 1
                });
            }
        });

        //Add Task List
        $(document).on('click', '#addTaskList', function() {
            var name = $('input[name=listname]').val();
            var button = $(this);
            if (name !== '') {
                button.addClass('loading');
                $.post(config.url + "/controller.php", {
                        action: "processTaskList",
                        pid: $.url().segment(-1),
                        name: name
                    },
                    function(json) {
                        if (json.type === "success") {
                            $(json.list_small).prependTo($("#taskListData"));
                            $(json.list_big).prependTo($("#taskHolder"));
                            $(".sortable.divided").sortables("destroy").sortables(initList);
                        }
                        button.removeClass('loading');
                        $.wNotice(decodeURIComponent(json.message), {
                            autoclose: 4000,
                            type: json.type,
                            title: json.title
                        });
                }, "json");
            }
        });

        //Complete task
        $('#taskHolder').on('change', '.is_completed', function() {
            var id = $(this).val();
            var list_id = $(this).data('list');
            $.post(config.url + "/helper.php", {
                id: id,
                pid: $.url().segment(-1),
                iaction: "completeTask"
            }, function(json) {
                if (json.type === "success") {
                    $('#item_' + id).remove();
                    var new_value = parseInt($("#listItem_" + list_id).find('span:last').text());
                    $("#listItem_" + list_id).find('span:last').text(new_value - 1);
                    $("#taskProgress").html(json.html).transition('fadeIn');
                }
            }, "json");
        });

        //Trash task
        $('#taskHolder').on('click', '.is_trash', function() {
            var id = $(this).data('id');
            var list_id = $(this).data('list');
            var name = $(this).data('name');
            $.post(config.url + "/controller.php", {
                trash: "trashTask",
                title: name,
                id: id,
                pid: $.url().segment(-1),
            }, function(json) {
                if (json.type === "success") {
                    $('#item_' + id).remove();
                    var new_value = parseInt($("#listItem_" + list_id).find('span:last').text());
                    $("#listItem_" + list_id).find('span:last').text(new_value - 1);
                    $.notice(decodeURIComponent(json.message), {
                        autoclose: 12000,
                        type: json.type,
                        title: json.title
                    });
                }
            }, "json");
        });

        //Edit task
        $('#taskHolder').on('click', '.is_edit', function() {
            $("#taskForm").slideDown().addClass('loading');
            var id = $(this).data('id');
            $.get(config.url + "/helper.php", {
                action: "editTask",
                id: id
            }, function(json) {
                if (json.type === "success") {
                    $('html').animate({
                        scrollTop: $("#mainTasks").offset().top
                    }, 600);

                    var row = json.data;
                    $("#showTaskForm").hide();
                    $("#taskForm input[name=name]").val(row.name);
                    $("#taskForm textarea[name=body]").trumbowyg('html', row.body ? row.body : '');
                    if (row.task_list_id) {
                        $("#taskForm hidden[name=list_id]").val(row.task_list_id);
                    }

                    var tList = $("#dTaskList").find("[data-value='" + row.task_list_id + "']");
                    $("input[name=list_id]").val(row.task_list_id);
                    tList.addClass('selected');
                    $("[data-dropdown='#dTaskList']").find('span').text(tList.data('html'));

                    var aList = $("#dAssignList").find("[data-value='" + row.assigned_id + "']");
                    $("input[name=assignee]").val(row.assigned_id);
                    aList.addClass('selected');
                    $("[data-dropdown='#dAssignList']").find('span').text(aList.data('html'));

                    if (json.labels) {
                        var labels = json.labels.map(function(val) {
                            return val.id + '';
                        });
                        $('#tLabels_' + row.project_id).find(':checkbox[name^="labels"]').each(function() {
                            $(this).prop("checked", ($.inArray($(this).val(), labels) !== -1));
                        });
                    }

                    $("#elButton").find("span").text(json.date_long);
                    $("#elButton").attr("value", json.date_short);
                    $("input[name=due_date]").val(row.due_on);

                    $("select[name=job_id] option:selected").prop("selected", false);
                    $("select[name=job_id] option[value=" + row.job_id + "]").prop("selected", true);

                    $("#taskForm input[name=job_hours]").val(row.job_hours);
                    if (row.job_hours > 0) {
                        $("#taskForm button[name=set]").prop("disabled", false);
                    }
                    $("#dIsHidden input[type='checkbox']").prop('checked', row.is_hidden ? true : false);
                    $("#dIsPriority input[type='checkbox']").prop('checked', row.is_priority ? true : false);


                    if (json.subscribers) {
                        var subscribers = json.subscribers.map(function(val) {
                            return val.uid + '';
                        });
                        $('#subscList').find(':checkbox[name^="subscribers"]').each(function() {
                            $(this).prop("checked", ($.inArray($(this).val(), subscribers) !== -1));
                        });
                    } else {
                        $('#subscList').find(':checkbox[name^="subscribers"]').each(function() {
                            $(this).prop("checked", false);
                        });
                    }

                    if (json.files) {
                        $.each(json.files, function() {
                            var template = '' +
                                '<div class="item" id="uploadFile_' + this.id + '">' +
                                '<div class="columns auto">' +
                                '<img src="' + config.surl + '/assets/images/filetypes/' + this.type + '" class="wojo small rounded image">' +
                                '</div>' +
                                '<div class="columns" id="contentFile_' + this.id + '">' +
                                '<h6 class="basic">' + this.caption + '</h6>' +
                                '<a class="wojo small negative icon right text iaction" data-set=\'{"option":[{"iaction":"removeTaskFile", "id":' + this.id + ',"name":"' + this.name + '"}], "url":"/helper.php", "complete":"remove", "parent":"#uploadFile_' + this.id + '"}\'>' + config.lang.removeText + ' <i class="icon close"></i></a>' +
                                '</div>' +
                                '<input type="hidden" value="' + this.name + '" name="attachment[]">' +
                                '</div>';

                            $('#fileList').append(template);
                        });
                    }
                    $("button[name=dosubmit]").text(config.lang.updateTask);
                    $('<input />', {
                        type: 'hidden',
                        name: 'id',
                        value: id
                    }).appendTo("#wojo_form");
                }
                $("#taskForm").removeClass('loading');
            }, "json");
        });

        //File Upload
        $('#drag-and-drop-zone').on('click', function() {
            $(this).wojoUpload({
                url: config.url + "/helper.php",
                dataType: 'json',
                extraData: {
                    iaction: "taskFiles",
                    type: "task",
                    id: $.url().segment(-1)
                },
                allowedTypes: '*',
                onBeforeUpload: function(id) {
                    update_file_status(id, '', 'Uploading...');
                },
                onNewFile: function(id, file) {
                    add_file(id, file);
                },
                onUploadProgress: function(id, percent) {
                    update_file_progress(id, percent);
                },
                onUploadSuccess: function(id, data) {
                    if (data.status === "error") {
                        update_file_status(id, '<i class="icon small negative circular minus"></i>', data.message);
                        update_file_progress(id, 0);
                        $('#uploadFile_' + id).find('input').remove();
                    } else {
                        var icon = '<i class="icon small positive circular check"></i>';
                        var btn = '<img src="' + config.surl + '/assets/images/filetypes/' + data.type + '" class="wojo default rounded image">';
                        update_file_status(id, icon, btn);
                        update_file_progress(id, 100);
                    }
                },
                onUploadError: function(id, message) {
                    update_file_status(id, '<i class="icon small negative circular minus"></i>', message);
                },
                onFallbackMode: function(message) {
                    alert('Browser not supported: ' + message);
                },
            });
        });

        function add_file(id, file) {
            var template = '' +
                '<div class="item progress" id="uploadFile_' + id + '">' +
                '<div class="columns auto" id="bStstus_' + id + '">' +
                '<div class="wojo icon button"><i class="icon white file"></i></div>' +
                '</div>' +
                '<div class="columns id="contentFile_' + id + '">' +
                '<h6 class="basic">' + file.name + '</h6>' +
                '<a class="wojo small negative icon right text removeit" data-id="' + id + '">' + config.lang.removeText + '</a>' +
                '</div>' +
                '<div class="columns auto" id="iStatus_' + id + '"><i class="icon small info circular upload"></i></div>' +
                '<div class="wojo attached bottom tiny progress">' +
                '<div class="bar" data-percent="100"></div>' +
                '</div>' +
                '<input type="hidden" value="' + file.name + '" name="attachment[]">' +
                '</div>';

            $('#fileList').prepend(template);
        }

        function update_file_status(id, status, message) {
            $('#bStstus_' + id).html(message);
            $('#iStatus_' + id).html(status);
        }

        function update_file_progress(id, percent) {
            $('#uploadFile_' + id).find('.progress').wProgress();
            $('#uploadFile_' + id).find('.progress .bar').attr("data-percent", percent);
        }

        //Edit Task List
        $(document).on('click', 'a.editTaskList', function() {
            var $el = $(this).closest('.header').find('h4 span');
            var $item = $el.attr({
                "data-editable": true,
                "data-edit": true
            });

            $('.editable').on('validate', '[data-editable]', function(e, val) {
                if (val === "") {
                    return false;
                }
            }).on('change', '[data-editable]', function(e, val) {
                var dataset = $(this).data('set');
                var parent_id = dataset.parent_id;
                var $this = $(this);
                $.ajax({
                    type: "POST",
                    url: config.url + "/helper.php",
                    dataType: "json",
                    data: ({
                        'title': val,
                        'type': dataset.type,
                        'key': dataset.key,
                        'id': dataset.id,
                        'quickedit': 1
                    }),
                    beforeSend: function() {
						$this.animate({
							opacity: 0.2
						}, 800);
                    },
                    success: function(json) {
                        $this.animate({
                            opacity: 1
                        }, 800);
                        setTimeout(function() {
                            $this.html(json.title).fadeIn("slow");
                            $("#listItem_" + parent_id).find('span:first').text(json.title);
                            $item = $el.removeAttr("data-editable data-edit style");
                        }, 1000);

                    }
                });
            }).editableTableWidget();
        });
    };
})(jQuery);
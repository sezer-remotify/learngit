(function($) {
    "use strict";
    $.Invite = function(settings) {
        var config = {
            url: '',
            upurl: ''
        };

        if (settings) {
            $.extend(config, settings);
        }

        $('#memberList, #clientList').on('click', '.item', function() {
            var dataset = $(this).data("set");
            $(this).addClass('disabled');
            var newDiv = $('<div class="item align middle"></div>');
            var avatar = dataset.avatar ? dataset.avatar : "blank.svg";
            var type;
            var id;

            switch (dataset.type) {
                case "staff":
                    newDiv.html(
                        '<div class="columns auto">' +
                        '<img src="' + config.upurl + '/avatars/' + avatar + '" alt="" class="wojo category image">' +
                        '</div>' +
                        '<div class="columns">' +
                        '' + dataset.name + '' +
                        '</div>' +
                        '<div class="content auto">' +
                        '<a class="makeLeader wojo small circular inverted icon button" data-id="' + dataset.id + '"><i class="icon badge link"></i></a> ' +
                        '<a data-set=\'{"name": "' + dataset.name + '","type":"staff", "avatar": "' + avatar + '","id":' + dataset.id + '}\' class="removeItem wojo small inverted negative circular icon button"><i class="icon close link"></i></a>' +
                        '</div>');

                    $('<input>').attr({
                        type: 'hidden',
                        name: 'users[]',
                        id: 'staff_' + dataset.id,
                        value: dataset.id
                    }).appendTo('#wojo_form');
                    newDiv.prependTo("#mlist");
                    id = dataset.id;
                    type = "staff";
                    break;

                case "team":
                    newDiv.html(
					    '<div class="columns auto">' +
						'<span class="wojo small circular empty label" style="background:' + dataset.color + ';border-color:' + dataset.color + '"></span> ' +
						'</div>' +
                        '<div class="columns">' +
                        '' + dataset.name + '' +
                        '</div>' +
                        '<div class="columns auto">' +
                        '<div class="wojo basic small separator"></div>' +
                        '<a data-set=\'{"name": "' + dataset.name + '","type":"team", "color": "' + dataset.color + '", "counter": ' + dataset.counter + ', "id":' + dataset.id + ' ,"ids":"' + dataset.ids + '", "text": "' + dataset.text + '"}\' class="removeItem wojo small inverted negative circular icon button"><i class="icon close link"></i></a>' +
                        '</div>');
                    var users = dataset.ids.split(',');
                    for (var i = 0; i < users.length; i++) {
                        $('<input>').attr({
                            type: 'hidden',
                            name: 'users[]',
                            id: 'team_' + users[i],
                            value: users[i]
                        }).appendTo('#wojo_form');
                    }
                    newDiv.prependTo("#mlist");
                    type = "team";
                    id = $("input[name='users[]']").map(function() {
                        return $(this).val();
                    }).get();
                    break;

                case "client":
                    newDiv.html(
                        '<div class="columns auto">' +
                        '<img src="' + config.upurl + '/avatars/' + avatar + '" alt="" class="wojo category image">' +
                        '</div>' +
                        '<div class="columns">' +
                        '' + dataset.name + '' +
                        '</div>' +
                        '<div class="columns auto">' +
                        '<div class="wojo basic small separator"></div>' +
                        '<a data-set=\'{"name": "' + dataset.name + '","type":"client", "avatar": "' + avatar + '","id":' + dataset.id + '}\' class="removeItem wojo small inverted negative circular icon button"><i class="icon close link"></i></a>' +
                        '</div>');

                    $('<input>').attr({
                        type: 'hidden',
                        name: 'users[]',
                        id: 'client_' + dataset.id,
                        value: dataset.id
                    }).appendTo('#wojo_form');
                    newDiv.prependTo("#clist");
                    type = "client";
                    id = dataset.id;
                    break;
            }

            $.post(config.url + "/helper.php", {
                type: type,
                uid: id,
                id: $("input[name=id]").val(),
                iaction: "addperm",
            });
        });

        $('#mlist , #clist').on('click', 'a.removeItem', function() {
            var dataset = $(this).data("set");
            switch (dataset.type) {
                case "staff":
                    $('#staff_' + dataset.id).removeClass('disabled');
                    $('input#staff_' + dataset.id).remove();
                    break;

                case "team":
                    $('#team_' + dataset.id).removeClass('disabled');
                    var users = dataset.ids.split(',');
                    for (var i = 0; i < users.length; i++) {
                        $('input#team_' + users[i]).remove();
                    }
                    break;

                case "client":
                    $('#client_' + dataset.id).removeClass('disabled');
                    $('input#client_' + dataset.id).remove();
                    break;
            }

            $(this).closest('.item').slideUp().remove();
            $.post(config.url + "/helper.php", {
                field: "project_id",
                id: $("input[name=id]").val(),
                iaction: "pperm",
                value: dataset.id
            });
        });

        $(document).on('click', '.makeLeader', function() {
            $(this).addClass('positive');
            $("#mlist").find('.makeLeader').not($(this)).removeClass('positive');
            $.post(config.url + "/helper.php", {
                field: "leader_id",
                id: $("input[name=id]").val(),
                iaction: "pstatus",
                value: $(this).data('id')
            });
        });

    };
})(jQuery);
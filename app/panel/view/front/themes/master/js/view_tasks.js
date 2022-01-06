(function($) {
    "use strict";
    $.Tasks = function(settings) {
        var config = {
            url: '',
            surl: '',
            lang: {
				btnmAdd: "Add Coment",
				btnmUpd: "Update Comment"
            }
        };

        if (settings) {
            $.extend(config, settings);
        }
		
		function resetEditor () {
			var $el = $('.is_editor');
            $el.trumbowyg('destroy');
			$el.html('Write a comment...');
            $("#cButtons").hide();
            $el.data("editor", false);
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
					is_front: true,
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
    };
})(jQuery);
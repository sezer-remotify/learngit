(function($) {
    "use strict";
    $.Files = function(settings) {
        var config = {
            url: '',
            lang: {
                removeText: "Remove",
                addText: "Add",
            }
        };

        if (settings) {
            $.extend(config, settings);
        }

        $(document).on('click', '#doFiles', function() {
            var $button = $(this);
            $button.addClass('loading');
            var files = $('input[name="attachment[]"]').map(function() {
                return $(this).val();
            }).get();
            $.post(config.url + "/controller.php", {
                    action: "tempProjectFiles",
                    id: $.url().segment(-1),
                    mode: config.mode,
                    files: files,
                },
                function(json) {
                    if (json.type === "success") {
						$('main').transition("scaleOut", {
							duration: 1000,
							complete: function() {
								window.location.href = $.url().attr("source");
							}
						});
                    }
            }, "json");

        });

        //Uploader
        $('#drag-and-drop-zone').wojoUpload({
            url: config.url + '/helper.php',
            dataType: 'json',
            extraData: {
                iaction: "projectFiles",
                type: "project",
                is_temp: true,
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
					var btn = '<img src="' + config.surl + '/assets/images/filetypes/' + data.type + '" class="wojo small rounded image">';
					update_file_status(id, icon, btn);
					update_file_progress(id, 100);
					$('#uploadFile_' + id).find('input').val(data.filename);
				}
			},
            onUploadError: function(id, message) {
                update_file_status(id, '<i class="icon small negative circular minus"></i>', message);
            },
            onFallbackMode: function(message) {
                alert('Browser not supported: ' + message);
            },

            onComplete: function() {
                if (!$("#doFiles").length) {
                    $("#fileList").after("<button id=\"doFiles\" class=\"wojo small primary button margin top\">" + config.lang.addText + "</button>");
                }
            }
        });

        function add_file(id, file) {
            var template = '' +
                '<div class="item align middle" id="uploadFile_' + id + '">' +
                '<div class="columns auto" id="bStstus_' + id + '">' +
                '<div class="wojo icon button"><i class="icon white file"></i></div>' +
                '</div>' +
                '<div class="columns" id="contentFile_' + id + '">' +
                '<h6 class="basic">' + file.name + '</h6>' +
                '<a data-set=\'{"option":[{"iaction":"removeProjectTempFile", "name":"' + file.name + '"}], "url":"/helper.php", "parent":"#uploadFile_' + id + '", "complete":"remove"}\' class="wojo small negative icon right text iaction" data-id="' + id + '">' + config.lang.removeText + '</a>'+
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

        //Remove Add files button
        $("#fileList").on('click', '.iaction', function() {
            setTimeout(function() {
                if (!$("#fileList .item").length) {
                    $("#doFiles").remove();
                }
            }, 1200);
        });
    };
})(jQuery);
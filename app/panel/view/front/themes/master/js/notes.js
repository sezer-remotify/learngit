(function($) {
    "use strict";
    $.Notes = function(settings) {
        var config = {
            url: '',
            is_edit: true,
            pid: '',
            notename: '',
            lang: {
                removeText: "Remove",
                addText: "Add",
                saveText: "Save Note",
                editText: "Edit Note",
            }
        };

        if (settings) {
            $.extend(config, settings);
        }


		$('#bgColor').wColorPicker({
			allowCustomColor: false,
			allowRecent: false,
			recentMax: 5,
			rows: 5,
			cel: ".icon",
			celType: 'color',
			showClear:false,
            palette: [
                '#ffebee', '#fce4ec', '#f3e5f5', '#ede7f6',
                '#e8eaf6', '#e3f2fd', '#e1f5fe', '#e0f7fa',
                '#e0f2f1', '#e8f5e9', '#f1f8e9', '#f9fbe7',
                '#fffde7', '#fff8e1', '#fff3e0', '#fbe9e7',
                '#efebe9', '#fafafa', '#eceff1', '#ffffff'
            ],
			onChangeColor: function() {
				$('input[name=color]').val(this);
				$("#dColor").css('background', this);
			}
		});

        $('#noteBody').trumbowyg({
            svgPath: false,
            prefix: 'simple trumbowyg-',
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

        //Uploader
        $('#drag-and-drop-zone').on('click', function() {
            $(this).wojoUpload({
                url: config.url + "/helper.php",
                dataType: 'json',
                extraData: {
                    iaction: "noteFiles",
					type: "note",
                    id: config.pid
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
                    if (data.type === "error") {
                        update_file_status(id, '<i class="icon small negative circular minus"></i>', data.message);
                        update_file_progress(id, 0);
                        $('#uploadFile_' + id).find('input').remove();
                    } else {
                        var icon = '<i class="icon small positive circular check"></i>';
						var btn = '<img src="' + config.surl + '/assets/images/filetypes/' + data.type + '" class="wojo small rounded image">';
                        update_file_status(id, icon, btn);
                        update_file_progress(id, 100);
                    }
                },
                onUploadError: function(id, message) {
                    update_file_status(id, '<i class="icon small negative circular minus"></i>', message);
                },
                onFallbackMode: function(message) {
                    alert('Browser not supported: ' + message);
                }
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
    };
})(jQuery);
(function($) {
    "use strict";
    $.Discussions = function(settings) {
        var config = {
			url: '',
			surl: '',
			pid: '',
			discname: '',
            lang: {
                removeText: "Remove",
                showHistory: "Show History of Changes",
                hideHistory: "Hide History of Changes",
            }
        };

        if (settings) {
            $.extend(config, settings);
        }

        function updateStatus(data, callback) {
            $.post(config.url + "/helper.php", data, callback, "json");
        }
		
		function resetEditor () {
			var $el = $('.is_editor');
            $el.trumbowyg('destroy');
			$el.html('Write a comment...');
            $("#cButtons").hide();
            $el.attr("data-active", false);
			$('button[name=doComments]').attr('data-id', 0);
		}

        //Comments Add
        $('.is_editor').on("click", function() {
            var is_editor = $(this).attr("data-active");
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
                $(this).attr("data-active", true);
            }
        });

        $('#cCancel').click(function() {
			resetEditor();
        });

        $('button[name=doComments]').click(function() {
			var $button = $(this);
			var id = $button.data('id');
            var content = $('.is_editor').trumbowyg('html');
			if(content) {
				$button.addClass('loading').prop('disabled', true);
				$.post(config.url + "/controller.php", {
					action: "processMessage",
					pid: config.pid,
					type_id: config.pid,
					body: content,
					discname: config.discname,
					taskname: '',
					type: "message",
					parent_id: $.url().segment(-1),
					id: id
				}, function(json) {
					if(json.type === "success") {
						setTimeout(function() {
							if(id) {
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
        });

        $('#dIsHidden').on('change', function() {
			var status = $(this).is(':checked') ? 1 : 0;
            var data = {
                iaction: "messageHiddenSatatus",
                pid: config.pid,
				discname: config.discname,
                id: $.url().segment(-1),
                status: status
            };
            updateStatus(data);
			if (status === 1) {
				$("#dHidden").html('<i class="icon negative mask"></i>');
			} else {
				$("#dHidden").html('');
			}
        });

        $('#subscList').on('change', 'input', function() {
            var data = {
                iaction: "messageSubscribersStatus",
				discname: config.discname,
                uid: $(this).val(),
                id: $.url().segment(-1),
                status: $(this).is(':checked') ? 1 : 0
            };
            updateStatus(data);
        });
		
        //message history
        $('#showHistory').click(function() {
            var $this = $(this);
			$($this).html(config.lang.showHistory + '<i class="icon spinning spinner circles"></i>');
            if ($("#tHistory").is(":hidden")) {
                $.get(config.url + "/helper.php", {
					type: "message_id",
                    action: "getMessageHistory",
                    id: $.url().segment(-1)
                }, function(data) {
                    $("#tHistory").html(data);
                    $($this).html(config.lang.hideHistory + '<i class="icon chevron up"></i>');
					$("#tHistory").slideDown();
                });
            } else {
                $("#tHistory").slideUp();
                $($this).html(config.lang.showHistory + '<i class="icon chevron down"></i>');
            }
			
        });

        //Remove temp file
        $(document).on('click', '.removeit', function() {
            var id = $(this).attr("data-id");
            $("#uploadFile_" + id).transition("scaleOut", {
				duration: 250,
                complete: function() {
                    $(this).remove();
                }
            });
        });
		
        //Uploader
        $('#drag-and-drop-zone').on('click', function() {
            $(this).wojoUpload({
                url: config.url + "/helper.php",
                dataType: 'json',
                extraData: {
                    iaction: "discussionFiles",
					type: "discussion",
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
                    if (data.status === "error") {
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
    };
})(jQuery);
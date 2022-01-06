(function($) {
    "use strict";
    $.Config = function(settings) {
        var config = {
            url: '',
            lang: {
                palLabel: "Default Palette",
                prjLabel: "Label Name",
                catLabel: "Category Name",
                rateLabel: "Job Type",
                hourLabel: "Rate per hour",
                taxLabel: "Name of the tax",
                taxRate: "Tax %",
            }
        };

        if (settings) {
            $.extend(config, settings);
        }

        function colorPicker() {
            $('.is_colorOld, .is_color').wColorPicker({
                paletteLabel: config.lang.palLabel,
                allowCustomColor: false,
                allowRecent: false,
                recentMax: 5,
                rows: 5,
                cel: ".icon",
                celType: 'color',
                onChangeColor: function(element) {
                    var type = $(element).data('type');
                    var id = $(element).data('id');
                    if ($(element).hasClass('is_color')) {
                        $(element).parent().prev().prop('name', type + '[' + this + ']');
                    } else {
                        var data = {
                            action: "update" + type,
                            color: this,
                            id: id
                        };
                        $.post(config.url + "/helper.php", data);
                    }
                }
            });
        }

        colorPicker();
        $(document).on('click', 'a.removeOld, a.remove', function() {
            $(this).closest('.item').transition("scaleOut", {
                duration: 300,
                complete: function() {
                    $(this).remove();
                }
            });
            if ($(this).data('id')) {
                var id = $(this).data('id');
                var type = $(this).data('type');
                var data = {
                    action: type,
                    id: id
                };
                $.post(config.url + "/helper.php", data);
            }
        });

        $(document).on('click', '#clonetLabel', function() {
            var html = '' +
                '<div class="item align middle">' +
                '<div class="content">' +
                '<div class="wojo small input">' +
                '<input name="tasklabels[]" placeholder="' + config.lang.prjLabel + '" type="text">' +
                '</div>' +
                '</div>' +
                '<div class="content auto small left padding">' +
                '<a class="wojo small dark inverted icon button is_color" data-type="tasklabels"><i class="icon contrast"></i></a> ' +
                '<a class="wojo small light inverted icon button remove"><i class="icon negative delete"></i></a>' +
                '</div>' +
                '</div>';

            $("#tLabelHolder").append(html);
            colorPicker();

        });

        $(document).on('click', '#clonepLabel', function() {
            var html = '' +
                '<div class="item align middle">' +
                '<div class="content">' +
                '<div class="wojo small input">' +
                '<input name="prjlabels[]" placeholder="' + config.lang.prjLabel + '" type="text">' +
                '</div>' +
                '</div>' +
                '<div class="content auto small left padding">' +
                '<a class="wojo small dark inverted icon button is_color" data-type="prjlabels"><i class="icon contrast"></i></a> ' +
                '<a class="wojo small light inverted icon button remove"><i class="icon negative delete"></i></a></div>' +
                '</div>' +
                '</div>';

            $("#pLabelHolder").append(html);
            colorPicker();

        });

        $(document).on('click', '#clonecLabel', function() {
            var html = '' +
                '<div class="item align middle">' +
                '<div class="content">' +
                '<div class="wojo small input">' +
                '<input name="prjcats[]" placeholder="' + config.lang.catLabel + '" type="text">' +
                '</div>' +
                '</div>' +
                '<div class="content auto small left padding">' +
                '<a class="wojo small light inverted icon button remove"><i class="icon negative delete"></i></a></div>' +
                '</div>' +
                '</div>';

            $("#cLabelHolder").append(html);
            colorPicker();
        });

        $(document).on('click', '#clonejType', function() {
            var html = '' +
                '<div class="item align middle">' +
                '<div class="content small right padding">' +
                '<div class="wojo small input">' +
                '<input name="jtype[]" placeholder="' + config.lang.rateLabel + '" type="text">' +
                '</div>' +
                '</div>' +
                '<div class="content small left padding">' +
                '<div class="wojo small input">' +
                '<input name="jrate[]" placeholder="' + config.lang.hourLabel + '" type="text">' +
                '</div>' +
                '</div>' +
                '<div class="content auto small left padding">' +
                '<a class="wojo small light inverted icon button remove"><i class="icon negative delete"></i></a></div>' +
                '</div>' +
                '</div>';

            $("#jtypelHolder").append(html);
        });

        $(document).on('click', '#clonexType', function() {
            var html = '' +
                '<div class="item align middle">' +
                '<div class="content">' +
                '<div class="wojo small input">' +
                '<input name="excats[]" placeholder="' + config.lang.catLabel + '" type="text">' +
                '</div>' +
                '</div>' +
                '<div class="content auto small left padding">' +
                '<a class="wojo small light inverted icon button remove"><i class="icon negative delete"></i></a></div>' +
                '</div>' +
                '</div>';

            $("#xtypelHolder").append(html);
        });

        $(document).on('click', '#clonetxType', function() {
            var html = '' +
                '<div class="item align middle">' +
                '<div class="content small right padding">' +
                '<div class="wojo small input">' +
                '<input name="taxName[]" placeholder="' + config.lang.taxLabel + '" type="text">' +
                '</div>' +
                '</div>' +
                '<div class="content small left padding">' +
                '<div class="wojo small input">' +
                '<input name="taxRate[]" placeholder="' + config.lang.taxRate + ' %" type="text">' +
                '</div>' +
                '</div>' +
                '<div class="content auto small left padding">' +
                '<a class="wojo small light inverted icon button remove"><i class="icon negative delete"></i></a></div>' +
                '</div>' +
                '</div>';

            $("#taxHolder").append(html);
        });
    };
})(jQuery);
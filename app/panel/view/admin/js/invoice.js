(function($) {
    "use strict";
    $.Invoice = function(settings) {
        var config = {
            tax_rates: {},
            url: '',
            is_project: false,
            lang: {
                add_error: "",
                add_errort: '',
                no_tax: '',
                no_items: '',
                ialert: '',
            }
        };

        if (settings) {
            $.extend(config, settings);
        }

		$('select[name=company_id]').on('change', function() {
            $.getJSON(config.url + "/helper.php", {
				action: "companyAddress",
                id: $(this).val(),
            }).done(function(json) {
                if (json.status === 'success') {
                    $("textarea[name=company_address]").val(json.message);
					$('select[name=currency]').val(json.currency).wSelect("refresh");
                } else {
                    $("textarea[name=company_address]").val("");
                }
            });
        });

        $(".wojo.table.invoice").rowSorter({
            handler: ".icon.reorder",
            onDrop: function() {
                var data = [];
                $('.wojo.table.invoice tbody tr').each(function() {
                    data.push($(this).data("id"));
                });
            }
        });

        $('#AddNote').on('click', function() {
            $(this).hide();
            $("#invNote").show();
        });

        $('#AddComment').on('click', function() {
            $(this).hide();
            $("#invComment").show();
        });


        var tax_rates = config.tax_rates;
		var counter = 0;

        $(document).on('change', '.price', function() {
            calculateTotal();
        });
        $(document).on('change', '.tax', function() {
            calculateTotal();
        });
        $(document).on('change', '.quantity', function() {
            calculateTotal();
        });

        $(document).on('change', '.discount', function() {
            calculateTotal();
        });

        function calculateTotal() {
            var subtotal = 0;
            var taxtotal = 0;
            var total = 0;
            var discount = 0;
            var pins = $('.price');
            $.each(pins, function() {
                if ($(this).val()) {
                    var id = parseInt($(this).data('id'));
                    var pr_tax = 0;
                    var pr_qty = parseFloat($('#quantity' + id).val() ? $('#quantity' + id).val() : 0);
                    var tax = parseInt($('#tax_rate' + id).val());
                    var pr_price = parseFloat($(this).val());
                    $.each(tax_rates, function() {
                        if (this.id === tax) {
                            if (this.amount !== 0) {
                                pr_tax = parseFloat((pr_price * this.amount) / 100) * pr_qty;
                            } else {
                                pr_tax = parseFloat(this.amount);
                            }
                        }
                    });

                    total += (pr_price + pr_tax) * pr_qty;
                    subtotal += (pr_price * pr_qty);
                    taxtotal += pr_tax;
                }
            });
            var disc = parseFloat($('.discount').val());

            if (disc > 0 && disc < 100) {
                discount = parseFloat((subtotal * disc) / 100);
            } else {
                discount = 0;
                $('.discount').val(0).number(true, 2);
            }

            $('.total').text(parseFloat(subtotal - discount + taxtotal).toFixed(2));
            $('.subtotal').text(parseFloat(subtotal).toFixed(2));
            $('.taxtotal').text(parseFloat(taxtotal).toFixed(2));
            $('.disctotal').text(parseFloat(discount).toFixed(2));

            $('input[name=total_amount]').val(parseFloat(subtotal - discount + taxtotal).toFixed(2));
            $('input[name=subtotal]').val(parseFloat(subtotal).toFixed(2));
            $('input[name=taxes]').val(parseFloat(taxtotal).toFixed(2));
        }

        //var counter = parseInt($("#ivTable").children().length);

        $(document).on('click', 'a.removeItem', function() {
			counter = parseInt($("#ivTable").children().length);
            if (counter === 1) {
                return false;
            }
            $(this).closest('tr').fadeOut().remove();
            counter = 0;
            $("#ivTable").children().each(function() {
                counter++;
                $(this).find("small").text(counter).end();
                $(this).find("input").attr("data-id", counter);
            });
            calculateTotal();
        });

        $('#addItem').on('click', function() {
			counter = parseInt($("#ivTable").children().length);
            if (counter > 10) {
                $.wNotice(decodeURIComponent(config.lang.add_error), {
                    autoclose: 4000,
                    type: "error",
                    title: config.lang.add_errort
                });
                return false;
            }

            counter++;
            var newTr = $('<tr data-id="' + counter + '"></tr>').attr("id", 'item' + counter);

            var taxes = '';
            if (tax_rates.length) {
                $.each(tax_rates, function() {
                    taxes += '<option value="' + this.id + '">' + this.name + ' ' + this.amount + '%</option>';
                });
            }
			
			var html = 
                '<td class="handle"><i class="icon reorder"></i></td>' +
                '<td><small class="wojo bold text">' + counter + '.</span></td>' +
                '<td><div class="wojo small input"><input type="text" name="item[]" data-id="' + counter + '" id="item' + counter + '"></div></td>' +
                '<td><div class="wojo small input"><input type="text" class="quantity" name="quantity[]" id="quantity' + counter + '" value="1.00"></div></td>';
				
				 if (tax_rates.length) {
					 html +=
					'<td><select name="tax_rate[]" id="tax_rate' + counter + '" class="tax">' +
					'<option value="0" selected="selected">' + config.lang.no_tax + '</option>' +
					'' + taxes + '' +
					'</select></td>';
				 }
			
			html += 
                '<td><div class="wojo small input"><input type = "text" name = "price[]" data-id = "' + counter + '" class = "price"></div></td>' +
                '<td><a class="removeItem grey"><i class="icon delete"></i></a></td>';

            newTr.html(html);

            newTr.appendTo("#ivTable");
            $('.price, .quantity, .discount').number(true, 2);
			
			/* == Input focus == */
			$('.wojo.input input, .wojo.input textarea').focusout(function() {
				$('.wojo.input').removeClass('focus');
			});
			$('.wojo.input input, .wojo.input textarea').focusin(function() {
				$(this).closest('.input').addClass('focus');
			});
        });

        $(document).on('blur', '.quantity', function() {
            if (parseInt($(this).val()) === 0 && $(this).is(':empty')) {
                $(this).val(1);
            }
        });
        $('.price, .quantity, .discount').number(true, 2);

        function getItems() {
            var result = false;
            var timerecord = false;
            var expense = false;
            var timeperiod = false;
            var datefrom = false;
            var dateto = false;

            if ($('input[name=project]').is(':checked')) {
                var project_id = $('input[name=project]:checked').val();

                if ($('input[name=timerecord]').is(':checked')) {
                    timerecord = true;
                    result = true;
                }

                if ($('input[name=expense]').is(':checked')) {
                    expense = true;
                    result = true;
                }

                if ($('input[name=timeperiod]').is(':checked')) {
                    timeperiod = $('input[name=timeperiod]:checked').val();
                }

                datefrom = $('input[name=datefrom_submit]').val();
                dateto = $('input[name=dateto_submit]').val();

                if (result === true) {
                    $('button[name=getItems]').addClass('loading');
                    $.getJSON(config.url + "/helper.php", {
                        action: "invoiceItems",
                        id: project_id,
                        timerecord: timerecord,
                        expense: expense,
                        timeperiod: timeperiod,
                        datefrom: datefrom,
                        dateto: dateto,
                    }).done(function(json) {
                        if (json.status === 'success') {
                            $("#ivTable").html(json.message);
                            calculateTotal();
                            $('.price, .quantity, .discount').number(true, 2);
                        } else {
                            $.wNotice(decodeURIComponent(config.lang.no_items), {
                                autoclose: 4000,
                                type: "alert",
                                title: config.lang.ialert
                            });
                        }
                        $('button[name=getItems]').removeClass('loading');
                    });
                }
            }
        }

        $('button[name=getItems]').on('click', function() {
            getItems();
        });

        if (config.is_project === true) {
            getItems();
        }

        $("#iDueDate").on('change', function() {
            if (parseInt($(this).val()) === 5) {
                $("#cdate").show();
            } else {
                $("#cdate").hide();
            }
        });
    };
})(jQuery);
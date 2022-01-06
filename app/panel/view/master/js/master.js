(function ($) {
  "use strict";
  $.Master = function (settings) {
    var config = {
      weekstart: 0,
      ampm: 0,
      url: "",
      aurl: "",
      eucookie: 0,
      lang: {
        monthsFull: "",
        monthsShort: "",
        weeksFull: "",
        weeksShort: "",
        weeksMed: "",
        weeksSmall: "",
        today: "Today",
        now: "Now",
        selPic: "Select Picture",
        delBtn: "Delete Record",
        trsBtn: "Move to Trash",
        arcBtn: "Move to Archive",
        uarcBtn: "Restore From Archive",
        restBtn: "Restore Item",
        canBtn: "Cancel",
        aOffer: "Accept Offer",
        clear: "Clear",
        sellected: "Selected",
        allBtn: "Select All",
        allSel: "all selected",
        sellOne: "Select option",
        doSearch: "Search ...",
        noMatch: "No matches for",
        ok: "OK",
        delMsg1: "Are you sure you want to delete this record?",
        delMsg2: "This action cannot be undone!!!",
        delMsg3: "Trash",
        delMsg5: "Move [NAME] to the archive?",
        delMsg6: "Remove [NAME] from the archive?",
        delMsg7: "Restore [NAME]?",
        delMsg8:
          "The item will remain in Trash for 30 days. To remove it permanently, go to Trash and empty it.",
        delMsg12: "Accept [NAME] bid?",
        working: "working...",
      },
    };
    if (settings) {
      $.extend(config, settings);
    }
    /*
            $.cookie("FMEU", 1, {
                expires: 120,
                path: '/'
            });*/

    /*
		if(config.eucookie === 1) {
			
			$.wNotice(decodeURIComponent('must be width:3200px, and height:1800px  max.'), {
				autoclose: 40000,
				type: "info",
				title: 'Error'
			});
		}
		*/
    /* == Transitions == */
    $(document).on("click", '[data-slide="true"]', function () {
      var trigger = $(this).data("trigger");
      $(trigger).slideToggle(100);
    });
    /* == Navigation == */
    $("#mobileToggle a").click(function (e) {
      $(".navbar").slideToggle(150);
      e.preventDefault();
    });

    /* == Input focus == */
    $(".wojo.input input, .wojo.input textarea").focusout(function () {
      $(".wojo.input").removeClass("focus");
    });
    $(".wojo.input input, .wojo.input textarea").focusin(function () {
      $(this).closest(".input").addClass("focus");
    });

    $(".selectbox").wSelect({
      lang: {
        txt_ok: config.lang.ok,
        txt_cancel: config.lang.canBtn,
        txt_all: config.lang.allBtn,
        noMatch: config.lang.noMatch + ' "{0}"',
        captionFormat: "{0} " + config.lang.sellected,
        captionFormatAllSelected: "{0} " + config.lang.allSell + "!",
        searchText: config.lang.doSearch,
        placeholder: config.lang.sellOne,
        prefix: "",
      },
    });

    /* == EU Cookie == */
    $(document).on("click", "#c_yes", function () {
      $.cookie("FMEU", 1, {
        expires: 365,
        path: "/",
      });
      $("#cookie-overlay").transition("fadeOutRight", {
        duration: 500,
        complete: function () {
          $(this).remove();
        },
      });
    });

    /* == Tabs == */
    $(".wojo.tabs").wTabs();

    /* == Accordion == */
    $(".wojo.accordion").wAccordion();

    /* == Progress Bars == */
    $(".wojo.progress").wProgress();

    /* == Range Slider == */
    $('input[type="range"]').wRange({
      //onInit: function() {},
      //onSlide: function(position, value) {},
      //onSlideEnd: function(position, value) {}
    });

    /* == Dimmable content == */
    $(document).on("change", ".is_dimmable", function () {
      var dataset = $(this).data("set");
      var status = $("input[type=checkbox]", this).is(":checked") ? 1 : 0;
      var result = $.extend(true, dataset.option[0], {
        active: status,
      });
      $.post(config.url + "/helper.php", result);
      $(dataset.parent).toggleClass("active");
    });

    $(".datepick")
      .wDate({
        months: config.lang.monthsFull,
        short_months: config.lang.monthsShort,
        days_of_week: config.lang.weeksFull,
        short_days: config.lang.weeksShort,
        days_min: config.lang.weeksSmall,
        selected_format: "DD, mmmm d",
        month_head_format: "mmmm yyyy",
        format: "mm/dd/yyyy",
        clearBtn: true,
        todayBtn: true,
        cancelBtn: true,
        clearBtnLabel: config.lang.clear,
        cancelBtnLabel: config.lang.canBtn,
        okBtnLabel: config.lang.ok,
        todayBtnLabel: config.lang.today,
      })
      .on("datechanged", function (event) {
        if ($(this).attr("data-element")) {
          var element = $(this).data("element");
          var parent = $(this).data("parent");

          var date = new Date(event.date);
          var day = date.getDate();
          var month = config.lang.monthsFull[date.getMonth()];
          var year = date.getFullYear();
          var formatted = month + " " + day + ", " + year;

          $(parent).html(formatted);
          if ($(element).is(":input")) {
            $(element).val(event.date).trigger("change");
          } else {
            $(element).html(formatted);
          }
        }
      });

    $(".timepick").wTime({
      timeFormat: "hh:mm:ss.000", // format of the time value (data-time attribute)
      format: "hh:mm t", // format of the input value
      is24: true, // format 24 hour header
      readOnly: true, // determines if input is readonly
      hourPadding: true, // determines if display value has zero padding for hour value less than 10 (i.e. 05:30 PM); 24-hour format has padding by default
      btnNow: config.lang.now,
      btnOk: config.lang.ok,
      btnCancel: config.lang.canBtn,
    });

    /* == From/To date range == */
    $("#fromdate").wDate({
      rangeTo: $("#enddate"),
      clearBtn: true,
      todayBtn: true,
      cancelBtn: true,
      days_min: config.lang.weeksSmall,
      clearBtnLabel: config.lang.clear,
      cancelBtnLabel: config.lang.canBtn,
      okBtnLabel: config.lang.ok,
      todayBtnLabel: config.lang.today,
    });
    $("#enddate").wDate({
      rangeFrom: $("#fromdate"),
      clearBtn: true,
      todayBtn: true,
      cancelBtn: true,
      days_min: config.lang.weeksSmall,
      clearBtnLabel: config.lang.clear,
      cancelBtnLabel: config.lang.canBtn,
      okBtnLabel: config.lang.ok,
      todayBtnLabel: config.lang.today,
    });

    /* == Basic color picker == */
    $('[data-color="true"]').wColorPicker({
      applyLabel: "Apply:",
      resetLabel: "Reset:",
      recentLabel: "Recent:",
      paletteLabel: "Default Palette:",
      allowCustomColor: false,
      allowRecent: false,
      recentMax: 5,
      rows: 5,
    });

    /* == Advanced color picker == */
    $('[data-adv-color="true"]').wColorPicker({
      applyLabel: "Apply:",
      resetLabel: "Reset:",
      recentLabel: "Recent:",
      paletteLabel: "Default Palette:",

      recentMax: 10,
      rows: 10,
      palette: [
        "#000000",
        "#434343",
        "#666666",
        "#999999",
        "#b7b7b7",
        "#cccccc",
        "#d9d9d9",
        "#efefef",
        "#f3f3f3",
        "#ffffff",
        "#980000",
        "#ff0000",
        "#ff9900",
        "#ffff00",
        "#00ff00",
        "#00ffff",
        "#4a86e8",
        "#0000ff",
        "#9900ff",
        "#ff00ff",
        "#e6b8af",
        "#f4cccc",
        "#fce5cd",
        "#fff2cc",
        "#d9ead3",
        "#d0e0e3",
        "#c9daf8",
        "#cfe2f3",
        "#d9d2e9",
        "#ead1dc",
        "#dd7e6b",
        "#ea9999",
        "#f9cb9c",
        "#ffe599",
        "#b6d7a8",
        "#a2c4c9",
        "#a4c2f4",
        "#9fc5e8",
        "#b4a7d6",
        "#d5a6bd",
        "#cc4125",
        "#e06666",
        "#f6b26b",
        "#ffd966",
        "#93c47d",
        "#76a5af",
        "#6d9eeb",
        "#6fa8dc",
        "#8e7cc3",
        "#c27ba0",
        "#a61c00",
        "#cc0000",
        "#e69138",
        "#f1c232",
        "#6aa84f",
        "#45818e",
        "#3c78d8",
        "#3d85c6",
        "#674ea7",
        "#a64d79",
        "#85200c",
        "#990000",
        "#b45f06",
        "#bf9000",
        "#38761d",
        "#134f5c",
        "#1155cc",
        "#0b5394",
        "#351c75",
        "#741b47",
        "#5b0f00",
        "#660000",
        "#783f04",
        "#7f6000",
        "#274e13",
        "#0c343d",
        "#1c4587",
        "#073763",
        "#20124d",
        "#4c1130",
      ],
    });

    /* == Avatar Upload == */
    $('[data-type="image"]').wavatar({
      text: config.lang.selPic,
      validators: {
        maxWidth: 3200,
        maxHeight: 1800,
      },
      reject: function (file, errors) {
        if (errors.mimeType) {
          $.wNotice(decodeURIComponent(file.name + " must be an image."), {
            autoclose: 4000,
            type: "error",
            title: "Error",
          });
        }
        if (errors.maxWidth || errors.maxHeight) {
          $.wNotice(
            decodeURIComponent(
              file.name + " must be width:3200px, and height:1800px  max."
            ),
            {
              autoclose: 4000,
              type: "error",
              title: "Error",
            }
          );
        }
      },
    });

    /* == Editor == */
    $(".bodypost").trumbowyg({
      svgPath: false,
      hideButtonTexts: true,
      autogrow: true,
      semantic: false,
      btns: [
        ["viewHTML"],
        ["formatting"],
        ["strong", "em", "del"],
        ["superscript", "subscript"],
        ["link"],
        ["insertImage"],
        ["justifyLeft", "justifyCenter", "justifyRight", "justifyFull"],
        ["unorderedList", "orderedList"],
        ["horizontalRule"],
        ["removeformat"],
        ["fullscreen"],
      ],
    });

    $(".quickpost").trumbowyg({
      svgPath: false,
      hideButtonTexts: true,
      autogrow: true,
      semantic: false,
      btns: [
        ["formatting"],
        ["strong", "em", "del"],
        ["superscript", "subscript"],
        ["link"],
        ["insertImage"],
        ["unorderedList", "orderedList"],
        ["removeformat"],
        ["fullscreen"],
      ],
    });
    $(".altpost").trumbowyg({
      svgPath: false,
      hideButtonTexts: true,
      autogrow: false,
      semantic: false,
      btns: [
        ["viewHTML"],
        ["formatting"],
        ["strong", "em", "del"],
        ["justifyLeft", "justifyCenter", "justifyRight", "justifyFull"],
        ["unorderedList", "orderedList"],
        ["removeformat"],
        ["fullscreen"],
      ],
    });

    //load gateway
    $("#dGateways").on("change", "input[name=gateway]", function () {
      var id = $(this).val();
      $.get(
        config.url + "/helper.php",
        {
          action: "gateway",
          id: id,
          inv: $(this).data("id"),
        },
        function (json) {
          $("#dCheckout").html(json.message);
          $("html, body").animate(
            {
              scrollTop: $("#dCheckout").offset().top,
            },
            500
          );
        },
        "json"
      );
    });

    /* == Clear Session Debug Queries == */
    $("#debug-panel").on("click", "a.clear_session", function () {
      $.get(config.url + "/helper.php", {
        ClearSessionQueries: 1,
      });

      $(this).css("color", "#222");
    });

    /* == Check All == */
    $("#masterCheckbox").click(function () {
      var parent = $(this).data("parent");
      var $checkbox = $(parent).find(":checkbox");
      $checkbox.prop("checked", !$checkbox.prop("checked"));
    });

    /* == Master Form == */
    $(document).on("click", "button[name=dosubmit]", function () {
      var $button = $(this);
      var action = $(this).data("action");
      var $form = $(this).closest("form");
      var asseturl = $(this).data("url");

      function showResponse(json) {
        setTimeout(function () {
          $($button).removeClass("loading").prop("disabled", false);
        }, 500);
        $.wNotice(json.message, {
          autoclose: 10000,
          type: json.type,
          title: json.title,
        });
        if (json.type === "success" && json.redirect) {
          setTimeout(() => {
            window.location.href = json.redirect;
          }, 11000);
          $("main").transition("scaleOut", {
            duration: 1000,
            complete: function () {
              window.location.href = json.redirect;
            },
          });
        }
      }

      function showLoader() {
        $($button).addClass("loading").prop("disabled", true);
      }
      var options = {
        target: null,
        beforeSubmit: showLoader,
        success: showResponse,
        type: "post",
        url: asseturl
          ? config.url + "/" + asseturl + "/controller.php"
          : config.url + "/controller.php",
        data: {
          action: action,
        },
        dataType: "json",
      };

      $($form).ajaxForm(options).submit();
    });

    /* == Simple Actions == */
    $(document).on("click", ".iaction", function () {
      var dataset = $(this).data("set");
      var $parent = $(dataset.parent);
      $.ajax({
        type: "POST",
        url: config.url + dataset.url,
        dataType: "json",
        data: dataset.option[0],
      }).done(function (json) {
        if (json.type === "success") {
          switch (dataset.complete) {
            case "remove":
              $parent.transition("scaleOut", {
                duration: 300,
                complete: function () {
                  $parent.remove();
                  if (dataset.callback === "mason") {
                    $(".wojo.mason").wMason("refresh");
                  }
                },
              });

              break;

            case "replace":
              $parent.html(json.html).transition("fadeIn", {
                duration: 600,
              });
              break;

            case "prepend":
              $parent.prepend(json.html).transition("fadeIn", {
                duration: 600,
              });
              break;
          }

          if (dataset.redirect) {
            setTimeout(function () {
              $("main").transition("scaleOut");
              window.location.href = dataset.redirect;
            }, 900);
          }
        }

        if (json.message) {
          $.wNotice(decodeURIComponent(json.message), {
            autoclose: 12000,
            type: json.type,
            title: json.title,
          });
        }
      });
    });

    /* == Add/Edit Modal Actions == */
    $(document).on("click", "a.action, button.action", function () {
      var dataset = $(this).data("set");
      var $parent = dataset.parent;
      var $this = $(this);
      var actions = "";
      var asseturl = dataset.url;
      //var closeb = dataset.buttons === false ? '<div class="header"><h5>Modal Header</h5> </div>' : '';
      var url = asseturl
        ? config.url + "/" + asseturl
        : config.url + "/controller.php";

      $.get(url, dataset.option[0], function (data) {
        if (dataset.buttons !== false) {
          actions +=
            "" +
            '<div class="footer">' +
            '<button type="button" class="wojo small simple button" data="modal:close">' +
            config.lang.canBtn +
            "</button>" +
            '<button type="button" class="wojo small positive button" data="modal:ok">' +
            dataset.label +
            "</button>" +
            "</div>";
        }

        var $wmodal = $(
          '<div class="wojo ' +
            dataset.modalclass +
            ' modal"><div class="dialog" role="document"><div class="content">' +
            //'' + closeb + '' +
            "" +
            data +
            "" +
            "" +
            actions +
            "" +
            "</div></div></div>"
        )
          .on($.modal.BEFORE_OPEN, function () {
            $(".selectbox", this).wSelect({
              lang: {
                txt_ok: config.lang.ok,
                txt_cancel: config.lang.canBtn,
                txt_all: config.lang.allBtn,
                noMatch: config.lang.noMatch + ' "{0}"',
                captionFormat: "{0} " + config.lang.sellected,
                captionFormatAllSelected: "{0} " + config.lang.allSell + "!",
                searchText: config.lang.doSearch,
                placeholder: config.lang.sellOne,
                prefix: "",
              },
            });
            $(".datepick", this)
              .wDate({
                months: config.lang.monthsFull,
                short_months: config.lang.monthsShort,
                days_of_week: config.lang.weeksFull,
                short_days: config.lang.weeksShort,
                days_min: config.lang.weeksSmall,
                selected_format: "DD, mmmm d",
                month_head_format: "mmmm yyyy",
                format: "mm/dd/yyyy",
                clearBtn: true,
                todayBtn: true,
                cancelBtn: true,
                clearBtnLabel: config.lang.clear,
                cancelBtnLabel: config.lang.canBtn,
                okBtnLabel: config.lang.ok,
                todayBtnLabel: config.lang.today,
              })
              .on("datechanged", function (event) {
                if ($(this).attr("data-element")) {
                  var element = $(this).data("element");
                  var parent = $(this).data("parent");

                  var date = new Date(event.date);
                  var day = date.getDate();
                  var month = config.lang.monthsFull[date.getMonth()];
                  var year = date.getFullYear();
                  var formatted = month + " " + day + ", " + year;

                  $(parent).html(formatted);
                  if ($(element).is(":input")) {
                    $(element).val(event.date).trigger("change");
                  } else {
                    $(element).html(formatted);
                  }
                }
              });
          })
          .modal()
          .on("click", '[data="modal:ok"]', function () {
            $(this).addClass("loading").prop("disabled", true);

            function showResponse(json) {
              setTimeout(function () {
                $('[data="modal:ok"]', $wmodal)
                  .removeClass("loading")
                  .prop("disabled", false);
                if (json.message) {
                  $.wNotice(decodeURIComponent(json.message), {
                    autoclose: 12000,
                    type: json.type,
                    title: json.title,
                  });
                }
                if (json.type === "success") {
                  if (dataset.redirect) {
                    setTimeout(function () {
                      $("main").transition("scaleOut");
                      window.location.href = json.redirect;
                    }, 800);
                  } else {
                    switch (dataset.complete) {
                      case "replace":
                        $($parent).html(json.html).transition("fadeIn", {
                          duration: 600,
                        });
                        break;
                      case "replaceWith":
                        $($this).replaceWith(json.html).transition("fadeIn", {
                          duration: 600,
                        });
                        break;
                      case "append":
                        $($parent).append(json.html).transition("scaleIn", {
                          duration: 300,
                        });
                        break;
                      case "prepend":
                        $($parent).prepend(json.html).transition("scaleIn", {
                          duration: 300,
                        });
                        break;
                      case "update":
                        $($parent).replaceWith(json.html).transition("fadeIn", {
                          duration: 600,
                        });
                        break;
                      case "insert":
                        if (dataset.mode === "append") {
                          $($parent).append(json.html);
                        }
                        if (dataset.mode === "prepend") {
                          $($parent).prepend(json.html);
                        }
                        break;
                      case "highlite":
                        $($parent).addClass("highlite");
                        break;
                      case "refresh":
                        $(".wojo.mason").wMason("refresh");
                        break;
                      default:
                        break;
                    }
                    if (dataset.callback) {
                      var callback = dataset.callback[0];
                      switch (callback.type) {
                        case "select":
                          if (callback.method === "refresh") {
                            $(callback.element).wSelect("refresh");
                          }
                          break;
                        case "mason":
                          if (callback.method === "refresh") {
                            $(callback.element).wMason("refresh");
                          }
                          break;
                      }
                    }
                    $.modal.close();
                  }
                }
              }, 500);
            }

            var options = {
              target: null,
              success: showResponse,
              type: "post",
              url: url,
              data: dataset.option[0],
              dataType: "json",
            };
            $("#modal_form").ajaxForm(options).submit();
          });
      });
    });

    /* == Modal Delete/Archive/Trash Actions == */
    $(document).on("click", "a.data", function () {
      var dataset = $(this).data("set");
      var $parent = $(this).closest(dataset.parent);
      var asseturl = dataset.url;
      var url = asseturl
        ? config.url + "/" + asseturl
        : config.url + "/controller.php";
      var subtext = dataset.subtext;
      var children = dataset.children ? dataset.children[0] : null;
      var complete = dataset.complete;
      var header;
      var content;
      var icon;
      var btnLabel;

      switch (dataset.action) {
        case "trash":
          icon = "trash";
          btnLabel = config.lang.trsBtn;
          subtext =
            '<span class="wojo bold text">' + config.lang.delMsg8 + "</span>";
          header =
            config.lang.delMsg3 +
            ' <span class="wojo secondary text">' +
            dataset.option[0].title +
            "?</span>";
          content =
            '<img src="' +
            config.url +
            '/images/trash.svg" class="wojo basic center notification image">';
          break;

        case "archive":
          icon = "briefcase";
          btnLabel = config.lang.arcBtn;
          header = config.lang.delMsg5.replace(
            "[NAME]",
            '<span class="wojo secondary text">' +
              dataset.option[0].title +
              "</span>"
          );
          content =
            '<img src="' +
            config.url +
            '/images/archive.svg" class="wojo basic center notification image">';
          break;

        case "unarchive":
          icon = "briefcase alt";
          btnLabel = config.lang.uarcBtn;
          header = config.lang.delMsg6.replace(
            "[NAME]",
            '<span class="wojo secondary text">' +
              dataset.option[0].title +
              "</span>"
          );
          content =
            '<img src="' +
            config.url +
            '/images/unarchive.svg" class="wojo basic center notification image">';
          break;

        case "offer":
          icon = "confirm";
          btnLabel = config.lang.aOffer;
          header = config.lang.delMsg12.replace(
            "[NAME]",
            '<span class="wojo secondary text">' +
              dataset.option[0].title +
              "</span>"
          );
          content =
            '<img src="' +
            config.url +
            '/images/auction.svg" class="wojo basic center notification image">';
          break;

        case "restore":
          icon = "undo";
          btnLabel = config.lang.restBtn;
          subtext =
            '<span class="wojo bold text">' + config.lang.delMsg9 + "</span>";
          header = config.lang.delMsg7.replace(
            "[NAME]",
            '<span class="wojo secondary text">' +
              dataset.option[0].title +
              "</span>"
          );
          content =
            '<img src="' +
            config.url +
            '/images/restore.svg" class="wojo basic center notification image">';
          break;

        case "delete":
          icon = "delete";
          btnLabel = config.lang.delBtn;
          subtext =
            '<span class="wojo bold text">' + config.lang.delMsg2 + "</span>";
          header = config.lang.delMsg1;
          content =
            '<img src="' +
            config.url +
            '/images/delete.svg" class="wojo basic center notification image">';
          break;
      }

      $(
        '<div class="wojo modal"><div class="dialog" role="document"><div class="content">' +
          '<div class="header"><h5>' +
          header +
          "</h5></div>" +
          '<div class="body center aligned">' +
          content +
          '<p class="margin top">' +
          subtext +
          "</p></div>" +
          '<div class="footer">' +
          '<button type="button" class="wojo small simple button" data="modal:close">' +
          config.lang.canBtn +
          "</button>" +
          '<button type="button" class="wojo small positive button" data="modal:ok">' +
          btnLabel +
          "</button>" +
          "</div></div></div></div>"
      )
        .modal()
        .on("click", '[data="modal:ok"]', function () {
          $(this).addClass("loading").prop("disabled", true);

          $.ajax({
            type: "POST",
            url: url,
            dataType: "json",
            data: dataset.option[0],
          }).done(function (json) {
            if (json.type === "success") {
              if (dataset.redirect) {
                $.modal.close();
                $.wNotice(decodeURIComponent(json.message), {
                  autoclose: 4000,
                  type: json.type,
                  title: json.title,
                });
                $("main").transition("scaleOut", {
                  duration: 4000,
                  complete: function () {
                    window.location.href = dataset.redirect;
                  },
                });
              } else {
                $($parent).transition("scaleOut", {
                  duration: 300,
                  complete: function () {
                    $($parent).remove();
                    if (complete === "refresh") {
                      $(".wojo.mason").wMason("refresh");
                    }
                  },
                });
                if (children) {
                  $.each(children, function (i, values) {
                    $.each(values, function (k, v) {
                      if (v === "html") {
                        $(i).html(json[k]);
                      } else {
                        $(i).val(json[k]);
                      }
                    });
                  });
                }
                $(".wojo.modal")
                  .find(".notification.image")
                  .attr("src", config.url + "/images/checkmark.svg")
                  .transition("rollInTop", {
                    duration: 500,
                    complete: function () {
                      $.modal.close();
                      $.wNotice(decodeURIComponent(json.message), {
                        autoclose: 6000,
                        type: json.type,
                        title: json.title,
                      });
                    },
                  });
              }
            } else {
              $.modal.close();
              $.wNotice(decodeURIComponent(json.message), {
                autoclose: 4000,
                type: json.type,
                title: json.title,
              });
            }
          });
        });
    });
  };
})(jQuery);

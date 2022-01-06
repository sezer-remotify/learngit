(function($, window, document, undefined) {
    "use strict";
    var pluginName = 'wCalendar';
    var markupBlankDay = '<div class="cell empty"><div class="date"></div></div>';
    var currentDate = new Date();
    var currentMonth = currentDate.getMonth() + 1;
    var currentYear = currentDate.getFullYear();
    var currentDay = currentDate.getDate();
	var phone = false;

    function Plugin(element, options) {
        this.element = element;
        this._name = pluginName;
        this._defaults = $.fn.wCalendar.defaults;
        this.options = $.extend({}, this._defaults, options);
        this.init();
    }
    $.extend(Plugin.prototype, {
        init: function() {
			if ($(window).width() <= 768) {
				phone = true;
			}

            this._appendDayNames();
            this._initCalendar(currentMonth, currentYear);
            this.bindEvents();
        },

        bindEvents: function() {
            var plugin = this;
            // Next month
            $("#calnav").on("click", ".next", function() {
                plugin._setNextMonth();
            });

            // Prev month
            $("#calnav").on("click", ".prev", function() {
                plugin._setPreviousMonth();
            });

            // Reset Month
            $("#calnav").on("click", ".now", function() {
                plugin._initCalendar(currentMonth, currentYear);
            });

            // Back to month view
            $("#calnav").on("click", "#back", function() {
                $(this).remove();
                $(".list", plugin.element).css("transform", "scale(0)");
                setTimeout(function() {
                    $(".list", plugin.element).hide();
                }, 250);
            });

            // Click A Day
            $(this.element).on("click", ".day", function() {
                // If events, show events list
                var whichDay = $(this).data("number");
                var uniqueId = $(plugin.element).attr("id");

                var theList = $(".list", plugin.element);
                var myElement = $("#" + uniqueId + "day" + whichDay);
                theList.show();
                theList.css("transform");
                theList.css("transform", "scale(1)");
                $('.event-item[data-number="' + whichDay + '"]', plugin.element).show();

                $(theList).animate({
                    scrollTop: parseInt($(myElement).offset().top)
                }, 200);

                plugin._viewToggleButton();
            });

            // Close Calendar Event
            $(document).on('click', '#cancelEvent', function() {
                $("#dropdown-addCalendar").transition("fadeOut", {
                    duration: 200,
                    complete: function() {
                        $(this).remove();
                        $(".wojo.calendar, .wojo.time.picker").remove();
                    }
                });
            });
        },

        _processEvent: function(element, data) {
            $.get(this.options.url + "/helper.php", data, function(html) {
                $(html).appendTo("body");
                $("#dropdown-addCalendar").addClass("active");
                $(element).removeClass('loading');
            });
        },

        _appendDayNames: function() {
            var plugin = this;
            var offset = this.options.weekStart ? 1 : 0;
            var dayName = "";
            var dayIndex = 0;
			var days = (phone === true) ? plugin.options.lang.dayNamesShort : plugin.options.lang.dayNames;
			
            for (dayIndex = 0; dayIndex < 6; dayIndex++) {
                dayName += "<div>" + days[dayIndex + offset] + "</div>";
            }

            dayName += "<div>" + days[this.options.weekStart ? 0 : 6] + "</div>";
            $(this.element).append('<div class="header">' + dayName + '</div><div class="content"></div>');
            $(this.element).append('<div class="list"></div>');
        },

        _initCalendar: function(month, year) {
            var plugin = this;
            $(this.element).data("setMonth", month).data("setYear", year);
            // Get number of days
            var index = 0;
            var dayQty = this._daysInMonth(month, year);
            // Get day of the week the first day is
            var mZeroed = month - 1;
            var firstDay = new Date(year, mZeroed, 1, 0, 0, 0, 0).getDay();
            var settingCurrentMonth = month === currentMonth && year === currentYear;
            var id = $(plugin.element).attr("id");
			var days = (phone === true) ? plugin.options.lang.dayNamesShort : plugin.options.lang.dayNames;

            // Remove old days
            $(".day", this.element).remove();
            $(".empty", this.element).remove();
            $(".list", this.element).empty();
            $(".content", this.element).empty();

            // Print out the days
            for (var dayNumber = 1; dayNumber <= dayQty; dayNumber++) {
                // Check if it's a day in the past
                var isInPast = plugin.options.stylePast && (year < currentYear || (year === currentYear && (month < currentMonth || (month === currentMonth && dayNumber < currentDay))));
                var innerMarkup = '<div class="date">' + dayNumber + '</div><div class="progress"></div>';
                var thisDate = new Date(year, mZeroed, dayNumber, 0, 0, 0, 0);

                $(".content", plugin.element).append("<div" +
                    plugin._attr("class", "cell day" +
                        (isInPast ? " monthly-past-day" : "") +
                        " dt" + thisDate.toISOString().slice(0, 10)
                    ) +
                    plugin._attr("data-number", dayNumber) +
                    ">" + innerMarkup + "</div>");

                $(".list", plugin.element).append('<div class="event-item" id="' + id + 'day' + dayNumber + '" data-number="' + dayNumber + '">' +
                    ' <div class="date">' + days[thisDate.getDay()] + ' <span>' + dayNumber + '</span></div></div>');
            }

            if (settingCurrentMonth) {
                $(' *[data-number="' + currentDay + '"]', this.element).addClass("today");
            }

            $("#calnav .now").html(plugin.options.lang.monthNames[month - 1] + ' ' + year);

            // Account for empty days at start
            if (plugin.options.weekStart) {
                if (firstDay === 0) {
                    this._prependBlankDays(6);
                } else if (firstDay !== 1) {
                    this._prependBlankDays(firstDay - 1);
                }
            } else if (firstDay !== 7) {
                this._prependBlankDays(firstDay);
            }

            // Account for empty days at end
            var numdays = $(".day", this.element).length;
            var numempty = $(".empty", this.element).length;
            var totaldays = numdays + numempty;
            var roundup = Math.ceil(totaldays / 7) * 7;
            var daysdiff = roundup - totaldays;
            if (totaldays % 7 !== 0) {
                for (index = 0; index < daysdiff; index++) {
                    $(".content", this.element).append(markupBlankDay);
                }
            }

            // Events
            this._addEvents(month, year);

            var divs = $(".cell", this.element);
            for (index = 0; index < divs.length; index += 7) {
                divs.slice(index, index + 7).wrapAll('<div class="weeks"></div>');
            }
        },

        _addEvent: function(event, setMonth, setYear) {
            var plugin = this;
            // Year [0]   Month [1]   Day [2]
            var fullStartDate = this._getEventDetail(event, "starts_on");
            var fullEndDate = this._getEventDetail(event, "ends_on");
            var startArr = fullStartDate.split("-");
            var startYear = parseInt(startArr[0], 10);
            var startMonth = parseInt(startArr[1], 10);
            var startDay = parseInt(startArr[2], 10);
            var startDayNumber = startDay;
            var endDayNumber = startDay;
            var comment = this._getEventDetail(event, "comment");
            var showEventTitleOnDay = startDay;
            var startsThisMonth = startMonth === setMonth && startYear === setYear;
            var happensThisMonth = startsThisMonth;

            if (fullEndDate) {
                // If event has an end date, determine if the range overlaps this month
                var endArr = fullEndDate ? fullEndDate.split("-") : '';
                var endYear = parseInt(endArr[0], 10);
                var endMonth = parseInt(endArr[1], 10);
                var endDay = parseInt(endArr[2], 10);
                var startsInPastMonth = startYear < setYear || (startMonth < setMonth && startYear === setYear);
                var endsThisMonth = endMonth === setMonth && endYear === setYear;
                var endsInFutureMonth = endYear > setYear || (endMonth > setMonth && endYear === setYear);
                if (startsThisMonth || endsThisMonth || (startsInPastMonth && endsInFutureMonth)) {
                    happensThisMonth = true;
                    startDayNumber = startsThisMonth ? startDay : 1;
                    endDayNumber = endsThisMonth ? endDay : this._daysInMonth(setMonth, setYear);
                    showEventTitleOnDay = startsThisMonth ? startDayNumber : 1;
                }
            }

            if (!happensThisMonth) {
                return;
            }

            var startTime = this._getEventDetail(event, "starts_on_time") ? this._getEventDetail(event, "starts_on_time") : '';
            var endTime = this._getEventDetail(event, "ends_on_time") ? this._getEventDetail(event, "ends_on_time") : '';

            var timeHtml = "";
            var startTimehtml = '';
            var endTimehtml = '';
            var eventTitle = this._getEventDetail(event, "name");
            var eventColor = this._getEventDetail(event, "color");
            var id = this._getEventDetail(event, "id");

            if (startTime) {
                startTimehtml = '<div class="time"><div class="start">' + this._formatTime(fullStartDate + ' ' + startTime) + '</div>';
                endTimehtml = '';
                if (endTime) {
                    endTimehtml = '<div class="end">' + this._formatTime(fullEndDate + ' ' + endTime) + '</div>';
                }
                timeHtml = startTimehtml + endTimehtml + '</div>';
            }

            var markupDayStart = "<div" +
                this._attr("data-id", id) +
                this._attr("title", eventTitle) +
                (eventColor ? this._attr("style", "background:" + eventColor + ";") : "");

            var markupListEvent = "<div" +
                this._attr("class", "event") +
                this._attr("data-id", id) +
                (eventColor ? this._attr("style", "background:" + eventColor) : "") +
                "><a" + this._attr("data-id", id) + "> " + eventTitle + "</a>" +
                "<div" + this._attr("class", "description") + ">" + comment + "</div>" + timeHtml +
                "</div>";

            for (var index = startDayNumber; index <= endDayNumber; index++) {
                var doShowTitle = index === showEventTitleOnDay;
                // Add to calendar view
                $('*[data-number="' + index + '"] .progress', plugin.element).append(
                    markupDayStart +
                    this._attr("class", "indicator" +
                        (doShowTitle ? "" : " monthly-event-continued")
                    ) +
                    ">" + (doShowTitle ? eventTitle : "") + "</div>");

                // Add to event list
                $('.event-item[data-number="' + index + '"]', plugin.element).addClass("active").append(markupListEvent);
            }
        },

        _addEvents: function(month, year) {
            var plugin = this;

            var cid = $('#calnav input[name=cid]:checked').map(function() {
                return $(this).val();
            }).get().join(",");

            $.get(plugin.options.url + "/helper.php", {
                now: $.now(),
                action: "getCalendarRecords",
                year: year,
                month: month,
                ids: cid
            }, function(data) {
                plugin._addEventsFromString(data, month, year);
            }, "json").fail(function() {
                console.error("Monthly.js failed to import " + plugin.options.url + ". Please check for the correct path and json syntax.");
            });
        },

        _addEventsFromString: function(data, setMonth, setYear) {
            var plugin = this;
            $.each(data.events, function(index, event) {
                plugin._addEvent(event, setMonth, setYear);
            });
        },

        _getEventDetail: function(event, nodeName) {
            return event[nodeName];
        },

        // How many days are in this month?
        _daysInMonth: function(month, year) {
            //return month === 2 ? (year & 3) || (!(year % 25) && year & 15) ? 28 : 29 : 30 + (month + (month >> 3) & 1);
            return new Date(year, month, 0).getDate();
        },

        _attr: function(name, value) {
            var parseValue = String(value);
            var newValue = "";
            for (var index = 0; index < parseValue.length; index++) {
                switch (parseValue[index]) {
                    case "'":
                        newValue += "&#39;";
                        break;
                    case "\"":
                        newValue += "&quot;";
                        break;
                    case "<":

                        newValue += "&lt;";
                        break;
                    case ">":
                        newValue += "&gt;";
                        break;
                    default:
                        newValue += parseValue[index];
                }
            }
            return " " + name + "=\"" + newValue + "\"";
        },

        _formatTime: function(time) {
            return time.replace(/(\d?\d)(:\d\d)(:\d\d)/, function(_, h, m) {
                return (h > 12 ? h - 12 : +h === 0 ? "12" : +h) + m + (h >= 12 ? "pm" : "am");
            });
        },

        _prependBlankDays: function(count) {
            var wrapperEl = $(".content", this.element),
                index = 0;
            for (index = 0; index < count; index++) {
                wrapperEl.prepend(markupBlankDay);
            }
        },

        _setNextMonth: function() {
            var setMonth = $(this.element).data("setMonth"),
                setYear = $(this.element).data("setYear"),
                newMonth = setMonth === 12 ? 1 : setMonth + 1,
                newYear = setMonth === 12 ? setYear + 1 : setYear;
            this._initCalendar(newMonth, newYear);
            this._viewToggleButton();
        },

        _setPreviousMonth: function() {
            var setMonth = $(this.element).data("setMonth"),
                setYear = $(this.element).data("setYear"),
                newMonth = setMonth === 1 ? 12 : setMonth - 1,
                newYear = setMonth === 1 ? setYear - 1 : setYear;
            this._initCalendar(newMonth, newYear);
            this._viewToggleButton();
        },

        _viewToggleButton: function() {
            if ($(".list", this.element).is(":visible")) {
                $("#calnav").find("#now").after('<button type="button" id="back" class="wojo primary inverted icon button"><i class="icon calendar"></i></button>');
            }
        }
    });
    $.fn.wCalendar = function(options) {
        this.each(function() {
            if (!$.data(this, "plugin_" + pluginName)) {
                $.data(this, "plugin_" + pluginName, new Plugin(this, options));
            }
        });
        return this;
    };
    $.fn.wCalendar.defaults = {
        weekStart: 0, // Sunday
        ampm: 0,
        url: '',
        stylePast: false,
        lang: {
            btnSave: 'Save',
            btnCancel: 'Cancel',
            dayNames: ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"],
			dayNamesShort: ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"],
            monthNames: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
        }
    };
})(jQuery, window, document);
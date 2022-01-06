<?php
  /**
   * Calendar
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2019
   * @version $Id: calendar.tpl.php, v1.00 2019-05-05 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
?>
<div class="wojo fitted segment">
  <div  class="full padding">
    <div class="wojo small form">
      <div class="row gutters" id="calnav">
        <div class="columns phone-100">
          <div class="wojo stacked buttons">
            <button type="button" class="wojo primary inverted icon button prev"><i class="icon chevron left"></i></button>
            <button type="button" id="now" class="wojo primary inverted primary inverted button now">
            <?php echo Date::doDate("MMMM yyyy", Date::today());?>
            </button>
            <button type="button" class="wojo primary inverted icon button next"><i class="icon chevron right"></i></button>
          </div>
        </div>
        <div class="columns auto phone-100"><span class="wojo large text now"><?php echo Date::doDate("MMMM yyyy", Date::today());?></span></div>
      </div>
    </div>
  </div>
  <div class="wojo mcalendar form" id="mCalendar"></div>
</div>
<script src="<?php echo THEMEURL;?>/js/calendar.js"></script>
<script type="text/javascript"> 
// <![CDATA[	
$(document).ready(function() {
    $('#mCalendar').wCalendar({
		url: "<?php echo FRONTVIEW;?>",
        weekStart: <?php echo $this->core->weekstart;?>,
        ampm: "<?php echo ($this->core->time_format)  == "HH:mm" ? 1 : 0;?>",
        lang: {
            dayNames: [<?php echo Date::weekList(false, false);?>],
			dayNamesShort: [<?php echo Date::weekList(false, 3);?>],
            monthNames: [<?php echo Date::monthList(false);?>],
        }
    });
});
// ]]>
</script>
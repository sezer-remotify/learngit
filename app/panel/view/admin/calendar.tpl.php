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
        <div class="columns auto phone-100">
          <a class="wojo right primary inverted fluid button" data-dropdown="#dropdown-calHeader">
          <?php echo Lang::$word->CAL_CALENDARS;?>
          <i class="icon chevron down"></i></a>
          <div class="wojo small pointing dropdown top-left" id="dropdown-calHeader">
            <div class="wojo relaxed fluid divided list">
              <div class="item align middle">
                <div class="content padding right">
                  <h6 class="basic"><?php echo Lang::$word->CAL_CALENDARS;?></h6>
                </div>
                <div class="content auto">
                  <a data-set='{"option":[{"action":"addCalendar"}], "label":"<?php echo Lang::$word->CAL_CREATE;?>", "url":"helper.php", "parent":"#item0", "complete":"replace", "modalclass":"normal", "redirect":true}' class="wojo small positive inverted compact button action"><i class="icon plus alt"></i>
                  <?php echo Lang::$word->CAL_NEW;?></a>
                </div>
              </div>
              <?php if($this->data):?>
              <?php foreach($this->data as $row):?>
              <?php if($row->created_by_id == App::Auth()->uid):?>
              <div class="item align middle">
                <div class="content padding right">
                  <div class="wojo fitted toggle checkbox">
                    <input type="checkbox" data-name="<?php echo $row->name;?>" name="cid" value="<?php echo $row->id;?>" <?php echo Validator::getChecked($row->is_visible, 1);?> id="mCal_<?php echo $row->id;?>">
                    <label id="lCal_<?php echo $row->id;?>" for="mCal_<?php echo $row->id;?>" style="color:<?php echo $row->color;?>"><?php echo $row->name;?></label>
                  </div>
                </div>
                <div class="content auto">
                  <div class="wojo buttons" id="dCalEdit_<?php echo $row->id;?>">
                    <!-- Start editCalendar -->
                    <a data-set='{"option":[{"action":"editCalendar", "id":<?php echo $row->id;?>}], "label":"<?php echo Lang::$word->CAL_UPDATE;?>", "url":"helper.php", "parent":"#lCal_<?php echo $row->id;?>", "complete":"replace", "modalclass":"normal"}' class="wojo small simple positive icon button action"><i class="icon pencil"></i></a>
                    <!-- Start trashCalendar -->
                    <a data-set='{"option":[{"trash": "trashCalendar","title": "<?php echo $row->name;?>","id": "<?php echo $row->id;?>"}],"action":"trash","subtext":"<?php echo Lang::$word->DELCONFIRM3;?>", "parent":"#self","redirect":"<?php echo Url::url("/admin/calendar");?>"}' class="wojo small simple negative icon button data"><i class="icon trash"></i>
                    </a>
                  </div>
                </div>
              </div>
              <?php endif;?>
              <?php endforeach;?>
              <?php foreach($this->data as $row):?>
              <?php if($row->created_by_id <> App::Auth()->uid):?>
              <div class="item align middle">
                <div class="content half-padding">
                  <div class="wojo small fitted checkbox">
                    <input type="checkbox" data-name="<?php echo $row->name;?>" name="cid" value="<?php echo $row->id;?>" <?php echo Validator::getChecked($row->is_visible, 1);?> id="mCal_<?php echo $row->id;?>">
                    <label for="mCal_<?php echo $row->id;?>" style="color:<?php echo $row->color;?>"><?php echo $row->name;?></label>
                  </div>
                </div>
              </div>
              <?php endif;?>
              <?php endforeach;?>
              <?php endif;?>
            </div>
          </div>
        </div>
        <div class="columns phone-100 center aligned">
          <div class="wojo buttons">
            <button type="button" class="wojo primary inverted icon button prev"><i class="icon chevron left"></i></button>
            <button type="button" id="add" class="wojo primary inverted icon button"><i class="icon plus alt"></i></button>
            <button type="button" id="now" class="wojo primary inverted primary inverted button now">
            <?php echo Date::doDate("MMMM yyyy", Date::today());?>
            </button>
            <button type="button" class="wojo primary inverted icon button next"><i class="icon chevron right"></i></button>
          </div>
        </div>
        <div class="columns auto phone-hide mobile-hide"><span class="wojo large text now"><?php echo Date::doDate("MMMM yyyy", Date::today());?></span></div>
      </div>
    </div>
  </div>
  <div class="wojo mcalendar form" id="mCalendar"></div>
</div>
<script src="<?php echo ADMINVIEW;?>/js/calendar.js"></script>
<script type="text/javascript"> 
// <![CDATA[	
$(document).ready(function() {
    $('#mCalendar').wCalendar({
		url: "<?php echo ADMINVIEW;?>",
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
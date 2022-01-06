<?php
  /**
   * Add Time
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2019
   * @version $Id: addTimeRecord.tpl.php, v1.00 2019-03-02 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
	  
  if(!$this->row) : Message::invalid("ID" . Filter::$id); return; endif;
?>
<div class="header">
  <h5><?php echo Lang::$word->INV_SUB5_1 . ' ' . Lang::$word->FOR;?><span class="wojo secondary text"><?php echo $this->row->name?></span></h5>
</div>
<div class="body">
  <div class="wojo small form">
    <form method="post" id="tmodal_form" name="tmodal_form">
      <div class="row gutters">
        <div class="columns screen-60 tablet-60 mobile-100 phone-100">
          <div class="wojo small block fields">
            <div class="wojo field">
              <label><?php echo Lang::$word->TITLE;?></label>
              <input placeholder="<?php echo Lang::$word->TITLE;?>" type="text" name="title">
            </div>
            <div class="wojo field">
              <label><?php echo Lang::$word->DESCRIPTION;?></label>
              <textarea name="description" placeholder="<?php echo Lang::$word->DESCRIPTION;?>"></textarea>
            </div>
          </div>
          <button id="mdAddTimeRecord" type="button" class="wojo rounded small primary button"><?php echo Lang::$word->TMR_TITLE1;?></button>
        </div>
        <div class="columns screen-40 tablet-40 mobile-100 phone-100">
          <div class="wojo small block fields">
            <div class="field">
              <label><?php echo Lang::$word->_HOURS;?></label>
              <input placeholder="<?php echo Lang::$word->TSK_TIME_EG;?>" type="text" name="hours">
            </div>
            <?php if(Auth::$userdata->type == "owner"):?>
            <div class="field">
              <label><?php echo Lang::$word->USER;?></label>
              <div class="wojo small dark inverted rounded right fluid button" data-dropdown="#mUserList">
                <span class="text mUserList"><?php echo Lang::$word->TSK_SUB11;?></span>
                <i class="icon chevron down"></i>
              </div>
              <div class="wojo dropdown small pointing top-left" id="mUserList">
                <?php if($this->puserdata):?>
                <?php foreach($this->puserdata as $prow):?>
                <?php if($prow->type != "member"):?>
                <a class="item" data-html="<?php echo $prow->name;?>" data-value="<?php echo $prow->id;?>">
                <?php echo $prow->name;?>
                </a>
                <?php endif;?>
                <?php endforeach;?>
                <?php endif;?>
                <input type="hidden" name="user_id" value="<?php echo Auth::$userdata->id;?>">
              </div>
            </div>
            <?php endif;?>
            <div class="field">
              <label><?php echo Lang::$word->CMP_JOBT;?></label>
              <div class="wojo small dark inverted rounded right fluid button" data-dropdown="#mJobList">
                <span class="text mJobList"><?php echo Lang::$word->CMP_JOBTS;?></span>
                <i class="icon chevron down"></i>
              </div>
              <div class="wojo dropdown small pointing top-left" id="mJobList">
                <?php if($this->core->job_types):?>
                <?php foreach(Utility::jSonToArray($this->core->job_types) as $jrow):?>
                <a class="item" data-html="<?php echo $jrow->name;?>" data-value="<?php echo $jrow->id;?>">
                <?php echo $jrow->name;?>
                </a>
                <?php endforeach;?>
                <?php endif;?>
                <input type="hidden" name="job_id" value="0">
              </div>
            </div>
            <div class="field">
              <label><?php echo Lang::$word->DATE;?></label>
              <div id="mCreated" class="datepick" data-datepicker="true" data-element="input[name=created]" data-parent="#mdButton > span">
                <div id="mdButton" class="wojo small dark inverted rounded right button">
                  <span><?php echo Date::doDate("dd/MM/yyyy", Date::today());?></span>
                  <i class="icon chevron down"></i></div>
              </div>
            </div>
          </div>
          <div class="wojo fitted toggle checkbox">
            <input type="checkbox" name="is_billable" value="1" id="mBillable">
            <label for="mBillable"><?php echo Lang::$word->INV_ISBILL;?></label>
          </div>
        </div>
      </div>
      <input type="hidden" name="created" value="<?php echo Date::doDate("short_date", Date::today());?>">
    </form>
    <h4>
      <?php echo Lang::$word->INV_SUB5_1;?>
    </h4>
    <div id="mTimeRecords" class="wojo segment">
      <?php if($this->timerecords):?>
      <?php foreach($this->timerecords as $day => $rows):?>
      <h5><?php echo Date::doDate("short_date", $day);?></h5>
      <div class="wojo relaxed small fluid divided list">
        <?php foreach($rows as $val):?>
        <?php $category = Utility::searchForValueName('id', $val->job_id, 'name', Utility::jSonToArray($this->core->job_types));?>
        <div class="item" id="mItem_<?php echo $val->id;?>">
          <div class="content auto margin right">
            <img src="<?php echo UPLOADURL;?>/avatars/<?php echo $val->avatar ? $val->avatar : "blank.svg" ;?>" alt="" class="wojo tiny circular image">
          </div>
          <div class="content">
            <h6 class="basic"><?php echo $val->title;?></h6>
            <div class="description">@<?php echo $val->hours;?>
              <?php echo $category ? $category : "...";?> | <span class="wojo small bold text"><?php echo $val->is_billable ? Lang::$word->INV_ISBILL : Lang::$word->INV_ISNOBILL;?></span></div>
          </div>
          <div class="content auto">
            <a class="grey" data-dropdown="#rList_<?php echo $val->id;?>">
            <i class="icon horizontal ellipsis"></i>
            </a>
            <div class="wojo dropdown small pointing top-right" id="rList_<?php echo $val->id;?>">
              <a data-id="<?php echo $val->id;?>" class="is_edit item"><?php echo Lang::$word->EDIT;?></a>
              <div class="divider"></div>
              <a data-set='{"option":[{"trash": "trashTimeRecordTask","title": "<?php echo Validator::sanitize($val->title, "chars");?>","id": "<?php echo $val->id;?>","project_id": <?php echo $val->project_id;?>,"task_id":<?php echo $this->row->id;?>, "taskname":"<?php echo $this->row->name?>","is_billable":<?php echo $val->is_billable;?>}],"action":"trash","subtext":"<?php echo Lang::$word->DELCONFIRM3;?>", "parent":"#mItem_<?php echo $val->id;?>", "children":[{"#dHours":{"totalHours":"html"}}]}' class="item wojo demi text data">
              <?php echo Lang::$word->MTOTRASH;?>
              </a>
            </div>
          </div>
        </div>
        <?php endforeach;?>
      </div>
      <?php endforeach;?>
      <?php endif;?>
    </div>
  </div>
</div>
<script type="text/javascript">
  $(document).ready(function() {
      $("#mTimeRecords").on('click', '.is_edit', function() {
          var id = $(this).data('id');
          $.get("<?php echo ADMINVIEW;?>/helper.php", {
              action: "editTimeRecord",
              id: id,
          }, function(json) {
              if (json.type == "success") {
                  var row = json.data;
                  $("#tmodal_form input[name=title]").val(row.title);
                  $("#tmodal_form textarea[name=description]").val(row.description);
                  $("#tmodal_form input[name=hours]").val(row.hours);
                  $('#mUserList input').val(row.user_id);
                  var user = $('#mUserList [data-value = ' + row.user_id + ']').attr('data-html');
                  $("#tmodal_form .mUserList").text(user);
                  $('#tmodal_form #mUserList [data-value = ' + row.user_id + ']').addClass('selected');

                  $('#tmodal_form #mJobList input').val(row.job_id);
                  var job = $('#mJobList [data-value = ' + row.job_id + ']').attr('data-html');
                  $(".mJobList").text(job);
                  $('#tmodal_form #mJobList [data-value = ' + row.job_id + ']').addClass('selected');
                  $('#tmodal_form #mCreated span').text(json.short_date);
				  $('#tmodal_form input[name=created]').val(json.input_date);
                  $('#tmodal_form #mBillable').prop('checked', row.is_billable ? true : false);

                  $("#mdAddTimeRecord").text("<?php echo Lang::$word->TMR_TITLE2;?>");
                  $('input[name=id]').remove();
                  $('<input />', {
                      type: 'hidden',
                      name: 'id',
                      value: id
                  }).appendTo("#tmodal_form");
              }
          }, "json");
      });

      $("#mdAddTimeRecord").click(function() {
          var $button = $(this);

          function showResponse(json) {
              setTimeout(function() {
                  $($button).removeClass("loading").prop("disabled", false);
              }, 500);
              $.wNotice(decodeURIComponent(json.message), {
                  autoclose: 12000,
                  type: json.type,
                  title: json.title
              });
              if (json.type == "success") {
                  $("#mTimeRecords").html(json.html);
                  //$('.wojo.modal').modal('refresh');
                  $("#dHours").html(json.hours);
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
              url: "<?php echo ADMINVIEW;?>/controller.php",
              data: {
                  action: "processTimeRecord",
                  task_id: <?php echo $this->id;?>,
                  project_id: <?php echo $this->row->project_id;?>,
                  tpl: "loadTimeRecordModal",
                  taskname: "<?php echo $this->row->name;?>",
                  is_modal: 1
              },
              dataType: 'json'
          };

          $("#tmodal_form").ajaxForm(options).submit();
      });
  });
</script>
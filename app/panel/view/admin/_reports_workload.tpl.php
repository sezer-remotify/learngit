<?php
  /**
   * Reports Workload
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2019
   * @version $Id: _reports_workload.tpl.php, v1.00 2019-05-05 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
?>
<div class="wojo fitted segment">
  <div class="divided header">
    <div class="items">
      <h4 class="basic"><?php echo Lang::$word->REP_SUB5;?></h4>
    </div>
    <div class="items">
      <a data-dropdown="#dProjectList" class="grey">
      <i class="icon horizontal ellipsis"></i>
      </a>
      <div class="wojo dropdown small pointing top-left" id="dProjectList">
        <a class="item" data-value="all"><?php echo Lang::$word->REP_SUB23;?></a>
        <div class="divider"></div>
        <?php if($this->projects):?>
        <?php foreach($this->projects as $prow):?>
        <a class="item" data-value="<?php echo $prow->id;?>"><?php echo $prow->name;?></a>
        <?php endforeach;?>
        <?php endif;?>
      </div>
    </div>
  </div>
  <?php if(!$this->data):?>
  <div class="content" id="results">
    <div class="center aligned"><img src="<?php echo ADMINVIEW;?>/images/search_empty.svg" alt="" class="wojo center large image">
      <p class="wojo semi grey text"><?php echo Lang::$word->REP_INFO11;?></p>
    </div>
  </div>
  <?php endif;?>
</div>
<?php if($this->data):?>
<div class="wojo mason">
  <?php foreach($this->staff as $srow):?>
  <div class="item" id="item_<?php echo $srow->id;?>">
    <div class="wojo simple fitted attached segment">
      <div class="wojo primary inverted bg divided header align middle">
      <div class="items">
        <?php if($srow->avatar):?>
        <img src="<?php echo UPLOADURL;?>/avatars/<?php echo $srow->avatar;?>" alt="" class="wojo category image">
        <?php else:?>
        <span class="wojo initials circular label"><?php echo Utility::getInitials($srow->name);?></span>
        <?php endif;?>
        </div>
        <div class="items">
        <span><?php echo $srow->name;?></span></div>
      </div>
      <div class="content">
        <div class="wojo relaxed divided fluid list" data-id="<?php echo $srow->id;?>">
          <?php if($this->data):?>
          <?php foreach($this->data as $row):?>
          <?php if($srow->id == $row->assigned_id):?>
          <div class="item align middle" data-parent="<?php echo $row->id;?>" data-filter="<?php echo $row->assigned_id;?>,<?php echo $row->project_id;?>">
            <div class="content">
              <?php echo $row->name;?>
            </div>
            <div class="content auto">
              <a class="grey" data-dropdown="#dAssigneeList_<?php echo $row->id;?>">
              <i class="icon horizontal ellipsis"></i>
              </a>
              <div class="wojo dropdown small pointing top-right dAssigneeList" id="dAssigneeList_<?php echo $row->id;?>">
                <?php foreach($this->staff as $urow):?>
                <?php if($urow->id != $row->assigned_id):?>
                <a class="item" data-value="<?php echo $urow->id;?>" data-item="<?php echo $row->id;?>">
                <?php echo $urow->name;?>
                </a>
                <?php endif;?>
                <?php endforeach;?>
              </div>
            </div>
          </div>
          <?php endif;?>
          <?php endforeach;?>
          <?php endif;?>
        </div>
      </div>
    </div>
  </div>
  <?php endforeach;?>
</div>
<?php endif;?>
<script src="<?php echo ADMINVIEW;?>/js/reportsWorkload.js"></script>
<script type="text/javascript"> 
// <![CDATA[	
$(document).ready(function() {
    $.Workload({
		url: "<?php echo ADMINVIEW;?>"
    });
});
// ]]>
</script>
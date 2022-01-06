<?php
  /**
   * Load Message History
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2019
   * @version $Id: loadMessageHistory.tpl.php, v1.00 2019-03-02 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
?>
<?php if($this->data):?>
<div class="wojo segment scrollbox" style="height:250px">
  <div class="wojo small relaxed fluid divided list">
    <?php foreach ($this->data as $i => $row):?>
    <?php $i++;?>
    <div class="item">
      <div class="content">
        <div class="header"><?php echo $i;?>. <?php echo $row->comment;?>
          <?php echo Lang::$word->BY;?>
          <a href="<?php echo Url::url("/admin/members/details", $row->uid);?>"><?php echo $row->fullname;?></a>
        </div>
      </div>
      <div class="content auto padding left"><?php echo Date::timesince($row->created);?></div>
    </div>
    <?php endforeach;?>
  </div>
</div>
<?php endif;?>
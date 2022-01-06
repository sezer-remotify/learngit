<?php
  /**
   * Company History
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2019
   * @version $Id: companyHistory.tpl.php, v1.00 2019-03-02 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
	  
	  
  if(!$this->row) : Message::invalid("ID" . Filter::$id); return; endif;
      $data = App::Company()->getCompanyHistory($this->row->id);
?>
<div class="header">
  <h5><?php echo Lang::$word->HISOCHGE;?><span class="wojo secondary text"><?php echo $this->row->name?></span></h5>
</div>
<div class="body">
  <?php if(!$data):?>
  <p class="wojo icon text"><i class="info sign icon"></i><?php echo Lang::$word->CMP_NOHISTORY;?></p>
  <?php else:?>
  <div class="wojo divided small relaxed list">
    <?php foreach($data as $row):?>
    <div class="item">
      <div class="content">
        <?php echo $row->title?>
        <?php echo $row->comment?>
        <span class="wojo dimmed text"><?php echo Lang::$word->BY;?></span>
        <a href="<?php echo Url::url("/admin/members/details", $row->uid);?>"><?php echo $row->fullname?></a>
        , <span class="wojo dimmed text"><?php echo Date::timeSince($row->created);?></span>
      </div>
    </div>
    <?php endforeach;?>
  </div>
  <?php endif;?>
</div>
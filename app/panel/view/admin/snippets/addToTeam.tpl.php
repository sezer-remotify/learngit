<?php
  /**
   * Add To Team
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2019
   * @version $Id: addToTeam.tpl.php, v1.00 2019-03-02 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
	  
	  
  if(!$this->row) : Message::invalid("ID" . Filter::$id); return; endif;
?>
<div class="header">
  <h5><?php echo Lang::$word->ADDTEAM;?><span class="wojo secondary text"><?php echo $this->row->fname . ' ' . $this->row->lname?></span></h5>
</div>
<div class="body">
  <div class="wojo form">
    <form method="post" id="modal_form" name="modal_form">
      <div class="wojo block fields">
        <div class="basic field">
          <label><?php echo Lang::$word->MAC_SUB11;?>:</label>
          <?php if($this->teams):?>
          <div class="padding top">
            <div class="row grid small gutters screen-2 tablet-2 mobile-2 phone-1">
              <?php foreach ($this->teams as $row):?>
              <div class="columns">
                <div class="wojo fitted checkbox">
                  <?php $check = in_array($this->row->id, $row['usarr']) ? ' checked="checked"' : null;?>
                  <input class="hidden" type="checkbox" name="teams[]" value="<?php echo $row['id'];?>"<?php echo $check;?> id="team_<?php echo $row['id'];?>">
                  <label for="team_<?php echo $row['id'];?>"><?php echo $row['name'];?></label>
                </div>
              </div>
              <?php endforeach;?>
            </div>
          </div>
          <?php endif;?>
        </div>
      </div>
    </form>
  </div>
</div>
<?php

/**
 * Add To Projects
 *
 * @package Wojo Framework
 * @author wojoscripts.com
 * @copyright 2019
 * @version $Id: addToProjects.tpl.php, v1.00 2019-03-02 10:12:05 gewa Exp $
 */
if (!defined("_WOJO"))
  die('Direct access to this location is not allowed.');
if (!$this->row) : Message::invalid("ID" . Filter::$id);
  return;
endif;
?>
<div class="header">
  <h5><span class="wojo secondary text"><?php echo $this->row->fname . ' ' . $this->row->lname ?></span></h5>
</div>
<div class="body">
  <div class="wojo form">
    <form method="post" id="modal_form" name="modal_form">
      <div class="wojo block fields">
        <div class="field">
          <textarea name="note" id="freelancer-note" class="height-130" cols="30" rows="10" placeholder="Enter a note about freelancer that you have chosen"><?php if (isset($this->note->note)) echo $this->note->note; ?></textarea>
        </div>
      </div>
    </form>
  </div>
</div>
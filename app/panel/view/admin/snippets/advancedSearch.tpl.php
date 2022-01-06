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
/**if (!$this->row) : Message::invalid("ID" . Filter::$id);
  return;
endif;**/
?>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<div class="header">
  <h5><span class="wojo secondary text"><?php //echo $this->row->fname . ' ' . $this->row->lname ?></span></h5>
</div>
<div class="body">
  <div class="wojo form">
    <form method="post" id="modal_form" name="modal_form">
      <div class="container">
        <div class="row">
          <div class=col-md-6>
            <div class="wojo fields">
              <div class="field">
                <label>Fullname</label>
                <input type="text" name="fullname" placeholder="John Doe" > 
              </div>
            </div>
            <div class="wojo fields">
              <div class="field">
                <label>Headline</label>
                <input type="text" name="headline" placeholder="Full Stack Developer" > 
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="wojo fields">
              <div class="field">
                <label>Approval Status</label>
                  <input type="checkbox" name="approvedStatus[]" value="Approved" <?php if($k==1) echo "selected"?> >Approved</input><br>
                  <input type="checkbox" name="approvedStatus[]" value="Not Approved" <?php if($k==2) echo "selected"?> >Not Approved</input><br>
                  <input type="checkbox" name="approvedStatus[]" value="Penalized" <?php if($k==3) echo "selected"?> >Penalized</input><br>
                  <input type="checkbox" name="approvedStatus[]" value="Not Sure" <?php if($k==4) echo "selected"?> >Not Sure</input><br>
                  <input type="checkbox" name="approvedStatus[]" value="On Hold" <?php if($k==5) echo "selected"?> >On Hold</input><br>
                  <input type="checkbox" name="approvedStatus[]" value="Other" <?php if($k==6) echo "selected"?> >Other</input>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="wojo fields">
              <div class="field">
                  <label>Price Range</label>
                  From <input type="number" name="from"> 
                  To <input type="number" name="to"> 
                </div>
            </div>
            <div class="wojo fields" style="position:relative">
              <div class="field">
                  <label>Available Hours</label><span style="position:absolute;top:-3px;right:10px;font-size:9pt">(0=null)</span>
                  <input type="range" name="hours" value="0" min="0" max="168" oninput="this.nextElementSibling.value = this.value">
                  <output>0</output>
                </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="row">
                <div class="col">
                  <div class="wojo fields">
                    <div class="field">
                      <label>Looking For</label>
                      <input type="text" name="fullname" placeholder="Freelance" > 
                    </div>
                  </div>
                  <div class="wojo fields">
                    <div class="field">
                      <label>Current Employment</label>
                      <input type="text" name="headline" placeholder="Full Time" > 
                    </div>
                </div>
            </div>
            </div>
          </div>
          <div class="row">
                <div class="col">
                 <div class="wojo fields">
                    <div class="field">
                      <label>Skills</label>
                      <select class="skills" multiple>
                      <?php foreach ($this->skills as $v) : ?>
                        <option value="<? echo $v->id ?>"><?php echo $v->name;?></option>
                      <?php endforeach; ?>
                      </select> 
                </div>
            </div>
            </div>
        </div>
      </div>
    </form>
  </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
$(document).ready(function() {
    $('.skills').select2();
});
</script>
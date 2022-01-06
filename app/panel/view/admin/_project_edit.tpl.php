<?php
  /**
   * Projects Edit
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2019
   * @version $Id: _project_edit.tpl.php, v1.00 2019-05-05 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
?>
<div class="wojo heading message">
  <div class="content">
    <h3><?php echo Lang::$word->CFG_SUB12;?></h3>
  </div>
</div>
<div class="row gutters align bottom">
  <div class="columns phone-100">
    <div class="wojo small white stacked buttons">
      <a href="<?php echo Url::url("/admin/projects", "new");?>" class="wojo button"><?php echo Lang::$word->PRJ_PRJSTART;?></a>
      <a href="<?php echo Url::url("/admin/projects", "archive");?>" class="wojo button"><?php echo Lang::$word->PRJ_SUB9;?></a>
    </div>
  </div>
</div>
<form method="post" id="wojo_form" name="wojo_form">
  <div class="wojo form gutters segment">
    <div class="wojo fields">
      <div class="field">
        <label><?php echo Lang::$word->PRJ_PRJNAME;?>
          <i class="icon asterisk"></i></label>
        <input placeholder="<?php echo Lang::$word->PRJ_PRJNAME;?> *" value="<?php echo $this->row->name;?>" type="text" name="name">
      </div>
    </div>
    <div class="wojo fields">
      <div class="field">
        <label><?php echo Lang::$word->DESCRIPTION;?></label>
        <input placeholder="<?php echo Lang::$word->DESCRIPTION;?>" type="text" value="<?php echo $this->row->description;?>" name="description">
      </div>
    </div>
  </div>
  <div class="wojo form segment">
    <div class="wojo fields">
      <div class="field four wide labeled">
        <label><?php echo Lang::$word->PRJ_LABEL;?></label>
      </div>
      <div class="field">
        <div class="wojo inverted dark right button" data-dropdown="#labelDrop">
          <span class="text"><?php echo ($this->label_selected) ? $this->label_selected : Lang::$word->NONE;?></span>
          <i class="icon chevron down"></i>
        </div>
        <div class="wojo dropdown small pointing top-center" id="labelDrop">
          <a class="item" data-value="0" data-html="<?php echo Lang::$word->NONE;?>"><?php echo Lang::$word->PRJ_LABEL_S;?></a>
          <div class="divider"></div>
          <?php if($this->labels):?>
          <?php foreach($this->labels as $label):?>
          <a class="item align spaced <?php echo Validator::getActive($label->id, $this->row->label_id);?>" data-html="<?php echo $label->name;?>" data-value="<?php echo $label->id;?>">
          <?php echo $label->name;?>
          <span class="wojo small circular right empty label" style="background:<?php echo $label->color;?>;border-color:<?php echo $label->color;?>"></span>
          </a>
          <?php endforeach;?>
          <?php endif;?>
          <input type="hidden" name="label" value="<?php echo $this->row->label_id;?>">
        </div>
        <p class="wojo small text"><?php echo Lang::$word->PRJ_LABEL_T;?></p>
      </div>
    </div>
    <div class="wojo fields">
      <div class="field four wide labeled">
        <label><?php echo Lang::$word->CATEGORY;?></label>
      </div>
      <div class="field">
        <div class="wojo inverted dark right button" data-dropdown="#categoryDrop">
          <span class="text"><?php echo ($this->category_selected) ? $this->category_selected : Lang::$word->NONE;?></span>
          <i class="icon chevron down"></i>
        </div>
        <div class="wojo dropdown small pointing top-center" id="categoryDrop">
          <a class="item" data-value="0" data-html="<?php echo Lang::$word->NONE;?>"><?php echo Lang::$word->PRJ_CAT_S;?></a>
          <div class="divider"></div>
          <?php if($this->cats):?>
          <?php foreach($this->cats as $cat):?>
          <a class="item <?php echo Validator::getActive($cat->id, $this->row->category_id);?>" data-html="<?php echo $cat->name;?>" data-value="<?php echo $cat->id;?>">
          <?php echo $cat->name;?>
          </a>
          <?php endforeach;?>
          <?php endif;?>
          <input type="hidden" name="category" value="<?php echo $this->row->category_id;?>">
        </div>
        <p class="wojo small text"><?php echo Lang::$word->PRJ_CAT_T;?></p>
      </div>
    </div>
    <div class="wojo fields">
      <div class="field four wide labeled">
        <label><?php echo Lang::$word->INV_CLCMP;?></label>
      </div>
      <div class="field">
        <div class="wojo inverted dark right button" data-dropdown="#companyDrop">
          <span class="text"><?php echo ($this->company_selected) ? $this->company_selected : Lang::$word->NONE;?></span>
          <i class="icon chevron down"></i>
        </div>
        <div class="wojo dropdown small pointing top-center" id="companyDrop">
          <div class="scrolling">
            <?php if($this->companies):?>
            <?php foreach($this->companies as $crow):?>
            <a class="item<?php echo ($crow->owner) ? ' highlite' : null;?> <?php echo Validator::getActive($crow->id, $this->row->company_id);?>" data-html="<?php echo $crow->name;?>" data-value="<?php echo $crow->id;?>">
            <?php echo $crow->name;?>
            </a>
            <?php endforeach;?>
            <?php endif;?>
          </div>
          <input name="company" type="hidden" value="<?php echo $this->row->company_id;?>">
        </div>
      </div>
    </div>
    <div class="wojo fields">
      <div class="field four wide labeled">
        <label><?php echo Lang::$word->PRJ_TIMEXP;?></label>
      </div>
      <div class="field">
        <div class="wojo toggle fitted checkbox">
          <input type="checkbox" checked="checked" name="dorates" value="1" onchange="$('#crates').slideToggle()" id="labelRates">
          <label for="labelRates"><?php echo Lang::$word->PRJ_TIMEXP_T;?></label>
        </div>
      </div>
    </div>
    <div class="wojo fields">
      <div class="basic field four wide labeled"></div>
      <div class="basic field">
        <div class="wojo small form" id="crates">
          <div class="wojo fields">
            <div class="field">
              <label><?php echo Lang::$word->CFG_CURRENCY;?></label>
              <select class="selectbox" name="currency" data-wselect='{"search":true,"placeholder":"<?php echo Lang::$word->CFG_CURRENCY;?>"}'>
                <?php foreach($this->countries as $ctrow):?>
                <option value="<?php echo $ctrow->currency_code . ',' . $ctrow->iso_alpha2;?>" <?php echo Validator::getSelected($this->row->currency . ',' . $this->row->country, $ctrow->currency_code . ',' . $ctrow->iso_alpha2);?>><?php echo $ctrow->name;?> - <?php echo $ctrow->currency_name;?> (<?php echo $ctrow->currrency_symbol;?>)</option>
                <?php endforeach;?>
              </select>
            </div>
          </div>
          <?php if($this->jobtypes):?>
          <div class="wojo fields">
            <div class="seven wide field">
              <h6>
                <?php echo Lang::$word->CMP_JOBT;?>
              </h6>
            </div>
            <div class="three wide field">
              <h6>
                <?php echo $this->row->currency ? $this->row->currency : $this->core->currency;?> / <?php echo Lang::$word->_HOUR;?>
              </h6>
            </div>
          </div>
          <div id="jbTable">
            <?php foreach($this->jobtypes as $i => $jrow):?>
            <div class="wojo small fields align middle">
              <?php $i++;?>
              <div class="seven wide field">
                <label><?php echo $i . '. ' . $jrow->name;?></label>
              </div>
              <div class="three wide field">
                <input placeholder="<?php echo $jrow->hrate;?>" type="text" value="<?php echo $jrow->hrate;?>" name="hrate[<?php echo $jrow->name;?>]">
              </div>
            </div>
            <?php endforeach;?>
          </div>
          <?php endif;?>
          <p>
            <a id="addItem" class="wojo white small button">
            <i class="icon alt plus"></i>
            <?php echo Lang::$word->PRJ_NEWJTYPE;?></a>
          </p>
          <div class="wojo fields">
            <div class="field">
              <label><?php echo Lang::$word->PRJ_BUDGET;?></label>
              <input value="<?php echo Utility::numberParse($this->row->budget);?>" placeholder="<?php echo $this->row->currency ? $this->row->currency : $this->core->currency;?>" type="text" name="budget">
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="center aligned">
    <a href="<?php echo Url::url("/admin/projects");?>" class="wojo simple small button"><?php echo Lang::$word->CANCEL;?></a>
    <button type="button" data-action="processProject" name="dosubmit" class="wojo primary button"><?php echo Lang::$word->PRJ_UPDATE;?></button>
  </div>
  <input name="id" type="hidden" value="<?php echo $this->row->id;?>">
</form>
<script type="text/javascript"> 
// <![CDATA[	
$(document).ready(function() {
	var counter = $("#jbTable").children().length;
	$('#addItem').on('click', function() {
	  if (counter > 10) {
		  return false;
	  }
      counter++;
	  var newDiv = $('<div class="wojo small fields align middle"></div>');
	  newDiv.html(
		  '<div class="seven wide field"><input placeholder="' + counter + '. <?php echo Lang::$word->PRJ_JOBNAME;?> *" type="text" name="xname[]"></div>\
		   <div class="three wide field"><input placeholder="<?php echo Lang::$word->PRJ_RATE;?> *" type="text" name="xhrate[]"></div>\
		  ');
		  newDiv.appendTo("#jbTable"); 
	  });
  });
// ]]>
</script>
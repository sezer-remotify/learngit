<?php
  /**
   * Invoices Project
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2019
   * @version $Id: _invoice_project.tpl.php, v1.00 2019-05-05 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
?>
<h3><?php echo Lang::$word->INV_TITLE1;?></h3>
<div class="wojo small white stacked buttons">
  <?php if(Auth::hasPrivileges('manage_invoices')):?>
  <a href="<?php echo Url::url("/admin/invoices", "new");?>" class="wojo button"><i class="icon plus alt"></i>
  <?php echo Lang::$word->INV_NEWINV;?></a>
  <?php endif;?>
  <?php /*?><a href="<?php echo Url::url("/admin/invoices", "recurring");?>" class="wojo button"><?php echo Lang::$word->INV_TITLE7;?></a><?php */?>
  <a href="<?php echo Url::url("/admin/invoices", "canceled");?>" class="wojo button"><?php echo Lang::$word->INV_PANDC;?></a>
</div>
<form method="post" id="invoiceForm" name="wojo_form">
  <div class="wojo segment spaced form">
    <h6><?php echo Lang::$word->INV_SUB2;?></h6>
    <div class="wojo fields align middle">
      <div class="field four wide labeled">
        <label>
          <?php echo Lang::$word->INV_CLCMP;?>
          <i class="icon asterisk"></i></label>
      </div>
      <div class="field">
        <select name="company_id">
          <option value="">--- <?php echo Lang::$word->CMP_SELECT;?> ---</option>
          <?php echo $this->companies;?>
        </select>
      </div>
    </div>
    <div class="wojo fields align middle">
      <div class="field four wide labeled">
        <label>
          <?php echo Lang::$word->ADDRESS;?>
          <i class="icon asterisk"></i></label>
      </div>
      <div class="field">
        <div class="wojo fluid input">
          <textarea class="small" name="company_address" placeholder="<?php echo Lang::$word->ADDRESS;?>"><?php echo $this->company->address . "\n";?><?php echo $this->company->city . "\n";?><?php echo $this->company->state . "\n";?><?php echo $this->company->zip . "\n";?><?php echo $this->company->country . "\n";?></textarea>
        </div>
      </div>
    </div>
    <div class="wojo fields align middle">
      <div class="field four wide labeled">
        <label>
          <?php echo Lang::$word->CFG_SCURRENCY_S;?>
          <i class="icon asterisk"></i></label>
      </div>
      <div class="field">
        <select class="selectbox" name="currency" data-wselect='{"search":true,"placeholder":"<?php echo Lang::$word->CFG_SCURRENCY_S;?>"}'>
          <?php foreach($this->countries as $ctrow):?>
          <option value="<?php echo $ctrow->currency_code . ',' . $ctrow->iso_alpha2;?>"<?php echo ($this->row->currency . ',' . $this->row->country == $ctrow->currency_code . ',' . $ctrow->iso_alpha2) ? ' selected="selected"' : null;?>><?php echo $ctrow->name;?> - <?php echo $ctrow->currency_name;?> (<?php echo $ctrow->currrency_symbol;?>)</option>
          <?php endforeach;?>
        </select>
      </div>
    </div>
    <div class="wojo auto divider"></div>
    <h6><?php echo Lang::$word->INV_SUB3;?></h6>
    <div class="wojo fields align middle">
      <div class="field four wide labeled">
        <label>
          <?php echo Lang::$word->INV_INVOICE;?> ID</label>
      </div>
      <div class="field">
        <input placeholder="<?php echo Lang::$word->INV_INVOICE;?> ID" type="text" name="custom_id">
      </div>
    </div>
    <div class="wojo fields align middle">
      <div class="field four wide labeled">
        <label>
          <?php echo Lang::$word->INV_ISSUED;?>
        </label>
      </div>
      <div class="field">
        <input name="created" type="text" value="<?php echo Date::doDate("dd/MM/yyyy", $this->row->created);?>" readonly class="datepick">
      </div>
    </div>
    <div class="wojo fields align middle">
      <div class="field four wide labeled">
        <label><?php echo Lang::$word->INV_DUEON;?>
          <i class="icon asterisk"></i>
        </label>
      </div>
      <div class="field">
        <select id="iDueDate" name="due_date">
          <option value="<?php echo Date::today();?>"><?php echo Lang::$word->INV_DUEON0;?></option>
          <option value="<?php echo Date::NumberOfDays('+ 10 day');?>"><?php echo Lang::$word->INV_DUEON1;?></option>
          <option value="<?php echo Date::NumberOfDays('+ 15 day');?>" selected="selected"><?php echo Lang::$word->INV_DUEON2;?></option>
          <option value="<?php echo Date::NumberOfDays('+ 30 day');?>"><?php echo Lang::$word->INV_DUEON3;?></option>
          <option value="<?php echo Date::NumberOfDays('+ 60 day');?>"><?php echo Lang::$word->INV_DUEON4;?></option>
          <option value="5"><?php echo Lang::$word->INV_DUEON5;?></option>
        </select>
      </div>
      <div class="field hide-all" id="cdate">
        <input name="due_date_custom" type="text" value="<?php echo Date::doDate("dd/MM/yyyy", date('Y-m-d'));?>" readonly class="datepick">
      </div>
    </div>
    <div class="wojo fields align middle">
      <div class="field four wide labeled">
        <label><?php echo Lang::$word->INV_REF;?></label>
      </div>
      <div class="field">
        <input name="reference" type="text" placeholder="<?php echo Lang::$word->INV_REF;?>">
      </div>
    </div>
  </div>
  <div class="wojo fitted segment form">
    <div class="header">
      <h4>
        <?php echo Lang::$word->INV_SUB4;?>
      </h4>
    </div>
    <div class="content">
      <div class="wojo toggle checkbox">
        <input name="freeform" checked="checked" type="radio" value="0" onchange="$('#tep').slideToggle()" id="freeform_1">
        <label for="freeform_1"><?php echo Lang::$word->INV_SUB4_1;?></label>
      </div>
      <div class="wojo small toggle checkbox">
        <input name="freeform" type="radio" value="1" onchange="$('#tep').slideToggle()" id="freeform_2" checked="checked">
        <label for="freeform_2"><?php echo Lang::$word->INV_SUB4_2;?></label>
      </div>
      <div id="tep">
        <div class="wojo fields align top">
          <div class="basic field four wide labeled">
            <label><?php echo Lang::$word->INV_SUB5_3;?></label>
          </div>
          <div class="basic field">
            <?php if($this->projects):?>
            <div class="row grid phone-1 mobile-1 tablet-2 screen-2 small gutters">
              <?php foreach ($this->projects as $prow):?>
              <div class="columns">
                <div class="wojo radio fitted checkbox">
                  <input type="radio" name="project" value="<?php echo $prow->id;?>" id="projectLabel_<?php echo $prow->id;?>" <?php Validator::getChecked($this->row->id, $prow->id);?>>
                  <label for="projectLabel_<?php echo $prow->id;?>"><?php echo $prow->name;?></label>
                </div>
              </div>
              <?php endforeach;?>
            </div>
            <?php endif;?>
          </div>
        </div>
        <div class="wojo divider"></div>
        <div class="wojo fields">
          <div class="basic field four wide labeled">
            <label><?php echo Lang::$word->INV_SUB5;?></label>
          </div>
          <div class="basic field">
            <div class="wojo fitted checkbox">
              <input name="timerecord" type="checkbox" value="1" id="timeRecord" checked="checked">
              <label for="timeRecord"><?php echo Lang::$word->INV_SUB5_1;?></label>
            </div>
            <div class="top margin">
              <div class="wojo fitted checkbox">
                <input name="expense" type="checkbox" value="1" id="timeExpense" checked="checked">
                <label for="timeExpense"><?php echo Lang::$word->INV_SUB5_2;?></label>
              </div>
            </div>
          </div>
        </div>
        <div class="wojo divider"></div>
        <div class="wojo fields align middle">
          <div class="basic field four wide labeled">
            <label><?php echo Lang::$word->INV_SUB6;?></label>
          </div>
          <div class="basic field">
            <div class="wojo radio fitted checkbox">
              <input name="timeperiod" checked="checked" type="radio" value="all" id="timePeriod_1">
              <label for="timePeriod_1"><?php echo Lang::$word->INV_SUB6_1;?></label>
            </div>
            <div class="small top margin">
              <div class="row small gutters align middle">
                <div class="columns mobile-100 phone-100">
                  <div class="wojo radio fitted checkbox">
                    <input name="timeperiod" type="radio" value="period" id="timePeriod_2">
                    <label for="timePeriod_2"><?php echo Lang::$word->INV_SUB6_2;?></label>
                  </div>
                </div>
                <div class="columns mobile-100 phone-100">
                  <div id="fromdate" class="wojo small input">
                    <input id="fromdate" name="datefrom" type="text" placeholder="<?php echo Date::doDate("dd/MM/yyyy", date('Y-m-d'));?>" readonly>
                  </div>
                </div>
                <div class="columns auto mobile-hide phone-hide"> - </div>
                <div class="columns mobile-100 phone-100">
                  <div id="enddate" class="wojo small input">
                    <input id="enddate" name="dateto" type="text" placeholder="<?php echo Date::doDate("dd/MM/yyyy", date('Y-m-d'));?>" readonly>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="center aligned">
          <button type="button" name="getItems" class="wojo small primary rounded button"><i class="icon find"></i><?php echo Lang::$word->FIND;?></button>
        </div>
      </div>
    </div>
  </div>
  <div class="wojo small form">
    <table class="wojo small segment responsive table invoice">
      <thead>
        <tr>
          <th class="auto"></th>
          <th class="auto">#</th>
          <th><?php echo Lang::$word->PRJ_DESC;?></th>
          <th class="two wide"><?php echo Lang::$word->INV_QTY;?></th>
          <?php if($this->taxes):?>
          <th class="two wide"><?php echo Lang::$word->INV_TAXRATE;?></th>
          <?php endif;?>
          <th class="two wide"><?php echo Lang::$word->INV_ITEMCST;?></th>
          <th class="auto"></th>
        </tr>
      </thead>
      <tbody id="ivTable">
        <tr id="item1" data-id="1">
          <td class="handle"><i class="icon drag"></i></td>
          <td><small class="wojo bold text">1.</small></td>
          <td><div class="wojo small input">
              <input type="text" name="item[]" id="item1">
            </div></td>
          <td><div class="wojo small input">
              <input type="text" name="quantity[]" class="quantity" id="quantity1" value="1.00">
            </div></td>
          <?php if($this->taxes):?>
          <td><select name="tax_rate[]" id="tax_rate1" class="tax">
              <option value="0" selected="selected"><?php echo Lang::$word->INV_NOTAX;?></option>
              <?php foreach($this->taxes as $tax):?>
              <option value="<?php echo $tax->id;?>"><?php echo $tax->name;?>
              <?php echo $tax->amount;?>%</option>
              <?php endforeach;?>
            </select></td>
          <?php endif;?>
          <td><div class="wojo small input">
              <input name="price[]" type="text" class="price" data-id="1">
            </div></td>
          <td><a class="removeItem inverted"><i class="icon delete"></i></a></td>
        </tr>
        <tr id="item2" data-id="2">
          <td class="handle"><i class="icon reorder"></i></td>
          <td><small class="wojo bold text">2.</small></td>
          <td><div class="wojo small input">
              <input type="text" name="item[]" id="item2">
            </div></td>
          <td><div class="wojo small input">
              <input type="text" name="quantity[]" id="quantity2" class="quantity" value="1.00">
            </div></td>
          <?php if($this->taxes):?>
          <td><select name="tax_rate[]" id="tax_rate2" class="tax">
              <option value="0" selected="selected"><?php echo Lang::$word->INV_NOTAX;?></option>
              <?php foreach($this->taxes as $tax):?>
              <option value="<?php echo $tax->id;?>"><?php echo $tax->name;?>
              <?php echo $tax->amount;?>%</option>
              <?php endforeach;?>
            </select></td>
          <?php endif;?>
          <td><div class="wojo small input">
              <input name="price[]" type="text" class="price" data-id="2">
            </div></td>
          <td><a class="removeItem grey"><i class="icon delete"></i></a></td>
        </tr>
      </tbody>
    </table>
    <div class="row align middle">
      <div class="columns screen-80 tablet-60 phone-100">
        <a id="addItem" class="wojo simple button"><i class="icon plus alt"></i><?php echo Lang::$word->INV_ADDITEM;?></a>
      </div>
      <div class="columns screen-20 tablet-40 phone-100">
        <div class="wojo small right input">
          <input name="discount" class="discount" type="text" value="">
          <div class="wojo simple label">
            <?php echo Lang::$word->DISC;?> % </div>
        </div>
      </div>
    </div>
    <div class="flex align end">
      <div class="vertical margin">
        <table class="wojo basic collapsing table">
          <tr>
            <td><?php echo Lang::$word->SUBTOTAL;?></td>
            <td><span class="subtotal">0.00</span></td>
          </tr>
          <tr>
            <td><?php echo Lang::$word->DISC;?></span></td>
            <td><span class="disctotal">0.00</span></td>
          </tr>
          <tr>
            <td><?php echo Lang::$word->TAXES;?></td>
            <td><span class="taxtotal">0.00</span></td>
          </tr>
          <tr>
            <td class="wojo demi text positive"><?php echo Lang::$word->TOTALAMT;?></td>
            <td class="wojo demi text positive"><span class="total">0.00</span></td>
          </tr>
        </table>
      </div>
    </div>
    <h6>
      <a id="AddNote" class="wojo simple button"><i class="icon plus alt"></i>
      <?php echo Lang::$word->INV_SUB7;?></a>
    </h6>
    <div id="invNote" class="hide-all">
      <div class="wojo divider"></div>
      <h6><?php echo Lang::$word->NOTE;?></h6>
      <div class="wojo fields">
        <div class="field four wide labeled">
          <label><?php echo Lang::$word->MESSAGE;?></label>
        </div>
        <div class="field">
          <textarea class="small" name="note"></textarea>
          <p class="wojo small text"><?php echo Lang::$word->INV_INFO_2;?></p>
        </div>
      </div>
    </div>
    <h6>
      <a id="AddComment" class="wojo simple button"><i class="icon plus alt"></i><?php echo Lang::$word->INV_SUB8;?></a>
    </h6>
    <div id="invComment" class="hide-all">
      <div class="wojo divider"></div>
      <h6><?php echo Lang::$word->INV_SUB8_1;?></h6>
      <div class="fields">
        <div class="wojo fields">
          <div class="field four wide labeled">
            <label><?php echo Lang::$word->MESSAGE;?></label>
          </div>
          <div class="field">
            <textarea class="small" name="comment"></textarea>
            <p class="wojo small text"><?php echo Lang::$word->INV_INFO_1;?></p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="full padding center aligned">
    <a href="<?php echo Url::url("/admin/invoices");?>" class="wojo simple small button"><?php echo Lang::$word->CANCEL;?></a>
    <button type="button" data-action="processInvoice" name="dosubmit" class="wojo primary button"><?php echo Lang::$word->INV_CREATE;?></button>
  </div>
  <input type="hidden" name="total_amount" value="0.00">
  <input type="hidden" name="subtotal" value="0.00">
  <input type="hidden" name="taxes" value="0.00">
</form>
<script src="<?php echo ADMINVIEW;?>/js/invoice.js"></script>
<script type="text/javascript"> 
// <![CDATA[	
$(document).ready(function() {
    $.Invoice({
        tax_rates: <?php echo json_encode($this->taxes ? $this->taxes : array());?>,
		url: "<?php echo ADMINVIEW;?>",
		is_project: true,
		taxes: {},
        lang: {
            add_error: "<?php echo Lang::$word->INV_ITMERROR;?>",
            add_errort: "<?php echo Lang::$word->ERROR;?>",
			no_tax: "<?php echo Lang::$word->INV_NOTAX;?>",
			no_items: "<?php echo Lang::$word->INV_NOITEMS;?>",
			ialert: "<?php echo Lang::$word->ALERT;?>",
        }
    });
});
// ]]>
</script>
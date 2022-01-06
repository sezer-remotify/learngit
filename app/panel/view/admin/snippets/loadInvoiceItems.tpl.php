<?php
  /**
   * Load Invoice Items
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2019
   * @version $Id: loadInvoiceItems.tpl.php, v1.00 2019-03-02 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
	  
  if(!$this->data) : Message::invalid("ID" . Filter::$id); return; endif;
?>
<?php foreach ($this->data as $i => $row):?>
<?php $i++;?>
<tr id="item<?php echo $i;?>" data-id="<?php echo $row->id;?>">
  <td class="handle"><i class="icon reorder"></i></td>
  <td><small class="wojo bold text"><?php echo $i;?>.</small></td>
  <td><div class="wojo small input">
      <input type="text" name="item[]" data-id="<?php echo $i;?>" id="item<?php echo $i;?>" value="<?php echo $row->title;?>">
    </div></td>
  <td><div class="wojo small input">
      <input type="text" name="quantity[]" class="quantity" id="quantity<?php echo $i;?>" value="<?php echo isset($row->hours) ? $row->hours : '1.00';?>">
    </div></td>
  <?php if($this->taxes):?>
  <td><select name="tax_rate[]" id="tax_rate<?php echo $i;?>" class="tax">
      <option value="0" selected="selected"><?php echo Lang::$word->INV_NOTAX;?></option>
      <?php foreach($this->taxes as $tax):?>
      <option value="<?php echo $tax->id;?>"><?php echo $tax->name;?>
      <?php echo $tax->amount;?>%</option>
      <?php endforeach;?>
    </select></td>
  <?php endif;?>
  <td><div class="wojo small input">
      <input name="price[]" type="text" class="price" data-id="<?php echo $i;?>" value="<?php echo Utility::formatNumber($row->amount);?>">
    </div></td>
  <td><a class="removeItem grey"><i class="icon delete"></i></a>
    <input type="hidden" name="<?php echo isset($row->hours) ? "is_timerecord[]" : "is_expense[]";?>" value="<?php echo $row->id;?>"></td>
</tr>
<?php endforeach;?>
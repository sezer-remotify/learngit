<?php
  /**
   * Project Estimates
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2019
   * @version $Id: estimates.tpl.php, v1.00 2019-05-05 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
?>
<?php switch(Url::segment($this->segments)): case "view": ?>
<div class="wojo segment">
  <table class="wojo very basic table">
    <tr>
      <td class="two wide"><?php if (file_exists(UPLOADS . '/print_logo.png')):?>
        <img alt="" src="<?php echo UPLOADURL . '/print_logo.png';?>" class="wojo basic medium image">
        <?php else:?>
        <?php echo App::Core()->company;?>
        <?php endif;?></td>
      <td class="right aligned"><p><?php echo $this->company->name;?></p>
        <p><?php echo $this->company->address;?></p>
        <p><?php echo $this->company->city . ' ' . $this->company->state . ' ' . $this->company->zip;?></p>
        <p><?php echo $this->company->phone;?></p>
        <p><?php echo $this->company->website;?>
          <?php echo $this->company->email;?></p>
        <p><small><?php echo Validator::cleanOut(App::Core()->invoice_info);?></small></p></td>
    </tr>
  </table>
  <table class="wojo basic table">
    <tr>
      <td><strong><?php echo Lang::$word->INV_SUB13;?>:</strong></td>
      <td class="right aligned"><strong><?php echo $this->row->title;?></strong></td>
    </tr>
  </table>
  <table class="wojo basic table">
    <tr>
      <td><p><?php echo $this->row->company_name;?></p>
        <p><?php echo $this->row->company_address;?></p></td>
      <td class="right aligned"><p><?php echo Lang::$word->INV_ISSUED;?>: <?php echo Date::dodate("short_date", $this->row->created);?></p></td>
    </tr>
  </table>
  <div class="wojo divider"></div>
  <table class="wojo basic table">
    <thead>
      <tr>
        <th class="auto">#</th>
        <th><?php echo Lang::$word->ITEM;?></th>
        <th><?php echo Lang::$word->INV_QTY;?></th>
        <?php if($this->row->tax <> 0):?>
        <th><?php echo Lang::$word->INV_TAXRATE;?></th>
        <?php endif;?>
        <th class="auto"><?php echo Lang::$word->INV_ITEMCST;?></th>
      </tr>
    </thead>
    <tbody id="ivTable">
      <?php $i = 1;?>
      <?php if($this->data):?>
      <?php foreach ($this->data as $irow):?>
      <tr id="list<?php echo $i;?>" data-id="<?php echo $irow->id;?>">
        <td><small class="wojo bold text"><?php echo $i;?>.</small></td>
        <td><?php echo $irow->description;?></td>
        <td><?php echo Utility::formatNumber($irow->quantity);?></td>
        <?php if($this->row->tax <> 0):?>
        <td><?php echo $irow->tax_name;?>
          <?php echo Utility::formatNumber($irow->tax_amount);?></td>
        <?php endif;?>
        <td class="right aligned"><?php echo Utility::formatNumber($irow->amount);?></td>
      </tr>
      <?php $i++;?>
      <?php endforeach;?>
      <?php endif;?>
    </tbody>
  </table>
  <div class="flex align end">
    <div>
      <table class="wojo basic collapsing table">
        <tr>
          <td><?php echo Lang::$word->SUBTOTAL;?></td>
          <td class="right aligned"><?php echo Utility::formatNumber($this->row->subtotal);?></td>
        </tr>
        <?php if($this->row->tax <> 0):?>
        <tr>
          <td><?php echo Lang::$word->TAXES;?></td>
          <td class="right aligned"><?php echo Utility::formatNumber($this->row->tax);?></td>
        </tr>
        <?php endif;?>
        <?php if($this->row->discount <> 0):?>
        <tr>
          <td><?php echo Lang::$word->DISC;?></td>
          <td class="right aligned">- <?php echo Utility::formatNumber(($this->row->subtotal * $this->row->discount) / 100);?></td>
        </tr>
        <?php endif;?>
        <tr>
          <td class="wojo demi text positive"><?php echo Lang::$word->TOTAL;?></td>
          <td class="wojo demi text positive right aligned"><?php echo Utility::formatNumber($this->row->total);?></td>
        </tr>
      </table>
    </div>
  </div>
  <a class="wojo small primary inverted button" href="<?php echo FRONTVIEW;?>/helper.php?action=downloadEstimate&amp;id=<?php echo $this->row->id;?>"><i class="icon download"></i><?php echo Lang::$word->DOWNLOAD;?></a>
</div>
<?php break;?>
<!-- Start default -->
<?php default: ?>
<h3><?php echo Lang::$word->ADM_ESTIMATES;?></h3>
<?php if(!$this->data):?>
<div class="center aligned"><img src="<?php echo ADMINVIEW;?>/images/estimates_empty.svg" alt="" class="wojo center large image">
  <p class="wojo semi grey text"><?php echo Lang::$word->EST_NOEST;?></p>
</div>
<?php else:?>
<?php if(isset($this->data[1])):?>
<!-- Sent -->
<div class="wojo segment">
  <table class="wojo basic table responsive">
    <thead>
      <tr>
        <th class="five wide"><?php echo Lang::$word->EST_NAME;?></th>
        <th class="four wide"><?php echo Lang::$word->CLIENT;?></th>
        <th class="three wide right aligned"><?php echo Lang::$word->INV_AMOUNT;?></th>
      </tr>
    </thead>
    <?php foreach($this->data[1] as $row):?>
    <tr id="ivitemu_<?php echo $row->id;?>">
      <td><a href="<?php echo Url::url("/dashboard/estimates/view", $row->id);?>">
        <?php echo $row->title;?></a></td>
      <td><?php echo $row->company_name;?></td>
      <td class="right aligned"><?php echo Utility::formatMoney($row->total, $row->currency);?></td>
    </tr>
    <?php endforeach;?>
    <?php unset($row);?>
  </table>
</div>
<?php endif;?>
<?php if(isset($this->data[2])):?>
<!-- Lost -->
<div class="wojo segment">
  <table class="wojo basic table responsive">
    <thead>
      <tr>
        <th class="five wide"><?php echo Lang::$word->EST_NAME;?></th>
        <th class="four wide"><?php echo Lang::$word->CLIENT;?></th>
        <th class="three wide right aligned"><?php echo Lang::$word->INV_AMOUNT;?></th>
      </tr>
    </thead>
    <?php foreach($this->data[2] as $row):?>
    <tr id="ivitemu_<?php echo $row->id;?>">
      <td><a href="<?php echo Url::url("/dashboard/estimates/view", $row->id);?>">
        <?php echo $row->title;?></a></td>
      <td><?php echo $row->company_name;?></td>
      <td class="right aligned"><?php echo Utility::formatMoney($row->total, $row->currency);?></td>
    </tr>
    <?php endforeach;?>
    <?php unset($row);?>
  </table>
</div>
<?php endif;?>
<?php if(isset($this->data[3])):?>
<!-- Won -->
<div class="wojo segment">
  <table class="wojo basic table responsive">
    <thead>
      <tr>
        <th class="five wide"><?php echo Lang::$word->EST_NAME;?></th>
        <th class="four wide"><?php echo Lang::$word->CLIENT;?></th>
        <th class="three wide right aligned"><?php echo Lang::$word->INV_AMOUNT;?></th>
      </tr>
    </thead>
    <?php foreach($this->data[3] as $row):?>
    <tr id="ivitemu_<?php echo $row->id;?>">
      <td><a href="<?php echo Url::url("/dashboard/estimates/view", $row->id);?>">
        <?php echo $row->title;?></a></td>
      <td><?php echo $row->company_name;?></td>
      <td class="right aligned"><?php echo Utility::formatMoney($row->total, $row->currency);?></td>
    </tr>
    <?php endforeach;?>
    <?php unset($row);?>
  </table>
</div>
<?php endif;?>
<?php endif;?>
<?php break;?>
<?php endswitch;?>

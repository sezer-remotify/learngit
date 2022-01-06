<?php
  /**
   * Load Invoice Full View
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2019
   * @version $Id: loadIvSingleFullView.tpl.php, v1.00 2019-03-02 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
?>
<div class="full padding">
  <div class="row align middle">
    <div class="columns mobile-100 phone-100">
      <!-- Start sendInvoice -->
      <a data-set='{"option":[{"action":"sendInvoice","id":<?php echo $this->row->id;?>, "tpl":"loadIvSingleFullView.tpl"}], "label":"<?php echo Lang::$word->INV_SENDIV;?>", "url":"helper.php", "parent":"#ivdata", "complete":"replace", "modalclass":"normal"}' class="wojo simple compact button action"><?php echo $this->row->status ? Lang::$word->INV_RESEND : Lang::$word->INV_SENDIVE;?></a>
      
      <!-- Start markAsSent -->
      <?php if($this->row->status == 0):?>
      <a data-set='{"option":[{"action":"invoiceMarkSent","id":<?php echo $this->row->id;?>, "tpl":"loadIvSingleFullView.tpl"}], "label":"<?php echo Lang::$word->INV_MASEND;?>", "url":"helper.php", "parent":"#ivdata", "complete":"replace", "modalclass":"normal"}' class="wojo simple compact button action"><?php echo Lang::$word->INV_MASEND;?></a>
      <?php endif;?>
      <?php if(!$this->row->recurring):?>
      <?php if($this->row->pstatus <> 2):?>
      <!-- Start invoiceAddPayment -->
      <a data-set='{"option":[{"action":"invoiceAddPayment","id":<?php echo $this->row->id;?>, "url":"<?php echo Url::uri();?>"}], "label":"<?php echo Lang::$word->INV_ADDPAY;?>", "url":"helper.php", "parent":"#ivdata", "redirect":true, "complete":"replace", "modalclass":"normal"}' class="wojo simple compact button action"><?php echo Lang::$word->INV_ADDPAY;?></a>
      <?php endif;?>
      <?php endif;?>
    </div>
    <div class="columns auto mobile-100 phone-100">
      <?php if(Auth::hasPrivileges('edit_invoice')):?>
      <?php if(!$this->row->recurring):?>
      <?php if($this->row->status != 2 and $this->row->pstatus != 2):?>
      <a class="wojo small basic circular icon button" href="<?php echo Url::url("/admin/invoices/edit", $this->row->id);?>"><i class="icon pencil"></i></a>
      <?php endif;?>
      <?php endif;?>
      <?php endif;?>
      <a href="<?php echo ADMINVIEW;?>/helper.php?action=downloadInvoice&amp;id=<?php echo $this->row->id;?>" class="wojo small basic circular icon button">
      <i class="icon download"></i>
      </a>
      <a class="wojo small basic circular icon button" data-dropdown="#invoiceDrop_<?php echo $this->row->id;?>">
      <i class="icon horizontal ellipsis"></i>
      </a>
      <div class="wojo dropdown small pointing top-right" id="invoiceDrop_<?php echo $this->row->id;?>">
        <?php if(!$this->row->recurring):?>
        <!-- Start duplicateInvoice -->
        <a href="<?php echo Url::url("/admin/invoices/duplicate", $this->row->id);?>" class=" item"><?php echo Lang::$word->DUPLICATE;?></a>
        <?php endif;?>
        <!-- Start disableReminders -->
        <?php if($this->row->status != 2 and $this->row->pstatus != 2):?>
        <a id="act_<?php echo $this->row->id;?>" data-set='{"option":[{"action":"invoiceReminder","id":<?php echo $this->row->id;?>}], "label":"<?php echo $this->row->reminder ? Lang::$word->INV_DISREM : Lang::$word->INV_ENREM;?>", "url":"helper.php", "parent":"#act_<?php echo $this->row->id;?>", "complete":"replaceWith", "modalclass":"normal"}' class="item action"><?php echo $this->row->reminder ? Lang::$word->INV_DISREM : Lang::$word->INV_ENREM;?></a>
        <?php endif;?>
        <div class="divider"></div>
        <!-- Start invoiceAccess -->
        <a data-set='{"option":[{"action":"invoiceAccess","id":<?php echo $this->row->id;?>}], "label":"<?php echo Lang::$word->INV_ACCESS;?>", "url":"helper.php", "parent":"#ivitemu_<?php echo $this->row->id;?>", "complete":"highlite", "modalclass":"normal","buttons":false}' class="item action"><?php echo Lang::$word->INV_ACCESS;?></a>
        <div class="divider"></div>
        <!-- Start archiveInvoice -->
        <a data-set='{"option":[{"archive": "archiveInvoice","title": "<?php echo Content::invoiceID($this->row->id, $this->row->custom_id);?>","id": "<?php echo $this->row->id;?>"}],"action":"archive","subtext":"<?php echo Lang::$word->INV_CANCEL_I;?>", "parent":"#ivdata", "redirect": "<?php echo Url::url("/admin/invoices");?>"}' class="wojo demi text item data">
        <?php echo Lang::$word->INV_CINV;?>
        </a>
      </div>
    </div>
  </div>
</div>
<div class="wojo attached secondary message align spaced">
  <?php if($this->row->pstatus == 1 or $this->row->pstatus == 2):?>
  <table class="wojo small very compact basic collapsing table">
    <?php foreach ($this->payments as $prow):?>
    <tr>
      <td class="wojo white text"><?php echo $prow->pp;?>:</td>
      <td class="wojo white text"><?php echo Utility::formatMoney($prow->amount, $prow->currency);?>
        <?php echo strtolower(Lang::$word->ON);?>
        <?php echo Date::dodate("short_date", $prow->created);?>
        <?php if(!$this->row->recurring):?>
        ( <a data-set='{"option":[{"action": 1,"page":"invoiceDeletePayment", "invoiceDeletePayment":1, "tpl":"loadIvSingleFullView", "processItem":1, "pay_id":<?php echo $prow->id;?>, "id":<?php echo $this->row->id;?>}], "label":"<?php echo Lang::$word->DELETE;?>", "url":"/helper.php", "parent":"#ivdata", "complete":"replace", "modalclass":"small"}' class="white mAction"><?php echo Lang::$word->DELETE;?></a>
        )
        <?php endif;?></td>
    </tr>
    <?php endforeach;?>
    <tr>
      <td><span class="wojo bold white text"><?php echo Lang::$word->INV_BALDUE;?>:</span></td>
      <td><span class="wojo bold white text"><?php echo Utility::formatMoney($this->row->balance_due - $this->row->paid_amount, $this->row->currency);?></span></td>
    </tr>
  </table>
  <?php else:?>
  <?php if($this->row->status):?>
  <?php echo Lang::$word->INV_SUB10;?>
  <?php else:?>
  <?php echo Lang::$word->INV_SUB9;?>
  <?php endif;?>
  <?php endif;?>
  <div>
    <?php echo Project::invoiceStatus($this->row->status);?>
    <?php echo Project::invoicepStatus($this->row->pstatus);?>
  </div>
</div>
<div class="content">
  <table class="wojo basic table">
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
      <td class="right aligned"><strong><?php echo Content::invoiceID($this->row->id, $this->row->custom_id);?></strong></td>
    </tr>
  </table>
  <table class="wojo basic table">
    <tr>
      <td><p><?php echo $this->row->company_name;?></p>
        <p><?php echo $this->row->company_address;?></p></td>
      <td class="right aligned"><?php if($this->row->reference):?>
        <p><?php echo $this->row->reference;?></p>
        <?php endif;?>
        <p><?php echo Lang::$word->INV_ISSUED;?>: <?php echo Date::dodate("short_date", $this->row->created);?></p>
        <p><?php echo Lang::$word->INV_DUED;?>: <?php echo Date::doDate("short_date", $this->row->due_date);?></p>
        <p><?php echo strtoupper(Lang::$word->TOTAL);?>: <?php echo Utility::formatMoney($this->row->total, $this->row->currency);?></p></td>
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
          <td><span class="left-padding right-padding"><?php echo Lang::$word->SUBTOTAL;?></span></td>
          <td class="right aligned"><span class="left-padding"><?php echo Utility::formatNumber($this->row->subtotal);?></span></td>
        </tr>
        <?php if($this->row->tax <> 0):?>
        <tr>
          <td><span class="left-padding right-padding"><?php echo Lang::$word->TAXES;?></span></td>
          <td class="right aligned"><span class="left-padding"><?php echo Utility::formatNumber($this->row->tax);?></span></td>
        </tr>
        <?php endif;?>
        <?php if($this->row->discount <> 0):?>
        <tr>
          <td><span class="left-padding right-padding"><?php echo Lang::$word->DISC;?></span></td>
          <td class="right aligned"><span class="left-padding">- <?php echo Utility::formatNumber(($this->row->subtotal * $this->row->discount) / 100);?></span></td>
        </tr>
        <?php endif;?>
        <tr>
          <td class="wojo demi text"><span class="left-padding right-padding"><?php echo Lang::$word->TOTAL;?></span></td>
          <td class="wojo demi text right aligned"><span class="left-padding"><?php echo Utility::formatNumber($this->row->total);?></span></td>
        </tr>
        <tr>
          <td><span class="left-padding right-padding"><?php echo Lang::$word->INV_AMT_PAID;?></span></td>
          <td class="right aligned"><span class="left-padding"><?php echo Utility::formatNumber($this->row->paid_amount);?></span></td>
        </tr>
        <tr>
          <td class="wojo demi text positive"><span class="left-padding right-padding"><?php echo Lang::$word->INV_BALDUE;?> (<?php echo $this->row->currency;?>)</span></td>
          <td class="wojo demi text positive right aligned"><span class="left-padding"><?php echo Utility::formatNumber($this->row->balance_due - $this->row->paid_amount);?></span></td>
        </tr>
      </table>
    </div>
  </div>
</div>
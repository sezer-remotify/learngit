<?php
  /**
   * Load Invoice Grid
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2019
   * @version $Id: loadIvSingleGrid.tpl.php, v1.00 2019-03-02 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
	  
  if(!$data) : Message::invalid("ID" . Filter::$id); return; endif;
?>
<div class="item" id="ivitemu_<?php echo $data->id;?>">
  <div class="wojo fitted segment">
    <div class="header align spaced">
      <div class="items">
        <h4><?php echo Lang::$word->INV_INVOICE;?>
          <a href="<?php echo Url::url("/admin/invoices/view", $data->id);?>" class="inverted"><small><?php echo Content::invoiceID($data->id, $data->custom_id);?></small></a>
        </h4>
        <p class="wojo small text"><?php echo strtolower(Lang::$word->FOR);?>
          <a href="<?php echo Url::url("/admin/companies/edit", $data->company_id);?>" class="inverted"><?php echo $data->company_name;?></a>
        </p>
      </div>
      <div class="items">
        <a class="inverted" data-dropdown="#invoiceDrop_<?php echo $data->id;?>">
        <i class="icon vertical ellipsis"></i>
        </a>
        <div class="wojo dropdown small menu pointing top-right" id="invoiceDrop_<?php echo $data->id;?>">
          <!-- Start editInvoice -->
          <?php if(Auth::hasPrivileges('edit_invoice') and $data->pstatus <> 2):?>
          <a href="<?php echo Url::url("/admin/invoices/edit", $data->id);?>" class="item"><?php echo Lang::$word->EDIT;?></a>
          <?php endif;?>
          
          <!-- Start duplicateInvoice -->
          <?php if($data->recurring == 0):?>
          <a href="<?php echo Url::url("/admin/invoices/duplicate", $data->id);?>" class="item"><?php echo Lang::$word->DUPLICATE;?></a>
          <?php endif;?>
          
          <!-- Start markAsSent -->
          <?php if($data->status == 0):?>
          <a data-set='{"option":[{"action":"invoiceMarkSent","id":<?php echo $data->id;?>, "tpl":"loadIvSingleGrid.tpl"}], "label":"<?php echo Lang::$word->INV_MASEND;?>", "url":"helper.php", "parent":"#ivitemu_<?php echo $data->id;?>", "complete":"replace", "modalclass":"normal"}' class="item action"><?php echo Lang::$word->INV_MASEND;?></a>
          <?php endif;?>
          
          <!-- Start disableReminders -->
          <a id="act_<?php echo $data->id;?>" data-set='{"option":[{"action":"invoiceReminder","id":<?php echo $data->id;?>}], "label":"<?php echo $data->reminder ? Lang::$word->INV_DISREM : Lang::$word->INV_ENREM;?>", "url":"helper.php", "parent":"#act_<?php echo $data->id;?>", "complete":"replaceWith", "modalclass":"normal"}' class="item action"><?php echo $data->reminder ? Lang::$word->INV_DISREM : Lang::$word->INV_ENREM;?></a>
          
          <!-- Start sendEmail -->
          <a data-set='{"option":[{"action":"sendInvoice","id":<?php echo $data->id;?>, "tpl":"loadIvSingleGrid.tpl"}], "label":"<?php echo Lang::$word->INV_SENDIV;?>", "url":"helper.php", "parent":"#ivitemu_<?php echo $data->id;?>", "complete":"replace", "modalclass":"normal"}' class="item action"><?php echo Lang::$word->INV_SENDIVE;?></a>
          
          <!-- Start invoicePayment -->
          <?php if($data->pstatus <> 2):?>
          <a data-set='{"option":[{"action":"invoiceAddPayment","id":<?php echo $data->id;?>, "url":"<?php echo Url::uri();?>"}], "label":"<?php echo Lang::$word->INV_ADDPAY;?>", "url":"helper.php", "parent":"#ivitemu_<?php echo $data->id;?>", "redirect":true, "complete":"replace", "modalclass":"normal"}' class="item action"><?php echo Lang::$word->INV_ADDPAY;?></a>
          <?php endif;?>
          <div class="divider"></div>
          <!-- Start downloadPdf -->
          <a class="item" href="<?php echo ADMINVIEW;?>/helper.php?action=downloadInvoice&amp;id=<?php echo $data->id;?>">
          <?php echo Lang::$word->INV_DPDF;?>
          </a>
          
          <!-- Start invoiceAccess -->
          <a data-set='{"option":[{"action":"invoiceAccess","id":<?php echo $data->id;?>}], "label":"<?php echo Lang::$word->INV_ACCESS;?>", "url":"helper.php", "parent":"#ivitemu_<?php echo $data->id;?>", "complete":"highlite", "modalclass":"normal","buttons":false}' class="item action"><?php echo Lang::$word->INV_ACCESS;?></a>
          <div class="divider"></div>
          <!-- Start archiveInvoice -->
          <a data-set='{"option":[{"archive": "archiveInvoice","title": "<?php echo Content::invoiceID($data->id, $data->custom_id);?>","id": "<?php echo $data->id;?>"}],"action":"archive","subtext":"<?php echo Lang::$word->INV_CANCEL_I;?>", "parent":"#ivitemu_<?php echo $data->id;?>"}' class="wojo demi text item data">
          <?php echo Lang::$word->INV_CINV;?>
          </a>
        </div>
      </div>
    </div>
    <div class="content">
      <p><?php echo Lang::$word->INV_DUED;?>: <?php echo Date::doDate("short_date", $data->due_date);?></p>
      <p class="wojo tiny bold caps text grey basic"><?php echo Lang::$word->INV_AMOUNT;?></p>
      <p class="wojo large semi text"><?php echo Utility::formatMoney($data->total, $data->currency);?></p>
      <p class="wojo small negative text"><?php echo Lang::$word->INV_OWNING;?>
        <?php echo Utility::formatMoney(($data->balance_due - $data->paid_amount), $data->currency);?></p>
    </div>
    <div class="footer divided center aligned"><?php echo Project::invoiceStatus($data->status);?>
      <?php echo Project::invoicepStatus($data->pstatus);?></div>
  </div>
</div>
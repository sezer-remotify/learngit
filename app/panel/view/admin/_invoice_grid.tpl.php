<?php
  /**
   * Invoices Grid
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2019
   * @version $Id: _invoice_grid.tpl.php, v1.00 2019-05-05 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
?>
<div class="wojo heading message">
  <div class="content">
    <h3><?php echo Lang::$word->INV_INVOICES;?></h3>
  </div>
</div>
<div class="row gutters align bottom">
  <div class="columns phone-100">
    <div class="wojo small white stacked buttons">
      <?php if(Auth::hasPrivileges('manage_invoices')):?>
      <a href="<?php echo Url::url("/admin/invoices", "new");?>" class="wojo button"><i class="icon plus alt"></i>
      <?php echo Lang::$word->INV_NEWINV;?></a>
      <?php endif;?>
      <?php /*?><a href="<?php echo Url::url("/admin/invoices", "recurring");?>" class="wojo button"><?php echo Lang::$word->INV_TITLE7;?></a><?php */?>
      <a href="<?php echo Url::url("/admin/invoices", "canceled");?>" class="wojo button"><?php echo Lang::$word->INV_PANDC;?></a>
    </div>
  </div>
  <div class="columns auto phone-100">
    <a href="<?php echo Url::url("/admin/invoices");?>" class="wojo small primary icon button"><i class="icon reorder"></i></a>
    <a class="wojo small basic disabled icon button"><i class="icon grid"></i></a>
  </div>
</div>
<?php if(!$this->data):?>
<div class="content-center"><img src="<?php echo ADMINVIEW;?>/images/invoice_empty.png" alt="">
  <p class="wojo small bold text"><?php echo Lang::$word->INV_NOINV;?></p>
</div>
<?php else:?>
<?php if(isset($this->data[3])):?>
<!-- Start Overdue -->
<span class="wojo rounded negative label"><?php echo Lang::$word->INV_PAIDO;?></span>
<div class="wojo mason" id="overdue_">
  <?php foreach ($this->data[3] as $row):?>
  <div class="item" id="ivitemu_<?php echo $row->id;?>">
    <div class="wojo fitted segment">
      <div class="header align spaced">
        <div class="items">
          <h4><?php echo Lang::$word->INV_INVOICE;?>
            <a href="<?php echo Url::url("/admin/invoices/view", $row->id);?>"><small><?php echo Content::invoiceID($row->id, $row->custom_id);?></small></a>
          </h4>
          <p class="wojo small text"><?php echo strtolower(Lang::$word->FOR);?>
            <a href="<?php echo Url::url("/admin/companies/edit", $row->company_id);?>"><?php echo $row->company_name;?></a>
          </p>
        </div>
        <div class="items">
          <a class="grey" data-dropdown="#invoiceDrop_<?php echo $row->id;?>">
          <i class="icon vertical ellipsis"></i>
          </a>
          <div class="wojo dropdown small pointing top-right" id="invoiceDrop_<?php echo $row->id;?>">
            <!-- Start editInvoice -->
            <?php if(Auth::hasPrivileges('edit_invoice') and $row->pstatus <> 2):?>
            <a href="<?php echo Url::url("/admin/invoices/edit", $row->id);?>" class="item"><?php echo Lang::$word->EDIT;?></a>
            <?php endif;?>
            
            <!-- Start duplicateInvoice -->
            <?php if($row->recurring == 0):?>
            <a href="<?php echo Url::url("/admin/invoices/duplicate", $row->id);?>" class="item"><?php echo Lang::$word->DUPLICATE;?></a>
            <?php endif;?>
            
            <!-- Start markAsSent -->
            <?php if($row->status == 0):?>
            <a data-set='{"option":[{"action":"invoiceMarkSent","id":<?php echo $row->id;?>, "tpl":"loadIvSingleGrid.tpl"}], "label":"<?php echo Lang::$word->INV_MASEND;?>", "url":"helper.php", "parent":"#ivitemu_<?php echo $row->id;?>", "complete":"replace", "modalclass":"normal","callback":[{"type": "mason","method":"refresh", "element":"#overdue_"}]}' class="item action"><?php echo Lang::$word->INV_MASEND;?></a>
            <?php endif;?>
            
            <!-- Start disableReminders -->
            <a id="act_<?php echo $row->id;?>" data-set='{"option":[{"action":"invoiceReminder","id":<?php echo $row->id;?>}], "label":"<?php echo $row->reminder ? Lang::$word->INV_DISREM : Lang::$word->INV_ENREM;?>", "url":"helper.php", "parent":"#act_<?php echo $row->id;?>", "complete":"replaceWith", "modalclass":"normal"}' class="item action"><?php echo $row->reminder ? Lang::$word->INV_DISREM : Lang::$word->INV_ENREM;?></a>
            
            <!-- Start sendEmail -->
            <a data-set='{"option":[{"action":"sendInvoice","id":<?php echo $row->id;?>, "tpl":"loadIvSingleGrid.tpl"}], "label":"<?php echo Lang::$word->INV_SENDIV;?>", "url":"helper.php", "parent":"#ivitemu_<?php echo $row->id;?>", "complete":"replace", "modalclass":"normal","callback":[{"type": "mason","method":"refresh", "element":"#overdue_"}]}' class="item action"><?php echo Lang::$word->INV_SENDIVE;?></a>
            
            <!-- Start invoicePayment -->
            <?php if($row->pstatus <> 2):?>
            <a data-set='{"option":[{"action":"invoiceAddPayment","id":<?php echo $row->id;?>, "url":"<?php echo Url::uri();?>"}], "label":"<?php echo Lang::$word->INV_ADDPAY;?>", "url":"helper.php", "parent":"#ivitemu_<?php echo $row->id;?>", "redirect":true, "complete":"replace", "modalclass":"normal"}' class="item action"><?php echo Lang::$word->INV_ADDPAY;?></a>
            <?php endif;?>
            <div class="divider"></div>
            <!-- Start downloadPdf -->
            <a class="item" href="<?php echo ADMINVIEW;?>/helper.php?action=downloadInvoice&amp;id=<?php echo $row->id;?>">
            <?php echo Lang::$word->INV_DPDF;?>
            </a>
            
            <!-- Start invoiceAccess -->
            <a data-set='{"option":[{"action":"invoiceAccess","id":<?php echo $row->id;?>}], "label":"<?php echo Lang::$word->INV_ACCESS;?>", "url":"helper.php", "parent":"#ivitemu_<?php echo $row->id;?>", "complete":"highlite", "modalclass":"normal","buttons":false}' class="item action"><?php echo Lang::$word->INV_ACCESS;?></a>
            <div class="divider"></div>
            <!-- Start archiveInvoice -->
            <a data-set='{"option":[{"archive": "archiveInvoice","title": "<?php echo Content::invoiceID($row->id, $row->custom_id);?>","id": "<?php echo $row->id;?>"}],"action":"archive","subtext":"<?php echo Lang::$word->INV_CANCEL_I;?>", "parent":"#ivitemu_<?php echo $row->id;?>","callback":[{"type": "mason","method":"refresh", "element":"#overdue_"}]}' class="wojo demi text item data">
            <?php echo Lang::$word->INV_CINV;?>
            </a>
          </div>
        </div>
      </div>
      <div class="content">
        <p><?php echo Lang::$word->INV_DUED;?>: <?php echo Date::doDate("short_date", $row->due_date);?></p>
        <p class="wojo tiny bold caps text grey basic"><?php echo Lang::$word->INV_AMOUNT;?></p>
        <p class="wojo large semi text"><?php echo Utility::formatMoney($row->total, $row->currency);?></p>
        <p class="wojo small negative text"><?php echo Lang::$word->INV_OWNING;?>
          <?php echo Utility::formatMoney(($row->balance_due - $row->paid_amount), $row->currency);?></p>
      </div>
      <div class="footer divided center aligned"><?php echo Project::invoiceStatus($row->status);?>
        <?php echo Project::invoicepStatus($row->pstatus);?></div>
    </div>
  </div>
  <?php endforeach;?>
</div>
<?php endif;?>
<?php if(isset($this->data[0])):?>
<!-- Start Not Paid -->
<span class="wojo rounded orange label"><?php echo Lang::$word->INV_PAIDN;?></span>
<div class="wojo mason" id="notpaid_">
  <?php foreach ($this->data[0] as $row):?>
  <div class="item" id="ivitemu_<?php echo $row->id;?>">
    <div class="wojo fitted segment">
      <div class="header align spaced">
        <div class="items">
          <h4><?php echo Lang::$word->INV_INVOICE;?>
            <a href="<?php echo Url::url("/admin/invoices/view", $row->id);?>"><small><?php echo Content::invoiceID($row->id, $row->custom_id);?></small></a>
          </h4>
          <p class="wojo small text"><?php echo strtolower(Lang::$word->FOR);?>
            <a href="<?php echo Url::url("/admin/companies/edit", $row->company_id);?>"><?php echo $row->company_name;?></a>
          </p>
        </div>
        <div class="items">
          <a class="grey" data-dropdown="#invoiceDrop_<?php echo $row->id;?>">
          <i class="icon vertical ellipsis"></i>
          </a>
          <div class="wojo dropdown small pointing top-right" id="invoiceDrop_<?php echo $row->id;?>">
            <!-- Start editInvoice -->
            <?php if(Auth::hasPrivileges('edit_invoice')):?>
            <a href="<?php echo Url::url("/admin/invoices/edit", $row->id);?>" class="item"><?php echo Lang::$word->EDIT;?></a>
            <?php endif;?>
            
            <!-- Start duplicateInvoice -->
            <a href="<?php echo Url::url("/admin/invoices/duplicate", $row->id);?>" class="item"><?php echo Lang::$word->DUPLICATE;?></a>
            
            <!-- Start markAsSent -->
            <?php if($row->status == 0):?>
            <a data-set='{"option":[{"action":"invoiceMarkSent","id":<?php echo $row->id;?>, "tpl":"loadIvSingleGrid.tpl"}], "label":"<?php echo Lang::$word->INV_MASEND;?>", "url":"helper.php", "parent":"#ivitemu_<?php echo $row->id;?>", "complete":"replace", "modalclass":"normal","callback":[{"type": "mason","method":"refresh", "element":"#notpaid_"}]}' class="item action"><?php echo Lang::$word->INV_MASEND;?></a>
            <?php endif;?>
            
            <!-- Start disableReminders -->
            <a id="act_<?php echo $row->id;?>" data-set='{"option":[{"action":"invoiceReminder","id":<?php echo $row->id;?>}], "label":"<?php echo $row->reminder ? Lang::$word->INV_DISREM : Lang::$word->INV_ENREM;?>", "url":"helper.php", "parent":"#act_<?php echo $row->id;?>", "complete":"replaceWith", "modalclass":"normal"}' class="item action"><?php echo $row->reminder ? Lang::$word->INV_DISREM : Lang::$word->INV_ENREM;?></a>
            
            <!-- Start sendEmail -->
            <a data-set='{"option":[{"action":"sendInvoice","id":<?php echo $row->id;?>, "tpl":"loadIvSingleGrid.tpl"}], "label":"<?php echo Lang::$word->INV_SENDIV;?>", "url":"helper.php", "parent":"#ivitemu_<?php echo $row->id;?>", "complete":"replace", "modalclass":"normal","callback":[{"type": "mason","method":"refresh", "element":"#notpaid_"}]}' class="item action"><?php echo Lang::$word->INV_SENDIVE;?></a>
            
            <!-- Start invoicePayment -->
            <?php if($row->pstatus <> 2):?>
            <a data-set='{"option":[{"action":"invoiceAddPayment","id":<?php echo $row->id;?>, "url":"<?php echo Url::uri();?>"}], "label":"<?php echo Lang::$word->INV_ADDPAY;?>", "url":"helper.php", "parent":"#ivitemu_<?php echo $row->id;?>", "redirect":true, "complete":"replace", "modalclass":"normal"}' class="item action"><?php echo Lang::$word->INV_ADDPAY;?></a>
            <?php endif;?>
            <div class="divider"></div>
            <!-- Start downloadPdf -->
            <a class="item" href="<?php echo ADMINVIEW;?>/helper.php?action=downloadInvoice&amp;id=<?php echo $row->id;?>">
            <?php echo Lang::$word->INV_DPDF;?>
            </a>
            
            <!-- Start invoiceAccess -->
            <a data-set='{"option":[{"action":"invoiceAccess","id":<?php echo $row->id;?>}], "label":"<?php echo Lang::$word->INV_ACCESS;?>", "url":"helper.php", "parent":"#ivitemu_<?php echo $row->id;?>", "complete":"highlite", "modalclass":"normal","buttons":false}' class="item action"><?php echo Lang::$word->INV_ACCESS;?></a>
            <div class="divider"></div>
            <!-- Start archiveInvoice -->
            <a data-set='{"option":[{"archive": "archiveInvoice","title": "<?php echo Content::invoiceID($row->id, $row->custom_id);?>","id": "<?php echo $row->id;?>"}],"action":"archive","subtext":"<?php echo Lang::$word->INV_CANCEL_I;?>", "parent":"#ivitemu_<?php echo $row->id;?>"}' class="wojo demi text item data">
            <?php echo Lang::$word->INV_CINV;?>
            </a>
          </div>
        </div>
      </div>
      <div class="content">
        <p><?php echo Lang::$word->INV_DUED;?>: <?php echo Date::doDate("short_date", $row->due_date);?></p>
        <p class="wojo tiny bold caps text grey basic"><?php echo Lang::$word->INV_AMOUNT;?></p>
        <p class="wojo large semi text"><?php echo Utility::formatMoney($row->total, $row->currency);?></p>
        <p class="wojo small negative text"><?php echo Lang::$word->INV_OWNING;?>
          <?php echo Utility::formatMoney(($row->balance_due - $row->paid_amount), $row->currency);?></p>
      </div>
      <div class="footer divided center aligned"><?php echo Project::invoiceStatus($row->status);?>
        <?php echo Project::invoicepStatus($row->pstatus);?></div>
    </div>
  </div>
  <?php endforeach;?>
</div>
<?php endif;?>
<?php if(isset($this->data[1])):?>
<!-- Start Partial Pay -->
<span class="wojo rounded secondary label"><?php echo Lang::$word->INV_PAIDP;?></span>
<div class="wojo mason" id="partialpay_">
  <?php foreach ($this->data[1] as $row):?>
  <div class="item" id="ivitemu_<?php echo $row->id;?>">
    <div class="wojo fitted segment">
      <div class="header align spaced">
        <div class="items">
          <h4><?php echo Lang::$word->INV_INVOICE;?>
            <a href="<?php echo Url::url("/admin/invoices/view", $row->id);?>"><small><?php echo Content::invoiceID($row->id, $row->custom_id);?></small></a>
          </h4>
          <p class="wojo small text"><?php echo strtolower(Lang::$word->FOR);?>
            <a href="<?php echo Url::url("/admin/companies/edit", $row->company_id);?>"><?php echo $row->company_name;?></a>
          </p>
        </div>
        <div class="items">
          <a class="grey" data-dropdown="#invoiceDrop_<?php echo $row->id;?>">
          <i class="icon vertical ellipsis"></i>
          </a>
          <div class="wojo dropdown small pointing top-right" id="invoiceDrop_<?php echo $row->id;?>">
            <!-- Start editInvoice -->
            <?php if(Auth::hasPrivileges('edit_invoice')):?>
            <a href="<?php echo Url::url("/admin/invoices/edit", $row->id);?>" class="item"><?php echo Lang::$word->EDIT;?></a>
            <?php endif;?>
            
            <!-- Start duplicateInvoice -->
            <a href="<?php echo Url::url("/admin/invoices/duplicate", $row->id);?>" class="item"><?php echo Lang::$word->DUPLICATE;?></a>
            
            <!-- Start markAsSent -->
            <?php if($row->status == 0):?>
            <a data-set='{"option":[{"action":"invoiceMarkSent","id":<?php echo $row->id;?>, "tpl":"loadIvSingleGrid.tpl"}], "label":"<?php echo Lang::$word->INV_MASEND;?>", "url":"helper.php", "parent":"#ivitemu_<?php echo $row->id;?>", "complete":"replace", "modalclass":"normal","callback":[{"type": "mason","method":"refresh", "element":"#partialpay_"}]}' class="item action"><?php echo Lang::$word->INV_MASEND;?></a>
            <?php endif;?>
            
            <!-- Start disableReminders -->
            <a id="act_<?php echo $row->id;?>" data-set='{"option":[{"action":"invoiceReminder","id":<?php echo $row->id;?>}], "label":"<?php echo $row->reminder ? Lang::$word->INV_DISREM : Lang::$word->INV_ENREM;?>", "url":"helper.php", "parent":"#act_<?php echo $row->id;?>", "complete":"replaceWith", "modalclass":"normal"}' class="item action"><?php echo $row->reminder ? Lang::$word->INV_DISREM : Lang::$word->INV_ENREM;?></a>
            
            <!-- Start sendEmail -->
            <a data-set='{"option":[{"action":"sendInvoice","id":<?php echo $row->id;?>, "tpl":"loadIvSingleGrid.tpl"}], "label":"<?php echo Lang::$word->INV_SENDIV;?>", "url":"helper.php", "parent":"#ivitemu_<?php echo $row->id;?>", "complete":"replace", "modalclass":"normal","callback":[{"type": "mason","method":"refresh", "element":"#partialpay_"}]}' class="item action"><?php echo Lang::$word->INV_SENDIVE;?></a>
            
            <!-- Start invoicePayment -->
            <?php if($row->pstatus <> 2):?>
            <a data-set='{"option":[{"action":"invoiceAddPayment","id":<?php echo $row->id;?>, "url":"<?php echo Url::uri();?>"}], "label":"<?php echo Lang::$word->INV_ADDPAY;?>", "url":"helper.php", "parent":"#ivitemu_<?php echo $row->id;?>", "redirect":true, "complete":"replace", "modalclass":"normal"}' class="item action"><?php echo Lang::$word->INV_ADDPAY;?></a>
            <?php endif;?>
            <div class="divider"></div>
            <!-- Start downloadPdf -->
            <a class="item" href="<?php echo ADMINVIEW;?>/helper.php?action=downloadInvoice&amp;id=<?php echo $row->id;?>">
            <?php echo Lang::$word->INV_DPDF;?>
            </a>
            
            <!-- Start invoiceAccess -->
            <a data-set='{"option":[{"action":"invoiceAccess","id":<?php echo $row->id;?>}], "label":"<?php echo Lang::$word->INV_ACCESS;?>", "url":"helper.php", "parent":"#ivitemu_<?php echo $row->id;?>", "complete":"highlite", "modalclass":"normal","buttons":false}' class="item action"><?php echo Lang::$word->INV_ACCESS;?></a>
            <div class="divider"></div>
            <!-- Start archiveInvoice -->
            <a data-set='{"option":[{"archive": "archiveInvoice","title": "<?php echo Content::invoiceID($row->id, $row->custom_id);?>","id": "<?php echo $row->id;?>"}],"action":"archive","subtext":"<?php echo Lang::$word->INV_CANCEL_I;?>", "parent":"#ivitemu_<?php echo $row->id;?>"}' class="wojo demi text item data">
            <?php echo Lang::$word->INV_CINV;?>
            </a>
          </div>
        </div>
      </div>
      <div class="content">
        <p><?php echo Lang::$word->INV_DUED;?>: <?php echo Date::doDate("short_date", $row->due_date);?></p>
        <p class="wojo tiny bold caps text grey basic"><?php echo Lang::$word->INV_AMOUNT;?></p>
        <p class="wojo large semi text"><?php echo Utility::formatMoney($row->total, $row->currency);?></p>
        <p class="wojo small negative text"><?php echo Lang::$word->INV_OWNING;?>
          <?php echo Utility::formatMoney(($row->balance_due - $row->paid_amount), $row->currency);?></p>
      </div>
      <div class="footer divided center aligned"><?php echo Project::invoiceStatus($row->status);?>
        <?php echo Project::invoicepStatus($row->pstatus);?></div>
    </div>
  </div>
  <?php endforeach;?>
</div>
<?php endif;?>
<?php if(isset($this->data[2])):?>
<!-- Start Paid -->
<span class="wojo rounded positive label"><?php echo Lang::$word->INV_PAID;?></span>
<div class="wojo mason" id="paid_">
  <?php foreach ($this->data[2] as $row):?>
  <div class="item" id="ivitemu_<?php echo $row->id;?>">
    <div class="wojo fitted segment">
      <div class="header align spaced">
        <div class="items">
          <h4><?php echo Lang::$word->INV_INVOICE;?>
            <a href="<?php echo Url::url("/admin/invoices/view", $row->id);?>" class="inverted">
            <small><?php echo Content::invoiceID($row->id, $row->custom_id);?></small></a>
          </h4>
          <p class="wojo small text"><?php echo strtolower(Lang::$word->FOR);?>
            <a href="<?php echo Url::url("/admin/companies/edit", $row->company_id);?>" class="inverted"><?php echo $row->company_name;?></a>
          </p>
        </div>
        <div class="items">
          <a class="grey" data-dropdown="#invoiceDrop_<?php echo $row->id;?>">
          <i class="icon vertical ellipsis"></i>
          </a>
          <div class="wojo dropdown small pointing top-right" id="invoiceDrop_<?php echo $row->id;?>">
            <!-- Start editInvoice -->
            <?php if(Auth::hasPrivileges('edit_invoice')):?>
            <a href="<?php echo Url::url("/admin/invoices/edit", $row->id);?>" class="item"><?php echo Lang::$word->EDIT;?></a>
            <?php endif;?>
            
            <!-- Start duplicateInvoice -->
            <a href="<?php echo Url::url("/admin/invoices/duplicate", $row->id);?>" class="item"><?php echo Lang::$word->DUPLICATE;?></a>
            
            <!-- Start markAsSent -->
            <?php if($row->status == 0):?>
            <a data-set='{"option":[{"action":"invoiceMarkSent","id":<?php echo $row->id;?>, "tpl":"loadIvSingleGrid.tpl"}], "label":"<?php echo Lang::$word->INV_MASEND;?>", "url":"helper.php", "parent":"#ivitemu_<?php echo $row->id;?>", "complete":"replace", "modalclass":"normal","callback":[{"type": "mason","method":"refresh", "element":"#paid_"}]}' class="item action"><?php echo Lang::$word->INV_MASEND;?></a>
            <?php endif;?>
            
            <!-- Start sendEmail -->
            <a data-set='{"option":[{"action":"sendInvoice","id":<?php echo $row->id;?>, "tpl":"loadIvSingleGrid.tpl"}], "label":"<?php echo Lang::$word->INV_SENDIV;?>", "url":"helper.php", "parent":"#ivitemu_<?php echo $row->id;?>", "complete":"replace", "modalclass":"normal","callback":[{"type": "mason","method":"refresh", "element":"#paid_"}]}' class="item action"><?php echo Lang::$word->INV_SENDIVE;?></a>
            <div class="divider"></div>
            <!-- Start downloadPdf -->
            <a class="item" href="<?php echo ADMINVIEW;?>/helper.php?downloadInvoice=1&amp;id=<?php echo $row->id;?>"><?php echo Lang::$word->INV_DPDF;?></a>
            
            <!-- Start invoiceAccess -->
            <a data-set='{"option":[{"action":"invoiceAccess","id":<?php echo $row->id;?>}], "label":"<?php echo Lang::$word->INV_ACCESS;?>", "url":"helper.php", "parent":"#ivitemu_<?php echo $row->id;?>", "complete":"highlite", "modalclass":"normal","buttons":false}' class="item action"><?php echo Lang::$word->INV_ACCESS;?></a>
            <div class="divider"></div>
            <!-- Start archiveInvoice -->
            <a data-set='{"option":[{"archive": "archiveInvoice","title": "<?php echo Content::invoiceID($row->id, $row->custom_id);?>","id": "<?php echo $row->id;?>"}],"action":"archive","subtext":"<?php echo Lang::$word->INV_CANCEL_I;?>", "parent":"#ivitemu_<?php echo $row->id;?>"}' class="wojo demi text item data">
            <?php echo Lang::$word->INV_CINV;?>
            </a>
          </div>
        </div>
      </div>
      <div class="content">
        <p><?php echo Lang::$word->INV_DUED;?>: <?php echo Date::doDate("short_date", $row->due_date);?></p>
        <p class="wojo tiny bold caps text grey basic"><?php echo Lang::$word->INV_AMOUNT;?></p>
        <p class="wojo large semi text"><?php echo Utility::formatMoney($row->total, $row->currency);?></p>
        <p class="wojo small positive text"><?php echo Lang::$word->INV_OWNING;?>
          <?php echo Utility::formatMoney(($row->balance_due - $row->paid_amount), $row->currency);?></p>
      </div>
      <div class="footer divided center aligned"><?php echo Project::invoiceStatus($row->status);?>
        <?php echo Project::invoicepStatus($row->pstatus);?></div>
    </div>
  </div>
  <?php endforeach;?>
</div>
<?php endif;?>
<?php endif;?>
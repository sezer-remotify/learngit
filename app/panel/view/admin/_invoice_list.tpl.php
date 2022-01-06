<?php
  /**
   * Invoices List
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2019
   * @version $Id: _invoice_list.tpl.php, v1.00 2019-05-05 10:12:05 gewa Exp $
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
    <a class="wojo small basic disabled icon button"><i class="icon reorder"></i></a>
    <a href="<?php echo Url::url("/admin/invoices/grid");?>" class="wojo small primary icon button"><i class="icon grid"></i></a>
  </div>
</div>
<?php if(!$this->data):?>
<div class="center aligned"><img src="<?php echo ADMINVIEW;?>/images/invoice_empty.svg" alt="" class="wojo center large image">
  <p class="wojo semi grey text"><?php echo Lang::$word->INV_NOINV;?></p>
</div>
<?php else:?>
<?php if(isset($this->data[3])):?>
<!-- Start Overdue -->
<div class="wojo fitted segment">
  <div class="wojo header text negative">
    <h4>
      <?php echo Lang::$word->INV_PAIDO;?>
    </h4>
  </div>
  <div class="content">
    <table class="wojo basic table responsive">
      <thead>
        <tr>
          <th class="two wide">#ID</th>
          <th class="three wide"><?php echo Lang::$word->CLIENT;?></th>
          <th class="three wide"><?php echo Lang::$word->INV_DUED;?></th>
          <th class="two wide"><?php echo Lang::$word->INV_AMOUNT;?></th>
          <th class="two wide"><?php echo Lang::$word->INV_OWNING;?></th>
          <th class="three wide"><?php echo Lang::$word->STATUS;?></th>
          <th class="one wide"></th>
        </tr>
      </thead>
      <?php foreach($this->data[3] as $row):?>
      <tr id="ivitemu_<?php echo $row->id;?>">
        <td><a href="<?php echo Url::url("/admin/invoices/view", $row->id);?>" class="wojo tiny bold text"><?php echo Content::invoiceID($row->id, $row->custom_id);?></a></td>
        <td><a href="<?php echo Url::url("/admin/companies/edit", $row->company_id);?>" class="grey"><?php echo $row->company_name;?></a></td>
        <td><?php echo Date::doDate("short_date", $row->due_date);?></td>
        <td><?php echo Utility::formatMoney($row->total, $row->currency);?></td>
        <td><?php echo Utility::formatMoney(($row->balance_due - $row->paid_amount), $row->currency);?></td>
        <td><?php echo Project::invoiceStatus($row->status);?>
          <?php echo Project::invoicepStatus($row->pstatus);?></td>
        <td class="right aligned"><a class="wojo small simple icon button" data-dropdown="#invoiceDrop_<?php echo $row->id;?>">
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
            <a data-set='{"option":[{"action":"invoiceMarkSent","id":<?php echo $row->id;?>, "tpl":"loadIvSingleList"}], "label":"<?php echo Lang::$word->INV_MASEND;?>", "url":"helper.php", "parent":"#ivitemu_<?php echo $row->id;?>", "complete":"replace", "modalclass":"normal"}' class="item action"><?php echo Lang::$word->INV_MASEND;?></a>
            <?php endif;?>
            
            <!-- Start disableReminders -->
            <a id="act_<?php echo $row->id;?>" data-set='{"option":[{"action":"invoiceReminder","id":<?php echo $row->id;?>}], "label":"<?php echo $row->reminder ? Lang::$word->INV_DISREM : Lang::$word->INV_ENREM;?>", "url":"helper.php", "parent":"#act_<?php echo $row->id;?>", "complete":"replaceWith", "modalclass":"normal"}' class="item action"><?php echo $row->reminder ? Lang::$word->INV_DISREM : Lang::$word->INV_ENREM;?></a>
            
            <!-- Start sendEmail -->
            <a data-set='{"option":[{"action":"sendInvoice","id":<?php echo $row->id;?>, "tpl":"loadIvSingleList"}], "label":"<?php echo Lang::$word->INV_SENDIV;?>", "url":"helper.php", "parent":"#ivitemu_<?php echo $row->id;?>", "complete":"replace", "modalclass":"normal"}' class="item action"><?php echo Lang::$word->INV_SENDIVE;?></a>
            
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
          </div></td>
      </tr>
      <?php endforeach;?>
      <?php unset($row);?>
    </table>
  </div>
</div>
<?php endif;?>
<?php if(isset($this->data[0])):?>
<!-- Start Not Paid -->
<div class="wojo fitted segment">
  <div class="wojo header text">
    <h4>
      <?php echo Lang::$word->INV_PAIDN;?>
    </h4>
  </div>
  <div class="content">
    <table class="wojo basic table responsive">
      <thead>
        <tr>
          <th class="two wide">#ID</th>
          <th class="three wide"><?php echo Lang::$word->CLIENT;?></th>
          <th class="three wide"><?php echo Lang::$word->INV_DUED;?></th>
          <th class="two wide"><?php echo Lang::$word->INV_AMOUNT;?></th>
          <th class="two wide"><?php echo Lang::$word->INV_OWNING;?></th>
          <th class="three wide"><?php echo Lang::$word->STATUS;?></th>
          <th class="one wide"></th>
        </tr>
      </thead>
      <?php foreach($this->data[0] as $row):?>
      <tr id="ivitemu_<?php echo $row->id;?>">
        <td><a href="<?php echo Url::url("/admin/invoices/view", $row->id);?>" class="wojo tiny bold text"><?php echo Content::invoiceID($row->id, $row->custom_id);?></a></td>
        <td><a href="<?php echo Url::url("/admin/companies/edit", $row->company_id);?>" class="grey"><?php echo $row->company_name;?></a></td>
        <td><?php echo Date::doDate("short_date", $row->due_date);?></td>
        <td><?php echo Utility::formatMoney($row->total, $row->currency);?></td>
        <td><?php echo Utility::formatMoney(($row->balance_due - $row->paid_amount), $row->currency);?></td>
        <td><?php echo Project::invoiceStatus($row->status);?>
          <?php echo Project::invoicepStatus($row->pstatus);?></td>
        <td class="right aligned"><a class="wojo small simple icon button" data-dropdown="#invoiceDrop_<?php echo $row->id;?>">
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
            <a data-set='{"option":[{"action":"invoiceMarkSent","id":<?php echo $row->id;?>, "tpl":"loadIvSingleList"}], "label":"<?php echo Lang::$word->INV_MASEND;?>", "url":"helper.php", "parent":"#ivitemu_<?php echo $row->id;?>", "complete":"replace", "modalclass":"normal"}' class="item action"><?php echo Lang::$word->INV_MASEND;?></a>
            <?php endif;?>
            
            <!-- Start disableReminders -->
            <a id="act_<?php echo $row->id;?>" data-set='{"option":[{"action":"invoiceReminder","id":<?php echo $row->id;?>}], "label":"<?php echo $row->reminder ? Lang::$word->INV_DISREM : Lang::$word->INV_ENREM;?>", "url":"helper.php", "parent":"#act_<?php echo $row->id;?>", "complete":"replaceWith", "modalclass":"normal"}' class="item action"><?php echo $row->reminder ? Lang::$word->INV_DISREM : Lang::$word->INV_ENREM;?></a>
            
            <!-- Start sendEmail -->
            <a data-set='{"option":[{"action":"sendInvoice","id":<?php echo $row->id;?>, "tpl":"loadIvSingleList"}], "label":"<?php echo Lang::$word->INV_SENDIV;?>", "url":"helper.php", "parent":"#ivitemu_<?php echo $row->id;?>", "complete":"replace", "modalclass":"normal"}' class="item action"><?php echo Lang::$word->INV_SENDIVE;?></a>
            
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
          </div></td>
      </tr>
      <?php endforeach;?>
      <?php unset($row);?>
    </table>
  </div>
</div>
<?php endif;?>
<?php if(isset($this->data[1])):?>
<!-- Start Partial Pay -->
<div class="wojo fitted segment">
  <div class="wojo header text secondary">
    <h4>
      <?php echo Lang::$word->INV_PAIDP;?>
    </h4>
  </div>
  <div class="content">
    <table class="wojo basic table responsive">
      <thead>
        <tr>
          <th class="two wide">#ID</th>
          <th class="three wide"><?php echo Lang::$word->CLIENT;?></th>
          <th class="three wide"><?php echo Lang::$word->INV_DUED;?></th>
          <th class="two wide"><?php echo Lang::$word->INV_AMOUNT;?></th>
          <th class="two wide"><?php echo Lang::$word->INV_OWNING;?></th>
          <th class="three wide"><?php echo Lang::$word->STATUS;?></th>
          <th class="one wide"></th>
        </tr>
      </thead>
      <?php foreach($this->data[1] as $row):?>
      <tr id="ivitemu_<?php echo $row->id;?>">
        <td><a href="<?php echo Url::url("/admin/invoices/view", $row->id);?>" class="wojo tiny bold text"><?php echo Content::invoiceID($row->id, $row->custom_id);?></a></td>
        <td><a href="<?php echo Url::url("/admin/companies/edit", $row->company_id);?>" class="grey"><?php echo $row->company_name;?></a></td>
        <td><?php echo Date::doDate("short_date", $row->due_date);?></td>
        <td><?php echo Utility::formatMoney($row->total, $row->currency);?></td>
        <td><?php echo Utility::formatMoney(($row->balance_due - $row->paid_amount), $row->currency);?></td>
        <td><?php echo Project::invoiceStatus($row->status);?>
          <?php echo Project::invoicepStatus($row->pstatus);?></td>
        <td class="right aligned"><a class="wojo small simple icon button" data-dropdown="#invoiceDrop_<?php echo $row->id;?>">
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
            <a data-set='{"option":[{"action":"invoiceMarkSent","id":<?php echo $row->id;?>, "tpl":"loadIvSingleList"}], "label":"<?php echo Lang::$word->INV_MASEND;?>", "url":"helper.php", "parent":"#ivitemu_<?php echo $row->id;?>", "complete":"replace", "modalclass":"normal"}' class="item action"><?php echo Lang::$word->INV_MASEND;?></a>
            <?php endif;?>
            
            <!-- Start disableReminders -->
            <a id="act_<?php echo $row->id;?>" data-set='{"option":[{"action":"invoiceReminder","id":<?php echo $row->id;?>}], "label":"<?php echo $row->reminder ? Lang::$word->INV_DISREM : Lang::$word->INV_ENREM;?>", "url":"helper.php", "parent":"#act_<?php echo $row->id;?>", "complete":"replaceWith", "modalclass":"normal"}' class="item action"><?php echo $row->reminder ? Lang::$word->INV_DISREM : Lang::$word->INV_ENREM;?></a>
            
            <!-- Start sendEmail -->
            <a data-set='{"option":[{"action":"sendInvoice","id":<?php echo $row->id;?>, "tpl":"loadIvSingleList"}], "label":"<?php echo Lang::$word->INV_SENDIV;?>", "url":"helper.php", "parent":"#ivitemu_<?php echo $row->id;?>", "complete":"replace", "modalclass":"normal"}' class="item action"><?php echo Lang::$word->INV_SENDIVE;?></a>
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
          </div></td>
      </tr>
      <?php endforeach;?>
      <?php unset($row);?>
    </table>
  </div>
</div>
<?php endif;?>
<?php if(isset($this->data[2])):?>
<!-- Start Paid -->
<div class="wojo fitted segment">
  <div class="wojo header text positive">
    <h4>
      <?php echo Lang::$word->INV_PAID;?>
    </h4>
  </div>
  <div class="content">
    <table class="wojo basic table responsive">
      <thead>
        <tr>
          <th class="two wide">#ID</th>
          <th class="three wide"><?php echo Lang::$word->CLIENT;?></th>
          <th class="three wide"><?php echo Lang::$word->INV_DUED;?></th>
          <th class="two wide"><?php echo Lang::$word->INV_AMOUNT;?></th>
          <th class="two wide"><?php echo Lang::$word->INV_OWNING;?></th>
          <th class="three wide"><?php echo Lang::$word->STATUS;?></th>
          <th class="one wide"></th>
        </tr>
      </thead>
      <?php foreach($this->data[2] as $row):?>
      <tr id="ivitemu_<?php echo $row->id;?>">
        <td><a href="<?php echo Url::url("/admin/invoices/view", $row->id);?>" class="wojo tiny bold text"><?php echo Content::invoiceID($row->id, $row->custom_id);?></a></td>
        <td><a href="<?php echo Url::url("/admin/companies/edit", $row->company_id);?>" class="grey"><?php echo $row->company_name;?></a></td>
        <td><?php echo Date::doDate("short_date", $row->due_date);?></td>
        <td><?php echo Utility::formatMoney($row->total, $row->currency);?></td>
        <td><?php echo Utility::formatMoney(($row->balance_due - $row->paid_amount), $row->currency);?></td>
        <td><?php echo Project::invoiceStatus($row->status);?>
          <?php echo Project::invoicepStatus($row->pstatus);?></td>
        <td class="right aligned"><a class="wojo small simple icon button" data-dropdown="#invoiceDrop_<?php echo $row->id;?>">
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
            <a data-set='{"option":[{"action":"invoiceMarkSent","id":<?php echo $row->id;?>, "tpl":"loadIvSingleList"}], "label":"<?php echo Lang::$word->INV_MASEND;?>", "url":"helper.php", "parent":"#ivitemu_<?php echo $row->id;?>", "complete":"replace", "modalclass":"normal"}' class="item action"><?php echo Lang::$word->INV_MASEND;?></a>
            <?php endif;?>
            
            <!-- Start sendEmail -->
            <a data-set='{"option":[{"action":"sendInvoice","id":<?php echo $row->id;?>, "tpl":"loadIvSingleList"}], "label":"<?php echo Lang::$word->INV_SENDIV;?>", "url":"helper.php", "parent":"#ivitemu_<?php echo $row->id;?>", "complete":"replace", "modalclass":"normal"}' class="item action"><?php echo Lang::$word->INV_SENDIVE;?></a>
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
          </div></td>
      </tr>
      <?php endforeach;?>
      <?php unset($row);?>
    </table>
  </div>
</div>
<?php endif;?>
<?php endif;?>
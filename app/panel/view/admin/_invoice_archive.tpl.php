<?php
  /**
   * Invoices Archive
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2019
   * @version $Id: _invoice_archive.tpl.php, v1.00 2019-05-05 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
?>
<h3><?php echo Lang::$word->INV_PANDC;?></h3>
<div class="wojo small white stacked buttons">
  <?php if(Auth::hasPrivileges('manage_invoices')):?>
  <a href="<?php echo Url::url("/admin/invoices", "new");?>" class="wojo button"><i class="icon plus alt"></i>
  <?php echo Lang::$word->INV_NEWINV;?></a>
  <?php endif;?>
  <?php /*?><a href="<?php echo Url::url("/admin/invoices", "recurring");?>" class="wojo button"><?php echo Lang::$word->INV_TITLE7;?></a><?php */?>
  <a class="wojo button active disabled"><?php echo Lang::$word->INV_PANDC;?></a>
</div>
<?php if(!$this->data):?>
<div class="center aligned"><img src="<?php echo ADMINVIEW;?>/images/invoice_empty.svg" alt="" class="wojo center large image">
  <p class="wojo semi grey text"><?php echo Lang::$word->INV_NOINV;?></p>
</div>
<?php else:?>
<table class="wojo segment spaced table">
  <thead>
    <tr>
      <th class="two wide">#ID</th>
      <th class="three wide"><?php echo Lang::$word->CLIENT;?></th>
      <th class="three wide"><?php echo Lang::$word->INV_DUED;?></th>
      <th class="two wide"><?php echo Lang::$word->INV_AMOUNT;?></th>
      <th class="two wide"><?php echo Lang::$word->INV_OWNING;?></th>
      <th class="three wide"><?php echo Lang::$word->STATUS;?></th>
      <th class="auto"></th>
    </tr>
  </thead>
  <?php foreach($this->data as $row):?>
  <tr id="ivitemu_<?php echo $row->id;?>">
    <td><a href="<?php echo Url::url("/admin/invoices/view", $row->id);?>" class="wojo tiny bold text"><?php echo Content::invoiceID($row->id, $row->custom_id);?></a></td>
    <td><a href="<?php echo Url::url("/admin/companies/edit", $row->company_id);?>" class="inverted"><?php echo $row->company_name;?></a></td>
    <td><?php echo Date::doDate("short_date", $row->due_date);?></td>
    <td><?php echo Utility::formatMoney($row->total, $row->currency);?></td>
    <td><?php echo Utility::formatMoney(($row->balance_due - $row->paid_amount), $row->currency);?></td>
    <td><?php echo Project::invoiceStatus($row->status);?>
      <?php echo Project::invoicepStatus($row->pstatus);?></td>
    <td class="right aligned"><a class="wojo simple icon button" data-dropdown="#invoiceDrop_<?php echo $row->id;?>">
      <i class="icon vertical ellipsis"></i>
      </a>
      <div class="wojo dropdown small pointing top-right" id="invoiceDrop_<?php echo $row->id;?>">
        <!-- Start duplicateInvoice -->
        <?php if($row->recurring == 0):?>
        <a href="<?php echo Url::url("/admin/invoices/duplicate", $row->id);?>" class="item"><?php echo Lang::$word->DUPLICATE;?></a>
        <?php endif;?>
        
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
<?php endif;?>
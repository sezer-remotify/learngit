<?php
  /**
   * Load Estimate Full View
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2019
   * @version $Id: loadEsSingleFullView.tpl.php, v1.00 2019-03-02 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
?>
<div class="full padding">
  <div class="row align middle">
    <div class="columns mobile-100 phone-100">
      <!-- Start sendEmail -->
      <a data-set='{"option":[{"action":"sendEstimate","id":<?php echo $this->row->id;?>, "tpl":"loadEsSingleFullView"}], "label":"<?php echo Lang::$word->INV_SENDIV;?>", "url":"helper.php", "parent":"#ivdata", "complete":"replace", "modalclass":"normal"}' class="wojo simple compact button action"><?php echo $this->row->status ? Lang::$word->INV_RESEND : Lang::$word->INV_SENDIVE;?></a>
      <?php if($this->row->status <> 3):?>
      <!-- Start markAsWon -->
      <a data-set='{"option":[{"iaction":"estimateMarkWon","id":<?php echo $this->row->id;?>, "name":"<?php echo Validator::sanitize($this->row->title, "chars");?>"}], "url":"/helper.php", "parent":"#ivdata", "complete":"remove"}' class="wojo simple compact button iaction"><?php echo Lang::$word->EST_MARKWON;?></a>
      <?php endif;?>
      <?php if($this->row->status <> 2):?>
      <!-- Start markAsLost -->
      <a data-set='{"option":[{"iaction":"estimateMarkLost","id":<?php echo $this->row->id;?>, "name":"<?php echo Validator::sanitize($this->row->title, "chars");?>"}], "url":"/helper.php", "parent":"#ivdata", "complete":"remove"}' class="wojo simple compact button iaction"><?php echo Lang::$word->EST_MARKLOST;?></a>
      <?php endif;?>
    </div>
    <div class="columns auto mobile-100 phone-100">
      <a class="wojo small basic circular icon button" href="<?php echo Url::url("/admin/estimates/edit", $this->row->id);?>"><i class="icon pencil"></i></a>
      <a class="wojo small basic circular icon button" href="<?php echo ADMINVIEW;?>/helper.php?action=downloadEstimate&amp;id=<?php echo $this->row->id;?>"><i class="icon download"></i></a>
      <a class="wojo small basic circular icon button" data-dropdown="#estimateDrop_<?php echo $this->row->id;?>">
      <i class="icon horizontal ellipsis"></i>
      </a>
      <div class="wojo dropdown small pointing top-right" id="estimateDrop_<?php echo $this->row->id;?>">
        <!-- Start createInvoice -->
        <a href="<?php echo Url::url("/admin/estimates/invoice", $this->row->id);?>" class="item"><?php echo Lang::$word->INV_CREATE;?></a>
        <?php if($this->row->status == 3):?>
        <!-- Start startProject -->
        <a href="<?php echo Url::url("/admin/estimates/project", $this->row->id);?>" class="item"><?php echo Lang::$word->EST_STARTP;?></a>
        <?php endif;?>
        <!-- Start duplicateEstimate -->
        <a href="<?php echo Url::url("/admin/estimates/duplicate", $this->row->id);?>" class="item"><?php echo Lang::$word->DUPLICATE;?></a>
        <div class="divider"></div>
        <!-- Start trashEstimate -->
        <a data-set='{"option":[{"trash": "trashEstimate","title": "<?php echo Validator::sanitize($this->row->title, "chars");?>","id": "<?php echo $this->row->id;?>", "redirect": "<?php echo Url::url("/admin/estimates");?>"}],"action":"trash","subtext":"<?php echo Lang::$word->INV_CANCEL_I;?>", "parent":"#ivdata"}' class="wojo demi text item data">
        <?php echo Lang::$word->MTOTRASH;?>
        </a>
      </div>
    </div>
  </div>
</div>
<div class="wojo attached secondary message align spaced">
  <?php echo($this->row->status) ? Lang::$word->EST_SUB4 : Lang::$word->EST_SUB3;?>
  <div>
    <?php echo Content::estimateStatus($this->row->status);?>
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
          <td class="wojo demi text positive"><span class="left-padding right-padding"><?php echo Lang::$word->TOTAL;?></span></td>
          <td class="wojo demi text positive right aligned"><span class="left-padding"><?php echo Utility::formatNumber($this->row->total);?></span></td>
        </tr>
      </table>
    </div>
  </div>
</div>
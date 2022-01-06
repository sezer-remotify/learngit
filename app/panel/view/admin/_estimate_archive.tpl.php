<?php
  /**
   * Estimates Archive
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2019
   * @version $Id: _estimate_archive.tpl.php, v1.00 2019-05-05 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
?>
<h3><?php echo Lang::$word->ADM_ESTIMATES;?></h3>
<div class="wojo small white stacked buttons">
  <a href="<?php echo Url::url("/admin/estimates", "new");?>" class="wojo button"><i class="icon plus alt"></i>
  <?php echo Lang::$word->EST_NEWEST;?></a>
  <a class="wojo button active disabled"><?php echo Lang::$word->EST_TITLE1;?></a>
</div>
<?php if(!$this->data):?>
<div class="content-center"><img src="<?php echo ADMINVIEW;?>/images/estimates_empty.png" alt="">
  <p class="wojo small bold text"><?php echo Lang::$word->EST_NOEST;?></p>
</div>
<?php else:?>
<?php foreach($this->data as $year => $rows):?>
<table class="wojo basic table segment">
  <thead>
    <tr>
      <th class="five wide"><?php echo $year;?></th>
      <th class="four wide"><?php echo Lang::$word->CLIENT;?></th>
      <th class="three wide right aligned"><?php echo Lang::$word->INV_AMOUNT;?></th>
      <th class="three wide"><?php echo Lang::$word->STATUS;?></th>
      <th class="one wide"></th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($rows as $row):?>
    <tr id="ivitemu_<?php echo $row->id;?>">
      <td><a href="<?php echo Url::url("/admin/estimates/view", $row->id);?>">
        <?php echo $row->title;?></a></td>
      <td><a href="<?php echo Url::url("/admin/companies/edit", $row->company_id);?>" class="grey"><?php echo $row->company_name;?></a></td>
      <td class="right aligned"><?php echo Utility::formatMoney($row->total, $row->currency);?></td>
      <td><?php echo Content::estimateStatus($row->status);?></td>
      <td class="right aligned"><a class="wojo small simple icon button" data-dropdown="#estimateDrop_<?php echo $row->id;?>">
        <i class="icon horizontal ellipsis"></i>
        </a>
        <div class="wojo dropdown small pointing top-right" id="estimateDrop_<?php echo $row->id;?>">
          <!-- Start editEstimate -->
          <a href="<?php echo Url::url("/admin/estimates/edit", $row->id);?>" class="item"><?php echo Lang::$word->EDIT;?></a>
          <!-- Start downloadPdf -->
          <a class="item" href="<?php echo ADMINVIEW;?>/helper.php?action=downloadEstimate&amp;id=<?php echo $row->id;?>">
          <?php echo Lang::$word->INV_DPDF;?>
          </a>
          
          <!-- Start sendEmail -->
          <a data-set='{"option":[{"action":"sendEstimate","id":<?php echo $row->id;?>}], "label":"<?php echo Lang::$word->INV_RESEND;?>", "url":"helper.php", "parent":"#ivitemu_<?php echo $row->id;?>", "complete":"replace", "modalclass":"normal"}' class="item action"><?php echo Lang::$word->INV_RESEND;?></a>
          <div class="divider"></div>
          <?php if($row->status == 2):?>
          <!-- Start markAsWon -->
          <a data-set='{"option":[{"iaction":"estimateMarkWon","id":<?php echo $row->id;?>, "name":"<?php echo Validator::sanitize($row->title, "chars");?>"}], "url":"/helper.php", "parent":"#ivitemu_<?php echo $row->id;?>", "complete":"remove"}' class="item iaction"><?php echo Lang::$word->EST_MARKWON;?></a>
          <?php endif;?>
          <?php if($row->status == 3):?>
          <!-- Start startProject -->
          <a href="<?php echo Url::url("/admin/estimates/project", $row->id);?>" class="item"><?php echo Lang::$word->EST_STARTP;?></a>
          
          <!-- Start markAsLost -->
          <a data-set='{"option":[{"iaction":"estimateMarkLost","id":<?php echo $row->id;?>, "name":"<?php echo Validator::sanitize($row->title, "chars");?>"}], "url":"/helper.php", "parent":"#ivitemu_<?php echo $row->id;?>", "complete":"remove"}' class="item iaction"><?php echo Lang::$word->EST_MARKLOST;?></a>
          <?php endif;?>
          <!-- Start createInvoice -->
          <a href="<?php echo Url::url("/admin/estimates/invoice", $row->id);?>" class="item"><?php echo Lang::$word->INV_CREATE;?></a>
          
          <!-- Start duplicateEstimate -->
          <a href="<?php echo Url::url("/admin/estimates/duplicate", $row->id);?>" class="item"><?php echo Lang::$word->DUPLICATE;?></a>
          <div class="divider"></div>
          <!-- Start trashEstimate -->
          <a data-set='{"option":[{"trash": "trashEstimate","title": "<?php echo Validator::sanitize($row->title, "chars");?>","id": "<?php echo $row->id;?>"}],"action":"trash","subtext":"<?php echo Lang::$word->INV_CANCEL_I;?>", "parent":"#ivitemu_<?php echo $row->id;?>"}' class="wojo demi text item data">
          <?php echo Lang::$word->MTOTRASH;?>
          </a>
        </div></td>
    </tr>
    <?php endforeach;?>
  </tbody>
</table>
<?php endforeach;?>
<?php endif;?>
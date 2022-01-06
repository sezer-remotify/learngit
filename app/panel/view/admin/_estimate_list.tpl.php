<?php
  /**
   * Estimates List
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2019
   * @version $Id: _estimates_list.tpl.php, v1.00 2019-05-05 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
?>
<h3><?php echo Lang::$word->ADM_ESTIMATES;?></h3>
<div class="wojo small white stacked buttons">
  <a href="<?php echo Url::url("/admin/estimates", "new");?>" class="wojo button"><i class="icon plus alt"></i>
  <?php echo Lang::$word->EST_NEWEST;?></a>
  <a href="<?php echo Url::url("/admin/estimates", "archive");?>" class="wojo button"><?php echo Lang::$word->EST_TITLE1;?></a>
</div>
<?php if(!$this->data):?>
<div class="center aligned"><img src="<?php echo ADMINVIEW;?>/images/estimates_empty.svg" alt="" class="wojo center large image">
  <p class="wojo semi grey text"><?php echo Lang::$word->EST_NOEST;?></p>
</div>
<?php else:?>
<?php if(isset($this->data[0])):?>
<!-- Unsent Draft -->
<div class="wojo fitted segment">
  <div class="header">
    <h4>
      <?php echo Lang::$word->INV_UNSENT;?>
    </h4>
  </div>
  <div class="content">
    <table class="wojo basic table responsive">
      <thead>
        <tr>
          <th class="five wide"><?php echo Lang::$word->EST_NAME;?></th>
          <th class="four wide"><?php echo Lang::$word->CLIENT;?></th>
          <th class="three wide right aligned"><?php echo Lang::$word->INV_AMOUNT;?></th>
          <th class="three wide"><?php echo Lang::$word->STATUS;?></th>
          <th class="auto"></th>
        </tr>
      </thead>
      <?php foreach($this->data[0] as $row):?>
      <tr id="ivitemu_<?php echo $row->id;?>">
        <td><a href="<?php echo Url::url("/admin/estimates/view", $row->id);?>">
          <?php echo $row->title;?></a></td>
        <td><a href="<?php echo Url::url("/admin/companies/edit", $row->company_id);?>" class="grey">
          <?php echo $row->company_name;?></a></td>
        <td class="right aligned"><?php echo Utility::formatMoney($row->total, $row->currency);?></td>
        <td><?php echo Content::estimateStatus($row->status);?></td>
        <td class="right aligned"><a class="wojo simple icon button" data-dropdown="#estimateDrop_<?php echo $row->id;?>">
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
            <a data-set='{"option":[{"action":"sendEstimate","id":<?php echo $row->id;?>}], "label":"<?php echo Lang::$word->EST_SENDES;?>", "url":"helper.php", "parent":"#ivitemu_<?php echo $row->id;?>", "complete":"replace", "modalclass":"normal"}' class="item action"><?php echo Lang::$word->INV_SENDIVE;?></a>
            <div class="divider"></div>
            
            <!-- Start markAsWon -->
            <a data-set='{"option":[{"iaction":"estimateMarkWon","id":<?php echo $row->id;?>, "name":"<?php echo Validator::sanitize($row->title, "chars");?>"}], "url":"/helper.php", "parent":"#ivitemu_<?php echo $row->id;?>", "complete":"remove"}' class="item iaction"><?php echo Lang::$word->EST_MARKWON;?></a>
            
            <!-- Start markAsLost -->
            <a data-set='{"option":[{"iaction":"estimateMarkLost","id":<?php echo $row->id;?>, "name":"<?php echo Validator::sanitize($row->title, "chars");?>"}], "url":"/helper.php", "parent":"#ivitemu_<?php echo $row->id;?>", "complete":"remove"}' class="item iaction"><?php echo Lang::$word->EST_MARKLOST;?></a>
            
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
      <?php unset($row);?>
    </table>
  </div>
</div>
<?php endif;?>
<?php if(isset($this->data[1])):?>
<!-- Sent -->
<div class="wojo fitted segment">
  <div class="wojo header text secondary">
    <h4>
      <?php echo Lang::$word->INV_SENT;?>
    </h4>
  </div>
  <div class="content">
    <table class="wojo basic table responsive">
      <thead>
        <tr>
          <th class="five wide"><?php echo Lang::$word->EST_NAME;?></th>
          <th class="four wide"><?php echo Lang::$word->CLIENT;?></th>
          <th class="three wide right aligned"><?php echo Lang::$word->INV_AMOUNT;?></th>
          <th class="three wide"><?php echo Lang::$word->STATUS;?></th>
          <th class="auto"></th>
        </tr>
      </thead>
      <?php foreach($this->data[1] as $row):?>
      <tr id="ivitemu_<?php echo $row->id;?>">
        <td><a href="<?php echo Url::url("/admin/estimates/view", $row->id);?>">
          <?php echo $row->title;?></a></td>
        <td><a href="<?php echo Url::url("/admin/companies/edit", $row->company_id);?>" class="inverted">
          <?php echo $row->company_name;?></a></td>
        <td class="right aligned"><?php echo Utility::formatMoney($row->total, $row->currency);?></td>
        <td><?php echo Content::estimateStatus($row->status);?></td>
        <td class="right aligned"><a class="wojo simple icon button" data-dropdown="#estimateDrop_<?php echo $row->id;?>">
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
            <a data-set='{"option":[{"action":"sendEstimate","id":<?php echo $row->id;?>}], "label":"<?php echo Lang::$word->EST_SENDES;?>", "url":"helper.php", "parent":"#ivitemu_<?php echo $row->id;?>", "complete":"replace", "modalclass":"normal"}' class="item action"><?php echo Lang::$word->INV_SENDIVE;?></a>
            <div class="divider"></div>
            
            <!-- Start markAsWon -->
            <a data-set='{"option":[{"iaction":"estimateMarkWon","id":<?php echo $row->id;?>, "name":"<?php echo Validator::sanitize($row->title, "chars");?>"}], "url":"/helper.php", "parent":"#ivitemu_<?php echo $row->id;?>", "complete":"remove"}' class="item iaction"><?php echo Lang::$word->EST_MARKWON;?></a>
            
            <!-- Start markAsLost -->
            <a data-set='{"option":[{"iaction":"estimateMarkLost","id":<?php echo $row->id;?>, "name":"<?php echo Validator::sanitize($row->title, "chars");?>"}], "url":"/helper.php", "parent":"#ivitemu_<?php echo $row->id;?>", "complete":"remove"}' class="item iaction"><?php echo Lang::$word->EST_MARKLOST;?></a>
            
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
      <?php unset($row);?>
    </table>
  </div>
</div>
<?php endif;?>
<?php if(isset($this->data[2])):?>
<!-- Lost -->
<div class="wojo fitted segment">
  <div class="wojo header text negative">
    <h4>
      <?php echo Lang::$word->EST_LOST;?>
    </h4>
  </div>
  <div class="content">
    <table class="wojo basic table responsive">
      <thead>
        <tr>
          <th class="five wide"><?php echo Lang::$word->EST_NAME;?></th>
          <th class="four wide"><?php echo Lang::$word->CLIENT;?></th>
          <th class="three wide right aligned"><?php echo Lang::$word->INV_AMOUNT;?></th>
          <th class="three wide"><?php echo Lang::$word->STATUS;?></th>
          <th class="auto"></th>
        </tr>
      </thead>
      <?php foreach($this->data[2] as $row):?>
      <tr id="ivitemu_<?php echo $row->id;?>">
        <td><a href="<?php echo Url::url("/admin/estimates/view", $row->id);?>">
          <?php echo $row->title;?></a></td>
        <td><a href="<?php echo Url::url("/admin/companies/edit", $row->company_id);?>" class="inverted">
          <?php echo $row->company_name;?></a></td>
        <td class="right aligned"><?php echo Utility::formatMoney($row->total, $row->currency);?></td>
        <td><?php echo Content::estimateStatus($row->status);?></td>
        <td class="right aligned"><a class="wojo simple icon button" data-dropdown="#estimateDrop_<?php echo $row->id;?>">
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
            <a data-set='{"option":[{"action":"sendEstimate","id":<?php echo $row->id;?>}], "label":"<?php echo Lang::$word->EST_SENDES;?>", "url":"helper.php", "parent":"#ivitemu_<?php echo $row->id;?>", "complete":"replace", "modalclass":"normal"}' class="item action"><?php echo Lang::$word->INV_SENDIVE;?></a>
            <div class="divider"></div>
            
            <!-- Start markAsWon -->
            <a data-set='{"option":[{"iaction":"estimateMarkWon","id":<?php echo $row->id;?>, "name":"<?php echo Validator::sanitize($row->title, "chars");?>"}], "url":"/helper.php", "parent":"#ivitemu_<?php echo $row->id;?>", "complete":"remove"}' class="item iaction"><?php echo Lang::$word->EST_MARKWON;?></a>
            
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
      <?php unset($row);?>
    </table>
  </div>
</div>
<?php endif;?>
<?php if(isset($this->data[3])):?>
<!-- Won -->
<div class="wojo fitted segment">
  <div class="wojo header text positive">
    <h4>
      <?php echo Lang::$word->EST_WON;?>
    </h4>
  </div>
  <div class="content">
    <table class="wojo basic table responsive">
      <thead>
        <tr>
          <th class="five wide"><?php echo Lang::$word->EST_NAME;?></th>
          <th class="four wide"><?php echo Lang::$word->CLIENT;?></th>
          <th class="three wide right aligned"><?php echo Lang::$word->INV_AMOUNT;?></th>
          <th class="three wide"><?php echo Lang::$word->STATUS;?></th>
          <th class="auto"></th>
        </tr>
      </thead>
      <?php foreach($this->data[3] as $row):?>
      <tr id="ivitemu_<?php echo $row->id;?>">
        <td><a href="<?php echo Url::url("/admin/estimates/view", $row->id);?>">
          <?php echo $row->title;?></a></td>
        <td><a href="<?php echo Url::url("/admin/companies/edit", $row->company_id);?>" class="inverted">
          <?php echo $row->company_name;?></a></td>
        <td class="right aligned"><?php echo Utility::formatMoney($row->total, $row->currency);?></td>
        <td><?php echo Content::estimateStatus($row->status);?></td>
        <td class="right aligned"><a class="wojo simple icon button" data-dropdown="#estimateDrop_<?php echo $row->id;?>">
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
            <a data-set='{"option":[{"action":"sendEstimate","id":<?php echo $row->id;?>}], "label":"<?php echo Lang::$word->EST_SENDES;?>", "url":"helper.php", "parent":"#ivitemu_<?php echo $row->id;?>", "complete":"replace", "modalclass":"normal"}' class="item action"><?php echo Lang::$word->INV_SENDIVE;?></a>
            <div class="basic divider"></div>
            
            <!-- Start createProject -->
            <a href="<?php echo Url::url("/admin/estimates/project", $row->id);?>" class="item"><?php echo Lang::$word->EST_STARTP;?></a>
            
            <!-- Start markAsLost -->
            <a data-set='{"option":[{"iaction":"estimateMarkLost","id":<?php echo $row->id;?>, "name":"<?php echo Validator::sanitize($row->title, "chars");?>"}], "url":"/helper.php", "parent":"#ivitemu_<?php echo $row->id;?>", "complete":"remove"}' class="item iaction"><?php echo Lang::$word->EST_MARKLOST;?></a>
            
            <!-- Start createInvoice -->
            <a href="<?php echo Url::url("/admin/estimates/invoice", $row->id);?>" class="item"><?php echo Lang::$word->INV_CREATE;?></a>
            
            <!-- Start duplicateEstimate -->
            <a href="<?php echo Url::url("/admin/estimates/duplicate", $row->id);?>" class="item"><?php echo Lang::$word->DUPLICATE;?></a>
            <div class="basic divider"></div>
            <!-- Start trashEstimate -->
            <a data-set='{"option":[{"trash": "trashEstimate","title": "<?php echo Validator::sanitize($row->title, "chars");?>","id": "<?php echo $row->id;?>"}],"action":"trash","subtext":"<?php echo Lang::$word->INV_CANCEL_I;?>", "parent":"#ivitemu_<?php echo $row->id;?>"}' class="wojo demi text item data">
            <?php echo Lang::$word->MTOTRASH;?>
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
<?php
  /**
   * Project Invoices
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2019
   * @version $Id: invoices.tpl.php, v1.00 2019-05-05 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
?>
<?php switch(Url::segment($this->segments)): case "view": ?>
<div class="wojo attached secondary message align spaced">
  <?php if($this->row->pstatus == 1 or $this->row->pstatus == 2):?>
  <table class="wojo small very compact basic collapsing table">
    <?php foreach ($this->payments as $prow):?>
    <tr>
      <td class="wojo white text"><?php echo $prow->pp;?>:</td>
      <td class="wojo white text"><?php echo Utility::formatMoney($prow->amount, $prow->currency);?>
        <?php echo strtolower(Lang::$word->ON);?>
        <?php echo Date::dodate("short_date", $prow->created);?></td>
    </tr>
    <?php endforeach;?>
    <tr>
      <td><span class="wojo bold white text"><?php echo Lang::$word->INV_BALDUE;?>:</span></td>
      <td><span class="wojo bold white text"><?php echo Utility::formatMoney($this->row->balance_due - $this->row->paid_amount, $this->row->currency);?></span></td>
    </tr>
  </table>
  <?php endif;?>
  <div>
    <?php echo Project::invoicepStatus($this->row->pstatus);?>
  </div>
</div>
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
          <td class="wojo demi text"><?php echo Lang::$word->TOTAL;?></td>
          <td class="wojo demi text right aligned"><?php echo Utility::formatNumber($this->row->total);?></td>
        </tr>
        <tr>
          <td><?php echo Lang::$word->INV_AMT_PAID;?></td>
          <td class="right aligned"><?php echo Utility::formatNumber($this->row->paid_amount);?></td>
        </tr>
        <tr>
          <td class="wojo demi text positive"><?php echo Lang::$word->INV_BALDUE;?> (<?php echo $this->row->currency;?>)</td>
          <td class="wojo demi text positive right aligned"><?php echo Utility::formatNumber($this->row->balance_due - $this->row->paid_amount);?></td>
        </tr>
      </table>
    </div>
  </div>
  <?php if($this->row->balance_due - $this->row->paid_amount > 0):?>
  <h4><?php echo Lang::$word->INV_PAY_METHOD;?></h4>
  <div class="wojo very relaxed celled fluid list" id="dGateways">
    <?php foreach($this->gateways as $grow):?>
    <div class="item align middle">
      <div class="content">
        <div class="wojo checkbox radio fitted inline">
          <input name="gateway" type="radio" value="<?php echo $grow->id;?>" id="gate_<?php echo $grow->id;?>" data-id="<?php echo $this->row->id;?>">
          <label for="gate_<?php echo $grow->id;?>"><?php echo $grow->displayname;?></label>
        </div>
      </div>
      <div class="content auto"><img src="<?php echo SITEURL;?>/gateways/<?php echo $grow->dir;?>/logo_large.png" alt="" class="wojo small basic image"></div>
    </div>
    <?php endforeach;?>
  </div>
  <div id="dCheckout"></div>
  <script type="text/javascript" src="https://js.stripe.com/v3/"></script>
  <?php endif;?>
</div>
<?php break;?>
<!-- Start default -->
<?php default: ?>
<div class="wojo heading message">
  <div class="content">
    <h3><?php echo Lang::$word->INV_INVOICES;?></h3>
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
          <th>#ID</th>
          <th><?php echo Lang::$word->CLIENT;?></th>
          <th><?php echo Lang::$word->INV_DUED;?></th>
          <th><?php echo Lang::$word->INV_AMOUNT;?></th>
          <th><?php echo Lang::$word->INV_OWNING;?></th>
          <th><?php echo Lang::$word->STATUS;?></th>
          <th class="auto"></th>
        </tr>
      </thead>
      <?php foreach($this->data[3] as $row):?>
      <tr id="ivitemu_<?php echo $row->id;?>">
        <td><a href="<?php echo Url::url("/dashboard/invoices/view", $row->id);?>" class="wojo tiny bold text"><?php echo Content::invoiceID($row->id, $row->custom_id);?></a></td>
        <td><?php echo $row->company_name;?></td>
        <td><?php echo Date::doDate("short_date", $row->due_date);?></td>
        <td><?php echo Utility::formatMoney($row->total, $row->currency);?></td>
        <td><?php echo Utility::formatMoney(($row->balance_due - $row->paid_amount), $row->currency);?></td>
        <td><?php echo Project::invoicepStatus($row->pstatus);?></td>
        <td><a class="wojo small icon primary button" href="<?php echo FRONTVIEW;?>/helper.php?action=downloadInvoice&amp;id=<?php echo $row->id;?>">
          <i class="icon download"></i>
          </a></td>
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
          <th>#ID</th>
          <th><?php echo Lang::$word->CLIENT;?></th>
          <th><?php echo Lang::$word->INV_DUED;?></th>
          <th><?php echo Lang::$word->INV_AMOUNT;?></th>
          <th><?php echo Lang::$word->INV_OWNING;?></th>
          <th><?php echo Lang::$word->STATUS;?></th>
          <th class="auto"></th>
        </tr>
      </thead>
      <?php foreach($this->data[0] as $row):?>
      <tr id="ivitemu_<?php echo $row->id;?>">
        <td><a href="<?php echo Url::url("/dashboard/invoices/view", $row->id);?>" class="wojo tiny bold text"><?php echo Content::invoiceID($row->id, $row->custom_id);?></a></td>
        <td><?php echo $row->company_name;?></td>
        <td><?php echo Date::doDate("short_date", $row->due_date);?></td>
        <td><?php echo Utility::formatMoney($row->total, $row->currency);?></td>
        <td><?php echo Utility::formatMoney(($row->balance_due - $row->paid_amount), $row->currency);?></td>
        <td><?php echo Project::invoicepStatus($row->pstatus);?></td>
        <td><a class="wojo small icon primary button" href="<?php echo FRONTVIEW;?>/helper.php?action=downloadInvoice&amp;id=<?php echo $row->id;?>">
          <i class="icon download"></i>
          </a></td>
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
          <th>#ID</th>
          <th><?php echo Lang::$word->CLIENT;?></th>
          <th><?php echo Lang::$word->INV_DUED;?></th>
          <th><?php echo Lang::$word->INV_AMOUNT;?></th>
          <th><?php echo Lang::$word->INV_OWNING;?></th>
          <th><?php echo Lang::$word->STATUS;?></th>
          <th class="auto"></th>
        </tr>
      </thead>
      <?php foreach($this->data[1] as $row):?>
      <tr id="ivitemu_<?php echo $row->id;?>">
        <td><a href="<?php echo Url::url("/dashboard/invoices/view", $row->id);?>" class="wojo tiny bold text"><?php echo Content::invoiceID($row->id, $row->custom_id);?></a></td>
        <td><?php echo $row->company_name;?></td>
        <td><?php echo Date::doDate("short_date", $row->due_date);?></td>
        <td><?php echo Utility::formatMoney($row->total, $row->currency);?></td>
        <td><?php echo Utility::formatMoney(($row->balance_due - $row->paid_amount));?></td>
        <td><?php echo Project::invoicepStatus($row->pstatus);?></td>
        <td><a class="wojo small icon primary button" href="<?php echo FRONTVIEW;?>/helper.php?action=downloadInvoice&amp;id=<?php echo $row->id;?>">
          <i class="icon download"></i>
          </a></td>
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
          <th>#ID</th>
          <th><?php echo Lang::$word->CLIENT;?></th>
          <th><?php echo Lang::$word->INV_DUED;?></th>
          <th><?php echo Lang::$word->INV_AMOUNT;?></th>
          <th><?php echo Lang::$word->INV_OWNING;?></th>
          <th><?php echo Lang::$word->STATUS;?></th>
          <th class="auto"></th>
        </tr>
      </thead>
      <?php foreach($this->data[2] as $row):?>
      <tr id="ivitemu_<?php echo $row->id;?>">
        <td><a href="<?php echo Url::url("/dashboard/invoices/view", $row->id);?>" class="wojo tiny bold text"><?php echo Content::invoiceID($row->id, $row->custom_id);?></a></td>
        <td><?php echo $row->company_name;?></td>
        <td><?php echo Date::doDate("short_date", $row->due_date);?></td>
        <td><?php echo Utility::formatMoney($row->total, $row->currency);?></td>
        <td><?php echo Utility::formatMoney(($row->balance_due - $row->paid_amount), $row->currency);?></td>
        <td><?php echo Project::invoicepStatus($row->pstatus);?></td>
        <td><a class="wojo small icon primary button" href="<?php echo FRONTVIEW;?>/helper.php?action=downloadInvoice&amp;id=<?php echo $row->id;?>">
          <i class="icon download"></i>
          </a></td>
      </tr>
      <?php endforeach;?>
      <?php unset($row);?>
    </table>
  </div>
</div>
<?php endif;?>
<?php endif;?>
<?php break;?>
<?php endswitch;?>		  
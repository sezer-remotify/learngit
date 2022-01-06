<?php
  /**
   * Reports Payments
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2019
   * @version $Id: _reports_payments.tpl.php, v1.00 2019-05-05 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
?>
<div class="wojo fitted segment">
  <div class="divided header align middle spaced">
    <div class="items">
      <h4 class="basic"><?php echo Lang::$word->REP_SUB1;?> (<?php echo date('Y');?>)</h4>
    </div>
    <div class="items" data-tooltip="<?php echo Lang::$word->REP_EXPORT;?>"><a href="<?php echo ADMINVIEW;?>/helper.php?action=getPaymentsCvs" class="wojo small primary inverted icon button"><i class="icon wysiwyg table"></i></a>
    </div>
  </div>
  <div class="content">
    <div class="right aligned">
      <div id="legend" class="wojo small horizontal fluid list"></div>
    </div>
    <div class="wojo form" id="payment_chart" style="height:400px;"></div>
    <table class="wojo basic table">
      <thead>
        <tr class="wojo secondary bg">
          <th class="wojo white text"><?php echo Lang::$word->_MONTH;?></th>
          <th class="wojo white text"><?php echo Lang::$word->REP_TOTAL_PAY;?></th>
          <?php if(isset($this->data['currency'])):?>
          <?php foreach($this->data['currency'] as $c => $cur):?>
          <th class="wojo white text"><?php echo $c;?></th>
          <?php endforeach;?>
          <?php endif;?>
        </tr>
      </thead>
      <tbody>
        <?php $sales = 0;?>
        <?php $amount = array();?>
        <?php foreach($this->data['month'] as $key => $date):?>
        <?php $sales += isset($this->data['total'][$date[0]]) ? count($this->data['total'][$date[0]]) : 0;?>
        <tr>
          <td><?php echo $date[1];?></td>
          <td><?php echo isset($this->data['total'][$date[0]]) ? count($this->data['total'][$date[0]]) : 0;?></td>
          <?php if(isset($this->data['currency'])):?>
          <?php foreach($this->data['currency'] as $c => $cur):?>
          <td><?php echo isset($this->data['currencies'][$c][$date[0]]) ? $amount[$c] = array_sum($this->data['currencies'][$c][$date[0]]) : '-';?></td>
          <?php endforeach;?>
          <?php endif;?>
        </tr>
        <?php endforeach;?>
      </tbody>
      <tfoot>
        <tr class="wojo secondary bg">
          <td class="wojo small white text"><?php echo Lang::$word->REP_TOTAL_AMT;?></td>
          <td class="wojo small white text"><?php echo $sales;?></td>
          <?php if(isset($this->data['currency'])):?>
          <?php foreach($this->data['currency'] as $c => $cur):?>
          <td class="wojo small white text"><?php echo Utility::formatMoney($amount[$c], $c);?></td>
          <?php endforeach;?>
          <?php endif;?>
        </tr>
      </tfoot>
    </table>
  </div>
</div>
<script type="text/javascript" src="<?php echo SITEURL;?>/assets/morris.min.js"></script>
<script type="text/javascript" src="<?php echo SITEURL;?>/assets/raphael.min.js"></script>
<script src="<?php echo ADMINVIEW;?>/js/reports.js"></script>
<script type="text/javascript"> 
// <![CDATA[	
$(document).ready(function() {
    $.Reports({
		url: "<?php echo ADMINVIEW;?>",
        lang: {
			months: [<?php echo Date::monthList(false, false);?>]
        }
    });
});
// ]]>
</script>
<?php
  /**
   * PDF Estimate
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2019
   * @version $Id: pdf_Estimate.tpl.php, v1.00 2019-10-08 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
	  
  $company = Db::run()->first(Company::cTable, null, array('owner' => 1));
  $data = Utility::jSonToArray($row->items);
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title></title>
<style type="text/css">
body {
  background-color: #fff;
  color: #333;
  font-family: DejaVu Sans, Helvetica, Times-Roman;
  font-size: 1.2em;
  line-height: 1.5em;
  margin: 0;
  padding: 0
}
table {
  font-size: 75%;
  width: 100%;
  border-collapse: separate;
  border-spacing: 2px
}
th,
td.celled {
  text-align: left;
  border-style: solid;
  border-width: 1px;
  border-color: #DDD;
  padding: .5em
}
th {
  background: #EEE;
  border-color: #BBB
}
td {
  border: 0
}
table.inventory tbody tr:nth-child(2n) {
  background-color: #F9F9F9;
}
table.inventory th {
  font-weight: 500;
  border: 0;
}
table.inventory td {
  border-spacing: 0;
  padding: .5em;
  border-bottom: 1px solid #DDD;
}
table.balance td {
  text-align: right
}
h1 {
  font: bold 100% sans-serif;
  letter-spacing: .5em;
  text-align: center;
  text-transform: uppercase
}
.green {
  background-color: #D5EEBE;
  color: #689340
}
.blue {
  background-color: #D0EBFB;
  color: #4995B1
}
.red {
  background-color: #FAD0D0;
  color: #AF4C4C
}
.yellow {
  background-color: #FFC;
  color: #BBB840
}
#aside {
  padding-top: 30px;
  font-size: 65%
}
small {
  font-size: 75%;
  line-height: 1.5em
}
#footer {
  position: fixed;
  bottom: 0px;
  left: 0px;
  right: 0px;
  height: 100px;
  text-align: center;
  border-top: 2px solid #eee;
  font-size: 85%;
  padding-top: 5px
}
.divider {
  border-bottom: 2px solid #ddd;
}
.spacer {
  margin: 20px 0
}
p {
  padding: 0;
  margin: 0;
  padding-bottom: 5px;
}
@page {
  margin: 30px;
  margin-footer: 5mm;
  footer: html_footer;
}
</style>
<table border="0" class="divider">
  <tr>
    <td style="width: 60%;"><?php if (file_exists(UPLOADS . '/print_logo.png')):?>
      <img alt="" src="<?php echo UPLOADS . '/print_logo.png';?>" style="height:70px">
      <?php else:?>
      <?php echo App::Core()->company;?>
      <?php endif;?></td>
    <td valign="top" style="width:40%;text-align: right"><p><?php echo $company->name;?></p>
      <p><?php echo $company->address;?></p>
      <p><?php echo $company->city . ' ' . $company->state . ' ' . $company->zip;?></p>
      <p><?php echo $company->phone;?></p>
      <p><?php echo $company->website;?> <?php echo $company->email;?></p>
      <p><small><?php echo Validator::cleanOut(App::Core()->invoice_info);?></small></p></td>
  </tr>
</table>
<div class="spacer"></div>
<table>
  <tr>
    <td style="width:60%"><strong>Invoiced To:</strong></td>
    <td style="width:40%;text-align:right"><strong><?php echo $row->title;?></strong></td>
  </tr>
  <tr>
    <td style="width:60%"><p><?php echo $row->company_name;?></p>
      <p><?php echo $row->company_address;?></p></td>
    <td style="width:40%;text-align:right">
      <p>Date of Issue: <?php echo Date::dodate("short_date", $row->created);?></p></td>
  </tr>
</table>
<div class="spacer"></div>
<div class="spacer"></div>
<table class="inventory">
  <tr>
    <th>#</th>
    <th><?php echo Lang::$word->PRJ_DESC;?></th>
    <th><?php echo Lang::$word->INV_QTY;?></th>
    <?php if($row->tax <> 0):?>
    <th><?php echo Lang::$word->INV_TAXRATE;?></th>
    <?php endif;?>
    <th style="text-align:right;width:20%"><?php echo Lang::$word->INV_ITEMCST;?></th>
  </tr>
  <tbody>
    <?php $i = 1;?>
    <?php if($data):?>
    <?php foreach ($data as $irow):?>
    <tr>
      <td><small><?php echo $i;?>.</small></td>
      <td><?php echo $irow->description;?></td>
      <td><?php echo $irow->quantity;?></td>
      <?php if($row->tax <> 0):?>
      <td><?php echo $irow->tax_name;?> <?php echo Utility::formatNumber($irow->tax_amount);?></td>
      <?php endif;?>
      <td style="text-align:right"><?php echo Utility::formatNumber($irow->amount);?></td>
    </tr>
    <?php $i++;?>
    <?php endforeach;?>
    <?php endif;?>
  </tbody>
</table>
<div class="spacer"></div>
<table class="balance">
  <tr>
    <td style="width:50%">&nbsp;</td>
    <td style="border-bottom: 1px solid #ddd"><strong>Subtotal</strong></td>
    <td style="width:20%;border-bottom: 1px solid #ddd"><strong><?php echo Utility::formatNumber($row->subtotal);?></strong></td>
  </tr>
  <?php if($row->tax > 0):?>
  <tr>
    <td>&nbsp;</td>
    <td style="border-bottom: 1px solid #ddd">Taxes</td>
    <td style="border-bottom: 1px solid #ddd"><?php echo Utility::formatNumber($row->tax);?></td>
  </tr>
  <?php endif;?>
  <?php if($row->discount > 0):?>
  <tr>
    <td>&nbsp;</td>
    <td style="border-bottom: 1px solid #ddd">Discount</td>
    <td style="border-bottom: 1px solid #ddd">- <?php echo Utility::formatNumber(($row->subtotal * $row->discount) / 100);?></td>
  </tr>
  <?php endif;?>
  <tr>
    <td>&nbsp;</td>
    <td style="border-bottom: 1px solid #ddd"><strong>Total (<?php echo $row->currency;?>)</strong></td>
    <td style="border-bottom: 1px solid #ddd"><strong><?php echo Utility::formatNumber($row->total);?></strong></td>
  </tr>
</table>
<htmlpagefooter name="footer">
  <table width="100%" style="vertical-align: bottom;font-size: 8pt; border-top:1px solid #000000; font-weight: bold; font-style: italic;">
    <tr>
      <td colspan="3"><?php if($row->note):?>
        <?php echo $row->note;?>
        <?php endif;?></td>
    </tr>
    <tr>
      <td width="33%"><span style="font-weight: bold; font-style: italic;">{DATE j-m-Y}</span></td>
      <td width="33%" align="center" style="font-weight: bold; font-style: italic;">{PAGENO}/{nbpg}</td>
      <td width="33%" style="text-align: right; "><?php echo App::Core()->company;?></td>
    </tr>
  </table>
</htmlpagefooter>
</body></html>
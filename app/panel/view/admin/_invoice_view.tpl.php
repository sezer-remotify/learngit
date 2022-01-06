<?php
/**
 * Invoices View
 *
 * @package Wojo Framework
 * @author wojoscripts.com
 * @copyright 2019
 * @version $Id: _invoice_view.tpl.php, v1.00 2019-05-05 10:12:05 gewa Exp $
 */
if ( !defined( "_WOJO" ) )
	die( 'Direct access to this location is not allowed.' );
?>
<h3><?php echo Lang::$word->INV_TITLE8;?></h3>
<div class="wojo small white stacked buttons">
  <?php if(Auth::hasPrivileges('manage_invoices')):?>
  <a href="<?php echo Url::url("/admin/invoices", "new");?>" class="wojo button"><i class="icon plus alt"></i>
  <?php echo Lang::$word->INV_NEWINV;?></a>
  <?php endif;?>
<?php /*?>  <a href="<?php echo Url::url("/admin/invoices", "recurring");?>" class="wojo button">
  <?php echo Lang::$word->INV_TITLE7;?>
  </a><?php */?>
  <a href="<?php echo Url::url("/admin/invoices", "canceled");?>" class="wojo button">
  <?php echo Lang::$word->INV_PANDC;?>
  </a>
</div>
<div class="wojo spaced fitted segment" id="ivdata">
  <?php include_once(ADMINBASE . '/snippets/loadIvSingleFullView.tpl.php');?>
</div>
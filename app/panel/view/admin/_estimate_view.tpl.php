<?php
  /**
   * Estimates View
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2019
   * @version $Id: _estimate_view.tpl.php, v1.00 2019-05-05 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
?>
<h3><?php echo Lang::$word->INV_TITLE8;?></h3>
<div class="wojo small white stacked buttons">
  <a href="<?php echo Url::url("/admin/estimates", "new");?>" class="wojo button"><i class="icon plus alt"></i>
  <?php echo Lang::$word->EST_NEWEST;?></a>
  <a href="<?php echo Url::url("/admin/invoices", "archive");?>" class="wojo button"><?php echo Lang::$word->EST_TITLE1;?></a>
</div>
<div class="wojo fitted spaced segment" id="ivdata">
  <?php include_once(ADMINBASE . '/snippets/loadEsSingleFullView.tpl.php');?>
</div>
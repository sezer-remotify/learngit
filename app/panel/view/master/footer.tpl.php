<?php

/**
 * Footer
 *
 * @package Wojo Framework
 * @author wojoscripts.com
 * @copyright 2019
 * @version $Id: footer.php, v1.00 2019-05-05 10:12:05 gewa Exp $
 */
if (!defined("_WOJO"))
	die('Direct access to this location is not allowed.');
?>
</main>
</div>
</div>
</div>

<!-- Footer -->
<footer> Copyright &copy;<?php echo date('Y') . ' ' . $this->core->company; ?> </footer>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="<?php echo MASTERVIEW; ?>/js/js/jquery-migrate-3.3.1.min.js"></script>
<script src="<?php echo MASTERVIEW; ?>/js/js/tippy.all.min.js"></script>
<script src="<?php echo MASTERVIEW; ?>/js/js/simplebar.min.js"></script>
<script src="<?php echo MASTERVIEW; ?>/js/js/bootstrap-select.min.js"></script>
<script src="<?php echo MASTERVIEW; ?>/js/js/bootstrap-slider.min.js"></script>
<script src="<?php echo MASTERVIEW; ?>/js/js/snackbar.js"></script>
<script src="<?php echo MASTERVIEW; ?>/js/js/clipboard.min.js"></script>
<script src="<?php echo MASTERVIEW; ?>/js/js/magnific-popup.min.js"></script>
<script src="<?php echo MASTERVIEW; ?>/js/js/slick.min.js"></script>
<script src="<?php echo MASTERVIEW; ?>/js/js/custom.js"></script>
<script type="text/javascript" src="<?php echo SITEURL; ?>/assets/editor/trumbowyg.js"></script>
<script type="text/javascript" src="<?php echo MASTERVIEW; ?>/js/master.js"></script>
<script type="text/javascript">
// <![CDATA[
$(document).ready(function() {
  $.Master({
    weekstart: <?php echo $this->core->weekstart; ?>,
    ampm: "<?php echo ($this->core->time_format) == "hh:mm" ? false : true; ?>",
    url: "<?php echo MASTERVIEW; ?>",
    surl: "<?php echo SITEURL; ?>",
    lang: {
      monthsFull: [<?php echo Date::monthList(false); ?>],
      monthsShort: [<?php echo Date::monthList(false, false); ?>],
      weeksFull: [<?php echo Date::weekList(false); ?>],
      weeksShort: [<?php echo Date::weekList(false, 3); ?>],
      weeksMed: [<?php echo Date::weekList(false, 2); ?>],
      weeksSmall: [<?php echo Date::weekList(false, 1); ?>],
      selPic: "<?php echo Lang::$word->SELPIC; ?>",
      ok: "<?php echo Lang::$word->OK; ?>",
      today: "<?php echo Lang::$word->TODAY; ?>",
      now: "<?php echo Lang::$word->NOW; ?>",
      clear: "<?php echo Lang::$word->CLEAR; ?>",
      doSearch: "<?php echo Lang::$word->SEARCH; ?>",
      delBtn: "<?php echo Lang::$word->DELETE_REC; ?>",
      arcBtn: "<?php echo Lang::$word->MTOARCHIVE; ?>",
      trsBtn: "<?php echo Lang::$word->MTOTRASH; ?>",
      restBtn: "<?php echo Lang::$word->RFCOMPLETE; ?>",
      aOffer: "<?php echo Lang::$word->ACCEPT_OFFER; ?>",
      uarcBtn: "<?php echo Lang::$word->RFARCHIVE; ?>",
      canBtn: "<?php echo Lang::$word->CANCEL; ?>",
      allBtn: "<?php echo Lang::$word->SELECT_ALL; ?>",
      sellOne: "<?php echo Lang::$word->SELECT; ?>",
      sellected: "<?php echo Lang::$word->SELECTED; ?>",
      allSell: "<?php echo Lang::$word->ALL_SELECTED; ?>",
      noMatch: "<?php echo Lang::$word->NOMATCH; ?>",
      delMsg1: "<?php echo Lang::$word->DELCONFIRM1; ?>",
      delMsg2: "<?php echo Lang::$word->DELCONFIRM2; ?>",
      delMsg3: "<?php echo Lang::$word->TRASH; ?>",
      delMsg5: "<?php echo Lang::$word->DELCONFIRM4; ?>",
      delMsg6: "<?php echo Lang::$word->DELCONFIRM6; ?>",
      delMsg7: "<?php echo Lang::$word->DELCONFIRM10; ?>",
      delMsg8: "<?php echo Lang::$word->DELCONFIRM3; ?>",
      delMsg9: "<?php echo Lang::$word->DELCONFIRM11; ?>",
      delMsg12: "<?php echo Lang::$word->DELCONFIRM12; ?>",
      working: "<?php echo Lang::$word->WORKING; ?>"

    }
  });
});
// ]]>
</script>
<?php Debug::displayInfo(); ?>
</body>

</html>

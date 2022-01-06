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
<!-- Footer -->
  <footer> Copyright &copy;<?php echo date('Y') . ' '. $this->core->company;?> </footer>
  
<script type="text/javascript" src="<?php echo SITEURL;?>/assets/editor/trumbowyg.js"></script>
<script type="text/javascript" src="<?php echo ADMINVIEW;?>/js/master.js"></script> 
<script type="text/javascript" src="https://code.jquery.com/ui/1.13.0/jquery-ui.js"></script> 
<script type="text/javascript"> 
// <![CDATA[
$(document).ready(function() {
    var close = 0;
    $(".close_button").click(function(e){
        e.preventDefault();
        $(".navbar").toggle("slide", {direction:"left"},500);
        if(close == 0)
        {
            $(".close_button").css({"transform":"rotate(180deg)"});
            close = 1;
        }else
        {
            $(".close_button").css({"transform":"rotate(0deg)"});
            close = 0;
        }
        
    });
    $.Master({
        weekstart: <?php echo $this->core->weekstart;?>,
		ampm: "<?php echo ($this->core->time_format) == "hh:mm" ? false : true;?>",
		url: "<?php echo ADMINVIEW;?>",
		surl: "<?php echo SITEURL;?>",
        lang: {
            monthsFull: [<?php echo Date::monthList(false);?>],
            monthsShort: [<?php echo Date::monthList(false, false);?>],
            weeksFull: [<?php echo Date::weekList(false);?>],
            weeksShort: [<?php echo Date::weekList(false, 3);?> ],
			weeksMed: [<?php echo Date::weekList(false, 2);?>],
			weeksSmall: [<?php echo Date::weekList(false, 1);?>],
			selPic: "<?php echo Lang::$word->SELPIC;?>",
			ok: "<?php echo Lang::$word->OK;?>",
            today: "<?php echo Lang::$word->TODAY;?>",
			now: "<?php echo Lang::$word->NOW;?>",
            clear: "<?php echo Lang::$word->CLEAR;?>",
			doSearch: "<?php echo Lang::$word->SEARCH;?>",
            delBtn: "<?php echo Lang::$word->DELETE_REC;?>",
			arcBtn: "<?php echo Lang::$word->MTOARCHIVE;?>",
			trsBtn: "<?php echo Lang::$word->MTOTRASH;?>",
			restBtn: "<?php echo Lang::$word->RFCOMPLETE;?>",
			uarcBtn: "<?php echo Lang::$word->RFARCHIVE;?>",
			canBtn: "<?php echo Lang::$word->CANCEL;?>",
			allBtn: "<?php echo Lang::$word->SELECT_ALL;?>",
			sellOne: "<?php echo Lang::$word->SELECT;?>",
			sellected: "<?php echo Lang::$word->SELECTED;?>",
			allSell: "<?php echo Lang::$word->ALL_SELECTED;?>",
			noMatch: "<?php echo Lang::$word->NOMATCH;?>",
            delMsg1: "<?php echo Lang::$word->DELCONFIRM1;?>",
            delMsg2: "<?php echo Lang::$word->DELCONFIRM2;?>",
			delMsg3: "<?php echo Lang::$word->TRASH;?>",
			delMsg5: "<?php echo Lang::$word->DELCONFIRM4;?>",
			delMsg6: "<?php echo Lang::$word->DELCONFIRM6;?>",
			delMsg7: "<?php echo Lang::$word->DELCONFIRM10;?>",
			delMsg8: "<?php echo Lang::$word->DELCONFIRM3;?>",
			delMsg9: "<?php echo Lang::$word->DELCONFIRM11;?>",
            working: "<?php echo Lang::$word->WORKING;?>"
			
		}
    });
});
// ]]>
</script>
<?php Debug::displayInfo();?>
</body>
</html>
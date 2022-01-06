<?php
  /**
   * Reports Budget
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2019
   * @version $Id: _reports_budget.tpl.php, v1.00 2019-05-05 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
?>
<div class="wojo fitted segment">
  <div class="divided header align middle spaced">
    <div class="items">
      <h4 class="basic"><?php echo Lang::$word->REP_SUB10;?></h4>
    </div>
    <div class="items">
      <a data-dropdown="#dProjectList" class="wojo small right primary button">
      <?php echo Lang::$word->REP_SUB24;?>
      <i class="icon horizontal ellipsis"></i>
      </a>
      <div class="wojo dropdown small pointing top-right" id="dProjectList">
        <?php if($this->data):?>
        <?php foreach($this->data as $row):?>
        <a class="item" data-value="<?php echo $row->id;?>"><?php echo $row->name;?></a>
        <?php endforeach;?>
        <?php endif;?>
      </div>
    </div>
  </div>
  <div class="content">
    <div class="row align middle">
      <div class="columns auto">
        <table class="wojo small very basic compact table">
          <tr>
            <td id="budget"></td>
            <td id="bamount"></td>
          </tr>
          <tr>
            <td id="spent"></td>
            <td id="samount"></td>
          </tr>
        </table>
      </div>
    </div>
  </div>
  <div id="results" class="content">
    <div class="center aligned"><img src="<?php echo ADMINVIEW;?>/images/search_empty.svg" alt="">
      <p class="wojo semi grey text"><?php echo Lang::$word->REP_INFO11;?></p>
    </div>
  </div>
</div>
<script src="<?php echo ADMINVIEW;?>/js/reportsBudget.js"></script>
<script type="text/javascript"> 
// <![CDATA[	
$(document).ready(function() {
    $.Budget({
		url: "<?php echo ADMINVIEW;?>",
		lang: {
			budget: "<?php echo Lang::$word->PRJ_BUDGET;?>",
			spent: "<?php echo Lang::$word->REP_SUB33;?>",
		}
    });
});
// ]]>
</script>
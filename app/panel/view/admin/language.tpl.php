<?php
  /**
   * Permissions
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2019
   * @version $Id: permissions.tpl.php, v1.00 2019-05-05 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
	  
  if(!Auth::hasPrivileges('manage_language')): print Message::msgError(Lang::$word->NOACCESS); return; endif;
?>
<div class="wojo heading message">
  <div class="content">
    <h3><?php echo Lang::$word->LMG_TITLE;?></h3>
    <p class="wojo small grey text"><?php echo Lang::$word->LMG_INFO;?></p>
  </div>
</div>
<div class="wojo segment gutters bottom attached form">
  <div class="row gutters align center">
    <div class="columns screen-30 tablet-50 mobile-100 phone-100">
      <div class="wojo fluid icon input"><i class="find icon"></i>
        <input id="filter" type="text" placeholder="<?php echo Lang::$word->SEARCH;?>">
      </div>
    </div>
    <div class="columns screen-30 tablet-50 mobile-100 phone-100">
      <select name="sections" id="pgroup">
        <option value="all"><?php echo Lang::$word->LMG_RESET;?></option>
        <?php foreach($this->sections as $rows):?>
        <option value="<?php echo $rows;?>"><?php echo $rows;?></option>
        <?php endforeach;?>
      </select>
    </div>
  </div>
</div>
<div class="wojo segment" id="langView">
  <div class="wojo small relaxed celled fluid list align middle">
    <div class="item">
      <div class="content"><strong><?php echo Lang::$word->LMG_VALUE;?></strong></div>
      <div class="content auto"><strong><?php echo Lang::$word->LMG_KEY;?></strong></div>
    </div>
  </div>
  <?php $i = 0;?>
  <div class="wojo small relaxed fluid celled list align middle" id="editable">
    <?php foreach ($this->data as $pkey) :?>
    <?php $i++;?>
    <div class="item">
      <div class="content"><span data-editable="true" data-set='{"action": "editPhrase", "id": <?php echo $i;?>,"key":"<?php echo $pkey['data'];?>"}'><?php echo $pkey;?></span></div>
      <div class="content auto"><span class="wojo small dark inverted label"><?php echo $pkey['data'];?></span></div>
    </div>
    <?php endforeach;?>
  </div>
</div>
<script type="text/javascript"> 
// <![CDATA[	
$(document).ready(function() {
  $("#filter").on("keyup", function() {
	  var filter = $(this).val(),
		  count = 0;
	  $("span[data-editable=true]").each(function() {
		  if ($(this).text().search(new RegExp(filter, "i")) < 0) {
			  $(this).parents('.item').fadeOut();
		  } else {
			  $(this).parents('.item').fadeIn();
			  count++;
		  }
	  });
  });
  
  $('#pgroup').on('change', function() {
	  var sel = $(this).val();
	  var type = (sel === "all") ? "all" : "filter";
	  $('#langView').addClass('loading');
	  $.get("<?php echo ADMINVIEW . "/helper.php";?>", {
		  action: "loadLanguageSection",
		  type: type,
		  section: sel
	  }, function(json) {
		  $("#editable").html(json.html).fadeIn("slow");
		  $('#editable').editableTableWidget();
		  $('#langView').removeClass('loading');
	  }, "json");
  });
});
// ]]>
</script>
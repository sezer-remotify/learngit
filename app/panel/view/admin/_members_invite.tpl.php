<?php
  /**
   * Members Invite
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2019
   * @version $Id: _members_invite.tpl.php, v1.00 2019-05-05 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
	  
  if(!Auth::hasPrivileges('invite_people')): print Message::msgError(Lang::$word->NOACCESS); return; endif;
?>
<div class="wojo heading message">
  <div class="content">
    <h3><?php echo str_replace("[COMPANY]", App::Core()->company, Lang::$word->MAC_INVPEOPLE1);?></h3>
    <p class="wojo small grey text"><?php echo Lang::$word->MAC_INVPEOPLE1_INFO;?></p>
  </div>
</div>
<div class="row gutters align bottom">
  <div class="columns">
    <div class="wojo small white stacked buttons">
      <a class="wojo active passive button"><?php echo Lang::$word->MAC_INVPEOPLE;?></a>
      <a href="<?php echo Url::url("/admin/companies", "new");?>" class="wojo button"><?php echo Lang::$word->CMP_NEW;?></a>
      <a href="<?php echo Url::url("/admin/teams");?>" class="wojo button"><?php echo Lang::$word->TMS_TEAMS;?></a>
      <a href="<?php echo Url::url("/admin/archive");?>" class="wojo button"><?php echo Lang::$word->ARCHIVE;?></a>
    </div>
  </div>
</div>
<form method="post" id="wojo_form" name="wojo_form">
  <div class="wojo gutters segment form">
    <h6 class="big margin bottom"><span class="wojo grey text"><?php echo Lang::$word->MAC_SUB5;?></span></h6>
    <div class="wojo fields align middle">
      <div class="field four wide labeled">
        <label><?php echo Lang::$word->MAC_INVEMAIL;?>
          <i class="icon asterisk"></i></label>
      </div>
      <div class="field">
        <input placeholder="<?php echo Lang::$word->EMAIL;?>" type="text" name="email[]">
      </div>
    </div>
    <div class="wojo fields align middle">
      <div class="field four wide labeled"></div>
      <div class="field">
        <input placeholder="<?php echo Lang::$word->EMAIL;?>" type="text" name="email[]">
      </div>
    </div>
    <div class="wojo fields align middle clone">
      <div class="field four wide labeled"></div>
      <div class="field">
        <input placeholder="<?php echo Lang::$word->EMAIL;?>" type="text" name="email[]">
      </div>
    </div>
    <div class="wojo fields align middle">
      <div class="field four wide labeled"></div>
      <div class="field">
        <a class="wojo white small button clonner" data-wcloner='{"clonnable": ".clone","limit":5}'><i class="icon alt plus"></i><?php echo Lang::$word->ADDMORE;?></a>
      </div>
    </div>
    <h6 class="big margin bottom"><span class="wojo grey text"><?php echo Lang::$word->MAC_SUB6;?></span></h6>
    <div class="wojo fields">
      <div class="field four wide labeled">
        <label><?php echo Lang::$word->MAC_SUB7;?></label>
      </div>
      <div class="field">
        <div class="wojo block fields">
          <div class="wojo simple attached segment">
            <div class="basic field">
              <div class="wojo toggle radio checkbox">
                <input name="role" value="owner" type="radio" id="label_owner">
                <label for="label_owner"><?php echo Lang::$word->OWNER;?></label>
              </div>
              <p class="wojo small dimmed text"><?php echo Lang::$word->MAC_INFO1;?></p>
            </div>
          </div>
          <div class="wojo simple segment cwrap">
            <div class="basic field">
              <div class="wojo toggle radio checkbox">
                <input name="role" value="staff" type="radio" id="label_staff" checked="checked">
                <label for="label_staff"><?php echo Lang::$word->LEV8;?></label>
              </div>
            </div>
            <div class="basic field" id="companyField">
              <select name="company" id="companyList" data-wselect='{"search":true}' class="selectbox">
                <option value="0"><?php echo Lang::$word->CMP_SELECT;?></option>
                <?php if($this->companies):?>
                <?php foreach($this->companies as $crow):?>
                <option value="<?php echo $crow->id;?>"><?php echo $crow->name;?></option>
                <?php endforeach;?>
                <?php endif;?>
              </select>
              <p>
                <a data-set='{"option":[{"action":"newCompany"}], "label":"<?php echo Lang::$word->CREATE;?>", "url":"helper.php", "parent":"#companyList", "complete":"insert","mode":"prepend", "modalclass":"normal","callback":[{"type": "select","method":"refresh", "element":"#companyList"}]}' class="wojo small white button action"><i class="icon plus alt"></i><?php echo Lang::$word->CMP_ADD;?></a>
              </p>
              <p class="wojo small grey text">
                <?php echo Lang::$word->MAC_INFO2;?>
              </p>
            </div>
          </div>
          <div class="wojo simple attached segment cwrap">
            <div class="basic field">
              <div class="wojo toggle radio checkbox">
                <input name="role" value="member" type="radio" id="label_member">
                <label for="label_member"><?php echo Lang::$word->LEV1;?></label>
              </div>
              <p class="wojo small grey text"><?php echo Lang::$word->MAC_INFO3;?></p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="wojo segment form">
    <h6 class="big margin bottom"><span class="wojo grey text"><?php echo Lang::$word->CMP_PRJSEL;?></span></h6>
    <div class="wojo fields align middle">
      <div class="field four wide labeled">
        <label>
          <?php echo Lang::$word->MAC_SUB8;?>
        </label>
      </div>
      <div class="field">
        <?php if(!$this->projects):?>
        <p class="wojo small info message"><?php echo Lang::$word->MAC_SUB12;?></p>
        <?php endif;?>
        <?php if($this->projects):?>
        <a class="wojo simple right button" data-parent="#projects" id="masterCheckbox">
        <?php echo Lang::$word->TOGGLEALL;?>
        <i class="icon check"></i></a>
        <div class="wojo space divider"></div>
        <div class="row grid screen-3 tablet-2 mobile-2 small gutters" id="projects">
          <?php foreach ($this->projects as $prow):?>
          <div class="columns">
            <div class="wojo fitted checkbox">
              <input type="checkbox" name="projects[]" id="projects_<?php echo $prow->id;?>" value="<?php echo $prow->id;?>">
              <label for="projects_<?php echo $prow->id;?>"><?php echo $prow->name;?></label>
            </div>
          </div>
          <?php endforeach;?>
        </div>
        <?php endif;?>
      </div>
    </div>
    <div class="center aligned">
      <button type="button" data-action="invitePople" name="dosubmit" class="wojo primary button"><?php echo Lang::$word->MAC_SENDINV;?></button>
    </div>
  </div>
</form>
<script type="text/javascript"> 
// <![CDATA[  
$(document).ready(function() {	
  $("input[name=role]").change(function () {
	  if($(this).val() === "member" || $(this).val() === "staff") {
		  var $wrap = $(this).closest(".cwrap");
		  $("#companyField").appendTo($wrap).show();
	  } else {
		  $("#companyField").hide();
	  }
  });
});
// ]]>
</script>
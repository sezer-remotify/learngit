<?php
  /**
   * Configuration
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2019
   * @version $Id: configuration.tpl.php, v1.00 2019-05-05 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
	  
  if (!Auth::checkAcl("owner")) : print Message::msgError(Lang::$word->NOACCESS); return; endif;
?>
<?php switch(Url::segment($this->segments)): case "technical": ?>
<!-- Start technical -->
<div class="row align center">
  <div class="columns screen-70 tablet-100 mobile-100 phone-100">
    <form method="post" id="wojo_form" name="wojo_form">
      <div class="wojo segment form">
        <h4 class="big margin bottom"><?php echo Lang::$word->CFG_SUB1;?></h4>
        <div class="wojo fields align middle">
          <div class="field four wide labeled">
            <label>
              <?php echo Lang::$word->CFG_DIR;?></label>
          </div>
          <div class="field">
            <input type="text" value="<?php echo $this->core->site_dir;?>" placeholder="<?php echo Lang::$word->CFG_DIR;?>" name="site_dir">
          </div>
        </div>
        <div class="wojo fields align middle">
          <div class="field four wide labeled">
            <label>
              <?php echo Lang::$word->CFG_THEME;?></label>
          </div>
          <div class="field">
            <select name="theme">
              <?php File::getThemes(BASEPATH . "/view/front/themes", $this->core->theme);?>
            </select>
          </div>
        </div>
        <div class="wojo fields align middle">
          <div class="field four wide labeled">
            <label>
              <?php echo Lang::$word->CFG_FILES;?>
              <i class="asterisk icon"></i></label>
          </div>
          <div class="field">
            <div class="wojo labeled right input">
              <input type="text" value="<?php echo ($this->core->file_size / 1048576);?>" placeholder="<?php echo Lang::$word->CFG_FILES;?>" name="file_size">
              <span class="wojo simple label">mb</span>
            </div>
          </div>
        </div>
        <div class="wojo fields align middle">
          <div class="field four wide labeled">
            <label>
              <?php echo Lang::$word->CFG_FILEE;?>
              <i class="asterisk icon"></i></label>
          </div>
          <div class="field">
            <input type="text" value="<?php echo $this->core->file_ext;?>" placeholder="<?php echo Lang::$word->CFG_FILEE;?>" name="file_ext">
          </div>
        </div>
        <div class="wojo fields align middle">
          <div class="field four wide labeled">
            <label>
              <?php echo Lang::$word->CFG_MAILER;?></label>
          </div>
          <div class="field">
            <select id="mailerchange" name="mailer">
              <option value="PHP" <?php if ($this->core->mailer == "PHP") echo "selected=\"selected\"";?>>PHP Mailer</option>
              <option value="SMAIL" <?php if ($this->core->mailer == "SMAIL") echo "selected=\"selected\"";?>>Sendmail</option>
              <option value="SMTP" <?php if ($this->core->mailer == "SMTP") echo "selected=\"selected\"";?>>SMTP Mailer</option>
            </select>
          </div>
        </div>
        <div class="showsmail">
          <div class="wojo fields align middle">
            <div class="field four wide labeled">
              <label>
                <?php echo Lang::$word->CFG_SMAILPATH;?>
                <i class="asterisk icon"></i></label>
            </div>
            <div class="field">
              <input type="text" value="<?php echo $this->core->sendmail;?>" placeholder="<?php echo Lang::$word->CFG_SMAILPATH;?>" name="sendmail">
            </div>
          </div>
        </div>
        <div class="showsmtp">
          <div class="wojo fields align middle">
            <div class="field four wide labeled">
              <label>
                <?php echo Lang::$word->CFG_SMTP_HOST;?>
                <i class="asterisk icon"></i></label>
            </div>
            <div class="field">
              <input type="text" value="<?php echo $this->core->smtp_host;?>" placeholder="<?php echo Lang::$word->CFG_SMTP_HOST;?>" name="smtp_host">
            </div>
          </div>
          <div class="wojo fields align middle">
            <div class="field four wide labeled">
              <label>
                <?php echo Lang::$word->CFG_SMTP_USER;?>
                <i class="asterisk icon"></i></label>
            </div>
            <div class="field">
              <input type="text" value="<?php echo $this->core->smtp_user;?>" placeholder="<?php echo Lang::$word->CFG_SMTP_USER;?>" name="smtp_user">
            </div>
          </div>
          <div class="wojo fields align middle">
            <div class="field four wide labeled">
              <label>
                <?php echo Lang::$word->CFG_SMTP_PASS;?>
                <i class="asterisk icon"></i></label>
            </div>
            <div class="field">
              <input type="text" value="<?php echo $this->core->smtp_pass;?>" placeholder="<?php echo Lang::$word->CFG_SMTP_PASS;?>" name="smtp_pass">
            </div>
          </div>
          <div class="wojo fields align middle">
            <div class="field four wide labeled">
              <label>
                <?php echo Lang::$word->CFG_SMTP_PORT;?> / <?php echo Lang::$word->CFG_SMTP_SSL;?>
                <i class="asterisk icon"></i></label>
            </div>
            <div class="field">
              <input type="text" value="<?php echo $this->core->smtp_port;?>" placeholder="<?php echo Lang::$word->CFG_SMTP_PORT;?>" name="smtp_port">
            </div>
            <div class="field">
              <div class="wojo inline fitted checkbox toggle">
                <input name="is_ssl" type="radio" value="1" <?php Validator::getChecked($this->core->is_ssl, 1); ?> id="is_ssl_1">
                <label for="is_ssl_1"><?php echo Lang::$word->YES;?></label>
              </div>
              <div class="wojo inline fitted checkbox toggle">
                <input name="is_ssl" type="radio" value="0" <?php Validator::getChecked($this->core->is_ssl, 0); ?> id="is_ssl_0">
                <label for="is_ssl_0"><?php echo Lang::$word->NO;?></label>
              </div>
            </div>
          </div>
        </div>
        <div class="center aligned margin top">
          <a href="<?php echo Url::url("/admin/configuration");?>" class="wojo simple button"><?php echo Lang::$word->CANCEL;?></a>
          <button type="button" data-action="processConfig" name="dosubmit" class="wojo primary button"><?php echo Lang::$word->SAVEC;?></button>
        </div>
      </div>
      <input type="hidden" name="page" value="tech">
    </form>
  </div>
</div>
<script type="text/javascript"> 
// <![CDATA[  
$(document).ready(function () {
     var res2 = '<?php echo $this->core->mailer;?>';
     (res2 == "SMTP") ? $('.showsmtp').show() : $('.showsmtp').hide();
     $('#mailerchange').change(function () {
         var res = $("#mailerchange option:selected").val();
         (res == "SMTP") ? $('.showsmtp').show() : $('.showsmtp').hide();
     });

     (res2 == "SMAIL") ? $('.showsmail').show() : $('.showsmail').hide();
     $('#mailerchange').change(function () {
         var res = $("#mailerchange option:selected").val();
         (res == "SMAIL") ? $('.showsmail').show() : $('.showsmail').hide();
     });
});
// ]]>
</script>
<?php break;?>
<!-- Start global -->
<?php case "global": ?>
<div class="wojo segment form">
  <h4 class="big margin bottom"><?php echo Lang::$word->CFG_SUB2;?></h4>
  <form method="post" id="wojo_form" name="wojo_form">
    <div class="wojo fields align middle">
      <div class="field four wide labeled">
        <label>
          <?php echo Lang::$word->CFG_COMPANY;?>
          <i class="asterisk icon"></i></label>
      </div>
      <div class="field">
        <input type="text" value="<?php echo $this->core->company;?>" placeholder="<?php echo Lang::$word->CFG_COMPANY;?>" name="company">
      </div>
    </div>
    <div class="wojo fields align middle">
      <div class="field four wide labeled">
        <label>
          <?php echo Lang::$word->CFG_WEBEMAIL;?>
          <i class="asterisk icon"></i></label>
      </div>
      <div class="field">
        <input type="text" value="<?php echo $this->core->site_email;?>" placeholder="<?php echo Lang::$word->CFG_WEBEMAIL;?>" name="site_email">
      </div>
    </div>
    <div class="wojo fields align middle">
      <div class="field four wide labeled">
        <label>
          <?php echo Lang::$word->CFG_DTZ;?>
          <i class="asterisk icon"></i></label>
      </div>
      <div class="field">
        <select name="dtz">
          <?php echo Date::getTimezones();?>
        </select>
      </div>
    </div>
    <div class="wojo fields align middle">
      <div class="field four wide labeled">
        <label>
          <?php echo Lang::$word->CFG_LOCALES;?>
          <i class="asterisk icon"></i></label>
      </div>
      <div class="field">
        <select name="locale">
          <?php echo Date::localeList($this->core->locale);?>
        </select>
      </div>
    </div>
    <div class="wojo fields align middle">
      <div class="field four wide labeled">
        <label>
          <?php echo Lang::$word->CFG_WEEKSTART;?>
          <i class="asterisk icon"></i></label>
      </div>
      <div class="field">
        <div class="wojo checkbox fitted inline toggle">
          <input name="weekstart" type="radio" value="0" <?php Validator::getChecked($this->core->weekstart, 0); ?> id="weekstart_0">
          <label for="weekstart_0"><?php echo Lang::$word->SUN_L;?></label>
        </div>
        <div class="wojo checkbox fitted inline toggle">
          <input name="weekstart" type="radio" value="1" <?php Validator::getChecked($this->core->weekstart, 1); ?> id="weekstart_1">
          <label for="weekstart_1"><?php echo Lang::$word->MON_L;?></label>
        </div>
      </div>
    </div>
    <div class="wojo fields align middle">
      <div class="field four wide labeled">
        <label>
          <?php echo Lang::$word->CFG_SHORTDATE;?>
          <i class="asterisk icon"></i></label>
      </div>
      <div class="field">
        <select name="short_date">
          <?php echo Date::getShortDate($this->core->short_date);?>
        </select>
      </div>
    </div>
    <div class="wojo fields align middle">
      <div class="field four wide labeled">
        <label>
          <?php echo Lang::$word->CFG_LONGDATE;?>
          <i class="asterisk icon"></i></label>
      </div>
      <div class="field">
        <select name="long_date">
          <?php echo Date::getLongDate($this->core->long_date);?>
        </select>
      </div>
    </div>
    <div class="wojo fields align middle">
      <div class="field four wide labeled">
        <label>
          <?php echo Lang::$word->CFG_TIME;?>
          <i class="asterisk icon"></i></label>
      </div>
      <div class="field">
        <select name="time_format">
          <?php echo Date::getTimeFormat($this->core->time_format);?>
        </select>
      </div>
    </div>
    <div class="wojo fields align top">
      <div class="field four wide labeled">
        <label>
          <?php echo Lang::$word->PRIVACY;?></label>
      </div>
      <div class="field">
        <textarea name="privacy" class="auto quickpost"><?php echo $this->core->privacy;?></textarea>
      </div>
    </div>
    <div class="center aligned">
      <a href="<?php echo Url::url("/admin/configuration");?>" class="wojo simple button"><?php echo Lang::$word->CANCEL;?></a>
      <button type="button" data-action="processConfig" name="dosubmit" class="wojo primary button"><?php echo Lang::$word->SAVEC;?></button>
    </div>
    <input type="hidden" name="page" value="global">
  </form>
</div>
<?php break;?>
<!-- Start general -->
<?php case "general": ?>
<div class="row align center">
  <div class="columns screen-70 tablet-100 mobile-100 phone-100">
    <form method="post" id="wojo_form" name="wojo_form">
      <div class="wojo segment form">
        <h4 class="big margin bottom"><?php echo Lang::$word->CFG_SUB3;?></h4>
        <div class="wojo fields align middle">
          <div class="field four wide labeled">
            <label>
              <?php echo Lang::$word->CFG_CURRENCY;?>
              <i class="asterisk icon"></i></label>
          </div>
          <div class="field">
            <select name="currency">
              <?php foreach($this->countries as $ctrow):?>
              <option <?php echo ($this->core->currency == $ctrow->currency_code) ? 'selected="selected"' : null ;?> value="<?php echo $ctrow->currency_code;?>"><?php echo $ctrow->name;?> - <?php echo $ctrow->currency_name;?> (<?php echo $ctrow->currrency_symbol;?>)</option>
              <?php endforeach;?>
            </select>
          </div>
        </div>
        <div class="wojo fields align middle">
          <div class="field four wide labeled">
            <label>
              <?php echo Lang::$word->CFG_LANG;?>
              <i class="asterisk icon"></i></label>
          </div>
          <div class="field">
            <select name="lang">
              <?php foreach(Lang::fetchLanguage() as $langlist):?>
              <option value="<?php echo substr($langlist, 0, 2);?>" <?php echo Validator::getSelected($this->core->lang, substr($langlist, 0, 2));?>><?php echo strtoupper(substr($langlist, 0, 2));?></option>
              <?php endforeach;?>
            </select>
          </div>
        </div>
        <div class="wojo fields align middle">
          <div class="field four wide labeled">
            <label>
              <?php echo Lang::$word->CFG_PERPAGE;?>
              <i class="asterisk icon"></i></label>
          </div>
          <div class="field">
            <input name="perpage" type="range" min="10" max="60" step="5" value="<?php echo $this->core->perpage;?>" hidden data-suffix=" itm" data-type="labels" data-labels="10,20,30,40,50,60">
          </div>
        </div>
        <div class="wojo fields align middle">
          <div class="field four wide labeled">
            <label>
              <?php echo Lang::$word->CFG_TWID;?></label>
          </div>
          <div class="field">
            <input name="twitter" value="<?php echo $this->core->social->twitter;?>" placeholder="<?php echo Lang::$word->CFG_TWID;?>">
          </div>
        </div>
        <div class="wojo fields align middle">
          <div class="field four wide labeled">
            <label>
              <?php echo Lang::$word->CFG_FBID;?></label>
          </div>
          <div class="field">
            <div class="wojo fluid input">
              <input name="facebook" value="<?php echo $this->core->social->facebook;?>" placeholder="<?php echo Lang::$word->CFG_FBID;?>">
            </div>
          </div>
        </div>
        <div class="wojo fields align middle">
          <div class="field four wide labeled">
            <label>
              <?php echo Lang::$word->CFG_EUCOOKIE1;?></label>
          </div>
          <div class="field">
            <div class="wojo checkbox fitted inline toggle">
              <input name="eucookie" type="radio" value="0" <?php Validator::getChecked($this->core->eucookie, 0); ?> id="eucookie_0">
              <label for="eucookie_0"><?php echo Lang::$word->YES;?></label>
            </div>
            <div class="wojo checkbox fitted inline toggle">
              <input name="eucookie" type="radio" value="1" <?php Validator::getChecked($this->core->eucookie, 1); ?> id="eucookie_1">
              <label for="eucookie_1"><?php echo Lang::$word->NO;?></label>
            </div>
          </div>
        </div>
        <div class="wojo fields align middle">
          <div class="field four wide labeled">
            <label>
              <?php echo Lang::$word->CFG_LOGO;?></label>
          </div>
          <div class="field">
            <input type="file" data-type="image" data-class="inverted left" name="logo" data-exist="<?php echo ($this->core->logo) ? UPLOADURL . '/' . $this->core->logo : '';?>" accept="image/png, image/jpeg, image/svg">
          </div>
        </div>
        <div class="center aligned">
          <a href="<?php echo Url::url("/admin/configuration");?>" class="wojo simple button"><?php echo Lang::$word->CANCEL;?></a>
          <button type="button" data-action="processConfig" name="dosubmit" class="wojo primary button"><?php echo Lang::$word->SAVEC;?></button>
        </div>
      </div>
      <input type="hidden" name="page" value="general">
    </form>
  </div>
</div>
<?php break;?>
<!-- Start project -->
<?php case "project": ?>
<div class="row align center">
  <div class="columns screen-70 tablet-100 mobile-100 phone-100" id="editable">
    <form method="post" id="wojo_form" name="wojo_form">
      <div class="wojo form segment">
        <h4 class="big margin bottom"><?php echo Lang::$word->CFG_SUB4;?></h4>
        <div class="wojo fields">
          <div class="field four wide labeled">
            <label><?php echo Lang::$word->CFG_TASKL;?></label>
          </div>
          <div class="field">
            <div id="tLabelHolder" class="wojo small relaxed celled fluid list margin bottom">
              <?php if($this->tasklabels):?>
              <?php foreach($this->tasklabels as $trow):?>
              <div class="item align middle">
                <div class="content">
                  <span data-editable="true" data-set='{"action": "updateTaskLabel", "id": <?php echo $trow->id?>, "name":"<?php echo Validator::sanitize($trow->name, "chars");?>"}'><?php echo $trow->name;?></span></div>
                <div class="content auto">
                  <a class="wojo small dark inverted icon button is_colorOld" data-type="TaskLabelColor" data-id="<?php echo $trow->id?>"><i class="icon contrast" style="color:<?php echo $trow->color;?>"></i></a>
                  <a class="wojo small light inverted icon button removeOld" data-type="deleteTaskLabel" data-id="<?php echo $trow->id?>"><i class="icon negative delete"></i></a>
                </div>
              </div>
              <?php endforeach;?>
              <?php endif;?>
            </div>
          </div>
        </div>
        <div class="center aligned"><a id="clonetLabel" class="wojo small white compact button"><i class="icon plus alt"></i><?php echo Lang::$word->ADDMORE;?></a>
        </div>
      </div>
      <div class="wojo form segment">
        <div class="wojo fields">
          <div class="field four wide labeled">
            <label><?php echo Lang::$word->CFG_PRJLABELS;?></label>
          </div>
          <div class="field">
            <div id="pLabelHolder" class="wojo small relaxed celled fluid list margin bottom">
              <?php if($this->projectlabels):?>
              <?php foreach($this->projectlabels as $prow):?>
              <div class="item align middle">
                <div class="content">
                  <span data-editable="true" data-set='{"action": "updateProjectLabel", "id": <?php echo $prow->id?>,"name":"<?php echo Validator::sanitize($prow->name, "chars");?>"}'><?php echo $prow->name;?></span></div>
                <div class="content auto">
                  <a class="wojo small dark inverted icon button is_colorOld" data-type="ProjectLabelColor" data-id="<?php echo $prow->id?>"><i class="icon contrast" style="color:<?php echo $prow->color;?>"></i></a>
                  <a class="wojo small light inverted icon button removeOld" data-type="deleteProjectLabel" data-id="<?php echo $prow->id?>"><i class="icon negative delete"></i></a>
                </div>
              </div>
              <?php endforeach;?>
              <?php endif;?>
            </div>
          </div>
        </div>
        <div class="center aligned"><a id="clonepLabel" class="wojo small white compact button"><i class="icon plus alt"></i><?php echo Lang::$word->ADDMORE;?></a>
        </div>
      </div>
      <div class="wojo form segment">
        <div class="wojo fields">
          <div class="field four wide labeled">
            <label><?php echo Lang::$word->CFG_PRJCATS;?></label>
          </div>
          <div class="field">
            <div id="cLabelHolder" class="wojo small relaxed celled fluid list margin bottom">
              <?php if($this->projectcats):?>
              <?php foreach($this->projectcats as $crow):?>
              <div class="item align middle">
                <div class="content">
                  <span data-editable="true" data-set='{"action": "updateProjectCat", "id": <?php echo $crow->id?>,"name":"<?php echo Validator::sanitize($crow->name, "chars");?>"}'><?php echo $crow->name;?></span></div>
                <div class="content auto">
                  <a class="wojo small light inverted icon button removeOld" data-type="deleteProjectCat" data-id="<?php echo $crow->id?>"><i class="icon negative delete"></i></a>
                </div>
              </div>
              <?php endforeach;?>
              <?php endif;?>
            </div>
          </div>
        </div>
        <div class="center aligned">
          <a id="clonecLabel" class="wojo small white compact button"><i class="icon plus alt"></i><?php echo Lang::$word->ADDMORE;?></a>
        </div>
      </div>
      <div class="wojo form segment">
        <div class="wojo fields align middle">
          <div class="field four wide labeled">
            <label><?php echo Lang::$word->CFG_PRJVIEW;?></label>
          </div>
          <div class="field">
            <div class="wojo checkbox inline fitted toggle">
              <input name="project_view" type="radio" value="0" <?php Validator::getChecked($this->core->project_view, 0); ?> id="project_view_0">
              <label for="project_view_0"><?php echo Lang::$word->LIST;?></label>
            </div>
            <div class="wojo checkbox inline fitted toggle">
              <input name="project_view" type="radio" value="1" <?php Validator::getChecked($this->core->project_view, 1); ?> id="project_view_1">
              <label for="project_view_1"><?php echo Lang::$word->GRID;?></label>
            </div>
          </div>
        </div>
        <div class="center aligned">
          <a href="<?php echo Url::url("/admin/configuration");?>" class="wojo simple button"><?php echo Lang::$word->CANCEL;?></a>
          <button type="button" data-action="processConfig" name="dosubmit" class="wojo primary button"><?php echo Lang::$word->SAVEC;?></button>
        </div>
      </div>
      <input type="hidden" name="page" value="project">
    </form>
  </div>
</div>
<script src="<?php echo ADMINVIEW;?>/js/config.js"></script>
<script type="text/javascript"> 
// <![CDATA[	
$(document).ready(function() {
    $.Config({
		url: "<?php echo ADMINVIEW;?>",
        lang: {
            prjLabel: "<?php echo Lang::$word->CFG_PRJLABNAME;?>",
            catLabel: "<?php echo Lang::$word->PRJ_CATNAME;?>",
			palLabel: "<?php echo Lang::$word->DEFAULT_PALETTE;?>",
        }
    });
});
// ]]>
</script>
<?php break;?>
<!-- Start time -->
<?php case "time": ?>
<div class="row align center">
  <div class="columns screen-70 tablet-100 mobile-100 phone-100" id="editable">
    <form method="post" id="wojo_form" name="wojo_form">
      <div class="wojo form segment">
        <h4 class="big margin bottom"><?php echo Lang::$word->CFG_SUB5;?></h4>
        <div class="wojo fields">
          <div class="field four wide labeled">
            <label><?php echo Lang::$word->CFG_SUB7;?></label>
          </div>
          <div class="field">
            <div id="jtypelHolder" class="wojo small relaxed celled fluid list align middle">
              <?php if($this->jobs):?>
              <?php foreach($this->jobs as $jrow):?>
              <div class="item align middle">
                <div class="content">
                  <span data-editable="true" data-set='{"action": "updateJobName", "id": <?php echo $jrow->id?>,"name":"<?php echo Validator::sanitize($jrow->name, "chars");?>"}'><?php echo $jrow->name;?></span>
                </div>
                <div class="content">
                  <span data-editable="true" data-set='{"action": "updateJobHour", "id": <?php echo $jrow->id?>,"name":"<?php echo $jrow->hrate;?>"}'><?php echo $jrow->hrate;?></span>
                </div>
                <div class="content auto">
                  <?php if($jrow->active):?>
                  <a class="wojo small white icon button disabled"><i class="icon negative delete"></i></a>
                  <?php else:?>
                  <a class="wojo small light inverted icon button removeOld" data-type="deleteJobType" data-id="<?php echo $jrow->id?>"><i class="icon negative delete"></i></a>
                  <?php endif;?>
                </div>
              </div>
              <?php endforeach;?>
              <?php endif;?>
            </div>
            <p class="wojo small text"><?php echo Lang::$word->CFG_SUB7_1;?></p>
          </div>
        </div>
        <div class="center aligned">
          <a id="clonejType" class="wojo small white compact button"><i class="icon plus alt"></i><?php echo Lang::$word->ADDMORE;?></a>
        </div>
      </div>
      <div class="wojo form segment">
        <div class="wojo fields">
          <div class="field four wide labeled">
            <label><?php echo Lang::$word->EXP_CATS;?></label>
          </div>
          <div class="field">
            <div id="xtypelHolder" class="wojo small relaxed celled fluid list align middle">
              <?php if($this->excats):?>
              <?php foreach($this->excats as $crow):?>
              <div class="item align middle">
                <div class="content"><span data-editable="true" data-set='{"action": "upadeExCatName", "id": <?php echo $crow->id?>,"name":"<?php echo Validator::sanitize($crow->name, "name");?>"}'><?php echo $crow->name;?></span></div>
                <div class="content auto">
                  <?php if($crow->active):?>
                  <a class="wojo small white icon button disabled"><i class="icon negative delete"></i></a>
                  <?php else:?>
                  <a class="wojo small light inverted icon button removeOld" data-type="deleteExCat" data-id="<?php echo $crow->id?>"><i class="icon negative delete"></i></a>
                  <?php endif;?>
                </div>
              </div>
              <?php endforeach;?>
              <?php endif;?>
            </div>
          </div>
        </div>
        <div class="center aligned">
          <a id="clonexType" class="wojo small white compact button"><i class="icon plus alt"></i><?php echo Lang::$word->ADDMORE;?></a>
        </div>
      </div>
      <div class="center aligned">
        <a href="<?php echo Url::url("/admin/configuration");?>" class="wojo simple button"><?php echo Lang::$word->CANCEL;?></a>
        <button type="button" data-action="processConfig" name="dosubmit" class="wojo primary button"><?php echo Lang::$word->SAVEC;?></button>
      </div>
      <input type="hidden" name="page" value="time">
    </form>
  </div>
</div>
<script src="<?php echo ADMINVIEW;?>/js/config.js"></script>
<script type="text/javascript"> 
// <![CDATA[	
$(document).ready(function() {
    $.Config({
		url: "<?php echo ADMINVIEW;?>",
        lang: {
            prjLabel: "<?php echo Lang::$word->CFG_PRJLABNAME;?>",
            catLabel: "<?php echo Lang::$word->PRJ_CATNAME;?>",
			rateLabel: "<?php echo Lang::$word->CMP_JOBT;?>",
			hourLabel: "<?php echo Lang::$word->CFG_SUB8;?>",
        }
    });
});
// ]]>
</script>
<?php break;?>
<!-- Start invoicing -->
<?php case "invoicing": ?>
<div class="row align center">
  <div class="columns screen-70 tablet-100 mobile-100 phone-100">
    <form method="post" id="wojo_form" name="wojo_form">
      <div class="wojo segment form" id="editable">
        <h4 class="big margin bottom"><?php echo Lang::$word->CFG_SUB6;?></h4>
        <div class="wojo fields">
          <div class="field four wide labeled">
            <label><?php echo Lang::$word->CFG_TAX_RATE;?></label>
          </div>
          <div class="field">
            <div id="taxHolder" class="wojo small relaxed celled fluid list align-middle">
              <?php if($this->taxes):?>
              <?php foreach($this->taxes as $trow):?>
              <div class="item align middle">
                <div class="content"><span data-editable="true" data-set='{"action": "updateTaxName", "id": <?php echo $trow->id?>,"name":"<?php echo $trow->name;?>"}'><?php echo $trow->name;?></span></div>
                <div class="content"><span data-editable="true" data-set='{"action": "updateTaxRate", "id": <?php echo $trow->id?>,"name":"<?php echo $trow->amount;?>"}'><?php echo $trow->amount;?></span></div>
                <div class="content auto">
                  <a class="wojo small light inverted icon button removeOld" data-type="deleteTaxRate" data-id="<?php echo $trow->id?>"><i class="icon negative delete"></i></a>
                </div>
              </div>
              <?php endforeach;?>
              <?php endif;?>
            </div>
            <p class="wojo small text"><?php echo Lang::$word->CFG_SUB9;?></p>
          </div>
        </div>
        <div class="center aligned">
          <a id="clonetxType" class="wojo small white compact button"><i class="icon plus alt"></i><?php echo Lang::$word->ADDMORE;?></a>
        </div>
      </div>
      <div class="wojo segment form">
        <div class="wojo fields align middle">
          <div class="field four wide labeled">
            <label>
              <?php echo Lang::$word->CFG_OVERDUE;?></label>
          </div>
          <div class="field">
            <select name="overdue">
              <?php echo $this->overdue;?>
            </select>
          </div>
        </div>
        <div class="showsmail">
          <div class="wojo fields align middle">
            <div class="field four wide labeled">
              <label>
                <?php echo Lang::$word->CFG_INVPRFX;?></label>
            </div>
            <div class="field">
              <input type="text" value="<?php echo $this->core->invoice_number;?>" placeholder="<?php echo Lang::$word->CFG_INVPRFX;?>" name="invoice_number">
            </div>
          </div>
        </div>
        <div class="wojo fields align middle">
          <div class="field four wide labeled">
            <label>
              <?php echo Lang::$word->CFG_PSIZE;?></label>
          </div>
          <div class="field">
            <select name="pagesize">
              <option value="A4" <?php Validator::getSelected($this->core->pagesize, "A4");?>>A4</option>
              <option value="LETTER" <?php Validator::getSelected($this->core->pagesize, "LETTER");?>>LETTER</option>
            </select>
          </div>
        </div>
        <div class="wojo fields">
          <div class="field four wide labeled">
            <label>
              <?php echo Lang::$word->CFG_INVCMPINFO;?></label>
          </div>
          <div class="field">
            <textarea name="invoice_info" placeholder="<?php echo Lang::$word->CFG_INVCMPINFO;?>"><?php echo $this->core->invoice_info;?></textarea>
          </div>
        </div>
        <div class="wojo fields align middle">
          <div class="field four wide labeled">
            <label>
              <?php echo Lang::$word->CFG_INVIEW;?>
              <i class="asterisk icon"></i></label>
          </div>
          <div class="field">
            <div class="wojo checkbox fitted inline toggle">
              <input name="invoice_view" type="radio" value="0" <?php Validator::getChecked($this->core->weekstart, 0); ?> id="invoice_view_0">
              <label for="invoice_view_0"><?php echo Lang::$word->LIST;?></label>
            </div>
            <div class="wojo checkbox fitted inline toggle">
              <input name="invoice_view" type="radio" value="1" <?php Validator::getChecked($this->core->weekstart, 1); ?> id="invoice_view_1">
              <label for="invoice_view_1"><?php echo Lang::$word->GRID;?></label>
            </div>
          </div>
        </div>
        <div class="wojo fields align middle">
          <div class="field four wide labeled">
            <label>
              <?php echo Lang::$word->CFG_LOGO_PRINT;?></label>
          </div>
          <div class="field">
            <input type="file" data-type="image" data-class="inverted left" name="logo" data-exist="<?php echo (UPLOADURL . '/print_logo.png') ? UPLOADURL . '/print_logo.png' : '';?>" accept="image/png, image/jpeg">
          </div>
        </div>
        <div class="center aligned">
          <a href="<?php echo Url::url("/admin/configuration");?>" class="wojo simple button"><?php echo Lang::$word->CANCEL;?></a>
          <button type="button" data-action="processConfig" name="dosubmit" class="wojo primary button"><?php echo Lang::$word->SAVEC;?></button>
        </div>
      </div>
      <input type="hidden" name="page" value="invoicing">
    </form>
  </div>
</div>
<script src="<?php echo ADMINVIEW;?>/js/config.js"></script>
<script type="text/javascript"> 
// <![CDATA[	
$(document).ready(function() {
    $.Config({
		url: "<?php echo ADMINVIEW;?>",
        lang: {
            prjLabel: "<?php echo Lang::$word->CFG_PRJLABNAME;?>",
            catLabel: "<?php echo Lang::$word->PRJ_CATNAME;?>",
			rateLabel: "<?php echo Lang::$word->CMP_JOBT;?>",
			hourLabel: "<?php echo Lang::$word->CFG_SUB8;?>",
			taxLabel: "<?php echo Lang::$word->CFG_SUB10;?>",
			taxRate: "<?php echo Lang::$word->CFG_SUB11;?>",
        }
    });
});
// ]]>
</script>
<?php break;?>
<!-- Start default -->
<?php default: ?>
<div class="wojo heading message">
  <div class="content">
    <h3><?php echo Lang::$word->CFG_TITLE;?></h3>
    <p class="wojo small grey text"><?php echo Lang::$word->CFG_INFO;?></p>
  </div>
</div>
<div class="wojo card">
  <div class="header divided">
    <div class="row align middle">
      <div class="columns">
        <h5 class="basic"><?php echo Lang::$word->CFG_SUB1;?></h5>
      </div>
      <div class="columns auto">
        <a href="<?php echo Url::url("/admin/configuration/technical");?>" class="wojo small primary inverted icon button"><i class="icon pencil"></i></a>
      </div>
    </div>
  </div>
  <div class="content">
    <div class="row align middle">
      <div class="columns screen-20 tablet-25 mobile-30 phone-100"><span class="wojo semi text"><?php echo Lang::$word->CFG_DIR;?></span></div>
      <div class="columns screen-80 tablet-75 mobile-70 phone-100"><?php echo $this->core->site_dir;?></div>
    </div>
    <div class="row align middle">
      <div class="columns screen-20 tablet-25 mobile-30 phone-100"><span class="wojo semi text"><?php echo Lang::$word->CFG_THEME;?></span></div>
      <div class="columns screen-80 tablet-75 mobile-70 phone-100"><?php echo $this->core->theme;?></div>
    </div>
    <div class="row align middle">
      <div class="columns screen-20 tablet-25 mobile-30 phone-100"><span class="wojo semi text"><?php echo Lang::$word->CFG_MAILER;?></span></div>
      <div class="columns screen-80 tablet-75 mobile-70 phone-100"><?php echo $this->core->mailer;?></div>
    </div>
    <div class="row align middle">
      <div class="columns screen-20 tablet-25 mobile-30 phone-100"><span class="wojo semi text"><?php echo Lang::$word->CFG_FILES;?></span></div>
      <div class="columns screen-80 tablet-75 mobile-70 phone-100"><?php echo File::getSize($this->core->file_size);?></div>
    </div>
    <div class="row align middle">
      <div class="columns screen-20 tablet-25 mobile-30 phone-100"><span class="wojo semi text"><?php echo Lang::$word->CFG_FILEE;?></span></div>
      <div class="columns screen-80 tablet-75 mobile-70 phone-100"><?php echo $this->core->file_ext;?></div>
    </div>
  </div>
</div>
<div class="wojo card">
  <div class="header divided">
    <div class="row align middle">
      <div class="columns">
        <h5 class="basic"><?php echo Lang::$word->CFG_SUB2;?></h5>
      </div>
      <div class="columns auto">
        <a href="<?php echo Url::url("/admin/configuration/global");?>" class="wojo small primary inverted icon button"><i class="icon pencil"></i></a>
      </div>
    </div>
  </div>
  <div class="content">
    <div class="row align middle">
      <div class="columns screen-20 tablet-25 mobile-30 phone-100"><span class="wojo semi text"><?php echo Lang::$word->CFG_COMPANY;?></span></div>
      <div class="columns screen-80 tablet-75 mobile-70 phone-100"><?php echo $this->core->company;?></div>
    </div>
    <div class="row align middle">
      <div class="columns screen-20 tablet-25 mobile-30 phone-100"><span class="wojo semi text"><?php echo Lang::$word->CFG_WEBEMAIL;?></span></div>
      <div class="columns screen-80 tablet-75 mobile-70 phone-100"><?php echo $this->core->site_email;?></div>
    </div>
    <div class="row align middle">
      <div class="columns screen-20 tablet-25 mobile-30 phone-100"><span class="wojo semi text"><?php echo Lang::$word->CFG_DTZ;?></span></div>
      <div class="columns screen-80 tablet-75 mobile-70 phone-100"><?php echo $this->core->dtz;?></div>
    </div>
    <div class="row align middle">
      <div class="columns screen-20 tablet-25 mobile-30 phone-100"><span class="wojo semi text"><?php echo Lang::$word->CFG_LOCALES;?></span></div>
      <div class="columns screen-80 tablet-75 mobile-70 phone-100"><?php echo $this->core->locale;?></div>
    </div>
    <div class="row align middle">
      <div class="columns screen-20 tablet-25 mobile-30 phone-100"><span class="wojo semi text"><?php echo Lang::$word->CFG_WEEKSTART;?></span></div>
      <div class="columns screen-80 tablet-75 mobile-70 phone-100"><?php echo $this->core->weekstart ? Lang::$word->MON_L : Lang::$word->SUN_L;?></div>
    </div>
    <div class="row align middle">
      <div class="columns screen-20 tablet-25 mobile-30 phone-100"><span class="wojo semi text"><?php echo Lang::$word->CFG_SHORTDATE;?></span></div>
      <div class="columns screen-80 tablet-75 mobile-70 phone-100"><?php echo Date::doDate("short_date", Date::today());?></div>
    </div>
    <div class="row align middle">
      <div class="columns screen-20 tablet-25 mobile-30 phone-100"><span class="wojo semi text"><?php echo Lang::$word->CFG_LONGDATE;?></span></div>
      <div class="columns screen-80 tablet-75 mobile-70 phone-100"><?php echo Date::doDate("long_date", Date::today());?></div>
    </div>
    <div class="row align middle">
      <div class="columns screen-20 tablet-25 mobile-30 phone-100"><span class="wojo semi text"><?php echo Lang::$word->CFG_TIME;?></span></div>
      <div class="columns screen-80 tablet-75 mobile-70 phone-100"><?php echo ($this->core->time_format) == "hh:mm a" ? Lang::$word->CFG_TIME_1 : Lang::$word->CFG_TIME_2;?></div>
    </div>
  </div>
</div>
<div class="wojo card">
  <div class="header divided">
    <div class="row align middle">
      <div class="columns">
        <h5 class="basic"><?php echo Lang::$word->CFG_SUB3;?></h5>
      </div>
      <div class="columns auto">
        <a href="<?php echo Url::url("/admin/configuration/general");?>" class="wojo small primary inverted icon button"><i class="icon pencil"></i></a>
      </div>
    </div>
  </div>
  <div class="content">
    <div class="row align middle">
      <div class="columns screen-20 tablet-25 mobile-30 phone-100"><span class="wojo semi text"><?php echo Lang::$word->CFG_CURRENCY;?></span></div>
      <div class="columns screen-80 tablet-75 mobile-70 phone-100"><?php echo $this->core->currency;?></div>
    </div>
    <div class="row align middle">
      <div class="columns screen-20 tablet-25 mobile-30 phone-100"><span class="wojo semi text"><?php echo Lang::$word->CFG_LANG;?></span></div>
      <div class="columns screen-80 tablet-75 mobile-70 phone-100"><?php echo $this->core->lang;?></div>
    </div>
    <div class="row align middle">
      <div class="columns screen-20 tablet-25 mobile-30 phone-100"><span class="wojo semi text"><?php echo Lang::$word->CFG_LOGO;?></span></div>
      <div class="columns screen-80 tablet-75 mobile-70 phone-100"><?php echo ($this->core->logo) ? Lang::$word->YES : Lang::$word->NONE;?></div>
    </div>
    <div class="row align middle">
      <div class="columns screen-20 tablet-25 mobile-30 phone-100"><span class="wojo semi text"><?php echo Lang::$word->CFG_PERPAGE;?></span></div>
      <div class="columns screen-80 tablet-75 mobile-70 phone-100"><?php echo $this->core->perpage;?></div>
    </div>
    <div class="row align middle">
      <div class="columns screen-20 tablet-25 mobile-30 phone-100"><span class="wojo semi text"><?php echo Lang::$word->CFG_EUCOOKIE;?></span></div>
      <div class="columns screen-80 tablet-75 mobile-70 phone-100"><?php echo ($this->core->eucookie) ? Lang::$word->YES : Lang::$word->NO;?></div>
    </div>
    <div class="row align middle">
      <div class="columns screen-20 tablet-25 mobile-30 phone-100"><span class="wojo semi text"><?php echo Lang::$word->CFG_TWID;?></span></div>
      <div class="columns screen-80 tablet-75 mobile-70 phone-100"><?php echo $this->core->social->twitter;?></div>
    </div>
    <div class="row align middle">
      <div class="columns screen-20 tablet-25 mobile-30 phone-100"><span class="wojo semi text"><?php echo Lang::$word->CFG_FBID;?></span></div>
      <div class="columns screen-80 tablet-75 mobile-70 phone-100"><?php echo $this->core->social->facebook;?></div>
    </div>
  </div>
</div>
<div class="wojo card">
  <div class="header divided">
    <div class="row align middle">
      <div class="columns">
        <h5 class="basic"><?php echo Lang::$word->CFG_SUB4;?></h5>
      </div>
      <div class="columns auto">
        <a href="<?php echo Url::url("/admin/configuration/project");?>" class="wojo small primary inverted icon button"><i class="icon pencil"></i></a>
      </div>
    </div>
  </div>
  <div class="content">
    <div class="row align middle">
      <div class="columns screen-20 tablet-25 mobile-30 phone-100"><span class="wojo semi text"><?php echo Lang::$word->CFG_TASKL;?></span></div>
      <div class="columns screen-80 tablet-75 mobile-70 phone-100">
        <?php if($this->tasklabels):?>
        <?php
		echo implode(', ', array_map(function ($item) {
		  return $item->name;
		}, $this->tasklabels));
        ?>
        <?php endif;?>
      </div>
    </div>
    <div class="row align middle">
      <div class="columns screen-20 tablet-25 mobile-30 phone-100"><span class="wojo semi text"><?php echo Lang::$word->CFG_PRJLABELS;?></span></div>
      <div class="columns screen-80 tablet-75 mobile-70 phone-100">
        <?php if($this->prjlabels):?>
        <?php
		echo implode(', ', array_map(function ($item) {
		  return $item->name;
		}, $this->prjlabels));
        ?>
        <?php endif;?>
      </div>
    </div>
    <div class="row align middle">
      <div class="columns screen-20 tablet-25 mobile-30 phone-100"><span class="wojo semi text"><?php echo Lang::$word->CFG_PRJCATS;?></span></div>
      <div class="columns screen-80 tablet-75 mobile-70 phone-100">
        <?php if($this->prjcats):?>
        <?php
		echo implode(', ', array_map(function ($item) {
		  return $item->name;
		}, $this->prjcats));
        ?>
        <?php endif;?>
      </div>
    </div>
    <div class="row align middle">
      <div class="columns screen-20 tablet-25 mobile-30 phone-100"><span class="wojo semi text"><?php echo Lang::$word->CFG_PRJVIEW;?></span></div>
      <div class="columns screen-80 tablet-75 mobile-70 phone-100"><?php echo ($this->core->project_view) ? Lang::$word->GRID : Lang::$word->LIST;?></div>
    </div>
  </div>
</div>
<div class="wojo card">
  <div class="header divided">
    <div class="row align middle">
      <div class="columns">
        <h5 class="basic"><?php echo Lang::$word->CFG_SUB5;?></h5>
      </div>
      <div class="columns auto">
        <a href="<?php echo Url::url("/admin/configuration/time");?>" class="wojo small primary inverted icon button"><i class="icon pencil"></i></a>
      </div>
    </div>
  </div>
  <div class="content">
    <div class="row align middle">
      <div class="columns screen-20 tablet-25 mobile-30 phone-100"><span class="wojo semi text"><?php echo Lang::$word->CFG_JOB_TYPES;?></span></div>
      <div class="columns screen-80 tablet-75 mobile-70 phone-100">
        <?php if($this->job_types):?>
        <?php
		echo implode(', ', array_map(function ($item) {
		  return $item->name;
		}, $this->job_types));
        ?>
        <?php endif;?>
      </div>
    </div>
    <div class="row align middle">
      <div class="columns screen-20 tablet-25 mobile-30 phone-100"><span class="wojo semi text"><?php echo Lang::$word->EXP_CATS;?></span></div>
      <div class="columns screen-80 tablet-75 mobile-70 phone-100">
        <?php if($this->expcats):?>
        <?php
		echo implode(', ', array_map(function ($item) {
		  return $item->name;
		}, $this->expcats));
        ?>
        <?php endif;?>
      </div>
    </div>
  </div>
</div>
<div class="wojo card">
  <div class="header divided">
    <div class="row align middle">
      <div class="columns">
        <h5 class="basic"><?php echo Lang::$word->CFG_SUB6;?></h5>
      </div>
      <div class="columns auto">
        <a href="<?php echo Url::url("/admin/configuration/invoicing");?>" class="wojo small primary inverted icon button"><i class="icon pencil"></i></a>
      </div>
    </div>
  </div>
  <div class="content">
    <div class="row align middle">
      <div class="columns screen-20 tablet-25 mobile-30 phone-100"><span class="wojo semi text"><?php echo Lang::$word->CFG_TAX_RATE;?></span></div>
      <div class="columns screen-80 tablet-75 mobile-70 phone-100">
        <?php if($this->taxes):?>
        <?php
		echo implode(', ', array_map(function ($item) {
		  return $item->name . ' (' . $item->amount . '%)';
		}, $this->taxes));
        ?>
        <?php endif;?>
      </div>
    </div>
    <div class="row align middle">
      <div class="columns screen-20 tablet-25 mobile-30 phone-100"><span class="wojo semi text"><?php echo Lang::$word->CFG_OVERDUE;?></span></div>
      <div class="columns screen-80 tablet-75 mobile-70 phone-100"><?php echo ($this->core->overdue) ? Date::overdueList($this->core->overdue) . ' ' . Lang::$word->CFG_OVERDUE_1 : Lang::$word->NO;?></div>
    </div>
    <div class="row align middle">
      <div class="columns screen-20 tablet-25 mobile-30 phone-100"><span class="wojo semi text"><?php echo Lang::$word->CFG_INVPRFX;?></span></div>
      <div class="columns screen-80 tablet-75 mobile-70 phone-100"><?php echo $this->core->invoice_number ? $this->core->invoice_number : Lang::$word->NONE;?></div>
    </div>
    <div class="row align middle">
      <div class="columns screen-20 tablet-25 mobile-30 phone-100"><span class="wojo semi text"><?php echo Lang::$word->CFG_PSIZE;?></span></div>
      <div class="columns screen-80 tablet-75 mobile-70 phone-100"><?php echo $this->core->pagesize;?></div>
    </div>
    <div class="row align middle">
      <div class="columns screen-20 tablet-25 mobile-30 phone-100"><span class="wojo semi text"><?php echo Lang::$word->CFG_INVCMPINFO;?></span></div>
      <div class="columns screen-80 tablet-75 mobile-70 phone-100"><?php echo $this->core->invoice_info ? $this->core->invoice_info : Lang::$word->NONE;?></div>
    </div>
    <div class="row align middle">
      <div class="columns screen-20 tablet-25 mobile-30 phone-100"><span class="wojo semi text"><?php echo Lang::$word->CFG_INVIEW;?></span></div>
      <div class="columns screen-80 tablet-75 mobile-70 phone-100"><?php echo ($this->core->invoice_view) ? Lang::$word->GRID : Lang::$word->LIST;?></div>
    </div>
    <div class="row align middle">
      <div class="columns screen-20 tablet-25 mobile-30 phone-100"><span class="wojo semi text"><?php echo Lang::$word->CFG_LOGO_PRINT;?></span></div>
      <div class="columns screen-80 tablet-75 mobile-70 phone-100"><?php echo (File::exists(UPLOADS . '/print_logo.png')) ? Lang::$word->YES : Lang::$word->NONE;?></div>
    </div>
  </div>
</div>
<?php break;?>
<?php endswitch;?>
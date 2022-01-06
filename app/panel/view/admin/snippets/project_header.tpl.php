<?php
  /**
   * Projects View
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2019
   * @version $Id: _project_view.tpl.php, v1.00 2019-05-05 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
?>
<div class="row gutters align middle">
  <div class="columns mobile-50 phone-100">
    <h5><?php echo $this->row->name;?></h5>
  </div>
  <div class="columns auto mobile-50 phone-100">
    <div class="wojo white rounded small buttons">
      <a data-dropdown="#aPeopleList" class="wojo button right">
      <?php echo Lang::$word->PEOPLE;?> (<?php echo count($this->puserdata);?>) <i class="icon chevron down"></i>
      </a>
      <div class="wojo dropdown small pointing top-left" id="aPeopleList">
        <div class="center aligned">
          <a href="<?php echo Url::url("/admin/projects/invite", $this->row->id);?>" class="wojo primary inverted label"><?php echo Lang::$word->PRJ_SUB8;?></a>
        </div>
        <table class="wojo basic small table">
          <thead>
            <tr>
              <th colspan="2"><?php echo Lang::$word->MEMBERS;?></th>
            </tr>
          </thead>
          <tbody>
          <?php foreach($this->puserdata as $prow):?>
          <?php //if($prow->type == "staff" or $prow->type == "owner"):?>
          <tr>
            <td><img src="<?php echo UPLOADURL;?>/avatars/<?php echo $prow->avatar ? $prow->avatar : "blank.svg";?>" alt="" class="wojo category image"></td>
            <td><a class="grey" href="<?php echo Url::url("/admin/members/details", $prow->id);?>"><?php echo $prow->name;?></a></td>
          </tr>
          <?php //endif;?>
          <?php endforeach;?>
          </tbody>
        </table>
        <table class="wojo basic small table">
          <thead>
            <tr>
              <th colspan="2"><?php echo Lang::$word->CLIENTS;?></th>
            </tr>
          </thead>
          <?php foreach($this->puserdata as $prow):?>
          <?php if($prow->type == "member"):?>
          <tr>
            <td><img src="<?php echo UPLOADURL;?>/avatars/<?php echo $prow->avatar ? $prow->avatar : "blank.svg";?>" alt="" class="wojo category image"></td>
            <td><a class="grey" href="<?php echo Url::url("/admin/members/details", $prow->id);?>"><?php echo $prow->name;?></a></td>
          </tr>
          <?php endif;?>
          <?php endforeach;?>
        </table>
      </div>
      <a data-dropdown="#aProjectInfo" class="wojo button right">
      <?php echo Lang::$word->PRJ_SUB7;?>
      <i class="icon chevron down"></i>
      </a>
      <div class="wojo dropdown small pointing top-center" id="aProjectInfo">
        <table class="wojo basic small table">
          <tr>
            <td><?php echo Lang::$word->CREATED_BY;?></td>
            <td><a href="<?php echo Url::url("/admin/members/details", $this->row->created_by_id);?>"><?php echo $this->row->created_by_name;?></a></td>
          </tr>
          <tr>
            <td><?php echo Lang::$word->CREATED_ON;?></td>
            <td><?php echo Date::doDate("short_date", $this->row->created);?></td>
          </tr>
          <tr>
            <td><?php echo Lang::$word->CLIENT;?></td>
            <td><?php if($this->row->company):?>
              <a href="<?php echo Url::url("/admin/companies/edit", $this->row->company_id);?>"><?php echo $this->row->company;?></a>
              <?php else:?>
              ...
              <?php endif;?></td>
          </tr>
          <tr>
            <td><?php echo Lang::$word->LEADER;?></td>
            <td><a href="<?php echo Url::url("/admin/members/details", $this->row->leader_id);?>"><?php echo $this->row->leader_name;?></a></td>
          </tr>
          <?php if($this->row->category_id and $this->cats):?>
          <tr>
            <td><?php echo Lang::$word->CATEGORY;?></td>
            <td><?php echo Utility::searchForValueName("id", $this->row->category_id, "name", $this->cats);?></td>
          </tr>
          <?php endif;?>
          <?php if($lrow = Utility::searchForValueName("id", $this->row->label_id, "name", $this->labels, true)):?>
          <tr>
            <td><?php echo Lang::$word->LABEL;?></td>
            <td><span class="wojo small label" style="color:#fff;background:<?php echo $lrow->color;?>;border-color:<?php echo $lrow->color;?>"><?php echo $lrow->name;?></span></td>
          </tr>
          <?php endif;?>
        </table>
        <table class="wojo basic small table">
          <tr>
            <td><?php echo Lang::$word->PRJ_BUDGET;?></td>
            <td><?php echo Utility::formatMoney($this->row->budget, $this->row->currency);?></td>
          </tr>
          <tr>
            <td><?php echo Lang::$word->SPENT;?></td>
            <td><?php echo Utility::formatMoney($this->row->expenses, $this->row->currency);?></td>
          </tr>
          <tr>
            <td colspan="2" class="center aligned"><a href="<?php echo Url::url("/admin/reports");?>"><?php echo Lang::$word->VIEWDET;?></a></td>
          </tr>
        </table>
      </div>
      <div class="wojo dropdown small pointing top-right" id="aProjectMenu">
        <!-- Start editProject -->
        <?php if(App::Auth()->usertype == "owner"):?>
          <a href="<?php echo Url::url("/admin/projects/edit", $this->row->id);?>" class="item"><?php echo Lang::$word->EDIT;?></a>
        <?php endif;?>
        
        <!-- Start completeProject -->
        <a data-set='{"option":[{"iaction":"completeProject","id":<?php echo $this->row->id;?>, "name":"<?php echo Validator::sanitize($this->row->name, "chars");?>"}], "url":"/helper.php", "parent":"#ivitemu_<?php echo $this->row->id;?>", "complete":"remove", "redirect":"<?php echo Url::url("/admin/projects/");?>"}' class="item iaction"><?php echo Lang::$word->PRJ_SUB6;?></a>
        <div class="divider"></div>
        
        <!-- Start trashProject -->
        <a data-set='{"option":[{"trash": "trashProject","title": "<?php echo Validator::sanitize($this->row->name, "chars");?>","id": "<?php echo $this->row->id;?>"}],"action":"trash","subtext":"<?php echo Lang::$word->DELCONFIRM3;?>", "parent":"#ivitemu_<?php echo $this->row->id;?>", "redirect":"<?php echo Url::url("/admin/projects/");?>"}' class="item wojo demi text data">
        <?php echo Lang::$word->MTOTRASH;?>
        </a>
      </div>
      <a data-dropdown="#aProjectMenu" class="wojo icon button"><i class="icon horizontal ellipsis"></i></a>
    </div>
  </div>
</div>
<div class="wojo secondary navs">
  <ul class="nav">
    <li<?php if ($this->segments[2] == "bids") echo ' class="active"';?>><a href="<?php echo Url::url("/admin/projects/bids", $this->row->id);?>"><?php echo Lang::$word->PROJECT_BIDS;?></a></li>
    <li<?php if ($this->segments[2] == "tasks") echo ' class="active"';?>><a href="<?php echo Url::url("/admin/projects/tasks", $this->row->id);?>"><?php echo Lang::$word->TSK_TASKS;?></a></li>
    <li<?php if ($this->segments[2] == "discussions") echo ' class="active"';?>><a href="<?php echo Url::url("/admin/projects/discussions", $this->row->id);?>"><?php echo Lang::$word->MSG_DISC;?></a></li>
    <li<?php if ($this->segments[2] == "contract") echo ' class="active"';?>><a href="<?php echo Url::url("/admin/projects/contract", $this->row->id);?>"><?php echo Lang::$word->CONTRACT;?></a></li>
    <li<?php if ($this->segments[2] == "weekly-update") echo ' class="active"';?>><a href="<?php echo Url::url("/admin/projects/weekly-update", $this->row->id);?>"><?php echo Lang::$word->WEEKLY_UPDATE;?></a></li>
    <li<?php if ($this->segments[2] == "time") echo ' class="active"';?>><a href="<?php echo Url::url("/admin/projects/time", $this->row->id);?>"><?php echo Lang::$word->TIME;?></a></li>
    <?php /* <li<?php if ($this->segments[2] == "expenses") echo ' class="active"';?>><a href="<?php echo Url::url("/admin/projects/expenses", $this->row->id);?>"><?php echo Lang::$word->INV_SUB5_2;?></a></li>
    <li<?php if ($this->segments[2] == "activity") echo ' class="active"';?>><a href="<?php echo Url::url("/admin/projects/activity", $this->row->id);?>"><?php echo Lang::$word->ACTIVITY;?></a></li>*/ ?>
  </ul>
</div>
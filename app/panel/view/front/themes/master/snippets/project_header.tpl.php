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
    <a data-dropdown="#aPeopleList" class="wojo white button right">
    <?php echo Lang::$word->PEOPLE;?> (<?php echo count($this->puserdata);?>) <i class="icon chevron down"></i>
    </a>
    <div class="wojo dropdown small pointing top-left" id="aPeopleList">
      <table class="wojo basic celled table">
        <thead>
          <tr>
            <th colspan="2"><?php echo Lang::$word->MEMBERS;?></th>
          </tr>
        </thead>
        <?php foreach($this->puserdata as $prow):?>
        <?php if($prow->type == "staff" or $prow->type == "owner"):?>
        <tr>
          <td><img src="<?php echo UPLOADURL;?>/avatars/<?php echo $prow->avatar ? $prow->avatar : "blank.svg";?>" alt="" class="wojo category image"></td>
          <td><?php echo $prow->name;?></td>
        </tr>
        <?php endif;?>
        <?php endforeach;?>
        <?php foreach($this->puserdata as $prow):?>
        <?php if($prow->type == "member"):?>
        <tr>
          <td><img src="<?php echo UPLOADURL;?>/avatars/<?php echo $prow->avatar ? $prow->avatar : "blank.svg";?>" alt="" class="wojo category image"></td>
          <td><?php echo $prow->name;?></td>
        </tr>
        <?php endif;?>
        <?php endforeach;?>
      </table>
      <div class="wojo divider"></div>
      <table class="wojo very basic compact collapsing table">
        <tr>
          <td><?php echo Lang::$word->CREATED_BY;?></td>
          <td><?php echo $this->row->created_by_name;?></td>
        </tr>
        <tr>
          <td><?php echo Lang::$word->CREATED_ON;?></td>
          <td><?php echo Date::doDate("short_date", $this->row->created);?></td>
        </tr>
        <tr>
          <td><?php echo Lang::$word->LEADER;?></td>
          <td><?php echo $this->row->leader_name;?></td>
        </tr>
        <?php if($lrow = Utility::searchForValueName("id", $this->row->label_id, "name", $this->labels, true)):?>
        <tr>
          <td><?php echo Lang::$word->LABEL;?></td>
          <td><span class="wojo mini label" style="color:#fff;background:<?php echo $lrow->color;?>;border-color:<?php echo $lrow->color;?>"><?php echo $lrow->name;?></span></td>
        </tr>
        <?php endif;?>
      </table>
      <div class="wojo divider"></div>
      <table class="wojo very basic compact table">
        <tr>
          <td><?php echo Lang::$word->PRJ_BUDGET;?></td>
          <td><?php echo Utility::formatMoney($this->row->budget, $this->row->currency);?></td>
        </tr>
        <tr>
          <td><?php echo Lang::$word->SPENT;?></td>
          <td><?php echo Utility::formatMoney($this->row->expenses, $this->row->currency);?></td>
        </tr>
      </table>
    </div>
  </div>
</div>
<div class="wojo secondary navs">
  <ul class="nav">
    <li<?php if ($this->segments[2] == "tasks") echo ' class="active"';?>><a href="<?php echo Url::url("/dashboard/projects/tasks", $this->row->id);?>"><?php echo Lang::$word->TSK_TASKS;?></a>
    </li>
    <li<?php if ($this->segments[2] == "discussions") echo ' class="active"';?>><a href="<?php echo Url::url("/dashboard/projects/discussions", $this->row->id);?>"><?php echo Lang::$word->MSG_DISC;?></a>
    </li>
    <li<?php if ($this->segments[2] == "files") echo ' class="active"';?>><a href="<?php echo Url::url("/dashboard/projects/files", $this->row->id);?>"><?php echo Lang::$word->FILES;?></a>
    </li>
    <li<?php if ($this->segments[2] == "notes") echo ' class="active"';?>><a href="<?php echo Url::url("/dashboard/projects/notes", $this->row->id);?>"><?php echo Lang::$word->NOT_NOTES;?></a>
    </li>
    <li<?php if ($this->segments[2] == "time") echo ' class="active"';?>><a href="<?php echo Url::url("/dashboard/projects/time", $this->row->id);?>"><?php echo Lang::$word->TIME;?></a>
    </li>
    <li<?php if ($this->segments[2] == "expenses") echo ' class="active"';?>><a href="<?php echo Url::url("/dashboard/projects/expenses", $this->row->id);?>"><?php echo Lang::$word->INV_SUB5_2;?></a>
    </li>
  </ul>
</div>
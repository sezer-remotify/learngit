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
    <h5><?php echo $this->row->name; ?></h5>
  </div>
  <div class="columns auto mobile-50 phone-100">
    <div class="wojo white rounded small buttons">
      <?php /*<a data-dropdown="#aPeopleList" class="wojo button right">
        <?php echo Lang::$word->PEOPLE; ?> (<?php echo (count($this->puserdata) - 1); ?>) <i class="icon chevron down"></i>
      </a> */?>
      <div class="wojo dropdown small pointing top-left" id="aPeopleList">
        <?php if (count($this->puserdata) > 1) : ?>
          <table class="wojo small table">
            <thead>
              <tr>
                <th colspan="2" class="text-center"><?php echo Lang::$word->FREELANCERS; ?></th>
              </tr>
            </thead>
            <?php foreach ($this->puserdata as $prow) : ?>
              <?php if ($prow->type == "freelancer") : ?>
                <tr>
                  <td class="auto padding-right-0"><img src="<?php echo UPLOADURL; ?>/avatars/<?php echo $prow->avatar ? $prow->avatar : "blank.svg"; ?>" alt="" class="wojo category image"></td>
                  <td><a class="grey" href="<?php echo Url::url("/master/profile/view", $prow->username); ?>"><?php echo $prow->name; ?></a><span class="d-block"><?php echo $prow->email; ?></span></td>
                </tr>
              <?php endif; ?>
            <?php endforeach; ?>
          </table>
        <?php endif; ?>
        <table class="wojo small table">
          <thead>
            <tr>
              <th colspan="2" class="text-center"><?php echo Lang::$word->CL; ?></th>
            </tr>
          </thead>
          <?php foreach ($this->puserdata as $prow) : ?>
            <?php if ($prow->type == "client") : ?>
              <tr>
                <td class="auto padding-right-0"><img src="<?php echo UPLOADURL; ?>/avatars/<?php echo $prow->avatar ? $prow->avatar : "blank.svg"; ?>" alt="" class="wojo category image"></td>
                <td><?php echo $prow->name; ?> <span class="d-block"><?php echo $prow->email; ?></span> </td>
              </tr>
            <?php endif; ?>
          <?php endforeach; ?>
        </table>
      </div>
      <a data-dropdown="#aProjectInfo" class="wojo button right" style=" border-radius: 2rem 0 0 2rem; ">
        <?php echo Lang::$word->PRJ_SUB7; ?>
        <i class="icon chevron down"></i>
      </a>
      <div class="wojo dropdown small pointing top-center" id="aProjectInfo">
        <table class="wojo basic small table">
          <tr>
            <td><?php echo Lang::$word->CREATED_BY; ?></td>
            <td><?php echo $this->row->created_by_name; ?></td>
          </tr>
          <tr>
            <td><?php echo Lang::$word->CREATED_ON; ?></td>
            <td><?php echo Date::doDate("short_date", $this->row->created); ?></td>
          </tr>
          <tr>
            <td><?php echo Lang::$word->PRJ_TYPE; ?></td>
            <td><?php echo ucwords($this->row->work_type); ?></td>
          </tr>
          <tr>
            <td><?php echo Lang::$word->REP_SUB1; ?></td>
            <td><?php echo ucwords($this->row->project_type); ?></td>
          </tr>
          <tr>
            <td><?php echo Lang::$word->NEEDED; ?></td>
            <td><?php echo ($this->row->required_dev > 0) ? $this->row->required_dev . ' ' . (($this->row->required_dev > 1) ? Lang::$word->DEVS : Lang::$word->DEV) : Lang::$word->UNCERTAIN; ?></td>
          </tr>
          <?php if ($lrow = Utility::searchForValueName("id", $this->row->label_id, "name", $this->labels, true)) : ?>
            <tr>
              <td><?php echo Lang::$word->LABEL; ?></td>
              <td><span class="wojo small label" style="color:#fff;background:<?php echo $lrow->color; ?>;border-color:<?php echo $lrow->color; ?>"><?php echo $lrow->name; ?></span></td>
            </tr>
          <?php endif; ?>
          <tr>
            <td><?php echo Lang::$word->PRJ_BUDGET; ?></td>
            <td><i class="<?php echo ($this->row->currency === 'TRY') ? 'icon-line-awesome-turkish-lira' : 'icon-line-awesome-dollar'; ?>"></i><?php echo Utility::formatNumber($this->row->budget, $this->row->currency); ?></td>
          </tr>
          <tr>
            <td><?php echo Lang::$word->SPENT; ?></td>
            <td><i class="<?php echo ($this->row->currency === 'TRY') ? 'icon-line-awesome-turkish-lira' : 'icon-line-awesome-dollar'; ?>"></i><?php echo Utility::formatNumber($this->row->expenses, $this->row->currency); ?></td>
          </tr>
          <tr>
            <td colspan="2" class="center aligned"><a href="<?php echo Url::url("/master/projects/view", $this->row->id); ?>"><?php echo Lang::$word->VIEWDET; ?></a></td>
          </tr>
        </table>
      </div>
      <div class="wojo dropdown small pointing top-right" id="aProjectMenu">
        <!-- Start editProject -->
        <a href="#" class="item"><?php echo Lang::$word->EDIT; ?></a>
        <!-- Start completeProject -->
        <a href="#" class="item"><?php echo Lang::$word->PRJ_SUB6; ?></a>
        <div class="divider"></div>
        <!-- Start trashProject -->
        <a href="#" class="item wojo demi text data">
          <?php echo Lang::$word->REMOVE; ?>
        </a>
      </div>
      <a data-dropdown="#aProjectMenu" class="wojo icon button"><i class="icon horizontal ellipsis"></i></a>
    </div>
  </div>
</div>
<div class="wojo secondary navs">
  <ul class="nav">
    <li <?php if ($this->segments[2] == "bids") echo ' class="active"'; ?>><a href="<?php echo Url::url("/master/projects/bids", $this->row->id); ?>"><?php echo Lang::$word->PROJECT_BIDS; ?></a></li>
    <?php if ($this->row->label_id == 2) : ?>
      <!-- <li <?php if ($this->segments[2] == "tasks") echo ' class="active"'; ?>><a href="<?php echo Url::url("/master/projects/tasks", $this->row->id); ?>"><?php echo Lang::$word->TSK_TASKS; ?></a></li>
    <li <?php if ($this->segments[2] == "discussions") echo ' class="active"'; ?>><a href="<?php echo Url::url("/master/projects/discussions", $this->row->id); ?>"><?php echo Lang::$word->MSG_DISC; ?></a></li> -->
    
   
    <?php /* <li<?php if ($this->segments[2] == "tasks") echo ' class="active"';?>><a href="<?php echo Url::url("/master/projects/tasks", $this->row->id);?>"><?php echo Lang::$word->TSK_TASKS;?></a></li>
    <li<?php if ($this->segments[2] == "discussions") echo ' class="active"';?>><a href="<?php echo Url::url("/master/projects/discussions", $this->row->id);?>"><?php echo Lang::$word->MSG_DISC;?></a></li>*/ ?>
    <li<?php if ($this->segments[2] == "contract") echo ' class="active"';?>><a href="<?php echo Url::url("/master/projects/contract", $this->row->id);?>"><?php echo Lang::$word->CONTRACT;?></a></li>
    <li<?php if ($this->segments[2] == "weekly-update") echo ' class="active"';?>><a href="<?php echo Url::url("/master/projects/weekly-update", $this->row->id);?>"><?php echo Lang::$word->WEEKLY_UPDATE;?></a></li>
    <li<?php if ($this->segments[2] == "time") echo ' class="active"';?>><a href="<?php echo Url::url("/master/projects/time", $this->row->id);?>"><?php echo Lang::$word->TIME;?></a></li>

    
    <?php endif; ?>
  </ul>
</div>
<div class="alert"style=" background: #e82a68; color: #fff; width: 100%; max-width: 500px; margin: 30px auto 0 auto; border-radius: 5px; padding: 10px; ">
  <h4 class="text-center">Attention!</h4>
  <p class="text-center">Prices do not include tax and Remotify fee. (Fee%15 + Tax %10)</p>
</div>
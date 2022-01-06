<?php

/**
 * Projects List
 *
 * @package Wojo Framework
 * @author wojoscripts.com
 * @copyright 2019
 * @version $Id: _project_list.tpl.php, v1.00 2019-05-05 10:12:05 gewa Exp $
 */
if (!defined("_WOJO"))
  die('Direct access to this location is not allowed.');
?>
<div class="wojo heading message">
  <div class="content">
    <h3><?php echo Lang::$word->PRJ_PROJECTS; ?></h3>
  </div>
</div>
<div class="row gutters align bottom">
  <div class="columns phone-100">
    <div class="wojo small white stacked buttons">
      <?php if (App::Auth()->usertype == 'client') : ?>
        <a href="<?php echo Url::url("/master/projects", "new"); ?>" class="wojo button"><?php echo Lang::$word->PRJ_PRJSTART; ?></a>
      <?php endif; ?>
      <a href="#" class="wojo button"><?php echo Lang::$word->PRJ_SUB9; ?></a>
    </div>
  </div>
  <div class="columns auto phone-100">
    <a class="wojo small basic disabled icon button"><i class="icon reorder"></i></a>
    <a href="<?php echo Url::url("/master/projects"); ?>" class="wojo small primary icon button"><i class="icon grid"></i></a>
  </div>
</div>
<div class="center aligned padding bottom">
  <a data-dropdown="#labelFilter" class="wojo small primary inverted right stacked button">
    <?php echo Validator::Get("label") ? (Utility::searchForValueName("id", Validator::Get("label"), "name", $this->labels)) : Lang::$word->PRJ_LABEL; ?>
    <i class="icon horizontal ellipsis"></i>
  </a>
  <div class="wojo dropdown small pointing top-center" id="labelFilter">
    <div class="header">
      <a href="<?php echo Url::url("/master/projects", "list"); ?>" class="grey"><?php echo Lang::$word->RESET; ?></a>
    </div>
    <div class="divider"></div>
    <?php if ($this->labels) : ?>
      <?php foreach ($this->labels as $label) : ?>
        <a class="item align spaced <?php echo Url::isActive("label", $label->id); ?>" href="<?php echo Url::buildUrl("label", $label->id); ?>" data-value="<?php echo $label->id; ?>">
          <?php echo $label->name; ?>
          <span class="wojo small circular right empty label" style="background:<?php echo $label->color; ?>;border-color:<?php echo $label->color; ?>"></span>
        </a>
      <?php endforeach; ?>
    <?php endif; ?>
  </div><a data-dropdown="#categoryFilter" class="wojo small primary inverted right stacked button">
    <?php echo Validator::Get("type") ?  Validator::Get("type") :  Lang::$word->PRJ_TYPE; ?>
    <i class="icon horizontal ellipsis"></i>
  </a>
  <div class="wojo dropdown small pointing top-center" id="categoryFilter">
    <div class="header">
      <a href="<?php echo Url::url("/master/projects", "list"); ?>" class="inverted"><?php echo Lang::$word->RESET; ?></a>
    </div>
    <div class="divider"></div>
    <a class="item <?php echo Url::isActive("type", 'Project Based'); ?>" href="<?php echo Url::buildUrl("type", 'Project Based'); ?>" data-value="<?php echo Lang::$word->PROJECT_BASED; ?>">
      <?php echo Lang::$word->PROJECT_BASED; ?>
    </a>
    <a class="item <?php echo Url::isActive("type", 'Part-Time'); ?>" href="<?php echo Url::buildUrl("type", 'Part-Time'); ?>" data-value=" <?php echo Lang::$word->PARTTIME; ?>">
      <?php echo Lang::$word->PARTTIME; ?>
    </a>
    <a class="item <?php echo Url::isActive("type", 'Full-Time'); ?>" href="<?php echo Url::buildUrl("type", 'Full-Time'); ?>" data-value="<?php echo Lang::$word->FULLTIME; ?>">
      <?php echo Lang::$word->FULLTIME; ?>
    </a>
    <a class="item <?php echo Url::isActive("type", 'Full-Time Contract'); ?>" href="<?php echo Url::buildUrl("type", 'Full-Time Contract'); ?>" data-value="<?php echo Lang::$word->FULLTIME_CONTRACT; ?>">
      <?php echo Lang::$word->FULLTIME_CONTRACT; ?>
    </a>
  </div>
  <a data-dropdown="#projectFilter" class="wojo small primary inverted right stacked button">
    <?php echo Validator::Get("project") ?  ((Validator::Get("project") === 'fixed') ? Lang::$word->FIXED_PRICE : Lang::$word->HOURLY_PRICE) : Lang::$word->CMP_JOBT; ?>
    <i class="icon horizontal ellipsis"></i>
  </a>
  <div class="wojo dropdown small pointing top-center" id="projectFilter">
    <div class="header">
      <a href="<?php echo Url::url("/master/projects", "list"); ?>" class="inverted"><?php echo Lang::$word->RESET; ?></a>
    </div>
    <div class="divider"></div>
    <a class="item <?php echo Url::isActive("project", 'fixed'); ?>" href="<?php echo Url::buildUrl("project", 'fixed'); ?>" data-value="<?php echo Lang::$word->FIXED_PRICE; ?>">
      <?php echo Lang::$word->FIXED_PRICE; ?>
    </a>
    <a class="item <?php echo Url::isActive("project", 'hourly'); ?>" href="<?php echo Url::buildUrl("project", 'hourly'); ?>" data-value="<?php echo Lang::$word->HOURLY_PRICE; ?>">
      <?php echo Lang::$word->HOURLY_PRICE; ?>
    </a>
  </div>
</div>
<?php if (!$this->data) : ?>
  <div class="center aligned"><img src="<?php echo ADMINVIEW; ?>/images/projects_empty.svg" alt="" class="wojo center big image">
    <p class="wojo semi grey text"><?php echo (App::Auth()->usertype == 'client') ? Lang::$word->CLIENT_PRJ_INFO : Lang::$word->FREELANCER_PRJ_INFO; ?></p>
  </div>
<?php else : ?>
  <table class="wojo fitted segment  table">
    <?php foreach ($this->data as $row) : ?>
      <tr id="item_<?php echo $row->id; ?>">
        <td><a href="<?php echo (App::Auth()->usertype == 'client') ? Url::url("/master/projects/bids", $row->id) : Url::url("/master/projects/view", $row->id); ?>" class="color-blue"><?php echo $row->name; ?></a></td>
        <td>
          <?php echo $row->work_type . ' (' . ucwords($row->project_type) . ')'; ?>
        </td>
        <td><?php if ($lrow = Utility::searchForValueName("id", $row->label_id, "name", $this->labels, true)) : ?>
            <span class="wojo small label" style="color:#fff;background:<?php echo $lrow->color; ?>;border-color:<?php echo $lrow->color; ?>"><?php echo $lrow->name; ?></span>
          <?php endif; ?>
        </td>
        <td class="auto auto-sm"><?php echo Date::timesince($row->created); ?></td>
        <td class="auto auto-sm text-right"><a class="wojo small dark inverted icon button" data-dropdown="#projectDrop_<?php echo $row->id; ?>">
            <i class="icon vertical ellipsis"></i>
          </a>
          <div class="wojo dropdown small pointing top-right" id="projectDrop_<?php echo $row->id; ?>">
            <!-- View Project -->
            <a href="<?php echo Url::url("/master/projects/view", $row->id); ?>" class="item"><?php echo Lang::$word->VIEW; ?></a>
            <?php if (App::Auth()->usertype == 'client') : ?>
              <!-- Start editProject -->
              <a href="#" class="item"><?php echo Lang::$word->EDIT; ?></a>

              <!-- Start completeProject -->
              <a href="#" class="item "><?php echo Lang::$word->PRJ_SUB6; ?></a>
              <div class="divider"></div>
              <!-- Start trashProject -->
              <a href="#" class="item wojo demi text data">
                <?php echo Lang::$word->REMOVE; ?>
              </a>
            <?php endif; ?>
          </div>
        </td>
      </tr>
    <?php endforeach; ?>
  </table>
<?php endif; ?>
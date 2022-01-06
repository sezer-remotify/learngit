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
    <h3><?php echo Lang::$word->PRJ_PROJECTS;?></h3>
  </div>
</div>
<div class="row gutters align bottom">
  <div class="columns phone-100">
    <div class="wojo small white stacked buttons">
    </div>
  </div>
  <div class="columns auto phone-100">
    <a class="wojo small basic disabled icon button"><i class="icon reorder"></i></a>
    <a href="<?php echo Url::url("/admin/projects");?>" class="wojo small primary icon button"><i class="icon grid"></i></a>
  </div>
</div>
<div class="center aligned padding bottom">
  <a data-dropdown="#clientFilter" class="wojo small primary inverted right stacked button">
  <?php echo Validator::Get("company") ? (Utility::searchForValueName("id", Validator::Get("company"), "name", $this->companies)) : Lang::$word->CLIENT;?>
  <i class="icon horizontal ellipsis"></i>
  </a>
  <div class="wojo dropdown small pointing top-center" id="clientFilter">
    <div class="header">
      <a href="<?php echo Url::url("/admin/projects", "list");?>" class="grey"><?php echo Lang::$word->RESET;?></a>
    </div>
    <div class="divider"></div>
    <div class="scrolling">
      <?php if($this->companies):?>
      <?php foreach($this->companies as $crow):?>
      <a class="item <?php echo Url::isActive("company", $crow->id);?>" href="<?php echo Url::buildUrl("company", $crow->id);?>" data-value="<?php echo $crow->id;?>">
      <?php echo $crow->name;?>
      </a>
      <?php endforeach;?>
      <?php endif;?>
    </div>
  </div>
  <a data-dropdown="#labelFilter" class="wojo small primary inverted right stacked button">
  <?php echo Validator::Get("label") ? (Utility::searchForValueName("id", Validator::Get("label"), "name", $this->labels)) : Lang::$word->PRJ_LABEL;?>
  <i class="icon horizontal ellipsis"></i>
  </a>
  <div class="wojo dropdown small pointing top-center" id="labelFilter">
    <div class="header">
      <a href="<?php echo Url::url("/admin/projects", "list");?>" class="grey"><?php echo Lang::$word->RESET;?></a>
    </div>
    <div class="divider"></div>
    <?php if($this->labels):?>
    <?php foreach($this->labels as $label):?>
    <a class="item align spaced <?php echo Url::isActive("label", $label->id);?>" href="<?php echo Url::buildUrl("label", $label->id);?>" data-value="<?php echo $label->id;?>">
    <?php echo $label->name;?>
    <span class="wojo small circular right empty label" style="background:<?php echo $label->color;?>;border-color:<?php echo $label->color;?>"></span>
    </a>
    <?php endforeach;?>
    <?php endif;?>
  </div>
  <a data-dropdown="#categoryFilter" class="wojo small primary inverted right stacked button">
  <?php echo Validator::Get("category") ? (Utility::searchForValueName("id", Validator::Get("category"), "name", $this->cats)) : Lang::$word->CATEGORY;?>
  <i class="icon horizontal ellipsis"></i>
  </a>
  <div class="wojo dropdown small pointing top-center" id="categoryFilter">
    <div class="header">
      <a href="<?php echo Url::url("/admin/projects", "list");?>" class="grey"><?php echo Lang::$word->RESET;?></a>
    </div>
    <div class="divider"></div>
    <?php if($this->cats):?>
    <?php foreach($this->cats as $cat):?>
    <a class="item <?php echo Url::isActive("category", $cat->id);?>" href="<?php echo Url::buildUrl("category", $cat->id);?>" data-value="<?php echo $cat->id;?>">
    <?php echo $cat->name;?>
    </a>
    <?php endforeach;?>
    <?php endif;?>
  </div>
</div>
<?php if(!$this->data):?>
<div class="center aligned"><img src="<?php echo ADMINVIEW;?>/images/projects_empty.svg" alt="" class="wojo center big image">
  <p class="wojo semi grey text"><?php echo str_replace("[COMPANY]", $this->core->company, Lang::$word->PRJ_NOPRJ);?></p>
</div>
<?php else:?>
<table class="wojo fitted segment responsive table">
  <?php foreach($this->data as $row):?>
  <?php $crow = Utility::searchForValueName("id", $row->id, "name", $this->companies, true);?>
  <tr id="item_<?php echo $row->id;?>">
    <td><a href="<?php echo Url::url("/admin/projects/tasks", $row->id);?>"><?php echo $row->name;?></a></td>
    <td><?php if($crow):?>
      <strong><?php echo strtolower(Lang::$word->FOR);?></strong>
      <a href="<?php echo Url::url("/admin/companies/edit", $crow->id);?>"><?php echo $crow->name;?></a>
      <?php else:?>
      ...
      <?php endif;?></td>
    <td><?php if($lrow = Utility::searchForValueName("id", $row->label_id, "name", $this->labels, true)):?>
      <span class="wojo small label" style="color:#fff;background:<?php echo $lrow->color;?>;border-color:<?php echo $lrow->color;?>"><?php echo $lrow->name;?></span>
      <?php endif;?></td>
    <td class="auto"><?php echo Date::timesince($row->created);?></td>
    <td class="auto"><a class="wojo small dark inverted icon button" data-dropdown="#projectDrop_<?php echo $row->id;?>">
      <i class="icon vertical ellipsis"></i>
      </a>
      <div class="wojo dropdown small pointing top-right" id="projectDrop_<?php echo $row->id;?>">
        <!-- Start editProject -->
        <a href="<?php echo Url::url("/admin/projects/edit", $row->id);?>" class="item"><?php echo Lang::$word->EDIT;?></a>
        
        <!-- Start completeProject -->
        <a data-set='{"option":[{"iaction":"completeProject","id":<?php echo $row->id;?>, "name":"<?php echo Validator::sanitize($row->name, "chars");?>"}], "label":"<?php echo Lang::$word->HISOCHGE;?>", "url":"/helper.php", "parent":"#item_<?php echo $row->id;?>", "complete":"remove","callback":"mason"}' class="item iaction"><?php echo Lang::$word->PRJ_SUB6;?></a>
        <div class="divider"></div>
        <!-- Start trashProject -->
        <a data-set='{"option":[{"trash": "trashProject","title": "<?php echo Validator::sanitize($row->name, "chars");?>","id": "<?php echo $row->id;?>"}],"action":"trash","subtext":"<?php echo Lang::$word->DELCONFIRM3;?>", "parent":"#item_<?php echo $row->id;?>"}' class="item wojo demi text data">
        <?php echo Lang::$word->MTOTRASH;?>
        </a>
      </div></td>
  </tr>
  <?php endforeach;?>
</table>
<?php endif;?>
<?php
  /**
   * Files Grid
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2019
   * @version $Id: _files_grid.tpl.php, v1.00 2019-05-05 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
?>
<?php if($this->data):?>
<?php foreach($this->data as $date => $rows):?>
<div class="wojo small positive message">
  <h4 class="basic"><?php echo Date::doDate("short_date", $date);?></h4>
</div>
<div class="wojo mason">
  <?php foreach($rows as $row):?>
  <div class="item" id="item_<?php echo $row->id;?>">
    <div class="wojo attached fitted segment">
      <div class="content center aligned">
        <img src="<?php echo UPLOADURL . "/mime/" . File::getFileType($row->name);?>" alt="" class="wojo basic medium center image">
        <p class="wojo small demi text truncate vertical margin"><?php echo $row->caption;?></p>
        <div class="wojo small list">
          <div class="item align center">
            <?php switch($row->parent) :
			  case "discussion": 
				  echo Lang::$word->IN . ' ' . Lang::$word->MSG_DISCN . ': <a href="' . Url::url("/dashboard/projects/discussions", $this->row->id) . '">' . $row->commentname . '</a>';
			  break;
			  case "task": 
				  echo Lang::$word->IN . ' ' .  Lang::$word->TSK_TASK . ': <a href="' . Url::url("/dashboard/projects/tasks", $this->row->id) . '">' . $row->taskname . '</a>';
			  break;
			  case "note": 
				  echo Lang::$word->IN . ' ' .  Lang::$word->NOT_NOTE . ': <a href="' . Url::url("/dashboard/projects/notes", $this->row->id) . '">' . $row->notename . '</a>';
			  break;
			  default :
			  break;
		   ?>
            <?php endswitch;?>
          </div>
        </div>
        <div class="wojo small horizontal list">
          <div class="item">
            <?php echo Lang::$word->BY;?>: <?php echo $row->created_by_name;?>
          </div>
          <div class="item">
            <?php echo Lang::$word->ON . ': ' . Date::doDate("short_date", $row->created);?>
          </div>
        </div>
      </div>
      <div class="footer divided">
        <a href="<?php echo SITEURL . "/download.php?id=" . $row->id;?>" class="wojo small fluid secondary inverted button"><?php echo Lang::$word->DOWNLOAD;?></a>
      </div>
    </div>
  </div>
  <?php endforeach;?>
</div>
<?php endforeach;?>
<?php endif;?>
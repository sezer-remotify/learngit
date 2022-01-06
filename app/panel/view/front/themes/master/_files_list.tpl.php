<?php
  /**
   * Files List
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2018
   * @version $Id: _files_list.tpl.php, v1.00 2018-05-05 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
?>
<?php if($this->data):?>
<?php foreach($this->data as $date => $rows):?>
<div class="wojo card">
  <div class="header">
    <h4 class="basic"><?php echo Date::doDate("short_date", $date);?></h4>
  </div>
  <div class="content">
    <div class="wojo fluid celled relaxed list">
      <?php foreach($rows as $row):?>
      <div class="item align middle" id="item_<?php echo $row->id;?>">
        <div class="content auto">
          <a href="<?php echo SITEURL . "/download.php?id=" . $row->id;?>">
          <img src="<?php echo SITEURL;?>/assets/images/filetypes/<?php echo File::getFileType($row->name);?>" class="wojo default rounded image">
          </a>
        </div>
        <div class="content horizontal padding">
          <h6 class="basic"><a href="<?php echo SITEURL . "/download.php?id=" . $row->id;?>"><?php echo $row->caption;?></a></h6>
          <div class="wojo small text">
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
          <p class="wojo small text"><?php echo Lang::$word->BY;?>
            <?php echo $row->created_by_name;?>
            <?php echo Lang::$word->ON . ' ' . Date::doDate("short_date", $row->created);?>
          </p>
        </div>
      </div>
      <?php endforeach;?>
    </div>
  </div>
</div>
<?php endforeach;?>
<?php endif;?>
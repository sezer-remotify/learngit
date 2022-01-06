<?php
  /**
   * Project Archive
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2019
   * @version $Id: project_archive.tpl.php, v1.00 2019-05-05 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
?>
<h3><?php echo Lang::$word->PRJ_SUB9;?></h3>
<?php if(!$this->data):?>
<div class="center aligned"><img src="<?php echo ADMINVIEW;?>/images/archive_empty.svg" alt="" class="wojo center large image">
  <p class="wojo semi grey text"><?php echo Lang::$word->PRJ_INFO2;?></p>
</div>
<?php else:?>
<div class="wojo segment">
  <table class="wojo basic table">
    <thead>
      <tr>
        <th><?php echo Lang::$word->PRJ_PRJNAME;?> </th>
        <th class="auto"> </th>
      </tr>
    </thead>
    <tbody>
      <?php foreach($this->data as $row):?>
      <tr id="item_<?php echo $row->id;?>">
        <td><a href="<?php echo Url::url("/dashboard/projects/tasks", $row->id);?>"><?php echo $row->name;?></a></td>
        <td><?php echo Date::doDate("short_date", $row->completed);?></td>
      </tr>
      <?php endforeach;?>
    </tbody>
  </table>
</div>
<?php endif;?>
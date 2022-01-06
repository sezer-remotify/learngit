<?php

/**
 * Render Notifications
 *
 * @package Wojo Framework
 * @author wojoscripts.com
 * @copyright 2019
 * @version $Id: renderNotification.tpl.php, v1.00 2019-03-02 10:12:05 gewa Exp $
 */
if (!defined("_WOJO"))
  die('Direct access to this location is not allowed.');
?>

<?php if ($this->data) : ?>
  <?php foreach ($this->data as $row) : ?>
    <?php if ($row->note) : ?>
      <a data-info='{"type":"note", "note_id":"<?php echo $row->note_id; ?>"}' class="item" href="<?php echo Url::url("/admin/notes/view", $row->npid . '/' .  $row->note_id); ?>"><?php echo $row->note; ?></a>
    <?php endif; ?>
    <?php if ($row->message) : ?>
      <a data-info='{"type":"message", "message_id":"<?php echo $row->message_id; ?>"}' class="item" href="<?php echo Url::url("/admin/discussions/view", $row->mpid . '/' .  $row->message_id); ?>"><?php echo $row->message; ?></a>
    <?php endif; ?>
    <?php if ($row->task) : ?>
      <a data-info='{"type":"task", "task_id":"<?php echo $row->task_id; ?>"}' class="item" href="<?php echo Url::url("/admin/tasks", $row->task_id); ?>"><?php echo $row->task; ?></a>
    <?php endif; ?>
  <?php endforeach; ?>
<?php endif; ?>

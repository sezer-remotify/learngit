<?php
/**
 * Projects Discussions
 *
 * @package Wojo Framework
 * @author wojoscripts.com
 * @copyright 2019
 * @version $Id: _projects_discussions.tpl.php, v1.00 2019-05-05 10:12:05 gewa Exp $
 */
if ( !defined( "_WOJO" ) )
	die( 'Direct access to this location is not allowed.' );
?>
<h3><?php echo Lang::$word->MSG_TITLE4;?></h3>
<?php include_once(ADMINBASE . '/snippets/project_header.tpl.php');?>
<div class="wojo form fitted segment">
  <div class="header">
    <div class="items icon"><i class="icon comments"></i>
    </div>
    <div class="items text">
      <h4 class="basic">
        <?php echo Lang::$word->MSG_SUB3;?>
      </h4>
      <a href="<?php echo Url::url("/admin/discussions/new", $this->row->id);?>" class="wojo icon text"><i class="icon plus alt"></i><?php echo Lang::$word->MSG_NEW;?></a>
    </div>
  </div>
  <div class="content">
    <div class="wojo very relaxed fluid celled list">
      <?php if(!$this->data):?>
      <div class="item blank align middle center">
        <img src="<?php echo ADMINVIEW;?>/images/comment_empty.svg" alt="" class="wojo center large image">
        <p class="wojo semi grey text"><?php echo Lang::$word->MSG_NOMSG;?></p>
      </div>
      <?php else:?>
      <?php foreach ($this->data as $parent_id => $values) :?>
      <div class="item align middle">
        <div class="content auto">
          <div class="wojo dark inverted label"><i class="icon comments"></i>
            <?php echo isset($this->data[$parent_id]['message']) ? count($this->data[$parent_id]['message']) : 0;?>
          </div>
        </div>
        <div class="content padding left">
          <a href="<?php echo Url::url("/admin/discussions/view/" . $this->row->id, $values['id']);?>" class="wojo demi text">
          <?php echo $values['name'];?>
          </a>
          <?php echo $values['is_hidden'] ? '<i class="icon eye blocked"></i>' : '';?>
          <?php if(isset($values['message'])):?>
          <div class="wojo small text description">
            <?php foreach ($values['message'] as $k => $row) :?>
            <a href="<?php echo Url::url("/admin/members/details", $row['user_id']);?>" class="grey">
            <?php echo $row['user'];?>
            </a>
            : <?php echo Validator::sanitize($row['body'], "default", 100);?>
            <span class="wojo small secondary inverted label">
            <?php echo Date::timeSince($row['created']);?>
            </span>
            <?php break;?>
            <?php endforeach;?>
          </div>
          <?php endif;?>
        </div>
      </div>
      <?php endforeach;?>
    </div>
  </div>
</div>
<?php endif;?>
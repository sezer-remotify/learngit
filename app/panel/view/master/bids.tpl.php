<?php

/**
 * Projects
 *
 * @package Wojo Framework
 * @author MOHAMMAD ILYAS KOHISTANI
 * @copyright 2019
 * @version $Id: projects.tpl.php, v1.00 2019-05-05 10:12:05 gewa Exp $
 */
if (!defined("_WOJO"))
  die('Direct access to this location is not allowed.');
?>
<div class="row gutters align bottom margin-right-0">
  <div class="columns phone-100">
    <div class="wojo small white stacked buttons">
      <a href="<?php echo Url::buildUrl("cat", 'active'); ?>" class="wojo button  <?php if (!isset($_GET['cat']) || Url::isActive("cat", 'active')) echo "active"; ?>"><?php echo Lang::$word->ACTIVE . " (" . ((isset($this->bidCount->active_bids)) ? $this->bidCount->active_bids : 0) . ")"; ?></a>
      <a href="<?php echo Url::buildUrl("cat", 'accepted'); ?>" class="wojo button <?php if (Url::isActive("cat", 'accepted')) echo "active"; ?>"><?php echo Lang::$word->ACCEPTED . " (" . ((isset($this->bidCount->accepted_bids)) ? $this->bidCount->accepted_bids : 0) . ")"; ?></a>
      <a href="<?php echo Url::buildUrl("cat", 'declined'); ?>" class="wojo button <?php if (Url::isActive("cat", 'declined')) echo "active"; ?>"><?php echo Lang::$word->DECLINED . " (" . ((isset($this->bidCount->declined_bids)) ? $this->bidCount->declined_bids : 0) . ")"; ?></a>
    </div>
  </div>
  <div class="columns auto phone-100">
    <a class="wojo small basic disabled icon button"><i class="icon-material-outline-gavel margin-right-3"></i><?php echo Lang::$word->BIDS_COUNT . " (" . ((isset($this->bidCount->total_bids)) ? $this->bidCount->total_bids : 0) . ")"; ?></a>
  </div>
</div>
<div class="dashboard-container d-block margin-bottom-60">
  <!-- Row -->
  <div class="row">
    <!-- Dashboard Box -->
    <div class="col-xl-12">
      <div class="dashboard-box margin-top-0">
        <!-- Headline -->
        <div class="headline">
          <h3 class="margin-bottom-0"><i class="icon-material-outline-gavel"></i><?php echo Lang::$word->BIDS_LIST; ?>
          </h3>
          <div class="sort-by">
            <select class="selectpicker show-tick" onchange="location = this.value;">
              <option value="<?php echo Url::url("/master/projects/bids", $this->row->id); ?>">
                <?php echo Lang::$word->LATEST_FIRST; ?></option>
              <option <?php if (Url::isActive("order", 'highest')) echo "selected"; ?> value="<?php echo Url::buildUrl("order", 'highest'); ?>"><?php echo Lang::$word->HIGHEST_FIRST; ?>
              </option>
              <option <?php if (Url::isActive("order", 'lowest')) echo "selected"; ?> value="<?php echo Url::buildUrl("order", 'lowest'); ?>"><?php echo Lang::$word->LOWEST_FIRST; ?>
              </option>
              <?php if ($this->row->work_type === "Project Based") : ?>
                <option <?php if (Url::isActive("order", 'fastest')) echo "selected"; ?> value="<?php echo Url::buildUrl("order", 'fastest'); ?>"><?php echo Lang::$word->FASTEST_FIRST; ?>
                </option>
              <?php else : ?>
                <option <?php if (Url::isActive("order", 'title')) echo "selected"; ?> value="<?php echo Url::buildUrl("order", 'title'); ?>"><?php echo Lang::$word->PROJECT_TITLE; ?>
                </option>
              <?php endif; ?>
            </select>
          </div>
        </div>
        <div class="content">
          <ul class="dashboard-box-list">
            <?php if (!$this->row) : ?>
              <div class="center aligned padding-top-50 padding-bottom-20">
                <p class="wojo semi grey text"><?php if (Url::isActive("cat", 'accepted')) echo Lang::$word->FREELANCER_ACC_BIDS_INFO;
                                                else if (Url::isActive("cat", 'declined')) echo Lang::$word->FREELANCER_DEC_BIDS_INFO;
                                                else echo Lang::$word->FREELANCER_BIDS_INFO; ?></p>
              </div>
            <?php else : ?>
              <?php foreach ($this->row as $row) : ?>
                <li id="bid_<?php echo $row->id; ?>">
                  <!-- Job Listing -->
                  <div class="job-listing width-adjustment">
                    <!-- Job Listing Details -->
                    <div class="job-listing-details">
                      <!-- Details -->
                      <div class="job-listing-description">
                        <h3 class="job-listing-title padding-right-0">
                          <?php if ($row->status != 4) : ?><a href="<?php echo Url::url('/master/projects/view', $row->project_id); ?>"><?php echo $row->name; ?></a>
                          <?php else : ?>
                            <span><?php echo $row->name; ?></span>
                          <?php endif; ?>
                        </h3>
                        <!-- Job Listing Footer -->
                        <div class="job-listing-footer">
                          <ul>
                            <li class="d-block font-size-13" style="line-height: 1.3em;"><?php echo $row->proposal; ?>
                            </li>
                            <li class="font-size-13"><i class="icon-material-outline-access-time"></i><?php echo Date::timesince($row->created_at); ?>
                            </li>
                          </ul>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- Task Details -->
                  <ul class="dashboard-task-info margin-top-4">
                    <li><strong><i class="<?php echo ($row->currency === 'TRY') ? 'icon-line-awesome-turkish-lira' : 'icon-line-awesome-dollar'; ?> font-weight-700"></i><?php echo App::Utility()->formatNumber($row->bid_amount); ?></strong><span><?php echo Lang::$word->BID_AMOUNT; ?></span>
                    </li>
                    <?php if ($row->work_type === "Project Based") : ?>
                      <li>
                        <strong><?php echo $row->delivery_time . " " . (($row->delivery_time > 1) ? (($row->time_type === "day") ? ucwordS(Lang::$word->_DAYS) : ucwordS(Lang::$word->_HOURS)) : ucwordS($row->time_type)); ?></strong><span><?php echo Lang::$word->DELIVERY_TIME; ?></span>
                      </li>
                    <?php else : ?>
                      <li>
                        <strong><?php echo ucwordS($row->payment_type); ?></strong><span><?php echo Lang::$word->TIME; ?></span>
                      </li>
                    <?php endif; ?>
                    <li>
                      <strong><?php echo $row->project_total_bids; ?></strong><span><?php echo Lang::$word->BIDS; ?></span>
                    </li>
                    <li>
                      <strong><i class="<?php echo ($row->currency === 'TRY') ? 'icon-line-awesome-turkish-lira' : 'icon-line-awesome-dollar'; ?> font-weight-700"></i><?php echo App::Utility()->formatNumber($row->average_bids_amount); ?></strong><span><?php echo Lang::$word->AVERAGE; ?></span>
                    </li>
                  </ul>
                  <!-- Buttons -->
                  <div class="buttons-to-right always-visible">

                    <?php switch ($row->status):
                      case 4: ?>
                        <a class="button ripple-effect color-white"><i class="icon-material-outline-thumb-down"></i> <?php echo Lang::$word->DECLINED; ?></a>
                      <?php break;
                      case 2: ?>
                        <a class="button color-white"><i class="icon-material-outline-thumb-up"></i> <?php echo Lang::$word->ACCEPTED; ?></a>
                      <?php break;
                      case 1: ?>
                        <a href="<?php echo Url::url('/master/projects/view', $row->project_id); ?>" class="button dark ripple-effect ico" title="<?php echo Lang::$word->EDIT_BID; ?>" data-tippy-placement="top"><i class="icon-feather-edit"></i></a>
                        <a data-set='{"option":[{"delete": "deleteBid","title": "<?php echo Validator::sanitize($row->name, "chars"); ?>","id": "<?php echo $row->id; ?>"}],"action":"delete", "parent":"#bid_<?php echo $row->id; ?>"}' class="button red ripple-effect ico data" title="<?php echo Lang::$word->CANCEL_BID; ?>" data-tippy-placement="top"><i class="icon-feather-trash-2"></i></a>
                      <?php break;
                      default: ?>
                        <a class="button ripple-effect color-white"><?php echo Lang::$word->COMPLETED; ?></a>
                    <?php break;
                    endswitch; ?>
                  </div>
                </li>
              <?php endforeach; ?>
            <?php endif; ?>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <!-- Row / End -->
</div>
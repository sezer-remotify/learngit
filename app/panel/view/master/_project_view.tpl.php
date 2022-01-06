<?php

/**
 * Freelancer Search Projects page
 *
 * @package Wojo Framework
 * @author MOHAMMAD ILYAS KOHISTANI
 * @copyright 2019
 * @version $Id: freelancer_search_proj.tpl.php, v1.00 2021-01-23 21:18:00 gewa Exp $
 */
if (!defined("_WOJO"))
  die('Direct access to this location is not allowed.');
?>

<!-- Titlebar
================================================== -->
<div class="single-page-header" data-background-image="images/single-task.jpg">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="single-page-header-inner">
          <div class="left-side">
            <div class="header-image "><a href="<?php echo Url::url('/master/profile/view/' . $this->uRow->username); ?>">
                <img id="company-logo" src="<?php echo ($this->uRow->avatar) ? UPLOADURL . "/avatars/" . $this->uRow->avatar : MASTERVIEW . "/images/user-avatar-placeholder.png"; ?>" alt="<?php echo $this->uRow->fname; ?>">
              </a></div>
            <div class="header-details">
              <h3 id="project-name"><?php echo $this->row->name; ?></h3>
              <ul>
                <li>
                  <h5><?php echo ucwords($this->uRow->fname . ' ' . $this->uRow->lname); ?></h5>
                </li>
                <li>
                  <div id="company-verified" class="verified-badge-with-title"><?php echo Lang::$word->VERIFIED; ?>
                  </div>
                </li>
              </ul>
              <ul>
                <?php
                if ($this->row->country) echo '<li><img id="company-country" class="flag" src=" ' . UPLOADURL . '/flags/' . $this->row->country . '.svg" alt="' . $this->row->country . '">
                </li>';
                ?>
                <li class="d-inline-flex align-items-center"><span class="icon-material-outline-business-center custom-icon margin-right-5"></span><?php echo $this->row->work_type; ?>
                </li>
                <li class="d-inline-flex align-items-center"><span class="icon-material-outline-access-time custom-icon margin-right-5"></span><?php echo $this->row->start_date; ?>
                </li>
                <li class="d-inline-flex align-items-center"><span class="icon-line-awesome-group custom-icon margin-right-5"></span><?php echo $this->row->required_dev; ?>
                </li>
              </ul>
            </div>
          </div>
          <div class="right-side">
            <div class="salary-box">
              <div class="salary-type text-center">
                <strong><?php echo ucwords($this->budget->type . ' ' . Lang::$word->NAV_37); ?></strong>
              </div>
              <div id="project-budget" class="salary-amount">
                <?php echo ($this->row->currency === 'TRY') ? '₺' . $this->budget->minimum . (($this->budget->maximum > 0) ? ' - ₺' . $this->budget->maximum : '+')
                  : '$' . $this->budget->minimum . (($this->budget->maximum > 0) ? ' - $' . $this->budget->maximum : '+'); ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Page Content
================================================== -->
<div class="dashboard-container height-auto">
  <div class="container">
    <div class="row">

      <!-- Content -->
      <div class="<?php echo (intval($this->row->created_by_id) != intval(Auth::$udata->uid)  && $this->row->label_id == 1) ? 'col-xl-8 col-lg-8' : 'col-xl-12 col-lg-12'; ?> content-right-offset">


        <!-- Description -->
        <div class="single-page-section">
          <h3 class="margin-bottom-25"><?php echo Lang::$word->PROJECT_DESCRIPTION; ?></h3>
          <p id="project-description"><?php echo $this->row->description; ?></p>
        </div>
        <!-- Skills -->
        <div class="single-page-section">
          <h3><?php echo Lang::$word->SKILLS_REQUIRED; ?></h3>
          <div id="skills-required" class="task-tags">
            <?php foreach ($this->skills as $v) echo '<span class="margin-left-4">' . $v->name . '</span>'; ?>
          </div>
        </div>

        <?php if (count((array)$this->files) > 0) : ?>
          <!-- Atachments -->
          <div class="single-page-section">
            <h3><?php echo Lang::$word->ATTACHMENTS; ?></h3>
            <div id="attachments" class="attachments-container">
              <?php foreach ($this->files as $v) : ?>
                <a target="_BLANK" href="<?php echo UPLOADURL . '/files/' . $v->name; ?>" class="attachment-box ripple-effect" download><span>Project Brief</span><i><?php echo $v->fext; ?></i></a>
              <?php endforeach; ?>
            </div>
          </div>
        <?php endif; ?>

        <div class="clearfix"></div>
      </div>



      <?php if (intval($this->row->created_by_id) != intval(Auth::$udata->uid) && $this->row->label_id == 1) : ?>
        <!-- Sidebar -->
        <div class="col-xl-4 col-lg-4">
          <div class="sidebar-container">
            <form id="bid-form" action="" method="POST">
              <div class="sidebar-widget">
                <div class="bidding-widget">
                  <div class="bidding-headline">
                    <h3><?php echo Lang::$word->BID_ON_THIS; ?></h3>
                  </div>
<div class="alert"style=" background: #e82a68; color: #fff; width: 100%; max-width: 500px; margin: 30px auto 0 auto; border-radius: 5px; padding: 10px; ">
  <h4 class="text-center">Attention!</h4>
  <p class="text-center">Taxes and Remotify fee will be added to the prices. Submit your bid accordingly.<br>(Fee%15 + Tax %10)</p>
</div>
                  <?php if ($this->bid) : ?>
                    <?php include 'snippets/_place_bid_edit.tpl.php'; ?>
                  <?php else : ?>
                    <?php if ($this->isProjectBased) : ?>
                      <div class="bidding-inner">
                        <!-- Headline -->
                        <span class="bidding-detail"><?php echo Lang::$word->SET_BID_AMOUNT; ?></span>

                        <!-- Price -->
                        <div class="bidding-fields">
                          <div class="bidding-field">
                            <div class="qtyButtons">
                              <span class="<?php echo ($this->row->currency === 'TRY') ? 'icon-line-awesome-turkish-lira' : 'icon-line-awesome-dollar'; ?> bid-rate d-flex align-items-center"></span>
                              <input type="text" id="bid_amount" name="bid_amount" min="0" value="0">
                            </div>
                          </div>
                        </div>

                        <!-- Headline -->
                        <span class="bidding-detail margin-top-30"><?php echo Lang::$word->SET_DELIVERY_TIME; ?></span>

                        <!-- Fields -->
                        <div class="bidding-fields">
                          <div class="bidding-field">
                            <!-- Quantity Buttons -->
                            <div class="qtyButtons">
                              <div class="qtyDec"></div>
                              <input type="text" id="delivery-time" name="delivery_time" value="1">
                              <div class="qtyInc"></div>
                            </div>
                          </div>
                          <div class="bidding-field">
                            <select id="time_type" name="time_type" class="selectpicker default">
                              <option selected value="day"><?php echo Lang::$word->_DAYS; ?></option>
                              <option value="hour"><?php echo Lang::$word->_HOURS; ?></option>
                            </select>
                          </div>
                        </div>
                        <!-- Proposal field -->
                        <div class="margin-top-20">
                          <h3><?php echo Lang::$word->PROPOSAL; ?></h3>
                          <textarea id="proposal" name="proposal" placeholder="<?php echo Lang::$word->ENTER_PROPOSAL; ?>" rows="3"></textarea>
                        </div>

                        <!-- Milestone field -->
                        <div id="milestone-container">
                          <div>
                            <div class="margin-top-20"></div>
                            <h3><?php echo Lang::$word->MILESTONE; ?></h3>
                            <textarea class="custom-textarea" id="milestone-task-1" name="milestone_task[]" placeholder="<?php echo Lang::$word->DESCRIBE_TASK; ?>" rows="1"></textarea>
                            <!-- Quantity Buttons -->
                            <div class="bidding-fields">
                              <div class="bidding-field">
                                <div class="qtyButtons">
                                  <span class="<?php echo ($this->row->currency === 'TRY') ? 'icon-line-awesome-turkish-lira' : 'icon-line-awesome-dollar'; ?> bid-rate d-flex align-items-center"></span>
                                  <input type="text" id="milestone-price-1" name="milestone_price[]" value="1">
                                </div>
                              </div>
                              <div class="bidding-field">
                                <button type="button" class="button gray full-width disabled" disabled><?php echo Lang::$word->REMOVE; ?></button>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div>
                          <button id="add-milestone" class="button full-width  margin-top-20" type="button"><?php echo Lang::$word->ADD_MILESTONE; ?></button>
                        </div>
                        <!-- Button -->
                        <button type="button" name="dosubmit" data-action="placeBid" form="bid-form" class="button ripple-effect move-on-hover full-width margin-top-15"><span><?php echo Lang::$word->PLACE_BID; ?></span></button>
                        <input type="hidden" name="project_id" value="<?php echo $this->row->id; ?>">
                      </div>
                    <?php else : ?>
                      <div class="bidding-inner">
                        <!-- Headline -->
                        <span class="bidding-detail"><?php echo Lang::$word->SET_BID_AMOUNT; ?></span>
                        <!-- Price -->
                        <div class="bidding-fields">
                          <div class="bidding-field">
                            <div class="qtyButtons">
                              <span class="<?php echo ($this->row->currency === 'TRY') ? 'icon-line-awesome-turkish-lira' : 'icon-line-awesome-dollar'; ?> bid-rate d-flex align-items-center"></span>
                              <input type="text" id="bid_amount" name="bid_amount" min="0" value="0">
                            </div>
                          </div>
                        </div>
                        <!-- price type -->
                        <select id="payment_type" name="payment_type" class="selectpicker default margin-top-15">
                          <option value="hourly"><?php echo Lang::$word->HOURLY; ?></option>
                          <option value="daily"><?php echo Lang::$word->DAILY; ?></option>
                          <option selected value="monthly"><?php echo Lang::$word->MONTHLY; ?></option>
                        </select>

                        <!-- Proposal field -->
                        <div class="margin-top-20">
                          <h3><?php echo Lang::$word->PROPOSAL; ?></h3>
                          <textarea id="proposal" name="proposal" placeholder="<?php echo Lang::$word->ENTER_PROPOSAL; ?>" rows="3"></textarea>
                        </div>

                        <!-- Button -->
                        <button type="button" name="dosubmit" data-action="placeBid" form="bid-form" class="button ripple-effect move-on-hover full-width margin-top-15"><span><?php echo Lang::$word->PLACE_BID; ?></span></button>
                        <input type="hidden" name="project_id" value="<?php echo $this->row->id; ?>">
                      </div>
                    <?php endif; ?>
                  <?php endif; ?>
                </div>
              </div>
            </form>
          </div>
        </div>
      <?php endif; ?>
    </div>
  </div>
</div>
<script link="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<script>
  $(document).ready(function() {
    //setTimeout(function(){ $(".alert").toggle("slide",{direction: "up"}); }, 3000);


    $(document).on('click', '.slider-horizontal', function() {
      $("#biddingVal").html(parseInt($('.bidding-slider').val()).toLocaleString());
    });
    $('#payment-verified,#deposit-verified,#email-verified,#profile-verified,#phone-verified').hover(function() {
      $(this).toggleClass("custom-icon-active");
    });
    var milestone_id = 1;
    $('#add-milestone').click(function() {
      ++milestone_id;
      $('#milestone-container').append(
        '<div id="milestone_' + milestone_id +
        '"><div class="margin-top-20"></div><h3>Milestone</h3>										<textarea class="custom-textarea" id="milestone-task-' +
        milestone_id +
        '" name="milestone_task[]" placeholder="Describe your task..." rows="1"></textarea><div class="bidding-fields"><div class="bidding-field"><div class="qtyButtons"><span class="icon-line-awesome-turkish-lira bid-rate  d-flex align-items-center"></span>						<input type="text" id="milestone-price-' +
        milestone_id +
        '" name="milestone_price[]" value="1"></div></div><div class="bidding-field"><button type="button" data-id="' +
        milestone_id + '" class="remove-button button full-width">Remove</button></div></div></div>'
      );
    });

    $('body').on('click', '.remove-button', function() {
      var id = "#milestone_" + $(this).data('id');
      var element = $(id);
      element.remove();
      --milestone_id;
    });

  });
</script>

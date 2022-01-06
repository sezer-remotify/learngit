<?php if (strtolower($this->bid->work_type) === 'project based') : ?>
  <div class="bidding-inner">
    <!-- Headline -->
    <span class="bidding-detail"><?php echo Lang::$word->SET_BID_AMOUNT; ?></span>

    <!-- Price -->
    <div class="bidding-fields">
      <div class="bidding-field">
        <div class="qtyButtons">
          <span class="<?php echo ($this->row->currency === 'TRY') ? 'icon-line-awesome-turkish-lira' : 'icon-line-awesome-dollar'; ?> bid-rate d-flex align-items-center"></span>
          <input type="text" id="bid_amount" name="bid_amount" min="0" value="<?php echo $this->bid->bid_amount; ?>">
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
          <input type="text" id="delivery-time" name="delivery_time" value="<?php echo $this->bid->delivery_time; ?>">
          <div class="qtyInc"></div>
        </div>
      </div>
      <div class="bidding-field">
        <select id="time_type" name="time_type" class="selectpicker default">
          <option value="day" <?php if ($this->bid->time_type === 'day') echo 'selected'; ?>><?php echo Lang::$word->_DAYS; ?></option>
          <option value="hour" <?php if ($this->bid->time_type === 'hour') echo 'selected'; ?>><?php echo Lang::$word->_HOURS; ?></option>
        </select>
      </div>
    </div>
    <!-- Proposal field -->
    <div class="margin-top-20">
      <h3><?php echo Lang::$word->PROPOSAL; ?></h3>
      <textarea id="proposal" name="proposal" placeholder="<?php echo Lang::$word->ENTER_PROPOSAL; ?>" rows="3"><?php echo $this->bid->proposal; ?></textarea>
    </div>


    <!-- Milestone field -->
    <div id="milestone-container">
      <?php if ($this->milestone) : ?>
        <?php $x = 1;
        foreach ($this->milestone as $milestone) : ?>
          <div id="<?php echo 'milestone_' . $x;  ?>">
            <div class="margin-top-20"></div>
            <h3><?php echo Lang::$word->MILESTONE; ?></h3>
            <textarea class="custom-textarea" id="milestone-task-<?php echo $x; ?>" name="milestone_task[]" placeholder="<?php echo Lang::$word->DESCRIBE_TASK; ?>" rows="1"><?php echo $milestone->task; ?></textarea>
            <!-- Quantity Buttons -->
            <div class="bidding-fields">
              <div class="bidding-field">
                <div class="qtyButtons">
                  <span class="<?php echo ($this->row->currency === 'TRY') ? 'icon-line-awesome-turkish-lira' : 'icon-line-awesome-dollar'; ?> bid-rate d-flex align-items-center"></span>
                  <input type="text" id="milestone-price-<?php echo $x; ?>" name="milestone_price[]" value="<?php echo $milestone->amount; ?>">
                </div>
              </div>
              <div class="bidding-field">
                <button type="button" <?php if ($x > 1) echo 'data-id="' . $x . '"'; ?> class="button full-width <?php echo ($x != 1) ? ' remove-button' : ' gray disabled'; ?>">Remove</button>
              </div>
            </div>
          </div>
          <?php $x++; ?>
        <?php endforeach; ?>
      <?php endif; ?>
    </div>
    <div>
      <button id="add-milestone" class="button full-width  margin-top-20" type="button"><?php echo Lang::$word->ADD_MILESTONE; ?></button>
    </div>
    <!-- Button -->
    <button type="button" name="dosubmit" data-action="placeBid" form="bid-form" class="button ripple-effect move-on-hover full-width margin-top-15"><span><?php echo Lang::$word->UP_BID; ?></span></button>
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
          <input type="text" id="bid_amount" name="bid_amount" min="0" value="<?php echo $this->bid->bid_amount; ?>">
        </div>
      </div>
    </div>
    <!-- price type -->
    <select id="payment_type" name="payment_type" class="selectpicker default margin-top-15">
      <option value="hourly" <?php if ($this->bid->payment_type === 'hourly') echo 'selected'; ?>><?php echo Lang::$word->HOURLY; ?></option>
      <option value="daily" <?php if ($this->bid->payment_type === 'daily') echo 'selected'; ?>><?php echo Lang::$word->DAILY; ?></option>
      <option value="monthly" <?php if ($this->bid->payment_type === 'monthly') echo 'selected'; ?>><?php echo Lang::$word->MONTHLY; ?></option>
    </select>

    <!-- Proposal field -->
    <div class="margin-top-20">
      <h3><?php echo Lang::$word->PROPOSAL; ?></h3>
      <textarea id="proposal" name="proposal" placeholder="<?php echo Lang::$word->ENTER_PROPOSAL; ?>" rows="3"><?php echo $this->bid->proposal; ?></textarea>
    </div>

    <!-- Button -->
    <button type="button" name="dosubmit" data-action="placeBid" form="bid-form" class="button ripple-effect move-on-hover full-width margin-top-15"><span><?php echo Lang::$word->UP_BID; ?></span></button>
    <input type="hidden" name="project_id" value="<?php echo $this->row->id; ?>">
  </div>
<?php endif; ?>
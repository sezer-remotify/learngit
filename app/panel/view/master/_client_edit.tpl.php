<?php

/**
 * Expenses
 *
 * @package Wojo Framework
 * @author wojoscripts.com
 * @copyright 2019
 * @version $Id: expenses.tpl.php, v1.00 2019-05-05 10:12:05 gewa Exp $
 */
if (!defined("_WOJO"))
  die('Direct access to this location is not allowed.');
?>

<!-- Titlebar
================================================== -->
<div class="dashboard-container d-block height-auto padding-top-30">
  <div class="container">
    <form class="row" id="client_form">
      <!-- Dashboard Box -->
      <div class="col-xl-12">
        <div class="dashboard-box margin-top-0">

          <!-- Headline -->
          <div class="headline">
            <h3><i class="icon-material-outline-account-circle"></i> <?php echo Lang::$word->ACC_MY_ACCOUNT; ?></h3>
          </div>

          <div class="content with-padding padding-bottom-0">

            <div class="row">

              <div class="col-xl-3 col-md-3 col-sm-12">
                <div class="avatar-wrapper" data-tippy-placement="bottom" title="Profile Picture">
                  <img class="profile-pic" src="<?php ($this->row->avatar) ? UPLOADURL . "/avatars/" . $this->row->avatar : MASTERVIEW . "/images/user-avatar-placeholder.png"; ?>" alt="" />
                  <div class="upload-button"></div>
                  <input class="file-upload" name="profile" type="file" accept="image/*" />
                </div>
              </div>

              <div class="col-xl-9 col-md-9 col-sm-12">
                <div class="row">

                  <div class="col-xl-6">
                    <div class="submit-field">
                      <h5><?php echo Lang::$word->FNAME; ?></h5>
                      <input id="first-name" name="name" type="text" class="with-border" value="<?php echo $this->row->fname; ?>" placeholder="<?php echo Lang::$word->FNAME; ?>">
                    </div>
                  </div>

                  <div class="col-xl-6">
                    <div class="submit-field">
                      <h5><?php echo Lang::$word->LNAME; ?></h5>
                      <input id="last-name" name="surname" type="text" class="with-border" value="<?php echo $this->row->lname; ?>" placeholder="<?php echo Lang::$word->LNAME; ?>">
                    </div>
                  </div>



                </div>
              </div>
            </div>

          </div>
        </div>
      </div>

      <!-- Dashboard Box -->
      <div class="col-xl-12">
        <div class="dashboard-box">

          <!-- Headline -->
          <div class="headline">
            <h3><i class="icon-material-outline-face"></i><?php echo Lang::$word->MY_PROFILE; ?></h3>
          </div>

          <div class="content">
            <ul class="fields-ul">
              <li>
                <div class="row">
                  <div class="col-xl-6 col-md-6">
                    <div class="submit-field">
                      <h5><?php echo Lang::$word->HEADLINE; ?></h5>
                      <input id="headline" name="headline" type="text" class="with-border" value="<?php echo $this->row->headline; ?>" placeholder="<?php echo Lang::$word->CLIENT_HEAD_EXAMPLE; ?>">
                    </div>
                  </div>


                  <div class="col-xl-6 col-md-6">
                    <div class="submit-field">
                      <div class="bidding-widget">
                        <!-- Headline -->
                        <span class="bidding-detail margin-bottom-10"><?php echo Lang::$word->CFG_PHONE; ?></span>
                        <input id="phone-number" name="phone" type="text" class="with-border" value="<?php echo $this->row->phone; ?>" placeholder="<?php echo Lang::$word->PHONE_NUMBER_EXAMPLE; ?>" maxlength="20">
                      </div>
                    </div>
                  </div>
                  <div class="col-xl-12">
                    <div class="submit-field">
                      <h5><?php echo Lang::$word->ABOUT_ME; ?></h5>
                      <textarea id="about-me" name="about" cols="30" rows="5" class="with-border" placeholder="<?php echo Lang::$word->ABOUT_ME; ?>"><?php echo $this->row->about; ?></textarea>
                    </div>
                  </div>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </div>

      <!-- Dashboard Box -->
      <div class="col-xl-12">
        <div class="dashboard-box">

          <!-- Headline -->
          <div class="headline">
            <h3><i class="icon-material-outline-face"></i> <?php echo Lang::$word->CMP_INFO; ?></h3>
          </div>

          <div class="content">
            <ul class="fields-ul">
              <li>
                <div class="row">
                  <div class="col-xl-6">
                    <div class="submit-field">
                      <h5><?php echo Lang::$word->CMP_NAME; ?></h5>
                      <input type="text" name="cmp_name" id="cmp_name" class="with-border" value="<?php echo $this->irow->cmp_name; ?>" placeholder="<?php echo Lang::$word->CMP_NAME; ?>">
                    </div>
                  </div>
                  <div class="col-xl-6">
                    <div class="submit-field">
                      <h5><?php echo Lang::$word->CMP_WEB; ?></h5>
                      <input type="text" name="cmp_web" id="cmp_web" class="with-border" value="<?php echo $this->irow->cmp_website; ?>" placeholder="<?php echo Lang::$word->CMP_WEB; ?>">
                    </div>
                  </div>
                  <div class="col-xl-12">
                    <div class="submit-field">
                      <h5><?php echo Lang::$word->CMP_LINKEDIN; ?></h5>
                      <input type="text" name="cmp_linkedin" id="cmp_linkedin" class="with-border" value="<?php echo $this->irow->cmp_linkedin; ?>" placeholder="<?php echo Lang::$word->CMP_LINKEDIN; ?>">
                    </div>
                  </div>
                  <div class="col-xl-12">
                    <div class="submit-field">
                      <h5><?php echo Lang::$word->CMP_DESC; ?></h5>
                      <textarea name="cmp_desc" id="cmp_desc" cols="30" class="with-border" placeholder="<?php echo Lang::$word->CMP_DESC; ?>"><?php echo $this->irow->cmp_desc; ?></textarea>
                    </div>
                  </div>
                </div>
              </li>
              <li>
                <h5 class="margin-bottom-20"><?php echo Lang::$word->SKILLS; ?> <i class="help-icon" data-tippy-placement="right" title="<?php echo Lang::$word->CLIENT_LOOKING; ?>"></i></h5>
                <div class="row">
                  <?php $x = 1;
                  foreach ($this->skills as $skills) : ?>
                    <?php if ($x == 1 || $x == intval(abs((count($this->skills) / 4))) + 1 || $x == (intval(abs((count($this->skills) / 4))) * 2) + 1 || $x == ((intval(abs((count($this->skills)) / 4)) * 3) + 1)) echo '<div class="col-sm-6 col-md-3 col-xl-3">'; ?>
                    <div class="checkbox custom-check padding-right-10 margin-bottom-7 col-xl-12">
                      <input type="checkbox" id="<?php echo $skills->id; ?>" name="skills[]" data-text="<?php echo $skills->name; ?>" <?php foreach ($this->uSkills as $uSkills) : if ($uSkills->id == $skills->id) echo 'checked';
                                                                                                                                      endforeach; ?> value="<?php echo $skills->id; ?>">
                      <label class="margin-bottom-0 padding-left-25" for="<?php echo $skills->id; ?>"><span class="checkbox-icon"></span><?php echo $skills->name; ?></label>
                    </div>
                    <?php if ($x == intval(abs(count($this->skills))) || $x == intval(abs((count($this->skills)) / 4)) || $x == (intval(abs((count($this->skills) / 4))) * 2) || $x == (intval(abs((count($this->skills) / 4))) * 3)) echo '</div>'; ?>
                    <?php ++$x; ?>

                  <?php endforeach; ?>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </div>

      <!-- Save changes Button -->
      <div class="col-xl-12 margin-bottom-100 centered-button">
        <button type="button" id="save-button" name="dosubmit" data-action="doUpdate" form="client_form" class="wojo secondary button margin-top-30"><?php echo Lang::$word->SAVEC; ?></button>
      </div>
    </form>
  </div>
</div>

<script src="https://unpkg.com/@popperjs/core@2/dist/umd/popper.min.js"></script>
<script src="https://unpkg.com/tippy.js@6/dist/tippy-bundle.umd.js"></script>
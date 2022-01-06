<div class="wojo fof card">
  <div class="content width-100">
    <h2 style="color:#1D3354; font-weight:bold;" class="margin-bottom-15">Hi <?php echo ucwords(App::Auth()->fname); ?>! How’s your day going?</h2>

    <?php if (App::Auth()->Is_Client()) : ?>
    <p class="margin-bottom-0">If you have any question, please book an appointment with Remotify Team</p>
    <!-- Calendly inline widget begin -->
    <div class="calendly-inline-widget" data-url="https://calendly.com/remotifyco/15min" style="min-width:320px;height:930px;"></div>
    <script type="text/javascript" src="https://assets.calendly.com/assets/external/widget.js" async></script>
    <!-- Calendly inline widget end -->
    <?php else : ?>

    <p class="margin-bottom-0">we will contact you if demand for your talent appears.</p>
    <div class="d-flex justify-content-center padding-top-50 width-100">
      <a href="<?php echo Url::url('/master/profile/edit'); ?>" class="wojo secondary button">Update Profile</a>
      <a href="<?php echo Url::url('/master/profile/view/' . App::Auth()->username . '/'); ?>" class="wojo secondary button margin-left-15">Visit
        Public Profile</a>
    </div>
    <?php endif; ?>

  </div>
</div>

<?php
$title = $args['title'] ?? '';
$description = $args['description'] ?? '';
$text = $args['text'] ?? '';
?>

<div class="newsletter">
  <div class="grid h-full content-center bg-gray-800 rounded-xs md:rounded-md lg:rounded-lg p-4 gap-4 md:p-6 md:gap-10 lg:p-10 xl:p-10">
    <div class="grid gap-2 md:gap-4">
      <div class="text-yellow font-h3">
        <?php echo esc_html($title); ?>
      </div>

      <div class="text-white font-b2">
        <?php echo esc_html($description); ?>
      </div>
    </div>

    <div class="grid gap-4 md:gap-6">
      <div class="grid gap-2 md:gap-4">
        <div class="sp-form-outer sp-force-hide">
          <div id="sp-form-235490" sp-id="235490" sp-hash="c27cfd8f39d692e19764757d1f5f2dc829445a8bd7a27c5d6eefd66a67c0d864" sp-lang="en" class="sp-form sp-form-regular sp-form-embed" sp-show-options="%7B%22satellite%22%3Afalse%2C%22maDomain%22%3A%22login.sendpulse.com%22%2C%22formsDomain%22%3A%22forms.sendpulse.com%22%2C%22condition%22%3A%22onEnter%22%2C%22scrollTo%22%3A25%2C%22delay%22%3A10%2C%22repeat%22%3A3%2C%22background%22%3A%22rgba(0%2C%200%2C%200%2C%200.5)%22%2C%22position%22%3A%22bottom-right%22%2C%22animation%22%3A%22%22%2C%22hideOnMobile%22%3Afalse%2C%22submitRedirectUrl%22%3A%22%22%2C%22urlFilter%22%3Afalse%2C%22urlFilterConditions%22%3A%5B%7B%22force%22%3A%22hide%22%2C%22clause%22%3A%22contains%22%2C%22token%22%3A%22%22%7D%5D%2C%22analytics%22%3A%7B%22ga%22%3A%7B%22eventLabel%22%3A%22Website_subs_newsletter%22%2C%22send%22%3Atrue%7D%7D%2C%22utmEnable%22%3Atrue%7D">
            <div class="sp-form-fields-wrapper">
              <div class="sp-message !text-gray-400 !font-b3">
                <div></div>
              </div>

              <form novalidate="" class="sp-element-container">
                <div class="grid gap-4 md:gap-6 w-full">
                  <div class="sp-field !grid !gap-2 md:!gap-4 !border-none !overflow-visible !rounded-none" sp-id="sp-b33a476a-0e5c-4718-b1b0-e4a151b49123">
                    <input type="email" sp-type="email" name="sform[email]" class="!border-solid !border !px-4 !py-0 !text-white !placeholder-white/60 !bg-white/5 font-b2 !border-white/60 !h-11 !rounded-full w-full md:!h-12 lg:!h-14" placeholder="Email address" sp-tips="%7B%22required%22%3A%22Required%20field%22%2C%22wrong%22%3A%22Wrong%20email%22%7D" autocomplete="on" required="required">

                    <div class="text-gray-400 font-b3">
                      <?php echo wp_kses_post($text); ?>
                    </div>
                  </div>

                  <div class="sp-field sp-button-container justify-self-start" sp-id="sp-1e691f9c-28bb-4505-8378-415d30c09396">
                    <button id="sp-1e691f9c-28bb-4505-8378-415d30c09396" class="button-md button-primary-white"><?php _e(
                                                                                                                  'Subscribe',
                                                                                                                  'SECRET-domain'
                                                                                                                ); ?></button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>

        <script type="text/javascript" async="async" src="//web.webformscr.com/apps/fc3/build/default-handler.js?1714030486793"></script>
      </div>
    </div>
  </div>
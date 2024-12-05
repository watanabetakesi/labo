<?php include_once(dirname(dirname(__FILE__)) . '/parts/header.php'); ?>
<?php include_once(dirname(dirname(__FILE__)) . '/parts/sidebar.php'); ?>

<div class="wrapper">

       <form>
              <fieldset class="uk-fieldset">

              <legend class="uk-legend">Uikit Form Sample</legend>

              <div class="uk-margin">
                     <input class="uk-input" type="text" placeholder="Input" aria-label="Input">
              </div>

              <div class="uk-margin">
                     <select class="uk-select" aria-label="Select">
                     <option>Option 01</option>
                     <option>Option 02</option>
                     </select>
              </div>

              <div class="uk-margin">
                     <textarea class="uk-textarea" rows="5" placeholder="Textarea" aria-label="Textarea"></textarea>
              </div>

              <div class="uk-margin uk-grid-small uk-child-width-auto uk-grid">
                     <label><input class="uk-radio" type="radio" name="radio2" checked> A</label>
                     <label><input class="uk-radio" type="radio" name="radio2"> B</label>
              </div>

              <div class="uk-margin uk-grid-small uk-child-width-auto uk-grid">
                     <label><input class="uk-checkbox" type="checkbox" checked> A</label>
                     <label><input class="uk-checkbox" type="checkbox"> B</label>
              </div>

              <div class="uk-margin">
                     <input class="uk-range" type="range" value="2" min="0" max="10" step="0.1" aria-label="Range">
              </div>

              <p uk-margin>
              <a class="uk-button uk-button-default" href="#">Link</a>
              <button class="uk-button uk-button-default">Button</button>
              <button class="uk-button uk-button-default" disabled>Disabled</button>
              </p>
              </fieldset>
       </form>

       <p class='uk-text-lead'>lead-TEST</p>
       <p class='uk-text-meta'>meta-TEST</p>
       <p class='uk-text-small'>small-TEST</p>
       <p class='uk-text-large'>large-TEST</p>
       <p class='uk-text-bold'>bold-TEST</p>
       <p class='uk-text-mute'>mute-TEST</p>
       <p class='uk-text-emphasis'>emphasis-TEST</p>
       <p class='uk-text-primary'>primary-TEST</p>
       <p class='uk-text-success'>success-TEST</p>
       <p class='uk-text-warning'>warning-TEST</p>
       <p class='uk-text-danger'>danger-TEST</p>
       <p class='uk-text-left'>left-TEST</p>
       <p class='uk-text-right'>right-TEST</p>
       <p class='uk-text-center'>center-TEST</p>
       <p class='uk-text-top'>top-TEST</p>
       <p class='uk-text-middle'>muddle-TEST</p>
       <p class='uk-text-bottom'>bottom-TEST</p>
       <p class='uk-text-baseline'>baseline-TEST</p>
</div>


<?php include_once(dirname(dirname(__FILE__)) . '/parts/footer.php'); ?>

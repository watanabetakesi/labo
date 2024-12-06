<? $page_title = "テキスト加工" ?>
<?php include_once(dirname(dirname(__FILE__)) . '/parts/header.php'); ?>
<?php include_once(dirname(dirname(__FILE__)) . '/parts/sidebar.php'); ?>

<div class="wrapper">
    <form>
        <fieldset class="uk-fieldset">

            <legend class="uk-legend">テキストフォーマッター</legend>

            <div class="uk-margin">
                <textarea class="uk-textarea" rows="5" placeholder="Textarea" aria-label="Textarea"></textarea>
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
</div>
<?php include_once(dirname(dirname(__FILE__)) . '/parts/footer.php'); ?>

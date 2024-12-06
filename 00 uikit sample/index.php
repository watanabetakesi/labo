<?php $page_title = 'Uikitフォームサンプル'; ?>
<?php include_once(dirname(dirname(__FILE__)) . '/parts/header.php'); ?>
<?php include_once(dirname(dirname(__FILE__)) . '/parts/sidebar.php'); ?>

<div class="wrapper">


    <legend class="uk-legend"><?= $page_title ?></legend>

    <form class="uk-form">
        <fieldset class="uk-fieldset">
            <div class="uk-margin">
                <label class="uk-form-label">テキストフォーム</label>
                <input class="uk-input" type="text" placeholder="Input" aria-label="Input">
            </div>
            <div class="uk-margin">
                <label class="uk-form-label">オプション</label>
                <select class="uk-select" aria-label="Select">
                    <option>Option 01</option>
                    <option>Option 02</option>
                </select>
            </div>

            <div class="uk-margin">
                <label class="uk-form-label">テキストエリア</label>
                <textarea class="uk-textarea" rows="5" placeholder="Textarea"
                    aria-label="Textarea"></textarea>
            </div>

            <div class="uk-margin">
                <label class="uk-form-label">ラジオボタン</label>
                <div class="uk-grid-small uk-child-width-auto uk-grid">
                    <label><input class="uk-radio" type="radio" name="radio2" checked> A</label>
                    <label><input class="uk-radio" type="radio" name="radio2"> B</label>
                </div>
            </div>

            <div class="uk-margin">
                <label class="uk-form-label">チェックボックス</label>
                <div class="uk-grid-small uk-child-width-auto uk-grid">
                    <label><input class="uk-checkbox" type="checkbox" checked> A</label>
                    <label><input class="uk-checkbox" type="checkbox"> B</label>
                </div>
            </div>

            <div class="uk-margin">
                <label class="uk-form-label">スライダー</label>
                <input class="uk-range" type="range" value="2" min="0" max="10" step="0.1"
                    aria-label="Range">
            </div>

            <div class="uk-margin">
                <label class="uk-form-label">ボタン</label>
                <a class="uk-button uk-button-default" href="#">Link</a>
                <button class="uk-button uk-button-default">Button</button>
                <button class="uk-button uk-button-default" disabled>Disabled</button>
            </div>
        </fieldset>
    </form>

    <div class="uk-grid">
        <div class="uk-width-2-3">
            グリッド1：これはグリッドで指定した左側３分の２の幅のグリッドボックスです。グリッド1これはグリッドで指定した左側３分の２の幅のグリッドボックスです。グリッド1これはグリッドで指定した左側３分の２の幅のグリッドボックスです。グリッド1これはグリッドで指定した左側３分の２の幅のグリッドボックスです。グリッド1これはグリッドで指定した左側３分の２の幅のグリッドボックスです。グリッド1これはグリッドで指定した左側３分の２の幅のグリッドボックスです。グリッド1これはグリッドで指定した左側３分の２の幅のグリッドボックスです。
        </div>
        <div class="uk-width-1-3">
            グリッド2：これはグリッドで指定した左側３分の１の幅のグリッドボックスです。これはグリッドで指定した左側３分の１の幅のグリッドボックスです。これはグリッドで指定した左側３分の１の幅のグリッドボックスです。これはグリッドで指定した左側３分の１の幅のグリッドボックスです。これはグリッドで指定した左側３分の１の幅のグリッドボックスです。これはグリッドで指定した左側３分の１の幅のグリッドボックスです。これはグリッドで指定した左側３分の１の幅のグリッドボックスです。これはグリッドで指定した左側３分の１の幅のグリッドボックスです。これはグリッドで指定した左側３分の１の幅のグリッドボックスです。これはグリッドで指定した左側３分の１の幅のグリッドボックスです。これはグリッドで指定した左側３分の１の幅のグリッドボックスです。
        </div>
    </div>

</div>


<?php include_once(dirname(dirname(__FILE__)) . '/parts/footer.php'); ?>
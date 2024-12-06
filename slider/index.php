<?php include_once(dirname(dirname(__FILE__)) . '/parts/header.php'); ?>
<?php include_once(dirname(dirname(__FILE__)) . '/parts/sidebar.php'); ?>

<style>
    * {
        font-family: "SF Pro JP","SF Pro Text","SF Pro Icons","Hiragino Kaku Gothic Pro","ヒラギノ角ゴ Pro W3","メイリオ","Meiryo","ＭＳ Ｐゴシック","Helvetica Neue","Helvetica","Arial",sans-serif;
    }
    *, :after, :before {
        box-sizing: inherit;
    }    
    .item_carousel{
        width: calc(100% - 72px);
        margin: 0 auto;
        display: block;
    }
    .items{
        width: 200px;
        position: relative;
        min-height: 1px;
        float: left;
        -webkit-backface-visibility: hidden;
        -webkit-tap-highlight-color: transparent;
        -webkit-touch-callout: none;
        margin-right: 14px;
    }
    .slider_wrapper{
        position: relative;
        overflow: hidden;
        -webkit-transform: translate3d(0px, 0px, 0px);
        -webkit-overflow-scrolling: touch;
    }
    .slider{
        transition: all 0s ease 0s;
        width: 3000px;        
    }
    .item_image {
        display: block;
        width: 200px;
        height: 200px;
        overflow: hidden;
    }
    .item_image img[data-src] { opacity: 0; }    
    .item_image img {
        object-fit: cover;
        width: 100%;
        opacity: 1;
        transition: opacity 1.0s;
    }
    .item_title, .item_cv {
        text-align: center;
        margin-top:6px;
        font-size: 12px;
    }
    .item-carousel .owl-nav div {
        top: 35%;
        opacity: 0.25;
        width: 25px;
        height: 35px;
    }
    .item_carousel .owl-nav .owl-prev, .item_carousel .owl-nav .owl-next, .item_carousel .owl-dot {
        cursor: pointer;
        cursor: hand;
        -webkit-user-select: none;
        -khtml-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
    }    
    .clearfix::after {
        content: "";
        display: block;
        clear: both;
    }
    section {
        display: block;
        margin-bottom: 20px;
    }
    .clearfix::after {
        content: "";
        float: none;
        display: block;
        clear: both;
    }
    .owl-nav div.owl-prev {
        background: url(img/back_arrow.png) no-repeat 0 0;
        background-size: 100% auto;
        left: 10px; 
    }
    .owl-nav div.owl-next {
        background: url(img/arrow.png) no-repeat 0 0;
        background-size: 100% auto;
        right: 10px;
    }
    .owl-nav div {
        text-align: center;
        line-height: 100%;
        cursor: pointer;
        position: absolute;
        width: 20px;
        height: 28px;
        margin-top: -160px;
    }
    row:after, .row:before {
        display: table;
        content: " ";
    }            
</style>

<section class="section_content row">
<div class="item_carousel" id="aikatsu">
<div class="slider_wrapper">
<div class="slider">
<div class="items">
<div class="item_image">
<img src="" data-src="https://cdn.img-conv.gamerch.com/img.gamerch.com/aikatsu-photo/wikidb_img/377681/20170926222339a5CgH9By.jpg">
</div>
<div class="item_title">星宮 いちご</div>
<div class="item_cv">cv (諸星 すみれ)</div>
</div>
<div class="items">
<div class="item_image">
<img src="" data-src="https://cdn.img-conv.gamerch.com/img.gamerch.com/aikatsu-photo/wikidb_img/1506564584001.jpg">
</div>
<div class="item_title">霧矢 あおい</div>
<div class="item_cv">cv (田所 あずさ)</div>
</div>
<div class="items">
<div class="item_image">
<img src="" data-src="https://cdn.img-conv.gamerch.com/img.gamerch.com/aikatsu-photo/wikidb_img/377681/20171217163806awgY71XI.jpg">
</div>
<div class="item_title">紫吹 蘭</div>
<div class="item_cv">cv (大橋 彩香)</div>
</div>
<div class="items">
<div class="item_image">
<img src="" data-src="https://cdn.img-conv.gamerch.com/img.gamerch.com/aikatsu-photo/wikidb_img/1529228079004.jpg">
</div>
<div class="item_title">有栖川 おとめ</div>
<div class="item_cv">cv (黒沢 ともよ)</div>
</div>
<div class="items">
<div class="item_image">
<img src="" data-src="https://cdn.img-conv.gamerch.com/img.gamerch.com/aikatsu-photo/wikidb_img/1530771093007.jpg">
</div>
<div class="item_title">藤堂 ユリカ</div>
<div class="item_cv">cv (沼倉 愛美)</div>
</div>                
<div class="items">
<div class="item_image">
<img src="" data-src="https://cdn.img-conv.gamerch.com/img.gamerch.com/aikatsu-photo/wikidb_img/377681/201806011541409x4cmBM8.jpg">
</div>
<div class="item_title">一ノ瀬 かえで</div>
<div class="item_cv">cv (三村 ゆうな)</div>
</div>                
<div class="items">
<div class="item_image">
<img src="" data-src="https://cdn.img-conv.gamerch.com/img.gamerch.com/aikatsu-photo/wikidb_img/1463050111.jpg">
</div>
<div class="item_title">北大路 さくら</div>
<div class="item_cv">cv (安野 希世乃)</div>
</div>
<div class="items">
<div class="item_image">
<img src="" data-src="https://i.pinimg.com/originals/d2/e9/86/d2e98684eed1c191f15dae1d444a48a9.jpg">
</div>
<div class="item_title">三ノ輪 ヒカリ</div>
<div class="item_cv">cv (森谷 里美)</div>
</div>
<div class="items">
<div class="item_image">
<img src="" data-src="https://cdn.img-conv.gamerch.com/img.gamerch.com/aikatsu-photo/wikidb_img/1479449331007.jpg">
</div>
<div class="item_title">神谷 しおん</div>
<div class="item_cv">cv (瀬戸 麻沙美)</div>
</div>                
<div class="items">
<div class="item_image">
<img src="" data-src="https://i.pinimg.com/originals/cc/b1/6a/ccb16ac9ff2dd05c35827926ef00e428.jpg">
</div>
<div class="item_title">神崎 美月</div>
<div class="item_cv">cv (寿 美菜子)</div>
</div>                
<div class="items">
<div class="item_image">
<img src="" data-src="https://cdn.img-conv.gamerch.com/img.gamerch.com/aikatsu-photo/wikidb_img/377681/20171117230006fJfIoNp7.jpg">
</div>
<div class="item_title">夏樹 みくる</div>
<div class="item_cv">cv (洲 崎綾)</div>
</div>
<div class="items">
<div class="item_image">
<img src="" data-src="https://cdn.img-conv.gamerch.com/img.gamerch.com/aikatsu-photo/wikidb_img/1492667475001.jpg">
</div>
<div class="item_title">音城 セイラ</div>
<div class="item_cv">cv (石原 夏織)</div>
</div>
<div class="items">
<div class="item_image">
<img src="" data-src="https://pbs.twimg.com/media/D_2GDuOU0AApogI.jpg">
</div>
<div class="item_title">冴草 きい</div>
<div class="item_cv">cv (秋奈)</div>
</div>
<div class="items">
<div class="item_image">
<img src="" data-src="https://cdn.img-conv.gamerch.com/img.gamerch.com/aikatsu-photo/wikidb_img/377681/20171215151440lLw0wG4h.jpg">
</div>
<div class="item_title">風沢 そら</div>
<div class="item_cv">cv (高橋 未奈美)</div>
</div>
<div class="items">
<div class="item_image">
<img src="" data-src="https://cdn.img-conv.gamerch.com/img.gamerch.com/aikatsu-photo/wikidb_img/377681/20160717105420Fjy9x41d.jpg">
</div>
<div class="item_title">姫里 マリア</div>
<div class="item_cv">cv (冨岡 美沙子)</div>
</div>
</div>
</div>
<div class="owl-nav">
<div class="owl-prev" onclick="slider('aikatsu', 'prev');return;"></div>
<div class="owl-next" onclick="slider('aikatsu', 'next');return;"></div>
</div>
<div class="clearfix"></div>
</div>
</section>



<section class="section_content row">
<div class="item_carousel" id="aikatsu2">
<div class="slider_wrapper">
<div class="slider">
<div class="items">
<div class="item_image">
<img src="" data-src="https://cdn.img-conv.gamerch.com/img.gamerch.com/aikatsu-photo/wikidb_img/1491013010.jpg">
</div>
<div class="item_title">大空 あかり</div>
<div class="item_cv">cv (下地 紫野)</div>
</div>
<div class="items">
<div class="item_image">
<img src="" data-src="https://i.pinimg.com/originals/57/9e/68/579e68f4cfc0a1196123c5688e4acf10.jpg">
</div>
<div class="item_title">氷上 スミレ</div>
<div class="item_cv">cv (和久井 優)</div>
</div>
<div class="items">
<div class="item_image">
<img src="" data-src="https://images-na.ssl-images-amazon.com/images/I/81V182Z-20L._CR150,10,640,960_.jpg">
</div>
<div class="item_title">新条 ひなき</div>
<div class="item_cv">cv (石川 由依)</div>
</div>
<div class="items">
<div class="item_image">
<img src="" data-src="https://cdn.img-conv.gamerch.com/img.gamerch.com/aikatsu-photo/wikidb_img/377681/20171226081131mvXmirn9.jpg">
</div>
<div class="item_title">天羽 まどか</div>
<div class="item_cv">cv (川上 千尋)</div>
</div>
<div class="items">
<div class="item_image">
<img src="" data-src="https://pbs.twimg.com/media/Dv09n02U8AE6NNl.jpg">
</div>
<div class="item_title">黒沢 凛</div>
<div class="item_cv">cv (高田 憂希)</div>
</div>                
<div class="items">
<div class="item_image">
<img src="" data-src="https://cdn.img-conv.gamerch.com/img.gamerch.com/aikatsu-photo/wikidb_img/1491811459.jpg">
</div>
<div class="item_title">栗栖 ここね</div>
<div class="item_cv">cv (伊藤 かな恵)</div>
</div>
<div class="items">
<div class="item_image">
<img src="" data-src="https://cdn.img-conv.gamerch.com/img.gamerch.com/aikatsu-photo/wikidb_img/1494405796002.jpg">
</div>
<div class="item_title">大地 のの</div>
<div class="item_cv">cv (小岩井 ことり)</div>
</div>
<div class="items">
<div class="item_image">
<img src="" data-src="https://images-na.ssl-images-amazon.com/images/I/71Jkq3OJlSL._CR150,0,640,960_.jpg">
</div>
<div class="item_title">白樺 リサ</div>
<div class="item_cv">cv (福沙 奈恵)</div>
</div>
<div class="items">
<div class="item_image">
<img src="" data-src="https://cdn.img-conv.gamerch.com/img.gamerch.com/aikatsu-photo/wikidb_img/1463347346.jpg">
</div>
<div class="item_title">紅林 珠璃</div>
<div class="item_cv">cv (齋藤 綾)</div>
</div>
<div class="items">
<div class="item_image">
<img src="" data-src="https://cdn.img-conv.gamerch.com/img.gamerch.com/aikatsu-photo/wikidb_img/377681/20171211163814EAduLBQD.jpg">
</div>
<div class="item_title">藤原 みやび</div>
<div class="item_cv">cv (関根 明良)</div>
</div>
</div>
</div>
<div class="owl-nav">
<div class="owl-prev" onclick="slider('aikatsu2', 'prev');return;"></div>
<div class="owl-next" onclick="slider('aikatsu2', 'next');return;"></div>
</div>
<div class="clearfix"></div>
</div>
</section>

<section class="section_content row">
<div class="item_carousel" id="aikatsustars">
<div class="slider_wrapper">
<div class="slider">
<div class="items">
<div class="item_image">
<img src="" data-src="https://cdn.img-conv.gamerch.com/img.gamerch.com/aikatsu-photo/wikidb_img/377681/2018042915440641FVpaDY.jpg">
</div>
<div class="item_title">虹野 ゆめ</div>
<div class="item_cv">cv (富田 美憂)</div>
</div>
<div class="items">
<div class="item_image">
<img src="" data-src="https://pbs.twimg.com/media/DrJIaj7VsAAkqaA.jpg">
</div>
<div class="item_title">桜庭 ローラ</div>
<div class="item_cv">cv (朝井 彩加)</div>
</div>
<div class="items">
<div class="item_image">
<img src="" data-src="https://pbs.twimg.com/media/DNLnfRRUEAA5l5P.jpg">
</div>
<div class="item_title">香澄  真昼</div>
<div class="item_cv">cv (宮本 侑芽)</div>
</div>                
<div class="items">
<div class="item_image">
<img src="" data-src="https://cdn.img-conv.gamerch.com/img.gamerch.com/aikatsu-photo/wikidb_img/377681/20180429161017Cb7uiQkT.jpg">
</div>
<div class="item_title">七倉 小春</div>
<div class="item_cv">cv (‎山口 愛)</div>
</div>
<div class="items">
<div class="item_image">
<img src="" data-src="https://live.staticflickr.com/410/31436114843_1472357c10_b.jpg">
</div>
<div class="item_title">白鳥 ひめ</div>
<div class="item_cv">cv (津田 美波)</div>
</div>
<div class="items">
<div class="item_image">
<img src="" data-src="https://live.staticflickr.com/4214/35505752686_0b29ab7bc0_b.jpg">
</div>
<div class="item_title">香澄 夜空</div>
<div class="item_cv">cv (大橋 彩香)</div>
</div>
<div class="items">
<div class="item_image">
<img src="" data-src="https://i.pinimg.com/736x/77/6a/7f/776a7f66c91a8e1286eb24d058d1c75d.jpg">
</div>
<div class="item_title">如月 ツバサ</div>
<div class="item_cv">cv (諸星 すみれ)</div>
</div>
<div class="items">
<div class="item_image">
<img src="" data-src="https://cdn.img-conv.gamerch.com/img.gamerch.com/aikatsu-photo/wikidb_img/377681/20180409200602MvhH6dWi.jpg">
</div>
<div class="item_title">二階堂 ゆず</div>
<div class="item_cv">cv (田所 あずさ)</div>
</div>
<div class="items">
<div class="item_image">
<img src="" data-src="https://cdn.img-conv.gamerch.com/img.gamerch.com/aikatsu-photo/wikidb_img/1505486592.jpg ">
</div>
<div class="item_title">白銀 リリィ</div>
<div class="item_cv">cv (上田 麗奈)</div>
</div>
<div class="items">
<div class="item_image">
<img src="" data-src="https://pbs.twimg.com/profile_images/918776757741797376/1u6iJ4Ae_400x400.jpg">
</div>
<div class="item_title">早乙女あこ</div>
<div class="item_cv">cv (村上 奈津実)</div>
</div>
<div class="items">
<div class="item_image">
<img src="" data-src="https://i.pinimg.com/originals/f6/1e/9c/f61e9c52feed71d858c8820a44a2f67a.jpg">
</div>
<div class="item_title">エルザ フォルテ</div>
<div class="item_cv">cv (日笠 陽子)</div>
</div>
<div class="items">
<div class="item_image">
<img src="" data-src="https://cdn.img-conv.gamerch.com/img.gamerch.com/aikatsu-photo/wikidb_img/377681/20180226200412D3a2zILI.jpg">
</div>
<div class="item_title">騎咲 レイ</div>
<div class="item_cv">cv (藤原 夏海)</div>
</div>
<div class="items">
<div class="item_image">
<img src="" data-src="https://cdn.img-conv.gamerch.com/img.gamerch.com/aikatsu-photo/wikidb_img/377681/20180116160723RmTs6LqM.jpg">
</div>
<div class="item_title">花園きらら</div>
<div class="item_cv">cv (江口 菜子)</div>
</div>
<div class="items">
<div class="item_image">
<img src="" data-src="https://i.pinimg.com/736x/1f/58/bc/1f58bccb5e186b043c590b56e8a42cb5.jpg">
</div>
<div class="item_title">双葉 アリア</div>
<div class="item_cv">cv (前田 佳織里)</div>
</div>
</div>
</div>
<div class="owl-nav">
<div class="owl-prev" onclick="slider('aikatsustars', 'prev');return;"></div>
<div class="owl-next" onclick="slider('aikatsustars', 'next');return;"></div>
</div>
<div class="clearfix"></div>
</div>
</section>

<div class="clearfix"></div>
</div>
</section>
        
<script>
    var isScrolling = false;
    var scaleInfo = new Object();

    window.onload = function () {
        getScaleInfo('aikatsu');
        lazyLoad('aikatsu');
        getScaleInfo('aikatsu2');
        lazyLoad('aikatsu2');
        getScaleInfo('aikatsustars');
        lazyLoad('aikatsustars');
        //getScaleInfo('aikatsufriends');
        //lazyLoad('aikatsufriends');                
    }

    function getScaleInfo(target) {
        var scrollContents = document.querySelector('div#' + target + ' div.slider');
        scaleInfo.itemCount = scrollContents.childElementCount;
        scaleInfo.itemWidth = document.querySelector('div#' + target + ' div.slider div.items').clientWidth;
        scaleInfo.itemMargin = document.querySelector('div#' + target + ' div.slider div.items').style.margin;
        scaleInfo.moveRange = scaleInfo.itemWidth + 14;
        scaleInfo.contentWidth = scaleInfo.moveRange * scaleInfo.itemCount;
        scrollContents.style.setProperty('width', scaleInfo.contentWidth + 'px');
        scaleInfo.wrapperWidth = document.querySelector('div#' + target + ' div.slider_wrapper').clientWidth;
        scaleInfo.maxTranslate = scaleInfo.contentWidth - scaleInfo.wrapperWidth;
        return scaleInfo;
    }
    /**
     * function scroll
     * @param {type} target
     * @param {type} action
     * @returns {undefined}
     */
    function slider(target, action) {

        console.log('target = ' + target);
        console.log('action = ' + action);

        isScrolling = true;
        scaleInfo = getScaleInfo(target);
        var scrollContents = document.querySelector('div#' + target + ' div.slider');

        // 現在のTranslateX
        scaleInfo.currentTX = 0;
        if (typeof scrollContents.style !== 'undefined' && typeof scrollContents.style.transform !== 'undefined') {
            transform = scrollContents.style.transform;
            // in case of translateX
            if (transform.match(/translateX\(([-]?[0-9]+(px))\)/)) {
                scaleInfo.currentTX = transform.match(/translateX\(([-]?[0-9]+(px))\)/)[1].replace(/px/g, '');
            }
            // in case of translate3d
            if (scaleInfo.currentTX == 0 && transform.match(/^translate3d\(.*?\)/)) {
                //scaleInfo.currentTX = transform.match(/translate3d\(([-]?[0-9]+(px))\)/)[1].replace(/px/g, '');
                //var translate3d = transform.match(/(?<=\().[a-z0-9\,\s]*(?=\))/)[0];
                var translate3d = transform.match(/\(.*?\)/)[0];
                translate3d = translate3d.replace(/(\(|\))/, '');
                console.log('translate3d = ' + translate3d);
                scaleInfo.currentTX = translate3d.split(',')[0].replace(/px/g, '');
                console.log('currentTX = ' + scaleInfo.currentTX);
            }
        }

        console.log(scaleInfo);

        // determin move range via action param.
        switch (action) {
            case 'prev':
                translateX = (Number(scaleInfo.currentTX) + scaleInfo.moveRange);
                break;
            case 'next':
                translateX = (Number(scaleInfo.currentTX) - scaleInfo.moveRange);
                break;
        }

        if (translateX >= 0) {
            translateX = 0;
        }
        if (translateX <= -scaleInfo.maxTranslate) {
            translateX = -scaleInfo.maxTranslate;
        }

        // when transition end
        scrollContents.addEventListener("transitionend", function () {
            if (isScrolling) {
                isScrolling = false;
            }
        });

        console.log("set translate3d style");
        //scrollContents.style = 'transform: translate3d(' + translateX + 'px, 0px, 0px); transition: all 0.5s ease 0s; width: ' + scaleInfo.contentWidth + 'px;';
        scrollContents.style.setProperty('transform', 'translate3d(' + translateX + 'px, 0px, 0px)');
        scrollContents.style.setProperty('transition', 'all 0.5s ease 0s');
        scrollContents.style.setProperty('width', scaleInfo.contentWidth + 'px');

        console.log('transform: translate3d(' + translateX + 'px, 0px, 0px); transition: all 0.5s ease 0s; width: ' + scaleInfo.contentWidth + 'px;');
        return;

    }
    ;

    function lazyLoad(target) {
        [].forEach.call(document.querySelectorAll('div#' + target + ' div.item_image img[data-src]'), function (img) {
            img.setAttribute('src', img.getAttribute('data-src'));
            img.onload = function () {
                img.removeAttribute('data-src');
            };
        });
    }
</script>    
<?php include_once(dirname(dirname(__FILE__)) . '/parts/footer.php'); ?>
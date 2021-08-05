
//parallax
(function($){
	
    $.fn.parallax = function(options){
				var ownerPos = $(this).backgroundPosition();
        var $$ = $(this);
        var offset = $$.offset();
        var defaults = {
            "start": 0,
            "stop": offset.top + $$.height(),
            "coeff": 0.95
        };
        var opts = $.extend(defaults, options);
        return this.each(function(){
            $(window).bind('scroll', function() {
                windowTop = $(window).scrollTop();
                if((windowTop >= opts.start) && (windowTop <= opts.stop)) {
                    newCoord = Number(ownerPos.y) + (windowTop * opts.coeff);
                    $$.css({
                        "background-position": ownerPos.x+ownerPos.xunit+" "+ newCoord + ownerPos.yunit
                    });
                }
            });
        });
    };
		
		
	//スタイルシートで設定している背景ポジションを取得
  $.fn.backgroundPosition = function() {
    var pos = $(this).css('backgroundPosition');
    if(typeof(pos) === 'undefined') {
			//id指定したエレメントの背景ポジションxとyを取得
			pos = document.getElementById(this.attr("id")).currentStyle["backgroundPositionX"] + ' ' + document.getElementById(this.attr("id")).currentStyle["backgroundPositionY"];
		}
		var bgPos = pos.split(' ');
		var rep = new Array();
		rep[0]=bgPos[0].match(/px|%/);//xの値がpxか％だった場合削除する
		rep[1]=bgPos[1].match(/px|%/);//yの値がpxか％だった場合削除する
		var posX = bgPos[0].replace(rep[0], '');
		var posY = bgPos[1].replace(rep[1], '');
		var bgpos = {x:posX,y:posY,xunit:rep[0],yunit:rep[1]};
		return bgpos;
		
  };
		
		
})(jQuery);


$(function () {
	// ページ移動のエフェクト
	jQuery.easing.quart = function (x, t, b, c, d) {
		return -c * ((t = t / d - 1) * t * t * t - 1) + b;
	};
	$('a[href^=#], area[href^=#]').not('a[href=#], area[href=#]').click(function () {
		if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
			var $target = $(this.hash);
			$target = $target.length && $target || $('[name=' + this.hash.slice(1) + ']');
			if ($target.length) {
				var targetOffset = $target.offset().top;
				$('html,body').animate({
					scrollTop: targetOffset
				}, 500, 'quart');
				return false;
			}
		}
	});
});
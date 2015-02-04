<?php header("Content-type: text/javascript");?>
/*
 * Superfish v1.4.8 - jQuery menu widget
 * Copyright (c) 2008 Joel Birch
 *
 * Dual licensed under the MIT and GPL licenses:
 * 	http://www.opensource.org/licenses/mit-license.php
 * 	http://www.gnu.org/licenses/gpl.html
 *
 * CHANGELOG: http://users.tpg.com.au/j_birch/plugins/superfish/changelog.txt
 */

(function(a){a.fn.superfish=function(c){var b=a.fn.superfish,h=b.c,n=a(['<span class="',h.arrowClass,'"> &#187;</span>'].join("")),i=function(){var d=a(this),e=j(d);clearTimeout(e.sfTimer);d.showSuperfishUl().siblings().hideSuperfishUl()},k=function(){var d=a(this),e=j(d),g=b.op;clearTimeout(e.sfTimer);e.sfTimer=setTimeout(function(){g.retainPath=a.inArray(d[0],g.$path)>-1;d.hideSuperfishUl();g.$path.length&&d.parents(["li.",g.hoverClass].join("")).length<1&&i.call(g.$path)},g.delay)},j=function(d){d=
d.parents(["ul.",h.menuClass,":first"].join(""))[0];b.op=b.o[d.serial];return d};return this.each(function(){var d=this.serial=b.o.length,e=a.extend({},b.defaults,c);e.$path=a("li."+e.pathClass,this).slice(0,e.pathLevels).each(function(){a(this).addClass([e.hoverClass,h.bcClass].join(" ")).filter("li:has(ul)").removeClass(e.pathClass)});b.o[d]=b.op=e;a("li:has(ul)",this)[a.fn.hoverIntent&&!e.disableHI?"hoverIntent":"hover"](i,k).each(function(){e.autoArrows&&a(">a:first-child",this).addClass(h.anchorClass).append(n.clone())}).not("."+
h.bcClass).hideSuperfishUl();var g=a("a",this);g.each(function(l){var m=g.eq(l).parents("li");g.eq(l).focus(function(){i.call(m)}).blur(function(){k.call(m)})});e.onInit.call(this)}).each(function(){menuClasses=[h.menuClass];b.op.dropShadows&&!(a.browser.msie&&a.browser.version<7)&&menuClasses.push(h.shadowClass);a(this).addClass(menuClasses.join(" "))})};var f=a.fn.superfish;f.o=[];f.op={};f.IE7fix=function(){var c=f.op;a.browser.msie&&a.browser.version>6&&c.dropShadows&&c.animation.opacity!=undefined&&
this.toggleClass(f.c.shadowClass+"-off")};f.c={bcClass:"sf-breadcrumb",menuClass:"sf-js-enabled",anchorClass:"sf-with-ul",arrowClass:"sf-sub-indicator",shadowClass:"sf-shadow"};f.defaults={hoverClass:"sfHover",pathClass:"overideThisToUse",pathLevels:1,delay:800,animation:{opacity:"show"},speed:"normal",autoArrows:true,dropShadows:true,disableHI:false,onInit:function(){},onBeforeShow:function(){},onShow:function(){},onHide:function(){}};a.fn.extend({hideSuperfishUl:function(){var c=f.op,b=c.retainPath===
true?c.$path:"";c.retainPath=false;b=a(["li.",c.hoverClass].join(""),this).add(this).not(b).removeClass(c.hoverClass).find(">ul").hide().css("visibility","hidden");c.onHide.call(b);return this},showSuperfishUl:function(){var c=f.op,b=this.addClass(c.hoverClass).find(">ul:hidden").css("visibility","visible");f.IE7fix.call(b);c.onBeforeShow.call(b);b.animate(c.animation,c.speed,function(){f.IE7fix.call(b);c.onShow.call(b)});return this}})})(jQuery);

/*
Albizia functions
*/
(function($) {
$(document).ready(function(){
    <?php if ( itx_get_option('misc','hover') == 0 ):?>
    $('a:not(.tabbed-a,#header a)').each(function(){
		var on=$('#on').css('color');
		var off=$(this).css('color');
		$(this).hover(
			function(){$(this).stop().css({'color':on})},
			function(){$(this).stop().animate({'color':off},500)}
		);
	});
    <?php endif;?>
    <?php if (itx_get_option('front','type')=='fl'):?>
        $('.linepost .bcats').samew();
    <?php endif;?>

	for(i=1;i<100;i++){$('.postwrap-'+i).sameh();}
    if($('#menu ul.sf-menu').width()<1) $('#menu .wrap2').width($('.wrap').width()-50);
    $('#menu').height($('#menu .wrap2').height());

    $('#navi .wp-pagenavi').addClass('ui-state-default ui-corner-all');
    $('.featured h3,.posts h3').hover(
        function(){$(this).addClass('ui-state-active')},
        function(){$(this).removeClass('ui-state-active')}
    );
    $('#comments #submit,#navi .wp-pagenavi a, #comments .wp-pagenavi a').hover(
        function(){$(this).addClass('ui-state-hover')},
        function(){$(this).removeClass('ui-state-hover')}
    );

    $('ul.sf-menu').superfish();
});
})(jQuery);

jQuery.fn.sameh = function() {
    var h=0;
    jQuery(this).each(function(){
            if(jQuery(this).height()>h){h=jQuery(this).height();}
        });
    jQuery(this).children('.postwrap').height(h-25);
};
jQuery.fn.samew = function() {
    var w=0;
    jQuery(this).each(function(){
            if(jQuery(this).width()>w){w=jQuery(this).width();}
        });
    jQuery(this).width(w);
};
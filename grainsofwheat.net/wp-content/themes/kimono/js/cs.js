var $jq = jQuery.noConflict()
	
$jq(document).ready(function() {
	jQuery('[placeholder]').ahPlaceholder({
		placeholderColor : 'silver',
		placeholderAttr : 'placeholder',
		likeApple : false
		});
	$jq('#secondary')
		.find('input.email').attr('placeholder','Your mail address').end()
		.find('textarea').attr('placeholder','comment');
	$jq('#inputtext')
		.find('#email').attr('placeholder','Your mail address');
	$jq('.contact-submit')
		.find('input[type="submit"]').val('Send'); 
	$jq('.form-submit')
		.find('input[type="submit"]').val('Send'); 
	var comment_height = parseInt($jq('#comments').find('.comment-list').outerHeight(true));
   var respond_height = parseInt($jq('#respond').outerHeight(true))+65;
   var setHeight = Math.max(comment_height,respond_height);
   var commentHeight = $jq('#comment-nav-above').height();
   if(commentHeight > 1){
   commentHeight = commentHeight + 56;
   }
   $jq('#comments').find('.comment-list').css('height',setHeight+'px');
   $jq('#respond').css('height',setHeight+65-commentHeight+'px'); 
});
$jq(window).load(function(){
   $jq(window).on('resize',function(){
       var docHeight = Math.max($jq('#page').outerHeight(true),$jq(window).height());
       $jq('#left, #right').css('height',docHeight+'px');
   }).resize();
}); 

$jq(function(){
    setInterval(function(){
        $jq(window).on('resize',function(){
       var docHeight = Math.max($jq('#page').outerHeight(true),$jq(window).height());
       $jq('#left, #right').css('height',docHeight+'px');
	 }).resize();
    },500);
});

// <![CDATA[
$jq(function() {
  $jq('.bxslider').bxSlider({
    auto:true,
    speed:1000,
    slideMargin:0
  });
});
// ]]>


  $jq(function(){
	$jq(".widget-title").click(function () {
		$jq(this).next("ul").stop(false,true).animate({height: "toggle"});
		$jq(this).next("div").stop(false,true).animate({height: "toggle"});
		});
});


$jq(document).ready(function(){
	$jq(window).on('resize',function(){
		var winWidth = parseInt($jq(this).width());
		var centerWidth = parseInt($jq('#page').width());
		if(winWidth<=centerWidth){
			$jq('#left, #right').hide();
		}else{
			var barWidth = winWidth-centerWidth;
			if(barWidth%2){
				$jq('#left').show().css('width',Math.ceil(barWidth/2)+'px');
				$jq('#right').show().css('width',Math.floor(barWidth/2)+'px');
			}else{
				$jq('#left, #right').show().css('width',barWidth/2+'px');
			}
		}
	}).resize();
});


var $jq = jQuery.noConflict()
$jq(document).ready(function(){
  $jq('.bxslider').bxSlider();
});

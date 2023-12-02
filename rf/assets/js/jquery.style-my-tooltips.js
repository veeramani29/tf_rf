//style-my-tootltips by malihu (http://manos.malihu.gr)
//plugin home http://manos.malihu.gr/style-my-tooltips-jquery-plugin
(function($){
	var methods={
		init:function(options){
			var defaults={ 
				tip_follows_cursor:false, //tooltip follows cursor: boolean
				tip_delay_time:700, //tooltip delay before displaying: milliseconds
				tip_fade_speed:300 //tooltip fade in/out speed: milliseconds
			};
			var options=$.extend(defaults,options);
			if($("#s-m-t-tooltip").length===0){
				$("body").append("<div id='s-m-t-tooltip'><div></div></div>");
			}
			var smtTooltip=$("#s-m-t-tooltip"); 
			smtTooltip.css({"position":"absolute","display":"none"}).data("smt-z-index",smtTooltip.css("z-index")).children("div").css({"width":"100%","height":"100%"});
			function smtGetCursorCoords(event){
				var smtCursorCoordsX=event.pageX;
				var smtCursorCoordsY=event.pageY;
				smtTooltip.style_my_tooltips("position",{
					smtCursorCoordsX:smtCursorCoordsX,
					smtCursorCoordsY:smtCursorCoordsY
				});
			}
			$("body").delegate(".smt-current-element","mouseout mousedown click",function(){
				var $this=$(this);
				clearTimeout(smtTooltip_delay);
				smtTooltip.style_my_tooltips("hide",{
					speed:$this.data("smt-fade-speed")
				});
				$(document).unbind("mousemove");
				$this.removeClass("smt-current-element");
				if($this.attr("title")===""){
					$this.attr("title",$this.data("smt-title"));
				}
			});
			return $("body")["delegate"](this.selector,"mouseover",function(event){
				var $this=$(this);
				var title=$this.attr("title");
				$this.addClass("smt-current-element").data({"smt-title":title,"smt-fade-speed":options.tip_fade_speed}).attr("title","");
				smtTooltip.style_my_tooltips("update",{
					title:title,
					speed:options.tip_fade_speed,
					delay:options.tip_delay_time,
					tip_follows_cursor:options.tip_follows_cursor
				});
				$(document).bind("mousemove", function(event){
					smtGetCursorCoords(event); 
				});
			});
		},
		update:function(options){
			var $this=$(this);
			$this.stop().css({"display":"none","z-index":$this.data("smt-z-index")}).children("div").text(options.title);
			smtTooltip_delay=setTimeout(function(){
				$this.style_my_tooltips("show",{
					speed:options.speed,
					tip_follows_cursor:options.tip_follows_cursor
				})
			}, options.delay);
		},
		show:function(options){
			var $this=$(this);
			$this.stop().fadeTo(options.speed,1);
			if(!options.tip_follows_cursor){
				$(document).unbind("mousemove");
			}
		},
		hide:function(options){
			var $this=$(this);
			$this.stop().fadeTo(options.speed,0,function(){
				$this.css({"z-index":"-1"});
			});
		},
		position:function(options){
			var $this=$(this);
			var winScrollX=$(window).scrollLeft();
			var winScrollY=$(window).scrollTop();
			var tipWidth=$this.outerWidth(true);
			var tipHeight=$this.outerHeight(true);
			var leftOffset=(options.smtCursorCoordsX+tipWidth)-winScrollX;
			var topOffset=(options.smtCursorCoordsY+tipHeight)-winScrollY;
			if(leftOffset<=$(window).width() && leftOffset<=$(document).width()){
				$this.css("left",options.smtCursorCoordsX);
			}else{
				var thePosX=options.smtCursorCoordsX-tipWidth;
				if(thePosX>=winScrollX){
					$this.css("left",thePosX);
				}else{
					$this.css("left",winScrollX);
				}
			}
			if(topOffset<=$(window).height() && topOffset<=$(document).height()){
				$this.css("top",options.smtCursorCoordsY);
			}else{
				var thePosY=options.smtCursorCoordsY-tipHeight;
				if(thePosY>=winScrollY){
					$this.css("top",thePosY);
				}else{
					$this.css("top",winScrollY);
				}
			}
		}
	}
	$.fn.style_my_tooltips=function(method){
		if(methods[method]){
			return methods[method].apply(this,Array.prototype.slice.call(arguments,1));
		}else if(typeof method==="object" || !method){
			return methods.init.apply(this,arguments);
		}else{
			$.error("Method "+method+" does not exist");
		}
	};
})(jQuery);  
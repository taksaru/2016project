function comSlider911021() { 
var self = this; 
var g_HostRoot = "";
var g_TransitionTimeoutRef = null;
var g_CycleTimeout = 5;
var g_currFrame = 0;
var g_fontLoadJsRetries = 0;
var g_currDate = new Date(); var g_currTime = g_currDate.getTime();var g_microID = g_currTime + '-' + Math.floor((Math.random()*1000)+1); 
var g_InTransition = 0;var g_Navigation = 0;this.getCurrMicroID = function() { return g_microID; } 
var g_kb = new Array();
var g_kbsupported = true;
var isOldIE = navigator.userAgent.indexOf('MSIE 6')>=0 || navigator.userAgent.indexOf('MSIE 7')>=0 || navigator.userAgent.indexOf('MSIE 8')>=0;if (isOldIE) {g_kbsupported = false;}    this.kenburns = function(options) {     
								if (!g_kbsupported)
									return null; 				
                                var ctx = jqCS911021("#"+options.name)[0].getContext('2d');
                                var thisobj = this;

                                var start_time = 0;
                                                            //var width = $thiscanvas.width();
                                                            //var height = $thiscanvas.height();	
                                                            var width = options.width;
                                                            var height = options.height;	


                                var image_path = options.image;		
                                var display_time = options.display_time || 7000;
                                var fade_time = options.fade_time || 0;
                                var fade_called = false;
                                var frames_per_second = options.frames_per_second || 30;		
                                var frame_time = (1 / frames_per_second) * 1000;
                                var zoom_level = 1 / (options.zoom || 2);
                                var clear_color = options.background_color || '#000000';	

                                var onstop = null;
                                var onloaded = null;
                                var onfade = null;

                                var timer_ref = null;
                                var images = [];
															
                                images.push({path:image_path,
                                                        initialized:false,
                                                        loaded:false});
                                function get_time() {
                                        var d = new Date();
                                        return d.getTime() - start_time;
                                }

                                function interpolate_point(x1, y1, x2, y2, i) {
                                        // Finds a point between two other points
                                        return  {x: x1 + (x2 - x1) * i,
                                                        y: y1 + (y2 - y1) * i}
                                }

                                function interpolate_rect(r1, r2, i) {
                                        // Blend one rect in to another
                                        var p1 = interpolate_point(r1[0], r1[1], r2[0], r2[1], i);
                                        var p2 = interpolate_point(r1[2], r1[3], r2[2], r2[3], i);
                                        return [p1.x, p1.y, p2.x, p2.y];
                                }

                                function scale_rect(r, scale) {
                                        // Scale a rect around its center
                                        var w = r[2] - r[0];
                                        var h = r[3] - r[1];
                                        var cx = (r[2] + r[0]) / 2;
                                        var cy = (r[3] + r[1]) / 2;
                                        var scalew = w * scale;
                                        var scaleh = h * scale;
                                        return [cx - scalew/2,
                                                        cy - scaleh/2,
                                                        cx + scalew/2,
                                                        cy + scaleh/2];		
                                }

                                function fit(src_w, src_h, dst_w, dst_h) {
                                        // Finds the best-fit rect so that the destination can be covered
                                        var src_a = src_w / src_h;
                                        var dst_a = dst_w / dst_h;			
                                        var w = src_h * dst_a;
                                        var h = src_h;						
                                        if (w > src_w)
                                        {
                                                var w = src_w;
                                                var h = src_w / dst_a;
                                        }						
                                        var x = (src_w - w) / 2;
                                        var y = (src_h - h) / 2;
                                        return [x, y, x+w, y+h]; 
                                }				

                                function get_image_info() {
                                        // Gets information structure for a given index
                                        // Also loads the image asynchronously, if required		
                                        var image_info = images[0];
                                        if (!image_info.initialized) {
                                                var image = new Image();
                                                image_info.image = image;
                                                image_info.loaded = false;
                                                image.onload = function(){
                                                        image_info.loaded = true;
                                                        var iw = image.width;
                                                        var ih = image.height;

                                                        var r1 = fit(iw, ih, width, height);;
                                                        var r2 = scale_rect(r1, zoom_level);

                                                        var align_x = Math.floor(Math.random() * 3) - 1;
                                                        var align_y = Math.floor(Math.random() * 3) - 1;
                                                        align_x /= 2;
                                                        align_y /= 2;

                                                        var x = r2[0];
                                                        r2[0] += x * align_x;
                                                        r2[2] += x * align_x; 

                                                        var y = r2[1];
                                                        r2[1] += y * align_y;
                                                        r2[3] += y * align_y;
											
												if (Math.floor((Math.random()*10)) % 2) {
														image_info.r1 = r1;
														image_info.r2 = r2;
												}
												else {
														image_info.r1 = r2;
														image_info.r2 = r1;
												}												
															       if (options.onloaded) {
                                                                options.onloaded(thisobj);
                                                        }					

                                                }				
                                                image_info.initialized = true;
                                                image.src = image_info.path;
                                        }
                                        return image_info;
                                }

                                function render_image(image_index, anim) {
                                        // Renders a frame of the effect	
                                        if (anim > 1) {
                                                return;
                                        } 									
                                        var image_info = get_image_info();
                                        if (image_info.loaded) {						
                                                var r = interpolate_rect(image_info.r1, image_info.r2, anim);

                                                ctx.save();
                                                ctx.globalAlpha = 1;
                                                ctx.drawImage(image_info.image, r[0], r[1], r[2] - r[0], r[3] - r[1], 0, 0, width, height);
                                                ctx.restore();

                                        }
                                }				

                                function clear() {
                                        // Clear the canvas
                                        ctx.save();
                                        ctx.globalAlpha = 1;
                                        ctx.fillStyle = clear_color;
                                        ctx.fillRect(0, 0, ctx.canvas.width, ctx.canvas.height);
                                        ctx.restore();
                                }


                                function update() {

                                        // Render the next frame										
                                        var time_passed = get_time();	

                                        render_image(0, time_passed / display_time/*, time_passed / fade_time*/);			

                                        if ((fade_time > 0) && (fade_called == false) && ((display_time - time_passed) <= fade_time))
                                        {
                                                if (options.onfade) {
                                                        options.onfade(thisobj, display_time - time_passed);	
                                                }					
                                                fade_called = true;					
                                        }

                                        if (time_passed >= display_time)
                                        {
                                                thisobj.stop();
                                                return;
                                        }
                                }

                                this.stop = function()
                                {
                                        if (timer_ref != null)
                                                clearInterval(timer_ref);
                                        timer_ref = null;
                                        //clear();
                                        images[0].initialized = null;			
                                        if (options.onstop) {
                                                options.onstop(thisobj);
                                        }
                                }

                                this.start = function()
                                {
                                        fade_called = false;		
                                        start_time = 0;
                                        start_time = get_time();	
                                        timer_ref = setInterval(update, frame_time);	
                                }

                                get_image_info();	
                                return this;	
                        }	
               this.setNavStyle = function(id, background, color, border, type)
{
 if (background == "")
 {
     jqCS911021("#comSNavigation911021_"+id).css("background", "none");
 }
 else if (background == "transparent")
 {
     jqCS911021("#comSNavigation911021_"+id).css("background", "transparent");
 }
 else
 {
     jqCS911021("#comSNavigation911021_"+id).css("background", "#"+background);
 }
 jqCS911021("#comSNavigation911021_"+id).css("color", "#"+color);
 if (background == "transparent") { jqCS911021("#comSNavigation911021_"+id).css("border", border+"px solid transparent"); } else if (background != "") { jqCS911021("#comSNavigation911021_"+id).css("border", border+"px solid #"+background); } else { jqCS911021("#comSNavigation911021_"+id).css("border", border+"px"); } 
 var margin = (-1)*border;
 jqCS911021("#comSNavigation911021_"+id).css("margin-top", margin+"px");
 jqCS911021("#comSNavigation911021_"+id).css("margin-left", margin+"px");
 if (type == 0)
 {
   jqCS911021("#comImgBullet911021_"+id).show();
   jqCS911021("#comImgBulletcurr911021_"+id).hide();
 }
 else
 {
   jqCS911021("#comImgBulletcurr911021_"+id).show();
   jqCS911021("#comImgBullet911021_"+id).hide();
 }
}
this.targetClearTimeouts = function()
{
 if (g_TransitionTimeoutRef != null)     { window.clearTimeout(g_TransitionTimeoutRef); g_TransitionTimeoutRef = null;}
}
this.getNextFrame = function()
{
 var ret = g_currFrame;
 ret++;
 if (ret == 5) {ret = 0;}
 return ret;
}
this.getPrevFrame = function()
{
 var ret = g_currFrame;
 ret--;
 if (ret < 0) {ret = (5-1);}
 return ret;
}
this.stopAll = function()
{
jqCS911021("#comSFrame911021_0").stop(true, true);
jqCS911021("#comSFrameSek911021_0").stop(true, true);
jqCS911021("#comSFrame911021_1").stop(true, true);
jqCS911021("#comSFrameSek911021_1").stop(true, true);
jqCS911021("#comSFrame911021_2").stop(true, true);
jqCS911021("#comSFrameSek911021_2").stop(true, true);
jqCS911021("#comSFrame911021_3").stop(true, true);
jqCS911021("#comSFrameSek911021_3").stop(true, true);
jqCS911021("#comSFrame911021_4").stop(true, true);
jqCS911021("#comSFrameSek911021_4").stop(true, true);
}
this.switchFrame = function()
{
     g_Navigation = 1;
     var currFrame=g_currFrame;
     g_currFrame = self.getNextFrame();
     self.switchFromToFrame(currFrame, g_currFrame);
}
 
this.switchFramePrev = function()
{
     g_Navigation = 0;
     var currFrame=g_currFrame;
     g_currFrame = self.getPrevFrame();
     self.switchFromToFrame(currFrame, g_currFrame);
}
 
this.switchToFrame = function(toFrame)
{
     if ((g_InTransition == 1) || (g_currFrame == toFrame))
     {
         if (g_currFrame == toFrame) { return false; }
         self.stopAll();
     }
     var currFrame=g_currFrame;
     g_currFrame=toFrame;
     if (currFrame < g_currFrame)
         g_Navigation = 0;
     else
         g_Navigation = 1;
     self.switchFromToFrame(currFrame, g_currFrame);
}
 
this.switchFromToFrame =  function(currFrame, toFrame)
{
     if (g_InTransition == 1)
     {
         self.stopAll();
     }
g_InTransition = 1;
self.startTransitionTimer();
if (g_kb.length > toFrame)
	g_kb[toFrame].start();
     jqCS911021("#comSFrameSek911021_"+currFrame+"").css("z-index", 1);
     jqCS911021("#comSFrameSek911021_"+toFrame+"").css("z-index", 2);
     jqCS911021("#comSFrameSek911021_"+toFrame+"").hide().fadeIn(2500, function() { 
if (g_microID !=objcomSlider911021.getCurrMicroID()){return false;};jqCS911021("#comSFrame911021_"+currFrame).hide(); g_InTransition = 0;
 } ); 
  self.setNavStyle(currFrame, 'transparent','000000',0, 0);  self.setNavStyle(toFrame, 'transparent','333333',0, 1);     jqCS911021("#comSFrame911021_"+toFrame).show(1, function(){  });
if (g_kb.length > currFrame)
	g_kb[currFrame].stop();
     
     
     
     
}
this.startTransitionTimer = function()
{
  self.targetClearTimeouts(); g_TransitionTimeoutRef = window.setTimeout(function() {objcomSlider911021.onTransitionTimeout(g_microID)}, g_CycleTimeout*1000);
}
this.onTransitionTimeout = function(microID)
{
   if (g_microID != microID) { return false; }
     self.switchFrame();
}
this.initFrame = function()
{
g_currFrame = 0;
self.startTransitionTimer();
if (g_kb.length)
    g_kb[0].start();
  jqCS911021("#comSFrame911021_"+g_currFrame).show(1, function(){if (g_microID !=objcomSlider911021.getCurrMicroID()){return false;};self.setNavStyle(g_currFrame, 'transparent','333333',0, 1);     });
  return true;
}

					this.scriptLoaded = function()
					{
				   jqCS911021 = jQuery911021.noConflict(false);jqCS911021("#comslider_in_point_911021").html('<div id="comSWrapper911021_" name="comSWrapper911021_" style="display: inline-block; text-align: center; border:0px; width:400px; height:300px; position: relative; top: 0px; left: 0px;"><div id="comSWrapper911021_" name="comSWrapper911021_" style="overflow:hidden;border:0px; width:400px; height:300px; "><div id="comSFrameWrapper911021_" name="comSFrameWrapper911021_" style="position: absolute; top: 0px; left: 0px;"><div id="comSFrame911021_0" name="comSFrame911021_0" style="position:absolute; top:0px; left:0px; width:400px; height:300px;"><div id="comSFrameSek911021_0" name="comSFrameSek911021_0" style="position:absolute; overflow:hidden; top:0px; left:0px; width:400px; height:300px;"><div id="comSImg911021_0" name="comSImg911021_0" style="position:absolute; overflow:hidden; top:0px; left:0px; width:400px; height:300px;"><canvas id="kenburns911021_0" width="400" height="300"></canvas></div><div id="comSHtml911021__bk0" name="comSHtml911021__bk0" style="background: #000000; position:absolute; overflow:hidden; top:240px; left:0px; width:400px; height:60px;"></div><script type="text/javascript"> jqCS911021("#comSHtml911021__bk0").fadeTo(0,0.5);</script><div id="comSHtml911021_0" name="comSHtml911021_0" style="padding:10px; background: transparent; position:absolute; overflow:hidden; top:240px; left:0px; width:400px; height:60px;"><p  style="color: #FDFEFC;"><span style="font-size:22px;">Events all over Ireland</span></p></div></div></div><div id="comSFrame911021_1" name="comSFrame911021_1" style="position:absolute; top:0px; left:0px; width:400px; height:300px;"><div id="comSFrameSek911021_1" name="comSFrameSek911021_1" style="position:absolute; overflow:hidden; top:0px; left:0px; width:400px; height:300px;"><div id="comSImg911021_1" name="comSImg911021_1" style="position:absolute; overflow:hidden; top:0px; left:0px; width:400px; height:300px;"><canvas id="kenburns911021_1" width="400" height="300"></canvas></div><div id="comSHtml911021__bk1" name="comSHtml911021__bk1" style="background: #000000; position:absolute; overflow:hidden; top:240px; left:0px; width:400px; height:60px;"></div><script type="text/javascript"> jqCS911021("#comSHtml911021__bk1").fadeTo(0,0.5);</script><div id="comSHtml911021_1" name="comSHtml911021_1" style="padding:10px; background: transparent; position:absolute; overflow:hidden; top:240px; left:0px; width:400px; height:60px;"><p  style="color: #FDFEFC;"><span style="font-size:22px;">Concerts, Competitions, Festivals</span></p></div></div></div><div id="comSFrame911021_2" name="comSFrame911021_2" style="position:absolute; top:0px; left:0px; width:400px; height:300px;"><div id="comSFrameSek911021_2" name="comSFrameSek911021_2" style="position:absolute; overflow:hidden; top:0px; left:0px; width:400px; height:300px;"><div id="comSImg911021_2" name="comSImg911021_2" style="position:absolute; overflow:hidden; top:0px; left:0px; width:400px; height:300px;"><canvas id="kenburns911021_2" width="400" height="300"></canvas></div><div id="comSHtml911021__bk2" name="comSHtml911021__bk2" style="background: #000000; position:absolute; overflow:hidden; top:240px; left:0px; width:400px; height:60px;"></div><script type="text/javascript"> jqCS911021("#comSHtml911021__bk2").fadeTo(0,0.5);</script><div id="comSHtml911021_2" name="comSHtml911021_2" style="padding:10px; background: transparent; position:absolute; overflow:hidden; top:240px; left:0px; width:400px; height:60px;"><p  style="color: #FDFEFC;"><span style="font-size:22px;">National & International Conferences</span></p></div></div></div><div id="comSFrame911021_3" name="comSFrame911021_3" style="position:absolute; top:0px; left:0px; width:400px; height:300px;"><div id="comSFrameSek911021_3" name="comSFrameSek911021_3" style="position:absolute; overflow:hidden; top:0px; left:0px; width:400px; height:300px;"><div id="comSImg911021_3" name="comSImg911021_3" style="position:absolute; overflow:hidden; top:0px; left:0px; width:400px; height:300px;"><canvas id="kenburns911021_3" width="400" height="300"></canvas></div><div id="comSHtml911021__bk3" name="comSHtml911021__bk3" style="background: #000000; position:absolute; overflow:hidden; top:240px; left:0px; width:400px; height:60px;"></div><script type="text/javascript"> jqCS911021("#comSHtml911021__bk3").fadeTo(0,0.5);</script><div id="comSHtml911021_3" name="comSHtml911021_3" style="padding:10px; background: transparent; position:absolute; overflow:hidden; top:240px; left:0px; width:400px; height:60px;"><p  style="color: #FDFEFC;"><span style="font-size:22px;">Plan Travel and How to Get There</span></p></div></div></div><div id="comSFrame911021_4" name="comSFrame911021_4" style="position:absolute; top:0px; left:0px; width:400px; height:300px;"><div id="comSFrameSek911021_4" name="comSFrameSek911021_4" style="position:absolute; overflow:hidden; top:0px; left:0px; width:400px; height:300px;"><div id="comSImg911021_4" name="comSImg911021_4" style="position:absolute; overflow:hidden; top:0px; left:0px; width:400px; height:300px;"><canvas id="kenburns911021_4" width="400" height="300"></canvas></div><div id="comSHtml911021__bk4" name="comSHtml911021__bk4" style="background: #000000; position:absolute; overflow:hidden; top:240px; left:0px; width:400px; height:60px;"></div><script type="text/javascript"> jqCS911021("#comSHtml911021__bk4").fadeTo(0,0.5);</script><div id="comSHtml911021_4" name="comSHtml911021_4" style="padding:10px; background: transparent; position:absolute; overflow:hidden; top:240px; left:0px; width:400px; height:60px;"><p  style="color: #FDFEFC;"><span style="font-size:22px;">Book Hotels and Where to Stay</span></p></div></div></div></div><a name="0" style="cursor:pointer; text-decoration:none !important; font-size:12px;" href=""><div id="comSNavigation911021_0" name="comSNavigation911021_0" style="border-radius: 32px; margin-left:0px; margin-top:0px; border: 0px solid transparent; position:absolute; height:16px; width:16px; top:5px; left:150px; z-index: 5; text-align: center; vertical-align:bottom;  color: #000000;background: transparent; "><div id="height_workaround" style="font-size:1px;line-height:0;height:16px;">&nbsp;<img style="position: absolute; top: 0px; left: 0px; border:0px;" id="comImgBullet911021_0" name="comImgBullet911021_0" src="comslider911021/imgnav/nav2.png?timstamp=1455219591" /><img style="display: none; position: absolute; position: absolute; top: 0px; left: 0px; border:0px;" id="comImgBulletcurr911021_0" name="comImgBulletcurr911021_0" src="comslider911021/imgnav/navs2.png?timstamp=1455219591" /></div></div></a><script type="text/javascript"> jqCS911021("#comSNavigation911021_0").fadeTo(0,0.7);</script><a name="1" style="cursor:pointer; text-decoration:none !important; font-size:12px;" href=""><div id="comSNavigation911021_1" name="comSNavigation911021_1" style="border-radius: 32px; margin-left:0px; margin-top:0px; border: 0px solid transparent; position:absolute; height:16px; width:16px; top:5px; left:171px; z-index: 5; text-align: center; vertical-align:bottom;  color: #000000;background: transparent; "><div id="height_workaround" style="font-size:1px;line-height:0;height:16px;">&nbsp;<img style="position: absolute; top: 0px; left: 0px; border:0px;" id="comImgBullet911021_1" name="comImgBullet911021_1" src="comslider911021/imgnav/nav2.png?timstamp=1455219591" /><img style="display: none; position: absolute; position: absolute; top: 0px; left: 0px; border:0px;" id="comImgBulletcurr911021_1" name="comImgBulletcurr911021_1" src="comslider911021/imgnav/navs2.png?timstamp=1455219591" /></div></div></a><script type="text/javascript"> jqCS911021("#comSNavigation911021_1").fadeTo(0,0.7);</script><a name="2" style="cursor:pointer; text-decoration:none !important; font-size:12px;" href=""><div id="comSNavigation911021_2" name="comSNavigation911021_2" style="border-radius: 32px; margin-left:0px; margin-top:0px; border: 0px solid transparent; position:absolute; height:16px; width:16px; top:5px; left:192px; z-index: 5; text-align: center; vertical-align:bottom;  color: #000000;background: transparent; "><div id="height_workaround" style="font-size:1px;line-height:0;height:16px;">&nbsp;<img style="position: absolute; top: 0px; left: 0px; border:0px;" id="comImgBullet911021_2" name="comImgBullet911021_2" src="comslider911021/imgnav/nav2.png?timstamp=1455219591" /><img style="display: none; position: absolute; position: absolute; top: 0px; left: 0px; border:0px;" id="comImgBulletcurr911021_2" name="comImgBulletcurr911021_2" src="comslider911021/imgnav/navs2.png?timstamp=1455219591" /></div></div></a><script type="text/javascript"> jqCS911021("#comSNavigation911021_2").fadeTo(0,0.7);</script><a name="3" style="cursor:pointer; text-decoration:none !important; font-size:12px;" href=""><div id="comSNavigation911021_3" name="comSNavigation911021_3" style="border-radius: 32px; margin-left:0px; margin-top:0px; border: 0px solid transparent; position:absolute; height:16px; width:16px; top:5px; left:213px; z-index: 5; text-align: center; vertical-align:bottom;  color: #000000;background: transparent; "><div id="height_workaround" style="font-size:1px;line-height:0;height:16px;">&nbsp;<img style="position: absolute; top: 0px; left: 0px; border:0px;" id="comImgBullet911021_3" name="comImgBullet911021_3" src="comslider911021/imgnav/nav2.png?timstamp=1455219591" /><img style="display: none; position: absolute; position: absolute; top: 0px; left: 0px; border:0px;" id="comImgBulletcurr911021_3" name="comImgBulletcurr911021_3" src="comslider911021/imgnav/navs2.png?timstamp=1455219591" /></div></div></a><script type="text/javascript"> jqCS911021("#comSNavigation911021_3").fadeTo(0,0.7);</script><a name="4" style="cursor:pointer; text-decoration:none !important; font-size:12px;" href=""><div id="comSNavigation911021_4" name="comSNavigation911021_4" style="border-radius: 32px; margin-left:0px; margin-top:0px; border: 0px solid transparent; position:absolute; height:16px; width:16px; top:5px; left:234px; z-index: 5; text-align: center; vertical-align:bottom;  color: #000000;background: transparent; "><div id="height_workaround" style="font-size:1px;line-height:0;height:16px;">&nbsp;<img style="position: absolute; top: 0px; left: 0px; border:0px;" id="comImgBullet911021_4" name="comImgBullet911021_4" src="comslider911021/imgnav/nav2.png?timstamp=1455219591" /><img style="display: none; position: absolute; position: absolute; top: 0px; left: 0px; border:0px;" id="comImgBulletcurr911021_4" name="comImgBulletcurr911021_4" src="comslider911021/imgnav/navs2.png?timstamp=1455219591" /></div></div></a><script type="text/javascript"> jqCS911021("#comSNavigation911021_4").fadeTo(0,0.7);</script></div><div id="comSNavigationControl911021__back" name="comSNavigationControl911021__back" style=" cursor: pointer; margin: 0px; margin-left:0px; border: 0px; position:absolute; height:32px; width:32px; top:134px; left:0px; z-index: 6; text-align: center; vertical-align:bottom;  background-color: #000000; "><img class="def" style="position: absolute; top: 0px; left: 0px; border: 0px;" src="comslider911021/imgnavctl/defback.png?1455219535" /><img class="hover" style="position: absolute; top: 0px; left: 0px; display:none; border: 0px;" src="comslider911021/imgnavctl/defbackhover.png?1455219535" /></div><script type="text/javascript"> jqCS911021("#comSNavigationControl911021__back").bind(\'mouseenter\', function() {  jqCS911021(this).css(\'background-color\', \'#111111\'); jqCS911021("#comSNavigationControl911021__back img.hover").show(); jqCS911021("#comSNavigationControl911021__back img.def").hide(); });</script><script type="text/javascript"> jqCS911021("#comSNavigationControl911021__back").bind(\'mouseleave\', function() {  jqCS911021(this).css(\'background-color\', \'#000000\'); jqCS911021("#comSNavigationControl911021__back img.def").show();  jqCS911021("#comSNavigationControl911021__back img.hover").hide(); });</script><script type="text/javascript"> jqCS911021("#comSNavigationControl911021__back").bind(\'click\', function() { objcomSlider911021.switchFramePrev(); });</script><div id="comSNavigationControl911021__forward" name="comSNavigationControl911021__forward" style=" cursor: pointer; margin: 0px; margin-left:0px; border: 0px; position:absolute; height:32px; width:32px; top:134px; left:368px; z-index: 6; text-align: center; vertical-align:bottom; background-color: #000000; "><img class="def" style="position: absolute; top: 0px; left: 0px; border: 0px;" src="comslider911021/imgnavctl/defforward.png?1455219535" /><img class="hover" style="position: absolute; top: 0px; left: 0px; display:none; border: 0px;" src="comslider911021/imgnavctl/defforwardhover.png?1455219535" /></div><script type="text/javascript"> jqCS911021("#comSNavigationControl911021__forward").bind(\'mouseenter\', function() {  jqCS911021(this).css(\'background-color\', \'#111111\'); jqCS911021("#comSNavigationControl911021__forward img.hover").show(); jqCS911021("#comSNavigationControl911021__forward img.def").hide(); });</script><script type="text/javascript"> jqCS911021("#comSNavigationControl911021__forward").bind(\'mouseleave\', function() {  jqCS911021(this).css(\'background-color\', \'#000000\'); jqCS911021("#comSNavigationControl911021__forward img.def").show();  jqCS911021("#comSNavigationControl911021__forward img.hover").hide(); });</script><script type="text/javascript"> jqCS911021("#comSNavigationControl911021__forward").bind(\'click\', function() { objcomSlider911021.switchFrame(); });</script><script type="text/javascript"> jqCS911021("#comSNavigationControl911021__back").fadeTo(0,0.7);</script><script type="text/javascript"> jqCS911021("#comSNavigationControl911021__forward").fadeTo(0,0.7);</script></div>');
                    jqCS911021("#comslider_in_point_911021 a").bind('click',  function() { if ((this.name.length > 0) && (isNaN(this.name) == false)) {  self.switchToFrame(parseInt(this.name)); return false;} });
                
				
						if (g_kbsupported == true)						
						{				
							g_kb[0] = new self.kenburns({
									name: 'kenburns911021_0',
									width: 400,
									height: 300,
image:'comslider911021/img/160211193539108.jpg?1455219535',
     frames_per_second: 30,
									display_time: 5000, 
									fade_time: 0,
									zoom: 1.5,
									background_color:'#ffffff',
									onstop:function(kenburnsobj) { },
									onloaded:function(kenburnsobj) { },
									onfade:function(kenburnsobj, timeleft) { }
							});						
						}
						else
						{
							jqCS911021("#comSImg911021_0").html('<img src="http://commondatastorage.googleapis.com/comslider/target/users/1455217286x5280901be14abb6a9a8c4314ad682fec/img/160211193539108.jpg?1455219535"/>');						
						}

				
						if (g_kbsupported == true)						
						{				
							g_kb[1] = new self.kenburns({
									name: 'kenburns911021_1',
									width: 400,
									height: 300,
image:'comslider911021/img/160211193539109.jpg?1455219535',
     frames_per_second: 30,
									display_time: 5000, 
									fade_time: 0,
									zoom: 1.5,
									background_color:'#ffffff',
									onstop:function(kenburnsobj) { },
									onloaded:function(kenburnsobj) { },
									onfade:function(kenburnsobj, timeleft) { }
							});						
						}
						else
						{
							jqCS911021("#comSImg911021_1").html('<img src="http://commondatastorage.googleapis.com/comslider/target/users/1455217286x5280901be14abb6a9a8c4314ad682fec/img/160211193539109.jpg?1455219535"/>');						
						}
jqCS911021("#comSFrame911021_1").hide();

				
						if (g_kbsupported == true)						
						{				
							g_kb[2] = new self.kenburns({
									name: 'kenburns911021_2',
									width: 400,
									height: 300,
image:'comslider911021/img/160211193539110.jpg?1455219535',
     frames_per_second: 30,
									display_time: 5000, 
									fade_time: 0,
									zoom: 1.5,
									background_color:'#ffffff',
									onstop:function(kenburnsobj) { },
									onloaded:function(kenburnsobj) { },
									onfade:function(kenburnsobj, timeleft) { }
							});						
						}
						else
						{
							jqCS911021("#comSImg911021_2").html('<img src="http://commondatastorage.googleapis.com/comslider/target/users/1455217286x5280901be14abb6a9a8c4314ad682fec/img/160211193539110.jpg?1455219535"/>');						
						}
jqCS911021("#comSFrame911021_2").hide();

				
						if (g_kbsupported == true)						
						{				
							g_kb[3] = new self.kenburns({
									name: 'kenburns911021_3',
									width: 400,
									height: 300,
image:'comslider911021/img/160211193539111.jpg?1455219535',
     frames_per_second: 30,
									display_time: 5000, 
									fade_time: 0,
									zoom: 1.5,
									background_color:'#ffffff',
									onstop:function(kenburnsobj) { },
									onloaded:function(kenburnsobj) { },
									onfade:function(kenburnsobj, timeleft) { }
							});						
						}
						else
						{
							jqCS911021("#comSImg911021_3").html('<img src="http://commondatastorage.googleapis.com/comslider/target/users/1455217286x5280901be14abb6a9a8c4314ad682fec/img/160211193539111.jpg?1455219535"/>');						
						}
jqCS911021("#comSFrame911021_3").hide();

				
						if (g_kbsupported == true)						
						{				
							g_kb[4] = new self.kenburns({
									name: 'kenburns911021_4',
									width: 400,
									height: 300,
image:'comslider911021/img/160211193539112.jpg?1455219535',
     frames_per_second: 30,
									display_time: 5000, 
									fade_time: 0,
									zoom: 1.5,
									background_color:'#ffffff',
									onstop:function(kenburnsobj) { },
									onloaded:function(kenburnsobj) { },
									onfade:function(kenburnsobj, timeleft) { }
							});						
						}
						else
						{
							jqCS911021("#comSImg911021_4").html('<img src="http://commondatastorage.googleapis.com/comslider/target/users/1455217286x5280901be14abb6a9a8c4314ad682fec/img/160211193539112.jpg?1455219535"/>');						
						}
jqCS911021("#comSFrame911021_4").hide();
self.initFrame();

}
var g_CSIncludes = new Array();
var g_CSLoading = false;
var g_CSCurrIdx = 0; 
 this.include = function(src, last) 
                {
                    if (src != '')
                    {				
                            var tmpInclude = Array();
                            tmpInclude[0] = src;
                            tmpInclude[1] = last;					
                            //
                            g_CSIncludes[g_CSIncludes.length] = tmpInclude;
                    }            
                    if ((g_CSLoading == false) && (g_CSCurrIdx < g_CSIncludes.length))
                    {


                            var oScript = null;
                            if (g_CSIncludes[g_CSCurrIdx][0].split('.').pop() == 'css')
                            {
                                oScript = document.createElement('link');
                                oScript.href = g_CSIncludes[g_CSCurrIdx][0];
                                oScript.type = 'text/css';
                                oScript.rel = 'stylesheet';

                                oScript.onloadDone = true; 
                                g_CSLoading = false;
                                g_CSCurrIdx++;								
                                if (g_CSIncludes[g_CSCurrIdx-1][1] == true) 
                                        self.scriptLoaded(); 
                                else
                                        self.include('', false);
                            }
                            else
                            {
                                oScript = document.createElement('script');
                                oScript.src = g_CSIncludes[g_CSCurrIdx][0];
                                oScript.type = 'text/javascript';

                                //oScript.onload = scriptLoaded;
                                oScript.onload = function() 
                                { 
                                        if ( ! oScript.onloadDone ) 
                                        {
                                                oScript.onloadDone = true; 
                                                g_CSLoading = false;
                                                g_CSCurrIdx++;								
                                                if (g_CSIncludes[g_CSCurrIdx-1][1] == true) 
                                                        self.scriptLoaded(); 
                                                else
                                                        self.include('', false);
                                        }
                                };
                                oScript.onreadystatechange = function() 
                                { 
                                        if ( ( "loaded" === oScript.readyState || "complete" === oScript.readyState ) && ! oScript.onloadDone ) 
                                        {
                                                oScript.onloadDone = true;
                                                g_CSLoading = false;	
                                                g_CSCurrIdx++;
                                                if (g_CSIncludes[g_CSCurrIdx-1][1] == true) 
                                                        self.scriptLoaded(); 
                                                else
                                                        self.include('', false);
                                        }
                                }
                                
                            }
                            //
                            document.getElementsByTagName("head").item(0).appendChild(oScript);
                            //
                            g_CSLoading = true;
                    }

                }
                

}
objcomSlider911021 = new comSlider911021();
objcomSlider911021.include('comslider911021/js/helpers.js', false);
objcomSlider911021.include('comslider911021/js/jquery-1.10.1.js', false);
objcomSlider911021.include('comslider911021/js/jquery-ui-1.10.3.effects.js', true);

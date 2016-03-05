/*
* @package component cubegallery for Joomla! 3.x
 * @version $Id: com_cubegallery 1.0.0 2016-1-20 23:26:33Z $
 * @author Kian William Nowrouzian
 * @copyright (C) 2015- Kian William Nowrouzian
 * @license GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 
 This file is part of cubegallery.
    cubegallery is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.
    cubegallery is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.
    You should have received a copy of the GNU General Public License
    along with cubegallery.  If not, see <http://www.gnu.org/licenses/>.
*/

(function($){
	
	function checkFields()
   {
	  
	if($('#dim0').val()=="" )
	{
		alert("X axis could not be empty ");
		return false;
	}
	else
		if($('#dim1').val()=="")
		{
			alert("Y axis could not be empty");
	       return false;
		}
		else
		if($('#dim2').val()=="")
		{
			alert("Z axis could not be empty");
	       return false;
		}
		else
		if($('#dim3').val()=="")
		{
			alert("Angle could not be empty");
	       return false;
		}
		else
			if(!$.isNumeric($('#dim0').val()))
			{
				alert('X axis must be numeric');
				return false;				
			}
			else
			if(!$.isNumeric($('#dim1').val() ))
			{
				alert('Y axis must be numeric');
				return false;				
			}
			else
			if(!$.isNumeric($('#dim2').val()))
			{
				alert('Z axis must be numeric');
				return false;				
			}
			else
			if(!$.isNumeric($('#dim3').val()))
			{
				alert('Angle must be numberic, usually 0 to 356 degrees!');
				return false;				
			}
				
				
			
			
	return true;
    }
	
	
	$.fn.cubic = function(options)
	{
		return this.each(function(){
			
			var $container, $options;
			$container = $(this);
			$options = $.extend({}, $.fn.cubic.defaults, options);
			var myobj = new Robik($container, $options);
			
		})
	}
	
	
	
	function Robik($container, $options)
	{
		var myobj = this;
		
		var arrayRotates= ["rotateX(   90deg ) translateZ( "+$options.height/2+"px )", "rotateX(  -90deg ) translateZ( "+$options.height/2+"px )"];
		var arrayRotatesb= ["rotateY(   90deg ) translateZ( "+$options.width/2+"px )", "rotateY(  -90deg ) translateZ( "+$options.width/2+"px )"];
	
		
		var arrayTranslates =["translateZ("+$options.width/2+"px )","rotateX( -180deg ) translateZ( "+$options.width/2+"px )"];
		$container.css({position:'relative',marginTop:'10px', marginLeft:'auto', marginRight:'auto', backgroundColor:$options.backgroundColor,  perspective:'1200px', mozPerspective:'1200px', webkitPerspective:'1200px', oPerspective:'1200px', width:$options.width+'px', height:'auto'})
		$('<div id="cubicContainer"></div>').css({transition:'all 1s ease', position:'absolute', left:0, top:0, display:'block', width:$options.width+'px', height:$options.height+'px',  transformStyle:'preserve-3d', webkitTransformStyle:'preserve-3d', mozTransformStyle:'preserve-3d', oTransformStyle:'preserve-3d' , animationFillMode:'both', webkitAnimationFillMode:'both', mozAnimationFillMode:'both' }).appendTo($container);
		
		for(var i=0; i<6; i++)
		{
			$('<div id="surface'+i+'"></div>').css({position:'absolute', left:0, top:0, width:$options.width+'px', height:$options.height+'px', backfaceVisibility:'hidden'}).appendTo($container.children('div'));
			$('<img src="'+$options.images[i]+'"/>').css({position:'absolute', width:$options.width+'px', height:$options.height+'px', display:'block', border:'2px solid '+$options.borderColor}).appendTo($container.children('div').children('div').eq(i))
		}
		var pad = parseInt($options.height) + 50;
		$('<form name="myform" id="myform"></from>').css({ display:'block', paddingTop:pad+'px', paddingLeft:'10px', paddingRight:'10px',paddingBottom:'10px', backgroundColor:$options.backgroundColor}).appendTo($container);
		var dims = ['X:  ', 'Y:  ', 'Z:  ','D:  '];
		$('<div>Input integer values for x-axis, y-axis & z-axis (e.g 1 or 2 or 3 ...), also degree (e.g 1 to 360 or more):</div>').css({fontSize:$options.fontSize+'px', fontFamily:$options.fontFamily, fontStyle:$options.fontStyle, fontWeight:$options.fontWeight, color:$options.fontColor}).appendTo('#myform');
		for(var l=0; l<4; l++)
		{
			$('#myform').append('<span style="margin-top:1px; font-size:'+$options.fontSize+'px; font-style:'+$options.fontStyle+'; font-weight:'+$options.fontWeight+'; color:'+$options.fontColor+'; font-family:'+$options.fontFamily+'; ">'+dims[l]+'</span>');
			$('<input type="text" name="dim'+l+'" id="dim'+l+'" value="" />').css({width:$options.txtWidth+'px', marginTop:'1px',marginLeft:'3px', backgroundColor:$options.bgColor, color:$options.fontColor, fontSize:$options.fontSize+'px'}).appendTo('#myform');
			$('<br />').appendTo('#myform');
		}
		$('#dim2').css({marginLeft:'5px'})
		for(l=0; l<4; l++)
		{
			
			$('#dim'+l).click( function(){
				$(this).val("");
			})
		}
		
			$('<input type="button" value="start" name="butt" id="butt"/>').css({marginTop:'1px', backgroundColor:$options.bgColor, color:$options.fontColor, fontSize:$options.fontSize+'px'}).appendTo('#myform');
		
		$('#myform #butt').click(function(){
			if(checkFields())
			{
			     myobj.rotate();
				 $(this).hide();
			}
		    else
			{
				 $(this).show();
			}
		});
				
		for(i=0; i<2; i++)
		{
			$container.children('div').children('div').eq(i).css({transform:arrayTranslates[i], webkitTransfrom:arrayTranslates[i], msTransfrom:arrayTranslates[i]});
		}
		for(i=2; i<4; i++)
		{
				$container.children('div').children('div').eq(i).css({transform:arrayRotates[i-2], webkitTransform:arrayRotates[i-2], msTransfrom:arrayRotates[i-2]});
	
		}
		
		for(i=4; i<=5; i++)
		{
			   $container.children('div').children('div').eq(i).css({transform:arrayRotatesb[i-4], webkitTransform:arrayRotatesb[i-4], msTransfrom:arrayRotatesb[i-4]});
		}
		
        var x=0;
		var y=0;
		var z=0;
		var t=0;
		this.rotate = function()
		{
	
		  $({deg:x}).animate({deg:$('#dim3').val()}, { duration:parseInt($options.moveTime), step:function(n){$container.children('div').css({
		      transform:'rotate3d('+parseInt($('#dim0').val())+','+parseInt($('#dim1').val())+','+parseInt($('#dim2').val())+','+n+'deg) ', webkitTransform:'rotate3d('+parseInt($('#dim0').val())+','+parseInt($('#dim1').val())+','+parseInt($('#dim2').val())+','+n+'deg) ',mozTransform:'rotate3d('+parseInt($('#dim0').val())+','+parseInt($('#dim1').val())+','+parseInt($('#dim2').val())+','+n+'deg)', msTransform:'rotate3d('+parseInt($('#dim0').val())+','+parseInt($('#dim1').val())+','+parseInt($('#dim2').val())+','+n+'deg)'})},
			  complete:function()
		    {				
				x = $('#dim3').val();
				y = $('#dim0').val();
				z = $('#dim1').val();
				t = $('#dim2').val();
					$container.children('div').css({transform:'rotate3d('+y+','+z+','+t+','+x+'deg)', webkitTransform:'rotate3d('+y+','+z+','+t+','+x+'deg)',mozTransform:'rotate3d('+y+','+z+','+t+','+x+'deg)', msTransform:'rotate3d('+y+','+z+','+t+','+x+'deg)'});
			
				$container.children('div').css({ animationFillMode:'both', webkitAnimationFillMode:'both', mozAnimationFillMode:'both'})
				$('#myform #butt').show();
			}
			 });
				
				
		
		}
		
		
	}
	
	
	
}(jQuery))



<?php
/**
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
 
**/

?>
<?php
defined('_JEXEC') or die;
  JHtml::_('jquery.framework');
  $document = &JFactory::getDocument();
  $document->addStyleSheet(JURI::Base()."components/com_cubegallery/assets/css/cubegallery.css");
  if($params->get('lib')==1)
  {
     $document->addScript(JURI::Base()."components/com_cubegallery/assets/js/jquery.js");
  }
    $document->addScript(JURI::Base()."components/com_cubegallery/assets/js/robique.js");
	  $noConflictb = "var cgg = jQuery.noConflict()";
      $document->addScriptDeclaration($noConflictb);
	  for($i=1; $i<7; $i++)
	  {
		  $myimagesb[] = JURI::Base().$itemmod->params->get('cubeimage'.$i);
		  $mytextsb[] = $itemmod->params->get('cubeimgtxt'.$i);
	  }
	  switch($itemmod->params->get("font_style"))
	  {
		  case 0:
			$cubefamilyb = 'normal';
			$cubestyleb='normal';
			break;
		  case 1:
			$cubefamilyb = 'bold';
			$cubestyleb='normal';
			break;
		  case 2:
		  	$cubefamilyb = 'normal';
			$cubestyleb='italic';
			break;
		  case 3:
			$cubefamilyb = 'bold';
			$cubestyleb='italic';
			break;
	  }
	  $mycubegalleryb = "
		cgg(document).ready(function(){
			
			cgg('.mcubegallery').cubic({width:'".$itemmod->params->get("cube_width")."', height:'".$itemmod->params->get("cube_height")."', 
			backgroundColor:'".$itemmod->params->get("backgroundcolorgallery")."', borderColor:'".$itemmod->params->get("bordercolortext")."', 
			txtWidth:'".$itemmod->params->get("text_width")."', fontSize:'".$itemmod->params->get("font_size")."', 
			fontStyle:'".$cubestyleb."', fontWeight:'".$cubefamilyb."', fontFamily:'".$itemmod->params->get("font_family")."',
			fontColor:'".$itemmod->params->get("font_color")."', bgColor:'".$itemmod->params->get("backgroundcolortext")."', 
			moveTime:'".$itemmod->params->get("cube_move_time")."'});
			
		});
		
		cgg.fn.cubic.defaults = {};
		cgg.fn.cubic.defaults.images = [];
		cgg.fn.cubic.defaults.texts = [];
		var siximagesb =".json_encode($myimagesb).";
		var sixtextsb =".json_encode($mytextsb).";
		for(var k=0; k<siximagesb.length; k++)
		{
			cgg.fn.cubic.defaults.images[k] = siximagesb[k];
			cgg.fn.cubic.defaults.texts[k] = sixtextsb[k];
		}
		
	  ";
	  $document->addScriptDeclaration($mycubegalleryb);
	  $imagesizeb = "
		#mycubegallery #cubeContainer div img
		{
			width: ".$itemmod->params->get("cube_width")."px;
			height:".$itemmod->params->get("cube_height")."px;
		}
	  ";
	  $document->addStyleDeclaration($imagesizeb);
?>

         <div  class="mcubegallery">
         </div>

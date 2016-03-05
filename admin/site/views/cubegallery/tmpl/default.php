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
  if($this->item->params->get('lib')==1)
  {
     $document->addScript(JURI::Base()."components/com_cubegallery/assets/js/jquery.js");
  }
    $document->addScript(JURI::Base()."components/com_cubegallery/assets/js/robique.js");
	  $noConflict = "var cg = jQuery.noConflict()";
      $document->addScriptDeclaration($noConflict);
	  for($i=1; $i<7; $i++)
	  {
		  $myimages[] = JURI::Base().$this->item->params->get('cubeimage'.$i);
		  $mytexts[] = $this->item->params->get('cubeimgtxt'.$i);
	  }
	  switch($this->item->params->get("font_style"))
	  {
		  case 0:
			$cubefamily = 'normal';
			$cubestyle='normal';
			break;
		  case 1:
			$cubefamily = 'bold';
			$cubestyle='normal';
			break;
		  case 2:
		  	$cubefamily = 'normal';
			$cubestyle='italic';
			break;
		  case 3:
			$cubefamily = 'bold';
			$cubestyle='italic';
			break;
	  }
	  $mycubegallery = "
		cg(document).ready(function(){
			
			cg('#mycubegallery').cubic({width:'".$this->item->params->get("cube_width")."', height:'".$this->item->params->get("cube_height")."', 
			backgroundColor:'".$this->item->params->get("backgroundcolorgallery")."', borderColor:'".$this->item->params->get("bordercolortext")."', 
			txtWidth:'".$this->item->params->get("text_width")."', fontSize:'".$this->item->params->get("font_size")."', 
			fontStyle:'".$cubestyle."', fontWeight:'".$cubefamily."', fontFamily:'".$this->item->params->get("font_family")."',
			fontColor:'".$this->item->params->get("font_color")."', bgColor:'".$this->item->params->get("backgroundcolortext")."', 
			moveTime:'".$this->item->params->get("cube_move_time")."'});
			
		});
		
		cg.fn.cubic.defaults = {};
		cg.fn.cubic.defaults.images = [];
		cg.fn.cubic.defaults.texts = [];
		var siximages =".json_encode($myimages).";
		var sixtexts =".json_encode($mytexts).";
		for(var i=0; i<siximages.length; i++)
		{
			cg.fn.cubic.defaults.images[i] = siximages[i];
			cg.fn.cubic.defaults.texts[i] = sixtexts[i];
		}
		
	  ";
	  $document->addScriptDeclaration($mycubegallery);
	  $imagesize = "
		#mycubegallery #cubeContainer div img
		{
			width: ".$this->item->params->get("cube_width")."px;
			height:".$this->item->params->get("cube_height")."px;
		}
	  ";
	  $document->addStyleDeclaration($imagesize);
?>

 <div class="gallery<?php echo $this->pageclass_sfx?>">

	<div class="gallery<?php echo $this->pageclass_sfx?>">
         <?php if ($this->params->get('show_page_heading', 1)) : ?>
             <h1>
	             <?php echo $this->escape($this->params->get('page_heading')); ?>
             </h1>
         <?php endif; ?>
		 
	     <?php if ($this->item->title) : ?>
		    <h2>
			     <span class="gallery-name"><?php echo $this->item->title; ?></span>
		    </h2>
	     <?php endif;  ?>

         <div id="mycubegallery" class="cubegallery<?php echo $this->pageclass_sfx?>">
         </div>
    </div>

</div>
        
    

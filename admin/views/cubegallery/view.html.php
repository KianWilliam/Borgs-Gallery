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
jimport('joomla.application.component.view');

class CubegalleryViewCubegallery extends JViewLegacy
{
	protected $state;
	protected $item;
	protected $form;
	protected $isNew = true;
	
	public function display($tpl = null)
	{
		$this->state	= $this->get('State');
		$this->item		= $this->get('Item');
		$this->form		= $this->get('Form');
		$this->isNew	= ($this->item->id == 0);
		
		if (count($errors = $this->get('Errors'))) {
			JError::raiseError(500, implode("\n", $errors));
			return false;
		}
		
		 $this->addToolbar();
		 parent::display($tpl);
		
	}
	
	protected function addToolbar()
	{
		JRequest::setVar('hidemainmenu', true);
		$title = JText::_('COM_CUBEGALLERY')." - ";
		if($this->isNew)
			$title .= '<small>[ ' . JText::_( 'COM_CUBEGALLERY_NEW' ).' ]</small>'; 
		else 
			$title .= $this->item->title." <small>[".JText::_("COM_CUBEGALLERY_EDIT_SETTINGS")."]</small>";
		
		JToolBarHelper::title($title   , 'generic.png' );
		if ($this->isNew){
			JToolBarHelper::apply('cubegallery.apply', 'JTOOLBAR_APPLY');
			JToolBarHelper::save('cubegallery.save', 'JTOOLBAR_SAVE');
			JToolBarHelper::custom('cubegallery.save2new', 'save-new.png', 'save-new_f2.png', 'JTOOLBAR_SAVE_AND_NEW', false);
			JToolBarHelper::cancel('cubegallery.cancel', 'JTOOLBAR_CANCEL');
		}
		else {
			JToolBarHelper::apply('cubegallery.apply', 'JTOOLBAR_APPLY');
			JToolBarHelper::save('cubegallery.save', 'JTOOLBAR_SAVE');
			JToolBarHelper::custom('cubegallery.save2copy', 'save-copy.png', 'save-copy_f2.png', 'JTOOLBAR_SAVE_AS_COPY', false);
			JToolBarHelper::cancel('cubegallery.cancel', 'JTOOLBAR_CANCEL');
		}
	}
	
	
}



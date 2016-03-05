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
defined('_JEXEC') or die( 'Restricted access' );
jimport('joomla.application.component.view');
class CubegalleryViewCubegalleries extends JViewLegacy
{
	protected $items;
	protected $pagination;
	protected $state;
	public function display($tpl = null)
	{
		$this->items		= $this->get('Items');
		$this->pagination	= $this->get('Pagination');
		$this->state		= $this->get('State');
		
		if (count($errors = $this->get('Errors'))) {
			JError::raiseError(500, implode("\n", $errors));
			return false;
		}
		
		$this->addToolbar();		
		parent::display($tpl);		
	}
	protected function addToolbar()
	{
		$title = JText::_('COM_CUBEGALLERY'). " - ". JText::_('COM_CUBEGALLERY_GALLERIES');
		JToolBarHelper::title($title , 'generic.png');
		
		JToolBarHelper::addNew('cubegallery.add','JTOOLBAR_NEW');
		JToolBarHelper::editList('cubegallery.edit','JTOOLBAR_EDIT');
		JToolBarHelper::deleteList('COM_CUBEGALLERY_GALLERY_APPROVE_DELETE', 'cubegalleries.delete','JTOOLBAR_DELETE');
		JToolBarHelper::divider();
		JToolBarHelper::custom('cubegalleries.publish', 'publish.png', 'publish_f2.png','JTOOLBAR_PUBLISH', true);
		JToolBarHelper::custom('cubegalleries.unpublish', 'unpublish.png', 'unpublish_f2.png', 'JTOOLBAR_UNPUBLISH', true);

	}



}
<?php
/**
 * @copyright   Copyright (C) 2015-2016 Cory Webb Media, LLC. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

require_once(JPATH_ROOT . '/modules/mod_cw_contentimage/helpers/base.php');

/**
 * Conctacts helper for mod_cw_contentimage
 */
class ModCwContentImageContactHelper extends ModCwContentImageBaseHelper
{

    /**
     * Get the item
     *
     * @return   ModCwContentImageItem
     */
    public function getItem()
    {
        $contact = $this->getContact();
        
        $category_helper = new ModCwContentImageCategoryHelper($this->params, $this->item);
        $category_helper->setId($contact->catid);
        $categoryitem = $category_helper->getItem();

        $this->item = $this->getContactItem($contact);

        switch ($this->params->get('contact_image')) {
            case 'category':
                if($categoryitem->getImage())
                {
                    $this->item->setImage($categoryitem->getImage())
                               ->setAlt($categoryitem->getAlt());
                }
                break;

            case 'default':
                $this->item->setImage($this->item->getDefaultImage())
                           ->setAlt($this->item->getDefaultAlt());
                break;
        }

        if(!$this->item->getImage())
        {
            if($this->params->get('contact_no_image') == 'category')
            {
                if($categoryitem->getImage())
                {
                    $this->item->setImage($categoryitem->getImage())
                               ->setAlt($categoryitem->getAlt());
                }
            }
            elseif($this->params->get('contact_no_image') == 'default')
            {
                $this->item->setImage($this->item->getDefaultImage())
                           ->setAlt($this->item->getDefaultAlt());
            }
        }

        return $this->item;
    }

    private function getContact()
    {
        $this->getId();

        $contact = JTable::getInstance('Contact', 'ContactTable');
        $contact->load($this->id);

        return $contact;
    }

    private function getContactItem($contact)
    {
        $contactitem = new ModCwContentImageItem($this->params);

        $contactitem->setTitle($contact->name)
                    ->setAlt(htmlspecialchars($contact->name));

        if($contact->image)
        {
            $contactitem->setImage($contact->image);
        }

        return $contactitem;

    }

}
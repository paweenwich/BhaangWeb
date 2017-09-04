<?php
/**
* Copyright (c) Microsoft Corporation.  All Rights Reserved.  Licensed under the MIT License.  See License in the project root for license information.
* 
* SharepointIds File
* PHP version 7
*
* @category  Library
* @package   Microsoft.Graph
* @copyright 2016 Microsoft Corporation
* @license   https://opensource.org/licenses/MIT MIT License
* @version   GIT: 0.1.0
* @link      https://graph.microsoft.io/
*/
namespace Microsoft\Graph\Model;
/**
* SharepointIds class
*
* @category  Model
* @package   Microsoft.Graph
* @copyright 2016 Microsoft Corporation
* @license   https://opensource.org/licenses/MIT MIT License
* @version   Release: 0.1.0
* @link      https://graph.microsoft.io/
*/
class SharepointIds extends Entity
{
    /**
    * Gets the listId
    * The unique identifier for the item's list in SharePoint.
    *
    * @return string The listId
    */
    public function getListId()
    {
        if (array_key_exists("listId", $this->_propDict)) {
            return $this->_propDict["listId"];
        } else {
            return null;
        }
    }

    /**
    * Sets the listId
    * The unique identifier for the item's list in SharePoint.
    *
    * @param string $val The value of the listId
    *
    * @return SharepointIds
    */
    public function setListId($val)
    {
        $this->_propDict["listId"] = $val;
        return $this;
    }
    /**
    * Gets the listItemId
    * An integer identifier for the item within the containing list.
    *
    * @return string The listItemId
    */
    public function getListItemId()
    {
        if (array_key_exists("listItemId", $this->_propDict)) {
            return $this->_propDict["listItemId"];
        } else {
            return null;
        }
    }

    /**
    * Sets the listItemId
    * An integer identifier for the item within the containing list.
    *
    * @param string $val The value of the listItemId
    *
    * @return SharepointIds
    */
    public function setListItemId($val)
    {
        $this->_propDict["listItemId"] = $val;
        return $this;
    }
    /**
    * Gets the listItemUniqueId
    * The unique identifier for the item within OneDrive for Busienss or a SharePoint site.
    *
    * @return string The listItemUniqueId
    */
    public function getListItemUniqueId()
    {
        if (array_key_exists("listItemUniqueId", $this->_propDict)) {
            return $this->_propDict["listItemUniqueId"];
        } else {
            return null;
        }
    }

    /**
    * Sets the listItemUniqueId
    * The unique identifier for the item within OneDrive for Busienss or a SharePoint site.
    *
    * @param string $val The value of the listItemUniqueId
    *
    * @return SharepointIds
    */
    public function setListItemUniqueId($val)
    {
        $this->_propDict["listItemUniqueId"] = $val;
        return $this;
    }
    /**
    * Gets the siteId
    * The unique identifier for the item's site collection.
    *
    * @return string The siteId
    */
    public function getSiteId()
    {
        if (array_key_exists("siteId", $this->_propDict)) {
            return $this->_propDict["siteId"];
        } else {
            return null;
        }
    }

    /**
    * Sets the siteId
    * The unique identifier for the item's site collection.
    *
    * @param string $val The value of the siteId
    *
    * @return SharepointIds
    */
    public function setSiteId($val)
    {
        $this->_propDict["siteId"] = $val;
        return $this;
    }
    /**
    * Gets the siteUrl
    *
    * @return string The siteUrl
    */
    public function getSiteUrl()
    {
        if (array_key_exists("siteUrl", $this->_propDict)) {
            return $this->_propDict["siteUrl"];
        } else {
            return null;
        }
    }

    /**
    * Sets the siteUrl
    *
    * @param string $val The value of the siteUrl
    *
    * @return SharepointIds
    */
    public function setSiteUrl($val)
    {
        $this->_propDict["siteUrl"] = $val;
        return $this;
    }
    /**
    * Gets the webId
    * The unique identifier for the item's site.
    *
    * @return string The webId
    */
    public function getWebId()
    {
        if (array_key_exists("webId", $this->_propDict)) {
            return $this->_propDict["webId"];
        } else {
            return null;
        }
    }

    /**
    * Sets the webId
    * The unique identifier for the item's site.
    *
    * @param string $val The value of the webId
    *
    * @return SharepointIds
    */
    public function setWebId($val)
    {
        $this->_propDict["webId"] = $val;
        return $this;
    }
}

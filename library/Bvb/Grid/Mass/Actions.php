<?php

/**
 * LICENSE
 *
 * This source file is subject to the new BSD license
 * It is  available through the world-wide-web at this URL:
 * http://www.petala-azul.com/bsd.txt
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to geral@petala-azul.com so we can send you a copy immediately.
 *
 * @package   Bvb_Grid
 * @author    Bento Vilas Boas <geral@petala-azul.com>
 * @copyright 2010 ZFDatagrid
 * @license   http://www.petala-azul.com/bsd.txt   New BSD License
 * @version   $Id: Actions.php 1928 2012-05-06 19:38:47Z bento@licentia.pt $
 * @link      http://zfdatagrid.com
 */
class Bvb_Grid_Mass_Actions {

    /**
     * Mass Actions
     *
     * @var array
     */
    protected $_massActions = array();
    /**
     * Columns that should be return when submiting the form
     *
     * @var array
     */
    protected $_fields = array();

    /**
     * Selected Values Mass Actions
     * @var type
     */
    protected $_preSelectedValues = array();
    /**
     * The defaulf separator for mass actions post values
     * @var string
     */
    protected $_recordSeparator = ',';
    /**
     * The defaulf separator for multiple fields values
     * @var string
     */
    protected $_multipleFieldsSeparator = '-';
    /**
     *
     * @var string|bool
     */
    protected $_decorator = false;
    /**
     *
     * @var string
     */
    protected $_submitAttributes = array();

    /**
     * Checks if there are any mass actions registered
     *
     * @return bool
     */
    public function hasMassActions()
    {
        return count($this->_massActions) > 0;
    }

    /**
     * Returns the active mass options
     *
     * @return array
     */
    public function getMassActionsOptions()
    {
        if (!$this->hasMassActions()) {
            return array();
        }

        return (array) $this->_massActions;
    }

    /**
     * Defines mass actions, overriden any previous
     *
     * @param array $options Options to be made available to user
     * @param type $fields  Fields to be used
     *
     * @return Bvb_Grid
     */
    public function setMassActions(array $options, $fields = null)
    {
        $this->clearMassActions();

        $this->addMassActions($options, $fields);

        return $this;
    }

    /**
     * Clears all mass actions previously defined
     *
     * @return Bvb_Grid
     */
    public function clearMassActions()
    {
        $this->_massActions = array();
        return $this;
    }

    /**
     * Adds a new mass action and clears all previous
     *
     * @param type $url     Url to post the results
     * @param type $caption Caption for the select option
     * @param type $confirm Confirmation message when submiting
     *
     * @return Bvb_Grid
     */
    public function setMassAction($url, $caption, $confirm='')
    {
        $options = array('url' => $url, 'caption' => $caption, 'confirm' => $confirm);

        $this->setMassActions($options);

        return $this;
    }

    /**
     * Adds a new mass action
     *
     * @param type $url     Url to post the results
     * @param type $caption Caption for the select option
     * @param type $confirm Confirmation message when submiting
     *
     * @return Bvb_Grid
     */
    public function addMassAction($url, $caption, $confirm='')
    {
        $options = array();
        $options[] = array('url' => $url, 'caption' => $caption, 'confirm' => $confirm);

        $this->addMassActions($options);
        return $this;
    }

    /**
     * Adds a new mass action option
     *
     * @param array $options Options to be made available to user
     * @param type $fields  Fields to be used
     *
     * @return Bvb_Grid
     */
    public function addMassActions(array $options, $fields = null)
    {

        foreach ($options as $value) {
            if (!isset($value['url']) || !isset($value['caption'])) {
                throw new Bvb_Grid_Exception('Options url and caption are required for each action');
            }
        }

        if(isset($fields)) {
            $this->setFields($fields);
        }

        $this->_massActions = array_merge($options, $this->_massActions);
        return $this;
    }

    /**
     * Defines which fields should be posted.
     *
     * @param mixed $fields Fields to be used as post ids
     * @return Bvb_Grid
     */
    public function setFields($fields)
    {
        $this->_fields = (array) $fields;

        return $this;
    }

    /**
     * Set's the pre-selected values
     * @param array $values
     * @return \Bvb_Grid_Mass_Actions
     */
    public function setPreSelectedValues(array $values = array())
    {
        $this->_preSelectedValues = $values;
        return $this;
    }

    public function getPreSelectedValues()
    {
        return $this->_preSelectedValues;
    }

    /**
     * Defines the separator for multiple primary keys or fields for mass actions post values
     *
     * @param string $separator Separator to be used
     *
     * @return Bvb_Grid
     */
    public function setMultipleFieldsSeparator($separator)
    {

        if (0 == strlen($separator)) {
            throw new Bvb_Grid_Exception('Please provide a Mass Actions separator');
        }

        $this->_multipleFieldsSeparator = (string) $separator;

        return $this;
    }

    /**
     * Returns the current Mass Action separator for multiple fields
     *
     * @return string
     */
    public function getMultipleFieldsSeparator()
    {
        return $this->_multipleFieldsSeparator;
    }

    /**
     * Defines the separator for primary keys or fields for mass actions post values
     *
     * @param string $separator Separator to be used in post fields
     *
     * @return Bvb_Grid
     */
    public function setMassActionsSeparator($separator)
    {

        if (0 == strlen($separator)) {
            throw new Bvb_Grid_Exception('Please provide a Mass Actions separator');
        }

        $this->_recordSeparator = (string) $separator;

        return $this;
    }

    /**
     * Returns the current Mass Action separator for post values
     *
     * @return string
     */
    public function getMassActionsSeparator()
    {
        return $this->_recordSeparator;
    }

    /**
     * Returns current decorator
     *
     * @return string
     */
    public function getDecorator()
    {
        return $this->_decorator;
    }

    /**
     * Set's decorator
     *
     * @param string $value
     * @return string
     */
    public function setDecorator($value)
    {
        return $this->_decorator = $value;
    }

    /**
     * Returns current fields
     *
     * @return array
     */
    public function getFields()
    {
        return $this->_fields;
    }

    /**
     * Returns current separator
     *
     * @return string
     */
    public function getRecordSeparator()
    {
        return $this->_recordSeparator;
    }

    /**
     * Defines attributes to be applyied to submit input for mass actions
     *
     * @param array $attributes
     *
     * @return Bvb_Grid_Mass_Actions
     */
    public function setSubmitAttributes(array $attributes)
    {
        $this->_submitAttributes = $attributes;
        return $this;
    }

    /**
     * Returns current attributes for submit button for mass actions
     *
     * @return array
     */
    public function getSumitAttributes()
    {
        return $this->_submitAttributes;
    }

}

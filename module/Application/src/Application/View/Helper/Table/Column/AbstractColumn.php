<?php

namespace Application\View\Helper\Table\Column;

/**
 * @package Application\View\Helper\Table\Column
 */
abstract class AbstractColumn
{
    /**
     * title of the column
     * @var string 
     */
    protected $title;
    
    /**
     * value key of the column
     * @var string
     */
    protected $valueKey;
    
    /**
     * Render a cell in regards of the passed data
     * @param $line
     * 
     * @return string
     */
    abstract public function render($line);
    
    /**
     * get the title
     * 
     * @return type
     */
    public function getTitle() {
        return $this->title;
    }

    /**
     * set the title
     * 
     * @param type $title
     * @return \Application\View\Helper\Table\Column\AbstractColumn
     */
    public function setTitle($title) {
        $this->title = $title;
        return $this;
    }

    /**
     * get the value key
     * 
     * @return type
     */
    public function getValueKey() {
        return $this->valueKey;
    }

    /**
     * Set the value key
     * 
     * @param type $valueKey
     * @return \Application\View\Helper\Table\Column\AbstractColumn
     */
    public function setValueKey($valueKey) {
        $this->valueKey = $valueKey;
        return $this;
    }
    
    /**
     * Set the options dynamically
     * 
     * @param type $options
     * @return \Application\View\Helper\Table\Column\AbstractColumn
     */
    public function setOptions($options){
        foreach($options as $key => $value) {
            $method = 'set'.ucfirst($key);

            if(method_exists($this, $method)) {
                $this->$method($value);
            }
        }
        return $this;
    }


}

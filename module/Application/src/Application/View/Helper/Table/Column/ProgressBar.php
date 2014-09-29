<?php

namespace Application\View\Helper\Table\Column;

use \Application\View\Helper\Table\Column\AbstractColumn;

/**
 * Description of ProgressBar
 *
 * @author claude
 * @package ApplicationTest\View\Helper\Table\Column
 */
class ProgressBar extends AbstractColumn
{
    
    
    /**
     * color
     * @var string 
     */
    protected $color = 'green';
    
   
    
    /**
     * Get Color
     * @return string
     */
    public function getColor() {
        return $this->color;
    }

    /**
     * Set Color
     * @param string $color
     * @return \Application\View\Helper\Table\Column\ProgressBar
     */
    public function setColor($color) {
        $this->color = $color;
        return $this;
    }

    
        
    public function render($line) {
        $progressData = $line[$this->valueKey];
        if($progressData > 100) {
            $progressData = 100;
        }
        
        $progressData = abs($progressData);
        
        return "<div style=\"background:".$this->color.";width:".$progressData."px;\">&nbsp;</div>";
    }

}
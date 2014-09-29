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
     * progressData
     * @var int 
     */
    protected $progressData;
    
    /**
     * color
     * @var string 
     */
    protected $color = 'green';
    
    /**
     * Get Progress Data
     * @return int
     */
    public function getProgressData() {
        return $this->progressData;
    }

    /**
     * Set Progress Data
     * @param int $progressData
     * @return \Application\View\Helper\Table\Column\ProgressBar
     */
    public function setProgressData($progressData) {
        if($progressData > 100) {
            $progressData = 100;
        }
        $this->progressData = abs($progressData);
        return $this;
    }
    
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
        return "<div style=\"background:".$this->color.";width:".$this->progressData."px;\">$line</div>";
    }

}
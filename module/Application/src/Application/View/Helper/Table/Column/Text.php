<?php

namespace Application\View\Helper\Table\Column;


/**
 * Description of Text
 *
 * @package Application\View\Helper\Table\Column
 * @author claude
 */
class Text extends AbstractColumn
{
    /**
     * render a cell
     * 
     * @param type $line
     * @return type
     */
    public function render($line) {
        return $line[$this->valueKey];
    }

}
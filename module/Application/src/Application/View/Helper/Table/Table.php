<?php

namespace Application\View\Helper\Table;

use \Zend\View\Helper\AbstractHelper;
use Application\View\Helper\Table\Exception;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorAwareTrait;

/**
 * Description of Table
 *
 * @author claude
 */
class Table extends AbstractHelper implements ServiceLocatorAwareInterface
{
    
    use ServiceLocatorAwareTrait;
    
    /**
     *
     * @var array 
     */
    protected $data = [];
    
    /**
     *
     * @var array 
     */
    protected $columns = [];
    
    /**
     *
     * @var TableColumnsManagerPlugin
     */
    protected $tableColumnPluginManager;
    
    /**
     * Set data
     * @param type $data
     * @return \Application\View\Helper\Table\Table
     */
    public function setData($data){
        $this->data = $data;
        return $this;
    }
    
    /**
     * Get data
     * @return array
     */
    public function getData(){
        return $this->data;
    }
    
    /**
     * 
     * @return type
     */
    public function getColumns() {
        return $this->columns;
    }

    /**
     * 
     * @param type $columns
     */
    public function setColumns($columns) {
        $this->columns = $columns;
        return $this;
    }

    /**
     * 
     * @param type $column
     * @return \Application\View\Helper\Table\Table
     */
    public function addColumn($column){
        if(is_array($column)) {
            $column = $this->columnFactory($column);
        }
        elseif(!$column instanceof \Application\View\Helper\Table\Column\AbstractColumn){
            throw new Exception("You must provide an array or AbstractColumn Object");
        }
        $this->columns[] = $column;
        return $this;
    }
    
    /**
     * 
     * @param array $data
     * @return type
     * @throws Exception
     */
    public function columnFactory(array $data){
        if(!isset($data['type'])){
            throw new Exception('The type property was not declared');            
        }
        $column = $this->getTableColumnPluginManager()
                    ->get($data['type']);
    
        unset($data['type']);
        $column->setOptions($data);
        return $column;
    }
    
    /**
     * Get Table Column Plugin Manager
     * @return TableColumnsManagerPlugin
     */
    public function getTableColumnPluginManager() {
        if(is_null($this->tableColumnPluginManager)) {
            $this->tableColumnPluginManager = $this->getServiceLocator()
                ->getServiceLocator()
                ->get('TableColumnsPluginManager');
        }
        return $this->tableColumnPluginManager;
    }
    
    /**
     * 
     * @param type $columns
     * @return \Application\View\Helper\Table\Table
     */
    public function addColumns($columns) {
        if(!is_array($columns)){
            throw new Exception('You must provide an array');
        }
        foreach($columns as $column){
            $this->addColumn($column);
        }
        return $this;
    }
    
    /**
     * render the html table
     * @return string
     */
    public function render() {
        $html  = '<table>' .PHP_EOL;
        $html .= '<thead>' .PHP_EOL;
        $html .= '<tr>' .PHP_EOL;
        foreach($this->columns as $column){
            $html .= '<th>' . $column->getTitle() . '</th>' . PHP_EOL;
        }
        $html .= '</tr>'.PHP_EOL;
        $html .= '</thead>'.PHP_EOL;
        $html .= '<tbody>'.PHP_EOL;
        foreach($this->data as $line){
            $html .= '<tr>' .PHP_EOL;        
            foreach($this->columns as $column){
                $html .= '<td>' . $column->render($line) . '</td>' . PHP_EOL;
            }
            $html .= '</tr>' .PHP_EOL;        
        }
        $html .= '</tbody>'.PHP_EOL;
        $html .= '</table>'.PHP_EOL;
        
        return $html;
    }
    
    /**
     * Proxy ro render()
     * @return String
     */
    public function __toString() {
        return $this->render();
    }
}
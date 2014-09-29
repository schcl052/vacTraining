<?php

namespace ApplicationTest\View\Helper\Table;

use Application\View\Helper\Table\Table;
use Application\Test\PhpunitTestCase;

/**
 * @package Application\View\Helper\Table\Table
 */
class TableTest extends PhpunitTestCase
{
    /**
     *
     * @var Application\View\Helper\Table\Table
     */
    protected $instance;
    
    /**
     * set up the test case
     */
    public function setUp() {
       $this->instance = new Table();
    }
    
    /**
     * tear down the test case
     */
    public function tearDown() {
        $this->instance = null;
    }
    
    /**
     * test the setter and getter of the Table 
     */
    public function testGetSetData(){
        $fixture = 
        [
            [1,2,3,4],
            [1,2,3,4],
        ];
        $this->assertSame($this->instance, $this->instance->setData($fixture));
        $this->assertSame($fixture, $this->instance->getData());
    }
    
    /**
     * test column from array
     */
    public function testAddColumnFromArray(){
        //column array
        $fixture = [
            'title' => 'Col1',
            'valueKey' => 'keyName',
            'type' => 'text',
        ];
        
        //create a mock for the abstract column
        $columnFixture = $this->getMockForAbstractClass('Application\View\Helper\Table\Column\AbstractColumn');
        
        //get a mock for the methor columnFactory()
        $this->instance = $this->getMock('Application\View\Helper\Table\Table', ['columnFactory']);
        
        //I expect that the method columnFactory() is called once with the given param. It will return the given return value
        $this->instance
            ->expects($this->once())
            ->method('columnFactory')
            ->with($fixture)
            ->will($this->returnValue($columnFixture));
        
        //test if the method addColumn() reurns the same instance
        $this->assertSame($this->instance, $this->instance->addColumn($fixture));
        //get the columns and test if the first column is the added column
        $columns = $this->instance->getColumns();
        $this->assertSame($columnFixture, $columns[0]);
    }
    
    /**
     * test add column with a abstract column
     */
    public function testAddColumnFromColumn() {
        $columnFixture = $this->getMockForAbstractClass('Application\View\Helper\Table\Column\AbstractColumn');
        
        $this->instance = $this->getMock('Application\View\Helper\Table\Table', ['columnFactory']);
        
        $this->instance
            ->expects($this->never())
            ->method('columnFactory');
        
        $this->assertSame($this->instance, $this->instance->addColumn($columnFixture));
        $columns = $this->instance->getColumns();
        $this->assertSame($columnFixture, $columns[0]);
    }
    
    /**
     * test the exception recieved
     */
    public function testColumnException() {
        //create an object that is not an abstractColumn
        $columnFixture = new \stdClass();
        
        //set the excepted exception
        $this->setExpectedException('\\Application\\View\\Helper\\Table\\Exception');
        $this->instance->addColumn($columnFixture);
        
    }    
    
    /**
     * test add columns
     */
    public function testAddColumns(){
        $fixture = [
            'title' => 'Col1',
            'valueKey' => 'keyName',
            'type' => 'text',
        ];
        $columnFixture = $this->getMockForAbstractClass('Application\View\Helper\Table\Column\AbstractColumn');
        
        $assignedColumns = 
        [
            $columnFixture,
            $fixture,
            $columnFixture,
        ];
        
        //get a mock for the table class with the addColumn method
        $this->instance = $this->getMock('Application\View\Helper\Table\Table', ['addColumn']);
        
        //I expect that the method addColumn will be called 3 ties with an Column or array param. It will return a Column
        $this->instance
            ->expects($this->exactly(3))
            ->method('addColumn')
            ->with($this->logicalOr($columnFixture, $fixture))
            ->will($this->returnValue($columnFixture));
        
        //Call the addColumns() method and test if it returns the same instance
        $this->assertSame($this->instance, $this->instance->addColumns($assignedColumns));
    }
    
    /**
     * test the add columns exception
     */
    public function testAddColumnsException() {
        $fixture = new \stdClass();
        $this->setExpectedException("Application\View\Helper\Table\Exception");
        $this->instance->addColumns($fixture);
    }
    
    /**
     * test column factory
     */
    public function testColumnFactory(){
        $columnDataFixture = 
        [
            'type' => 'text',
            'title' => 'Column title',
            'keyValue' => 'keyname',
        ];
                
        $columnOptionsFixture =
        [
            'title' => 'Column title',
            'keyValue' => 'keyname',
        ];
        
        //create a new mock for the abstract class AbstractColumn
        $columnMock = $this->getMockForAbstractClass('Application\View\Helper\Table\Column\AbstractColumn', [],
                    '', false, false, false, ['setOptions']);
        
        //the methode setOptions() should be called once
        $columnMock->expects($this->once())
                ->method('setOptions')
                ->with($columnOptionsFixture);
     
        
        //set the service locator to the table
        $this->instance->setServiceLocator($this->getViewHelperPluginManager(1, 'text', $columnMock));
        //call columnFactory() and test if a column is returned
        $column = $this->instance->columnFactory($columnDataFixture);
        $this->assertInstanceOf('Application\View\Helper\Table\Column\AbstractColumn', $column);
    }
    
    /**
     * test column factory exception
     */
    public function testColumnFactoryException() {
        $fixture = [];
        $this->setExpectedException('Application\View\Helper\Table\Exception');
        $this->instance->columnFactory($fixture);
    }
    
    /**
     * Test the render of the table
     */
    public function testRender() {
        //prepare the expected result
        $html  = '<table>
                    <thead>
                        <tr>
                            <th>title 1</th>
                            <th>title 2</th>
                            <th>title 3</th>
                        </tr>
                    </thead>
                    <tbody>#
                        <tr>
                            <td>Value 11</td>
                            <td>Value 12</td>
                            <td>Value 13</td>
                        </tr>
                        <tr>
                            <td>Value 21</td>
                            <td>Value 22</td>
                            <td>Value 23</td>
                        </tr>
                    </tbody>
                </table>';
        
        $expectedElement = new \DOMDocument();
        $expectedElement->loadHTML($html);
        
        //prepare the data values
        $data = 
        [
            ['key1' => 'Value 11', 'key2' => 'Value 12', 'key3' => 'Value 13'],
            ['key1' => 'Value 21', 'key2' => 'Value 22', 'key3' => 'Value 23'],
        ];
      
        //prepare the columns
        $columns = 
        [
            ['type' => 'test' , 'title' => 'title 1'],
            ['type' => 'test' , 'title' => 'title 2'],
            ['type' => 'test' , 'title' => 'title 3'],
        ];
        
        //mock a Test Column with the methods render(), setOptions() and getTitle()
        $column = $this->getMock('Application\\View\\Helper\\Table\\Column\\Test', ['render', 'setOptions', 'getTitle']);
        //I expect that the mocked column will return the expected result when I call the method render()
        $column->expects($this->any()) //or: $this->exactly(6)
                ->method('render')
                ->will($this->onConsecutiveCalls(
                    'value 11', 'value 12', 'value 13',
                    'value 21', 'value 22', 'value 23'
                ));
       
        
        //The service manager will be setted on the table. The columns will be added and the data set.
        $this->instance
                ->setServiceLocator($this->getViewHelperPluginManager(3,  'test', $column))
                ->addColumns($columns)
                ->setData($data);
        
        //load the html from the instance and create a DOM element
        $renderedElement = new \DOMDocument();
        $renderedElement->loadHTML($this->instance->render());
        
                
        //compare the expected resul with the actual result
        $this->assertEqualXMLStructure(
            $expectedElement->getElementsByTagName('table')->item(0), 
            $renderedElement->getElementsByTagName('table')->item(0)
        );        
    }
    
    public function getViewHelperPluginManager($count, $type, $columnMock){
        
        $tableColumnManagerMock = $this->getMockFromArray('Zend\ServiceManager\ServiceManager', false,
        [
            'get' =>
            [
                'expects' => $this->exactly($count),
                'with'    => $type,
                'will'    => $this->returnValue($columnMock)  
            ]
        ]);
        
        $serviceManagerMock = $this->getMockFromArray('Zend\ServiceManager\ServiceManager', false,
        [
            'get' =>
            [                
                'with'    => 'TableColumnsPluginManager',
                'will'    => $this->returnValue($tableColumnManagerMock)  
            ]
        ]);
        
        $viewHelperPluginManagerMock = $this->getMockFromArray('Zend\ServiceManager\ServiceManager', false,
        [
            'getServiceLocator' =>
            [
                'will'    => $this->returnValue($serviceManagerMock)  
            ]
        ]);
        
        /*
        $tableColumnManagerMock = $this->getMock('Zend\ServiceManager\ServiceManager', ['get'], [], 'TableColumnPluginManager');
        //the method get() should be called once and return a AbstractColumn
        $tableColumnManagerMock->expects($this->exactly($count))
                ->method('get')
                ->with($type)
                ->will($this->returnValue($columnMock));
        
        //create a new mock for the service manager
        $serviceManagerMock = $this->getMock('Zend\ServiceManager\ServiceManager', ['get'], [], 'ServiceLocator');
        //the method get() should be called once and return a AbstractColumn
        $serviceManagerMock->expects($this->once())
                ->method('get')
                ->with('TableColumnsPluginManager')
                ->will($this->returnValue($tableColumnManagerMock));
        
        $viewHelperPluginManagerMock = $this->getMock('Zend\ServiceManager\ServiceManager', ['getServiceLocator'], [], 'ViewHelperPluginManager');
        //the method get() should be called once and return a AbstractColumn
        $viewHelperPluginManagerMock->expects($this->once())
                ->method('getServiceLocator')
                ->will($this->returnValue($serviceManagerMock));*/
        
        
        return $viewHelperPluginManagerMock;
    }
    
    /**
     * test to string
     */
    public function testToString() {
        $fixture = '<table></table>';
        
        $this->instance = $this->getMock('Application\View\Helper\Table\Table', ['render']);
        
        //The method render will be called once and return fixture
        $this->instance->expects($this->once())
                ->method('render')
                ->will($this->returnValue($fixture));
        
        $this->assertSame($fixture, $this->instance->__toString());
    }
}
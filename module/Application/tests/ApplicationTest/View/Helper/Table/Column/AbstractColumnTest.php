<?php

namespace ApplicationTest\View\Helper\Table\Column;

/**
 * @package ApplicationTest\View\Helper\Table\Column
 */
class AbstractColumnTest extends \PHPUnit_Framework_TestCase
{
    /**
     *
     * @var type 
     */
    protected $instance;

    
    /**
     * set up the test
     */
    public function setUp() {
        $this->instance = $this->getMockForAbstractClass('Application\View\Helper\Table\Column\AbstractColumn');
    }
    
    /**
     * tear down the test
     */
    public function tearDown() {
        $this->instance = null;
    }
    
    /**
     * test set get title
     */
    public function testSetGetTitle() {
        $fixture = "title";
        
        $this->assertSame($this->instance, $this->instance->setTitle($fixture));
        $this->assertSame($fixture, $this->instance->getTitle());
    }
    
    /**
     * test set get value key
     */
    public function testSetGetValueKey() {
        $fixture = "keyname";
        
        $this->assertSame($this->instance, $this->instance->setValueKey($fixture));
        $this->assertSame($fixture, $this->instance->getValueKey());
    }
    
    /**
     * test set options
     */
    public function testSetOptions() {
        $fixture = 
        [
            'value1' => 1,
            'value2' => 'value 2',
        ];
        
        $this->instance = $this->getMockForAbstractClass('Application\View\Helper\Table\Column\AbstractColumn', [],
                 '', true, true, false, ['setValue1', 'setValue2']
        );                
        
        $this->instance
                ->expects($this->once())
                ->method('setValue1')
                ->with(1);
        
        $this->instance
                ->expects($this->once())
                ->method('setValue2')
                ->with('value 2');
        
        $this->assertSame($this->instance, $this->instance->setOptions($fixture));
    }    
}

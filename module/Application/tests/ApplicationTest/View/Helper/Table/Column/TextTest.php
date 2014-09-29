<?php

namespace ApplicationTest\View\Helper\Table\Column;

use \Application\View\Helper\Table\Column\Text;

/**
 * @package ApplicationTest\View\Helper\Table\Column;
 */
class TextTest extends \PHPUnit_Framework_TestCase
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
        $this->instance = new Text();
    }
    
    /**
     * tear down the test
     */
    public function tearDown() {
        $this->instance = null;
    }
    
    /**
     * test render
     */
    public function testRender() {
        $expected = "Claude";
        
        $fixture = 
        [
            'id' => 1,
            'firstname' => 'Claude',
            'lastname' => 'Schmitz',
            'age' => 24,
        ];
        
        //set the value key that has to be rendered
        $this->instance->setValueKey('firstname');
        
        $this->assertSame($expected, $this->instance->render($fixture));
    }
}

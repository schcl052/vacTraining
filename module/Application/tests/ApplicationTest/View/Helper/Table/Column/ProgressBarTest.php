<?php

namespace ApplicationTest\View\Helper\Table\Column;

use Application\Test\PhpunitTestCase;
use Application\View\Helper\Table\Column\ProgressBar;

/**
 * Description of ProgressBarTest
 *
 * @author claude
 */
class ProgressBarTest extends PhpunitTestCase
{
    
    /**
     * instance
     * @var Application\View\Helper\Table\Column\ProgressBar 
     */
    protected $instance;
    
    /**
     * set up the test
     */
    public function setUp() {
       $this->instance = new ProgressBar();
    }

    /**
     * tear down the test
     */
    public function tearDown() {
        $this->instance = null;
    }
    
    /**
     * Test Get Set Progress Data
     */
    public function testGetSetProgressData() {
        $fixture = 17;
        
        $this->assertSame($this->instance, $this->instance->setProgressData($fixture));
        $this->assertSame($fixture, $this->instance->getProgressData());
    }
    
    /**
     * Test Get Set Color
     */
    public function testGetSetColor() {
        $fixture = "red";
        
        $this->assertSame($this->instance, $this->instance->setColor($fixture));
        $this->assertSame($fixture, $this->instance->getColor());
    }

    /**
     * Test render
     * @dataProvider renderProvider
     */
    public function testRender($options, $result) {        
        $this->instance->setOptions($options);
        //$this->setInaccessiblePropertyValue('progressData', $options['progressData']);
        //$this->setInaccessiblePropertyValue('color', (isset($options['color'])?$options['color']:null));
        $this->assertSame($result, $this->instance->render("&nbsp;"));
    }
    
    /**
     * Render data Provider
     * @return array
     */
    public function renderProvider() {
        return 
        [
            [
                ['progressData' => null, 'valueKey' => 'progressData', 'color' => 'blue'], 
                '<div style="background:blue;width:0px;">&nbsp;</div>'
            ],
            [
                ['progressData' => -45, 'valueKey' => 'progressData', 'color' => 'blue'],
                '<div style="background:blue;width:45px;">&nbsp;</div>'
            ],
            [
                ['progressData' => 0, 'valueKey' => 'progressData', 'color' => 'red'],
                '<div style="background:red;width:0px;">&nbsp;</div>'
            ],
            [
                ['progressData' => 50, 'valueKey' => 'progressData'],
                '<div style="background:green;width:50px;">&nbsp;</div>'
            ],
            [
                ['progressData' => 150, 'valueKey' => 'progressData', 'color' => 'black'],
                '<div style="background:black;width:100px;">&nbsp;</div>'
            ],
        ];
    }
}

?>

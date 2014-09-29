<?php



/**
 * Description of ProgressBarTest
 *
 * @author claude
 */
class ProgressBarTest 
{
    /**
     * Test render
     * @dataProvider renderProvider
     */
    public function testRender($options, $result) {
        //$this->setOptopns($options);
        //$this->assertEquals()
    }
    
    /**
     * Render data Provider
     * @return array
     */
    public function renderProvider() {
        return 
        [
            [
                ['progressData' => null],
                ['valueKey' => 'progressData', 'color' => 'blue'], 
                '<div style="background:blue;width:0px">&nbsp;</div>'
            ],
            [
                ['progressData' => -45],
                ['valueKey' => 'progressData', 'color' => 'blue'],
                '<div style="background:blue;width:45px">&nbsp;</div>'
            ],
            [
                ['progressData' => 0],
                ['valueKey' => 'progressData', 'color' => 'red'],
                '<div style="background:red;width:0px">&nbsp;</div>'
            ],
            [
                ['progressData' => 50],
                ['valueKey' => 'progressData'],
                '<div style="background:green;width:50px">&nbsp;</div>'
            ],
            [
                ['progressData' => 150],
                ['valueKey' => 'progressData', 'color' => 'black'],
                '<div style="background:black;width:150px">&nbsp;</div>'
            ],
        ];
    }
}

?>

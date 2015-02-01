<?php

class SiteTest extends WebTestCase
{
    public function setUp(){
        parent::setUp();
    }
        
    public function tearDown(){
        $this->videoSleep(2000);
        $this->videoStop();
    }
    
    public function testVideoShowMessage(){
        $this->videoInit();
		$this->open('');
        $this->videoStart(__FUNCTION__);
        $this->videoShowMessage('function videoShowMessage($text, $position=null, $moreMsToWait = 0)'."\n".'Draws message like this.'."\n".'$position can override message position in CSS format, e.g. "top: 100px; left: 100px; right: 100px; height: 200px;"'."\n".'see also function videoSetDefaultMessagePosition($position = \'top: 100px; left: 100px; right: 100px; height: 200px;\')'."\n".'$moreMsToWait - just make it wait some more milliseconds after message is completely shown to give user some time to view it');
    }
    
    public function testVideoType(){
        $this->videoInit();
        $this->open('?r=site/contact');
        $this->videoStart(__FUNCTION__);
        $this->videoShowMessage('function videoType($element, $text)'."\n".'animates Selenium type() function by typing letters one by one, like this:');
        $this->videoType($q='xpath=//input[@name="ContactForm[name]"]', $t='My name is Bob');
        $this->videoSleep(3000);
        $this->videoShowMessage('recommended to use videoMouseClick() and focus() for better user experience:');
        $this->type($q, '');
        $this->focus('xpath=//input[@name="ContactForm[email]"]');
        $this->videoMouseClick($q);
        $this->focus($q);
        $this->videoType($q, $t);
        $this->videoSleep(2000);
    }
    public function testVideoShowImage(){
        $this->videoInit();
        $this->open('');
        $this->videoStart(__FUNCTION__);
        $this->videoShowMessage('function videoShowImage($files, $durations=5)'."\n".'Displays a kind of slideshow - for those cases when you need to show something like screenshots of other applications.'."\n".'$files is array of absolute paths to PNG files on local filesystem'."\n".'$duration is either delay between images (seconds) or array of delays (should be of same size as $files)');
        $this->videoShowImage(array(
            dirname(__FILE__).'/images/1.png',
            dirname(__FILE__).'/images/2.png',
            dirname(__FILE__).'/images/3.png',
        ),
        array(
            3,
            5,
            7,
        ));
    }
    
    public function testVideoSetVisible(){
        $this->videoInit();
        $this->open('?r=site/longpage');
        $this->videoStart(__FUNCTION__);
        $this->videoShowMessage('function videoSetVisible($element)'."\n".'used to scroll page up or down to make sure, that appropriate element is visible to user. This function is automatically called when you use videoMouseClick, but in all other cases you should use it explicitly');
        $this->videoSetVisible('xpath=//p[@id="p1000"]');
        $this->videoSleep(2000);
        $this->videoSetVisible('xpath=//p[@id="p300"]');
        $this->videoSleep(2000);
    }
    
    public function testVideoMouseClick(){
        $this->videoInit();
        $this->open('?r=site/mouseclick');
        $this->videoStart(__FUNCTION__);
        $this->videoShowMessage('function videoMouseClick($element, $nearTheLeftSide=false, $highlightCallback=false)'."\n".'used to animate a mouse pointer (arrow) approaching particular element to simulate a click. By default random position inside the $element is choosen as mouse destination:');
        $this->videoMouseClick('xpath=//button[@id="b1"]');
        $this->videoMouseClick('xpath=//button[@id="b2"]');
        $this->videoMouseClick('xpath=//button[@id="b3"]');
        $this->videoShowMessage('this is not too useful when an element has 100% width, while has only small text at its left, like these <p>\'s:');
        $this->videoMouseClick('xpath=//p[@id="p1"]');
        $this->videoMouseClick('xpath=//p[@id="p2"]');
        $this->videoMouseClick('xpath=//p[@id="p3"]');
        $this->videoShowMessage('to fix this $nearTheLeftSide parameter can be set to true:');
        $this->videoMouseClick('xpath=//p[@id="p1"]', true);
        $this->videoMouseClick('xpath=//p[@id="p2"]', true);
        $this->videoMouseClick($q = 'xpath=//p[@id="p3"]', true);
        
        $this->videoShowMessage('alternatively $nearTheLeftSide can be array(top, left) absolute exact coordinates (relative to the page, not the window');
        $this->videoMouseClick($q, array(100, 100));
        $this->videoMouseClick($q, array(200, 200));
        $this->videoMouseClick($q, array(300, 300));
        
        $this->videoShowMessage('or an array of two strings in format array(\'+20\', \'-5\') to tweak mouse destination position. This can be useful for the case, when one of element\'s ancestors has position: absolute; as in this case Selenium can not detect element position on page correctly and we need to introduce a shift. For example: here is if we try to use it without shift:');
        $this->videoMouseClick('xpath=//button[@id="b1"]', array('+20', '-5'));
        $this->videoMouseClick('xpath=//button[@id="b2"]', array('+20', '-5'));
        $this->videoMouseClick('xpath=//button[@id="b3"]', array('+20', '-5'));
        $this->videoShowMessage('at the end videoMouseClick calls mouseOver() for the desired element, but since this does not always work - you can specify your own callback at $highlightCallback parameter');        
    }

    public function testVideoCustomSelectBoxSelect(){
        $this->videoInit();
        $this->open('?r=site/customselectbox');
        $this->videoStart(__FUNCTION__);
        $this->videoShowMessage('function videoCustomSelectBoxSelect($id, $value)'."\n".'used to gracefully show selecting value from drop-down list drawn with selectBox jQuery plugin.'."\n".'$id is select\'s id.'."\n".'$value is option\'s value:');
        $this->videoCustomSelectBoxSelect('selectbox', 1);
        $this->videoCustomSelectBoxSelect('selectbox', 2);
        $this->videoCustomSelectBoxSelect('selectbox', 1);
    }
    
    public function testVideoHideDatePicker(){
        $this->videoInit();
        $this->open('?r=site/datepicker');
        $this->videoStart(__FUNCTION__);
        $this->videoShowMessage('function videoHideDatePicker()'."\n".'used to hide date picker shown by zii.widgets.jui.CJuiDatePicker');
        $this->videoMouseClick($q = 'xpath=//input[@name="datepickerinput"]');
        $this->focus($q);
        $this->videoType($q, '01.01.2015');
        $this->videoHideDatePicker();
        $this->videoSleep(2000);
    }
}

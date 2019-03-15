<?php

namespace ezsql\Tests;

use ezsql\Database\ezQuery;
use ezsql\Tests\DBTestCase;

class ezQueryTest extends DBTestCase 
{
	
    /**
     * @var ezQuery
     */
    protected $object;
	
    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp(): void
	{
        $this->object = new ezQuery();             
    } // setUp

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown() {
        $this->object = null;
    } // tearDown
 
    /**
      * @covers ezQuery::Clean
     */
    public function testClean()
    {
        $this->assertEquals("' help", $this->object->clean("<?php echo 'foo' >' help</php?>"));
    } 
         
    /**
     * @covers ezQuery::where
     */
    public function testWhere()
    {
        $this->assertFalse($this->object->where(''));
        $this->assertEmpty($this->object->where());
    }
     
    /**
     * @covers ezQuery::delete
     */
    public function testDelete()
    {
        $this->assertFalse($this->object->delete(''));
        $this->assertFalse($this->object->delete('test_unit_delete',array('good','bad')));
    }
       
    /**
     * @covers ezQuery::selecting
     */
    public function testSelecting()
    {
        $this->assertFalse($this->object->selecting('',''));

        $this->expectException(\Error::class);
        $this->expectExceptionMessageRegExp('/Call to undefined method ezQuery::get_results()/');
        $this->assertNotNull($this->object->selecting('table','columns','WHERE','GROUP BY','HAVING','ORDER BY','LIMIT'));
    }
    
    /**
     * @covers ezQuery::create_select
     */
    public function testCreate_select()
    {
        $this->assertFalse($this->object->create_select('','',''));
    }
    
    /**
     * @covers ezQuery::insert_select
     */
    public function testInsert_select()
    {
        $this->assertFalse($this->object->insert_select('','',''));
    }
    
    /**
     * @covers ezQuery::insert
     */
    public function testInsert()
    {
        $this->assertFalse($this->object->insert('',''));
    }
    
    /**
     * @covers ezQuery::update
     */
    public function testUpdate()
    {
        $this->assertFalse($this->object->update('',''));
        $this->assertFalse($this->object->update('test_unit_delete',array('test_unit_update'=>'date()'),''));
    }
	
    /**
     * @covers ezQuery::replace
     */
    public function testReplace()
    {
        $this->assertFalse($this->object->replace('',''));
    }
    
    /**
     * @covers ezQuery::__construct
     */
    public function test__Construct() {         
        $ezQuery = $this->getMockBuilder(ezQuery::class)
        ->setMethods(null)
        ->disableOriginalConstructor()
        ->getMock();
        
        $this->assertNull($ezQuery->__construct());  
    }
} //

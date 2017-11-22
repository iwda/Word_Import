<?php
namespace Iwda\IwdaWord2digi\Tests\Unit\Domain\Model;

/**
 * Test case.
 *
 * @author David Iwertowski 
 */
class ExampleTest extends \TYPO3\CMS\Core\Tests\UnitTestCase
{
    /**
     * @var \Iwda\IwdaWord2digi\Domain\Model\Example
     */
    protected $subject = null;

    protected function setUp()
    {
        parent::setUp();
        $this->subject = new \Iwda\IwdaWord2digi\Domain\Model\Example();
    }

    protected function tearDown()
    {
        parent::tearDown();
    }

    /**
     * @test
     */
    public function dummyTestToNotLeaveThisFileEmpty()
    {
        self::markTestIncomplete();
    }
}

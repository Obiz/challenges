<?php

namespace Obiz\Challenges\CashMachine;

class CashDistributorTest extends \PHPUnit_Framework_TestCase
{
    public function assertPreConditions()
    {
        $this->assertTrue(
            class_exists(
                $class = 'Obiz\Challenges\CashMachine\CashDistributor'),
            'Class not found: ' . $class
        );

        $this->assertClassHasAttribute('bills', 
            'Obiz\Challenges\CashMachine\CashDistributor');

        $this->assertTrue(
            class_exists(
                $class = 'Obiz\Challenges\CashMachine\InvalidWithdrawException'),
            'Class not found: ' . $class
        );
    }

    public function invalidWithdrawProvider()
    {
        return array(
            array(0),
            array(1),
            array(3),
        );
    }

    public function validWithdrawProvider()
    {
        return array(
            array(4, array(2 => 2)),
        );
    }

    public function testShouldInstantiateWithoutArguments()
    {
        $cashDistributor = new CashDistributor();
        $this->assertInstanceOf(
            'Obiz\Challenges\CashMachine\CashDistributor', $cashDistributor);
    }

    /**
     * @dataProvider validWithdrawProvider
     */
    public function testShouldReturnMinimumAmountBillsForValidWithdraw(
        $withdrawAmount, $expectedBills)
    {
        $cashDistributor = new CashDistributor();
        
        try {
            $returnedBills = 
                $cashDistributor->getMinimalAmountOfBills($withdrawAmount);
        } catch(InvalidWithdrawException $e) {
            $this->fail('Unexpected exception thrown: ' . $e->getMessage());
        }
        
        $this->assertEquals($expectedBills, $returnedBills,
            "Invalid bill distribution for the given value ($withdrawAmount):");
    }

    /**
     * @dataProvider invalidWithdrawProvider
     * @expectedException Obiz\Challenges\CashMachine\InvalidWithdrawException
     */
    public function testShouldThrowExceptionForInvalidWithdraw()
    {

    }
}
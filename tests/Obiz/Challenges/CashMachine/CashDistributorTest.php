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

        $this->assertClassHasAttribute('availableBills', 
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
            array(2, array(2 => 1)),
            array(4, array(2 => 2)),
            array(7, array(5 => 1, 2 => 1)),
            array(9, array(5 => 1, 2 => 2)),
            array(11, array(5 => 1, 2 => 3)),
            array(13, array(5 => 1, 2 => 4)),
            array(23, array(10 => 1, 5 => 1, 2 => 4)),
        );
    }

    public function testShouldInstantiateWithoutArguments()
    {
        $cashDistributor = new CashDistributor();
        $this->assertInstanceOf(
            'Obiz\Challenges\CashMachine\CashDistributor', $cashDistributor);
    }

    /**
     * @dataProvider invalidWithdrawProvider
     * @expectedException Obiz\Challenges\CashMachine\InvalidWithdrawException
     */
    public function testShouldThrowExceptionForInvalidWithdraw($withdrawAmount)
    {
        $cashDistributor = new CashDistributor();
        $returnedBills = $cashDistributor->getMinimalAmountOfBills($withdrawAmount);
    }

    /**
     * @dataProvider validWithdrawProvider
     */
    public function testShouldReturnMinimumAmountOfBillsForValidWithdraw(
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
}
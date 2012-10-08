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
            array(6, array(2 => 3)),
            array(7, array(5 => 1, 2 => 1)),
            array(8, array(2 => 4)),
            array(9, array(5 => 1, 2 => 2)),
            array(12, array(10 => 1, 2 => 1)),
            array(13, array(5 => 1, 2 => 4)),
            array(20, array(20 => 1)),
            array(22, array(20 => 1, 2 => 1)),
            array(25, array(20 => 1, 5 => 1)),
            array(26, array(20 => 1, 2 => 3)),
            array(36, array(20 => 1, 10 => 1, 2 => 3)),
            array(50, array(50 => 1)),
            array(52, array(50 => 1, 2 => 1)),
            array(53, array(20 => 2, 5 => 1, 2 => 4)),
            array(54, array(50 => 1, 2 => 2)),
            array(55, array(50 => 1, 5 => 1)),
            array(51, array(20 => 2, 5 => 1, 2 => 3)),
            array(70, array(50 => 1, 20 => 1)),
            array(96, array(50 => 1, 20 => 2, 2 => 3)),
            array(102, array(100 => 1, 2 => 1)),
            array(103, array(50 => 1, 20 => 2, 5 => 1, 2 => 4)),
            array(105, array(100 => 1, 5 => 1)),
            array(120, array(100 => 1, 20 => 1)),
            array(132, array(100 => 1, 20 => 1, 10 => 1, 2 => 1)),
            array(178, array(100 => 1, 50 => 1, 20 => 1, 2 => 4)),
            array(252, array(100 => 2, 50 => 1, 2 => 1)),
            array(296, array(100 => 2, 50 => 1, 20 => 2, 2 => 3)),
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
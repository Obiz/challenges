<?php

namespace Obiz\Challenges\CashMachine;

class CashDistributorTest extends \PHPUnit\Framework\TestCase
{
    public function assertPreConditions(): void
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
     */
    public function testShouldThrowExceptionForInvalidWithdraw($withdrawAmount)
    {
        $cashDistributor = new CashDistributor();
        $this->expectException(InvalidWithdrawException::class);
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

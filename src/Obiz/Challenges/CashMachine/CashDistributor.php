<?php

namespace Obiz\Challenges\CashMachine;

class CashDistributor
{
    /**
     * @var array
     */
    private $availableBills = array(2, 5, 10, 20, 50, 100);
     
    /**
     * Returns the bills that should be distributed for a given withdraw amount and available bills,
     * MINIMIZING the total number of distributed bills.
     * Ex: getBills(72) => array(50 => 1, 20 => 1, 2 => 1).
     *
     * @param int $withdrawAmount How much we want to withdraw from the cash distributor
     * @throws InvalidWithdrawException if the exact amount cannot be gathered with the available bills.
     * @return array Associative array representing the bills that should be distributed by the cash machine.
     */
    public function getMinimalAmountOfBills($withdrawAmount)
    {
        // Write your code here. Feel free to create any other functions or classes you need.
    }
}

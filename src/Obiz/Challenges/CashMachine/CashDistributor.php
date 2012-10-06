<?php 

namespace Obiz\Challenges\CashMachine;

class CashDistributor
{
	private $bills = array(2, 5, 10, 20, 50, 100);

	/**
	 * 
	 * 
	 * @param int The withdraw amount
	 * @throws InvalidWithdrawException For invalid withdraw amounts
	 * @return array The bill distribution for the given valid withdraw value
	 */
	public function getMinimalAmountOfBills($withdrawAmount)
	{
	}
}
<?php
namespace Fp\Payment\CheckBundle\Plugin;

use JMS\Payment\CoreBundle\Plugin\AbstractPlugin;
use JMS\Payment\CoreBundle\Model\FinancialTransactionInterface;

class CheckPlugin extends AbstractPlugin
{
    public function approve(FinancialTransactionInterface $transaction, $retry)
    {
        $this->deposit($transaction, $retry);
    }

    public function approveAndDeposit(FinancialTransactionInterface $transaction, $retry)
    {
        $this->deposit($transaction, $retry);
    }

    public function deposit(FinancialTransactionInterface $transaction, $retry)
    {
        $transaction->setProcessedAmount($transaction->getRequestedAmount());
        $transaction->setResponseCode(self::RESPONSE_CODE_SUCCESS);
        $transaction->setReasonCode(self::REASON_CODE_SUCCESS);
    }

    public function processes($paymentSystemName)
    {
        return 'check_payment' === $paymentSystemName;
    }

    public function isIndependentCreditSupported()
    {
        return false;
    }
}
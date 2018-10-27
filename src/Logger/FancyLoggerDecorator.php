<?php declare(strict_types=1);

namespace App\Logger;

use Psr\Log\LoggerInterface;

class FancyLoggerDecorator implements LoggerInterface
{
    /**
     * @var LoggerInterface
     */
    private $decoratedLogger;

    public function __construct(LoggerInterface $decoratedLogger)
    {
        $this->decoratedLogger = $decoratedLogger;
    }


    public function emergency($message, array $context = [])
    {
        $this->decoratedLogger->emergency('🆘 ' . $message, $context);
    }

    public function alert($message, array $context = [])
    {
        $this->decoratedLogger->alert('🚨 ' . $message, $context);
    }

    public function critical($message, array $context = [])
    {
        $this->decoratedLogger->critical('🛑 ' . $message, $context);
    }

    public function error($message, array $context = [])
    {
        $this->decoratedLogger->error('❌ ' . $message, $context);
    }

    public function warning($message, array $context = [])
    {
        $this->decoratedLogger->warning('⚠️ ' . $message, $context);
    }

    public function notice($message, array $context = [])
    {
        $this->decoratedLogger->notice('📝 ' . $message, $context);
    }

    public function info($message, array $context = [])
    {
        $this->decoratedLogger->info('ℹ️ ' . $message, $context);
    }

    public function debug($message, array $context = [])
    {
        $this->decoratedLogger->debug('🤖 ' . $message, $context);
    }

    public function log($level, $message, array $context = [])
    {
        $this->decoratedLogger->log($level, $message, $context);
    }
}
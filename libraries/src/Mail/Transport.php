<?php

namespace Swift\Mail;

use Swift\Mail\Exception\InvalidArgumentException;
use Symfony\Component\Mailer\Mailer as SymfonyMailer;
use Symfony\Component\Mailer\Transport\Dsn;
use Symfony\Component\Mailer\Transport\TransportInterface;

/**
 * Class Transport
 * @package Swift\Mail
 */
class Transport
{
    /**
     * Symfony transport instance or its array configuration.
     * @var TransportInterface|array
     */
    private $_transport = [];

    /**
     * @var SymfonyMailer|null
     */
    private ?SymfonyMailer $symfonyMailer = null;

    /**
     * Creates Symfony mailer instance.
     * @return SymfonyMailer mailer instance.
     */
    private function createSymfonyMailer(): SymfonyMailer
    {
        return new SymfonyMailer($this->getTransport());
    }

    /**
     * @return SymfonyMailer Swift mailer instance
     */
    public function getSymfonyMailer(): SymfonyMailer
    {
        if (!is_object($this->symfonyMailer)) {
            $this->symfonyMailer = $this->createSymfonyMailer();
        }
        return $this->symfonyMailer;
    }

    /**
     * @return TransportInterface
     */
    public function getTransport(): TransportInterface
    {
        if (!is_object($this->_transport)) {
            $this->_transport = $this->createTransport($this->_transport);
        }
        return $this->_transport;
    }

    /**
     * @param array|TransportInterface $transport
     * @throws InvalidArgumentException on invalid argument.
     */
    public function setTransport($transport): void
    {
        if (!is_array($transport) && !$transport instanceof TransportInterface) {
            throw new InvalidArgumentException('"' . get_class($this) . '::transport" should be either object or array, "' . gettype($transport) . '" given.');
        }
        if ($transport instanceof TransportInterface) {
            $this->_transport = $transport;
        } elseif (is_array($transport)) {
            $this->_transport = $this->createTransport($transport);
        }

        $this->symfonyMailer = null;
    }

    private function createTransport(array $config = []): TransportInterface
    {
        $config = array_merge(config('mail'), $config);
        $defaultFactories = \Symfony\Component\Mailer\Transport::getDefaultFactories(null, null, null);
        $transportObj = new \Symfony\Component\Mailer\Transport($defaultFactories);

        if (array_key_exists('dsn', $config)) {
            $transport = $transportObj->fromString($config['dsn']);
        } elseif (array_key_exists('scheme', $config) && array_key_exists('host', $config)) {
            $dsn = new Dsn(
                $config['scheme'],
                $config['host'],
                $config['username'] ?? '',
                $config['password'] ?? '',
                $config['port'] ?? '',
                $config['options'] ?? [],
            );
            $transport = $transportObj->fromDsnObject($dsn);
        } else {
            throw new InvalidArgumentException('Transport configuration array must contain either "dsn", or "scheme" and "host" keys.');
        }
        return $transport;
    }
}

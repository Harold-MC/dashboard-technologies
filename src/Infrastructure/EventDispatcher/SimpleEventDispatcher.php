<?php

namespace App\Infrastructure\EventDispatcher;

use App\Application\EventDispatcherInterface;
use App\Domain\Event\DomainEvent;

class SimpleEventDispatcher implements EventDispatcherInterface
{
    private array $listeners = [];

    public function __construct(array $listeners = [])
    {
        $this->listeners = $listeners;
    }

    public function dispatch(DomainEvent $event): void
    {
        foreach ($this->listeners as $listener) {
            $listener->handle($event);
        }
    }
}

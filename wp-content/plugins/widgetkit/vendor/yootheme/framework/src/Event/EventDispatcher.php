<?php

namespace YOOtheme\Framework\Event;

class EventDispatcher
{
    /**
     * @var callable[]
     */
    protected $listeners = array();

    /**
     * @var string[]
     */
    protected $sorted = array();

    /**
     * @var string
     */
    protected $event = 'YOOtheme\Framework\Event\Event';

    /**
     * Adds an event listener.
     *
     * @param string   $event
     * @param callable $listener
     * @param int      $priority
     */
    public function on($event, $listener, $priority = 0)
    {
        $this->listeners[$event][$priority][] = $listener;
        unset($this->sorted[$event]);
    }

    /**
     * Triggers an event.
     *
     * @param  string $event
     * @param  array  $arguments
     * @return Event
     */
    public function trigger($event, array $arguments = array())
    {
        if (is_string($event)) {
            $e = new $this->event($event);
        } elseif (is_a($event, $this->event)) {
            $e = $event;
        } else {
            throw new \RuntimeException(sprintf('Event must be an instance of "%s"', $this->event));
        }

        array_unshift($arguments, $e);

        foreach ($this->listeners($e->getName()) as $listener) {

            call_user_func_array($listener, $arguments);

            if ($e->isPropagationStopped()) {
                break;
            }
        }

        return $e;
    }

    /**
     * Gets all listeners of an event.
     *
     * @param  string $event
     * @return array
     */
    public function listeners($event)
    {
        return isset($this->sorted[$event]) ? $this->sorted[$event] : $this->sortListeners($event);
    }

    /**
     * Removes a listener.
     *
     * @param string   $event
     * @param callable $listener
     */
    public function removeListener($event, $listener)
    {
        if (!isset($this->listeners[$event])) {
            return;
        }

        foreach ($this->listeners[$event] as $priority => $listeners) {
            if (false !== ($key = array_search($listener, $listeners, true))) {
                unset($this->listeners[$event][$priority][$key], $this->sorted[$event]);
            }
        }
    }

    /**
     * Removes all listeners of an event.
     *
     * @param string $event
     */
    public function removeAllListeners($event = null)
    {
        if ($event !== null) {
            unset($this->listeners[$event]);
        } else {
            $this->listeners = array();
        }
    }

    /**
     * Adds an event subscriber.
     *
     * @param EventSubscriberInterface $subscriber
     */
    public function addSubscriber(EventSubscriberInterface $subscriber)
    {
        foreach ($subscriber->getSubscribedEvents() as $event => $params) {
            if (is_string($params)) {
                $this->on($event, array($subscriber, $params));
            } elseif (is_string($params[0])) {
                $this->on($event, array($subscriber, $params[0]), isset($params[1]) ? $params[1] : 0);
            } else {
                foreach ($params as $listener) {
                    $this->on($event, array($subscriber, $listener[0]), isset($listener[1]) ? $listener[1] : 0);
                }
            }
        }
    }

    /**
     * Removes an event subscriber.
     *
     * @param EventSubscriberInterface $subscriber
     */
    public function removeSubscriber(EventSubscriberInterface $subscriber)
    {
        foreach ($subscriber->getSubscribedEvents() as $event => $params) {
            if (is_array($params) && is_array($params[0])) {
                foreach ($params as $listener) {
                    $this->removeListener($event, array($subscriber, $listener[0]));
                }
            } else {
                $this->removeListener($event, array($subscriber, is_string($params) ? $params : $params[0]));
            }
        }
    }

    /**
     * Sorts all listeners of an event by their priority.
     *
     * @param  string $event
     * @return array
     */
    protected function sortListeners($event)
    {
        $sorted = array();

        if (isset($this->listeners[$event])) {
            krsort($this->listeners[$event]);
            $sorted = call_user_func_array('array_merge', $this->listeners[$event]);
        }

        return $this->sorted[$event] = $sorted;
    }
}

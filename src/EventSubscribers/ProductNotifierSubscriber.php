<?php
/**
 *  * Created by PhpStorm.
 * User: Tomasz Żewłakow <zewlak@gmail.com>
 * Date: 15.02.2018
 * Time: 17:20
 */

namespace App\EventSubscribers;

use App\Events\ProductCreatedEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Class used to send products notification emails.
 *
 * @author Tomasz Żewłakow <zewlak@gmail.com>
 */
class ProductNotifierSubscriber implements EventSubscriberInterface
{
    /**
     * Mailer.
     *
     * @var \Swift_Mailer
     */
    private $mailer;

    /**
     * Twig.
     *
     * @var \Twig_Environment
     */
    private $twig;

    /**
     * Recipients to notify after product creation.
     *
     * @var array
     */
    private $newProductRecipients = ['fake@example.com'];

    /**
     * ProductNotifierSubscriber constructor.
     *
     * @param \Swift_Mailer $mailer
     */
    public function __construct(\Twig_Environment $twig, \Swift_Mailer $mailer)
    {
        $this->twig = $twig;
        $this->mailer = $mailer;
    }

    /**
     * Returns an array of event names this subscriber wants to listen to.
     *
     * @return array The event names to listen to
     */
    public static function getSubscribedEvents(): array
    {
        return [
            ProductCreatedEvent::NAME => 'onProductCreated'
        ];
    }

    /**
     * Triggered on ProductCreatedEvent.
     *
     * @param ProductCreatedEvent $productCreatedEvent
     */
    public function onProductCreated(ProductCreatedEvent $productCreatedEvent): void
    {
        $message = (new \Swift_Message('New product notification!'))
            ->setFrom('send@example.com') //@todo consider moving to swiftmailer.yaml
            ->setTo($this->newProductRecipients)
            ->setBody(
                $this->twig->render(
                    'emails/product.created.notification.html.twig',
                    array('name' => $productCreatedEvent->getProduct()->getName())
                ),
                'text/html'
            )
        ;

        $this->mailer->send($message);
    }
}

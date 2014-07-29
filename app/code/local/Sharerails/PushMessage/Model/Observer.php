<?php
/**
 * Created by PhpStorm.
 * User: jzheng
 * Date: 25/07/14
 * Time: 4:12 PM
 */

class Sharerails_PushMessage_Model_Observer{
    public function pushMessage($observer){
        $event = $observer->getEvent();// fetch the current event
        $product = $event->getProduct();
        $url = $product->getProductUrl();
        $customerName = "Guest";
        $session = Mage::getSingleton('customer/session');
        if($session->isLoggedIn()) {
            $customer = $session->getCustomer();
            $customerName = $customer->getName();
            //$customer->getFirstname();
        }
        $eventmsg = "<a href='$url' title='click to enter the product details page'><strong>".$customerName. "</strong> currently added product: ". $product->getName()."</a>";

        //add custom message to shopping cart
        Mage::getSingleton("checkout/session")->addSuccess($eventmsg);
        //Custom Logic Here
        // print_r($product);
    }
}
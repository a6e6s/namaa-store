<?php

class Cart extends Model
{
    public $items = [];
    public $totalQty;
    public $totalPrice;

    public function __Construct($cart = null)
    {
        parent::__construct('cart');

        if ($cart) {

            $this->items = $cart->items;
            $this->totalQty = $cart->totalQty;
            $this->totalPrice = $cart->totalPrice;
        } else {

            $this->items = [];
            $this->totalQty = 0;
            $this->totalPrice = 0;
        }
    }

    public function add($project)
    {
        // dd($_SESSION);

        if (isset($_SESSION['cart'])) {
            // if there is a session update it
            if (array_key_exists($project->project_id, $_SESSION['cart']['items'])) {
                dd($_SESSION['cart']['items'][$project->project_id]['donation_type']);
                // if the same project with same type is added
                if (!in_array($_POST['donation_type'], $_SESSION['cart']['items'][$project->project_id]['donation_type'])) {
                    // if the same project with different type is added add new type
                    $item[$project->project_id] = [
                        'name' => $project->name,
                        'amount' => $_POST['amount'],
                        'quantity' => $_SESSION['cart']['items'][$project->project_id]['quantity'] +1 ,
                        'donation_type'=> [ $_SESSION['cart']['items'][$project->project_id]['donation_type'],$_POST['donation_type']]
                    ];
                }else{
                    $item[$project->project_id] = [
                        'name' => $project->name,
                        'amount' => $_POST['amount'],
                        'quantity' => $_SESSION['cart']['items'][$project->project_id]['quantity'] +1 ,
                        'donation_type'=> [ $_SESSION['cart']['items'][$project->project_id]['donation_type']]
                    ];
                }
                $_SESSION['cart']['items'] = $item;
                $_SESSION['cart']['total'] += 1;

            } else {
                $item[$project->project_id] = [
                    'name' => $project->name,
                    'amount' => $_POST['amount'],
                    'quantity' => 1,
                    'donation_type'=>[ $_POST['donation_type']]
                ];
                $_SESSION['cart']['items'] = $item;
                $_SESSION['cart']['total'] += 1;
            }

        } else {
            $item[$project->project_id] = [
                'name' => $project->name,
                'amount' => $_POST['amount'],
                'quantity' => 1,
                'donation_type'=>[ $_POST['donation_type']]
            ];
            //if no cart on the session create clean cart object to store project
            $_SESSION['cart']['items'] = $item;
            $_SESSION['cart']['total'] = 1;

        }

    }

    public function remove($id)
    {

        if (array_key_exists($id, $this->items)) {
            $this->totalQty -= $this->items[$id]['qty'];
            $this->totalPrice -= $this->items[$id]['qty'] * $this->items[$id]['price'];
            unset($this->items[$id]);

        }

    }

    public function updateQty($id, $qty)
    {

        //reset qty and price in the cart ,
        $this->totalQty -= $this->items[$id]['qty'];
        $this->totalPrice -= $this->items[$id]['price'] * $this->items[$id]['qty'];
        // add the item with new qty
        $this->items[$id]['qty'] = $qty;

        // total price and total qty in cart
        $this->totalQty += $qty;
        $this->totalPrice += $this->items[$id]['price'] * $qty;

    }

}

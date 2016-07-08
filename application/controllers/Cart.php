<?php

class Cart extends Frontend_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('cart_m');
        $this->load->model('cartitem_m');
        $this->load->model('sale_m');
        $this->load->model('saleitem_m');
        $this->load->library('session');
        $this->email = $this->session->userdata('email');
    }

    // Retorna el carrito del usuario logeado
    function get() {
        $cart = getCopy($this->cart_m->get($this->email, false));
        if ($cart !== NULL) {
            $cart->items = $this->cartitem_m->getItems($this->email);
            echo json_encode($cart);
        }
    }

    // Agrega un item al carrito del usuario logeado, si el item ya existe actualiza la cantidad
    function addItem($productid, $quantity) {
//        $productid = $this->input->get('productid');
//        $quantity = $this->input->get('quantity');
        $item = $this->cartitem_m->get_by(array(
            'email' => $this->email,
            'productid' => $productid,
                ), TRUE);

        if ($item) {
            $email = $this->email;
            $this->db->where('productid', $productid);
            $data['quantity'] = $item->quantity + $quantity;
        } else {
            $email = null;
            $data['email'] = $this->email;
            $data['productid'] = $productid;
            $data['quantity'] = $quantity;
        }

        $this->cartitem_m->save($data, $email);
    }

    // se modifica el item del carrito del usuario logeado
    function modifyItem($productid, $quantity) {
        $this->db->where('productid', $productid);
        $data['quantity'] = $quantity;
        $this->cartitem_m->save($data, $this->email);
    }

    // Elimina un item del carrito del usuario logeado
    function removeItem($productid) {
        $this->db->where('productid', $productid);
        $this->cartitem_m->delete($this->email);
    }

    // Cancela el carrito del usuario logeado, esto elimina todos los items agregados
    // No elimina el cabezal este se guarda para futuros carritos.
    function cancel() {
        $this->cartitem_m->delete($this->email);
    }

    // Confirma el carrito del usuario logeado, esto genera la compra, con los items 
    // del carrito y los elimina del mismo
    function confirm() {
        $cart = $this->cart_m->get($this->email, false);
        $items = $this->cartitem_m->getItems($this->email);
        if (count($items)) {
            $data['email'] = $cart->email;
            $data['address'] = $cart->address;
            $data['createDate'] = date('y-m-d H:i:s');
//        $data['shippingDate'] = '';
            $data['status'] = 'P';
            $id = $this->sale_m->save($data, NULL);
            unset($data);

            foreach ($items as $item) {
                $data['id'] = $id;
                $data['productid'] = $item->prodid;
                $data['quantity'] = $item->quantity;
                $data['productprice'] = $item->prodprecio;
                $this->saleitem_m->save($data, NULL);
            }
            $this->cancel();
        }
    }

}

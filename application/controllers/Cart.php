<?php

class Cart extends Frontend_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('user_m');
        $this->load->model('cart_m');
        $this->load->model('cartitem_m');
        $this->load->model('sale_m');
        $this->load->model('saleitem_m');
        $this->load->library('session');
        $this->email = $this->session->userdata('email');
    }
    function register() {
        $data = $this->user_m->array_from_post(array('email', 'name', 'password', 'phone', 'address'));       
        $data['type'] = 'C';
        
        $user = $this->user_m->get(['email'=>$data['email']]);
        if ($user) {
            $return = array('msg' => false);            
        } else {
            $data['password'] = $this->user_m->hash($data['password']);
            $this->user_m->save($data, NULL);

            $return = array('msg' => true);
        }
        echo json_encode($return);
    }

    function login() {
        if ($this->user_m->login() == TRUE) {
            $return = array('msg' => true);
        } else {
            $return = array('msg' => false);
        }
        echo json_encode($return);
    }
    function islogged() {
        $return = array('msg' => $this->user_m->loggedin());
        echo json_encode($return);
    }
    function logout() {
        $this->user_m->logout();
    }
    // Retorna el carrito del usuario logeado
    function get() {
        $cart = getCopy($this->cart_m->get(['cart.email'=>$this->email], true));
        if ($cart !== NULL) {
            $cart->items = $this->cartitem_m->getItems($this->email);
            echo json_encode($cart);
        }
    }

    // Agrega un item al carrito del usuario logeado, si el item ya existe actualiza la cantidad
    function addItem() {
        $productid = $this->input->post('productid');
        $quantity = $this->input->post('quantity');
        $item = $this->cartitem_m->get(array(
            'email' => $this->email,
            'productid' => $productid,
                ), TRUE);

        if ($item) {
            $where = ['email' => $this->email, 'productid' => $productid];
            $data['quantity'] = $item->quantity + $quantity;
        } else {
            $where = NULL;
            $data['email'] = $this->email;
            $data['productid'] = $productid;
            $data['quantity'] = $quantity;
        }

        $this->cartitem_m->save($data, $where);
    }

    // se modifica el item del carrito del usuario logeado
    function modifyItem() {
        $productid = $this->input->post('productid');
        $quantity = $this->input->post('quantity');
        $where = ['email' => $this->email, 'productid' => $productid];
        $data['quantity'] = $quantity;
        $this->cartitem_m->save($data, $where);
    }

    // Elimina un item del carrito del usuario logeado
    function removeItem() {
        $productid = $this->input->post('productid');
        $where = ['email' => $this->email, 'productid' => $productid];
        $this->cartitem_m->delete($where);
    }

    // Cancela el carrito del usuario logeado, esto elimina todos los items agregados
    // No elimina el cabezal este se guarda para futuros carritos.
    function cancel() {
        $this->cartitem_m->delete(['email' => $this->email]);
    }

    // Confirma el carrito del usuario logeado, esto genera la compra, con los items 
    // del carrito y los elimina del mismo
    function confirm() {
        $cart = $this->cart_m->get(['email' => $this->email], false);
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

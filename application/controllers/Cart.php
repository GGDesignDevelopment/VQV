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
            
            $cart['email'] = $data['email'];
            $cart['address'] = $data['address'];
            
            $this->cart_m->save($cart,NULL);
                   
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
    function updateAddress() {
        $data['address'] = $this->input->post('address');
        $this->user_m->save($data, ['email' => $this->email]);
    }
    // Agrega un item al carrito del usuario logeado, si el item ya existe actualiza la cantidad
    function addItem() {
        $productid = $this->input->post('productid');
        $quantity = $this->input->post('quantity');
        $envase = $this->input->post('envase');
        
        $item = $this->cartitem_m->get(array(
            'email' => $this->email,
            'productid' => $productid,
                ), TRUE);

        if ($item) {
            $where = ['email' => $this->email, 'productid' => $productid];
            $data['quantity'] = $item->quantity + $quantity;     
            $data['envase'] = $envase;
        } else {
            $where = NULL;
            $data['email'] = $this->email;
            $data['productid'] = $productid;
            $data['quantity'] = $quantity;
            $data['envase'] = $envase;
        }

        $this->cartitem_m->save($data, $where);
    }

    // se modifica el item del carrito del usuario logeado
    function modifyItem($productid,$quantity) {
//        $productid = $this->input->post('productid');
//        $quantity = $this->input->post('quantity');
        $where = ['email' => $this->email, 'productid' => $productid];
        $data['quantity'] = $quantity;
        $this->cartitem_m->save($data, $where);
    }

    // Elimina un item del carrito del usuario logeado
    function removeItem($productid) {
//        $productid = $this->input->post('productid');
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
        $cart = $this->cart_m->get(['cart.email' => $this->email], true);
        $items = $this->cartitem_m->getItems($this->email);
        $fp = $this->input->post('formapago');
        
        if (count($items)) {
            $data['email'] = $this->email;
            $data['address'] = $cart->address;
            $data['createDate'] = date('y-m-d H:i:s');
//        $data['shippingDate'] = '';
            $data['status'] = 'P';
            $data['payment'] = $fp;
            $id = $this->sale_m->save($data, NULL);
            unset($data);

            foreach ($items as $item) {
                $data['id'] = $id;
                $data['productid'] = $item->prodid;
                $data['quantity'] = $item->quantity;
                $data['productprice'] = $item->prodprecio;
                $data['envase'] = $item->envase;
                $this->saleitem_m->save($data, NULL);
            }
            
            $to = $this->email;
            $from = "info@vqv.hol.es";
            $headers = "From: " . $from . "\r\n";
            $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
            $subject = "Compra exitosa, #" . $id;
            $body = "<html><body>";
            $body .= "<h1>Gracias por preferirnos</h1>
                     <p>En breve nos comunicaremos con usted para coordinar la entrega.</p>
                     <h4>Atte. El equipo de VQV</h4>";
            $body .= "</body></html>";

            try {
                mail($to, $subject, $body, $headers, "-f " . $from) ;    
            } finally  {

            }            
            $this->cancel();
        }
    }

}

<?php

class Sale extends Admin_Controller {

    function __construct() {
        parent::__construct();
    }

    function index() {
        $where = ['status' => 'P', 'shippingDate <=' => date('y-m-d H:i')];
        $this->data['sales'] = $this->sale_m->get($where);
        $this->data['scripts'][] = '<script type="text/javascript" src="' . site_url('js/admin/sale.js') . '"></script>';
        $this->data['subview'] = 'admin/sale/index';
        $this->load->view('admin/_layout_main', $this->data);
    }

    function edit($id = NULL) {
        if ($id) {
            $this->data['scripts'][] = '<script type="text/javascript" src="' . site_url('js/admin/sale.js') . '"></script>';            
            $this->data['sale'] = $this->sale_m->get(['id' => $id], TRUE);
            count($this->data['sale']) || $this->data['errores'][] = 'Venta no encontrada';
//            $where = ['id' => $id];   
            $this->data['estados'] = get_status();
            $this->data['productos'] = $this->saleitem_m->get(['id' => $id]);
            $this->data['subview'] = 'admin/sale/edit';
            $this->load->view('admin/_layout_main', $this->data);
        } else {
            redirect('admin/sale');
        }
    }

    function search() {
        $email = $this->input->get('email');
        $status = $this->input->get('status');
        $fecha = $this->input->get('fecha');
        $where = ['email like' => '%' . $email . '%','status'=>$status, 'shippingDate <=' => $fecha];
        $sales = $this->sale_m->get($where, FALSE);

        if (count($sales)): foreach ($sales as $sale):
                echo '<tr>';
                echo '<td>' . anchor('admin/sale/edit/' . $sale->id, $sale->id) . '</td>';
                echo '<td>' . $sale->email . '</td>';
                echo '<td>' . $sale->address . '</td>';
                echo '<td>' . $sale->shippingDate . '</td>';
                echo '<td>' . get_status($sale->status) . '</td>';
                echo '<td>' . btn_edit('admin/sale/edit/' . $sale->id) . '</td>';
                echo '<td>' . btn_delete('admin/sale/delete/' . $sale->id) . '</td>';
                echo '</tr>';
            endforeach;
        else:
            echo '<tr>';
            echo '<td colspan=7>No se encontraron sales para estos filtros</td>';
            echo '</tr>';
        endif;
    }

    function save($id) {
        $data = $this->sale_m->array_from_post(array('status','shippingDate'));
        $this->sale_m->save($data, ['id'=>$id]);
        redirect('admin/sale');
    }

}

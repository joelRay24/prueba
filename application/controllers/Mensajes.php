<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mensajes extends CI_Controller {
    #===============================================
    function __construct() {
        parent::__construct();
        $this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->model('mensaje');
    }
    #===============================================
    public function index(){
        $data = array();
		


		$data['mensajes'] = $this->mensaje->getRows();
		$data['titulo'] = 'Mensajes archivados';
		$data['pie'] = 'vamos avanzando';
		
        $this->load->view('templates/header', $data);
        $this->load->view('mensajes/index', $data);
        $this->load->view('templates/footer',$data);
    }
	
	#===============================================
	public function ver($id){
		$data = array();
		
		if(!empty($id)){
			$data['mensaje'] = $this->mensaje->getRows($id);
			$data['titulo'] = $data['mensaje']['titulo'];
			
			$this->load->view('templates/header', $data);
			$this->load->view('mensajes/ver', $data);
			$this->load->view('templates/footer');
		}else{
			redirect('/mensajes');
		}
	}
	#===============================================
	public function agregar(){
        $data = array();
        $mensajeData = array();
		
        if($this->input->post('mensajeSubmit')){
			//---------------
			# solo se ejecutan cuando llegas aqui por presionar el boton enviar (submit) del formulario.
            $this->form_validation->set_rules('titulo', 'mensaje titulo', 'required');
            $this->form_validation->set_rules('contenido', 'mensaje contenido', 'required');
			
            $mensajeData = array(
                'titulo' => $this->input->post('titulo'),
                'contenido' => $this->input->post('contenido')
            );

            if($this->form_validation->run() == true){
                $insert = $this->mensaje->insert($mensajeData);

                if($insert){
                    $this->session->set_userdata('success_msg', 'Mensaje agregado.');
                    redirect('/mensajes');
                }else{
                    $data['error_msg'] = 'Mensaje NO agregado.';
                }
            }
			//---------------
        }
		
        $data['mensaje'] = $mensajeData;
		$data['titulo'] = 'Crear Mensaje';
		$data['accion'] = 'Agregandoooo ';

        $this->load->view('templates/header', $data);
        $this->load->view('mensajes/agregar-editar', $data);
        $this->load->view('templates/footer');
    }
	#===============================================
    public function editar($id){
        $data = array();
		
		$mensajeData = $this->mensaje->getRows($id);
		
        if($this->input->post('mensajeSubmit')){
			$this->form_validation->set_rules('titulo', 'mensaje titulo', 'required');
            $this->form_validation->set_rules('contenido', 'mensaje contenido', 'required');
			
			$mensajeData = array(
                'titulo' => $this->input->post('titulo'),
                'contenido' => $this->input->post('contenido')
            );
			
            if($this->form_validation->run() == true){
                $update = $this->mensaje->update($mensajeData, $id);

                if($update){
                    $this->session->set_userdata('success_msg', 'Mensaje actualizado.');
                    redirect('/mensajes');
                }else{
                    $data['error_msg'] = 'Mensaje NO actualizado.';
                }
            }
        }
		
        $data['mensaje'] = $mensajeData;
		$data['titulo'] = 'Actualizar Mensaje';
		$data['accion'] = 'Editandoooooooooooo ';
		
        $this->load->view('templates/header', $data);
        $this->load->view('mensajes/agregar-editar', $data);
        $this->load->view('templates/footer');
    }
	
	#===============================================
	public function borrar($id){
		if($id){
			$delete = $this->mensaje->delete($id);
			
			if($delete){
				$this->session->set_userdata('success_msg', 'Mensaje borrado.');
			}else{
				$this->session->set_userdata('error_msg', 'No se pudo borrar.');
			}
		}
		redirect('/mensajes');
	}
}

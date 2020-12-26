<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public $lengkap = '';

	public function __construct()
	{
		parent::__construct();
		//Do your magic here

		date_default_timezone_set('Asia/Jakarta');

		if( ! is_null($this->session->userdata('ci_userid')) ){
			$this->lengkap = $this->db->where('jamaah_id', $this->session->userdata('ci_userid'))->get('jamaah')->row()->jamaah_status;
		}
	}

	public function setAlert($type, $msg)
	{
		return $this->session->set_flashdata('alert', '<div class="alert alert-'.$type.' alert-dismissible fade show" role="alert">
	        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
	            <span aria-hidden="true">×</span>
	        </button>
	        '.$msg.'
	    </div>');
	}

	public function have_session()
	{
		if ( ! $this->session->userdata('ci_userid') ) {

			$this->setAlert('warning','Silahkan login ');

			redirect( base_url().'welcome/login' );
		}
	}
	
	public function index()
	{
		$data['title'] = 'Home';

		$data['init']  = $this->load->view('jamaah/home', $data, true);

		$this->load->view('jamaah/init', $data, false);
	}

	public function login()
	{
		$data['title'] = 'Login';
		$this->load->view('jamaah/login', $data, false);
	}

	public function checking()
	{
		$email    = $this->input->post('email');
		$password = $this->input->post('password');

		$object = array(
			'jamaah_email'    => $email , 
			'jamaah_password' => md5($password)
		);

		$sql = $this->db->where_in('jamaah_status','aktif')->or_where_in('jamaah_status','lengkap')->where($object)->get('jamaah');

		if ($sql->num_rows() == 1 ) 
		{
			$row = $sql->row();

			$array = array(
				'ci_userid'   => $row->jamaah_id,
				'ci_username' => $row->jamaah_nama
			);
			
			$this->session->set_userdata( $array );

			redirect( base_url().'welcome' );
		}
		else
		{
			$this->setAlert('warning','Login Gagal');

			redirect( base_url().'welcome/login' );
		}
	}

	public function logout()
	{
		$this->have_session();

		$this->session->sess_destroy();

		redirect( base_url().'welcome/login' );
	}

	public function daftar()
	{
		$data['title'] = 'Daftar';
		$this->load->view('jamaah/daftar', $data, false);
	}

	public function registrasi()
	{
		$nama     = $this->input->post('nama');
		$email    = $this->input->post('email');
		$password = md5($this->input->post('password'));

		$a = $this->input->post('a');
		$b = $this->input->post('b');
		$c = $this->input->post('c');

		if( ($a + $b) != $c )
		{
			$this->setAlert('warning','Jawaban Tidak sesuai');
			redirect($this->input->server('HTTP_REFERER'));
			die;
		}

		$object = array(
			'jamaah_email'          => $email , 
			'jamaah_password'       => $password , 
			'jamaah_nama'           => $nama ,
			'jamaah_status'         => 'baru' ,
			'jamaah_tanggal_tambah' => date('Y-m-d H:i:s')
		);

		if( $this->db->where('jamaah_email', $email)->get('jamaah')->num_rows() != 0 )
		{
			$this->setAlert('warning','Email telah didaftarkan');
			redirect($this->input->server('HTTP_REFERER'));
			die;
		}

		if( $this->db->insert('jamaah', $object) )
		{
			$link = base_url().'welcome/konfirmasi?u='.base64_encode($email).'';
			$this->setAlert('success','Berhasil mendaftar silahkan konfirmasi email pendaftaran anda <a href='.$link.'>DI SINI</a> ');
		}
		else{
			$this->setAlert('warning','Gagal mendaftar silahkan mencoba kembali');
		}

		redirect($this->input->server('HTTP_REFERER'));
	}

	public function konfirmasi()
	{
		$email = base64_decode($this->input->get('u'));

		$object = array(
			'jamaah_email' => $email,
			'jamaah_status'=> 'baru' 
		);

		$sql = $this->db->where($object)->get('jamaah');

		if ( $sql->num_rows() == 1 ) 
		{
			$object2 = array(
				'jamaah_status' => 'aktif' 
			);

			if( $this->db->where($object)->update('jamaah', $object2))
			{
				$this->setAlert('success','Konfirmasi berhasil');
			}
			else
			{
				$this->setAlert('warning','Konfirmasi gagal');
			}

		}
		else
		{
			$this->setAlert('warning','URL tidak valid');
		}

		redirect( base_url().'welcome/login' );
	}


	// ===========================================================
	// PROFIL
	// ===========================================================

	public function profil()
	{

		$this->have_session();

		$object = array(
			'jamaah_id' => $this->session->userdata('ci_userid') 
		);

		$data['query_jamaah'] = $this->db->where($object)->get('jamaah')->row();

		$data['title'] = 'Profil';

		$data['init']  = $this->load->view('jamaah/profil', $data, true);

		$this->load->view('jamaah/init', $data, false);
	}

	public function update_profil_jamaah()
	{
		$this->have_session();
		
		$nik           = $this->input->post('nik');
		$nama          = $this->input->post('nama');
		$jk            = $this->input->post('jk');
		$tempat_lahir  = $this->input->post('tempat_lahir');
		$tanggal_lahir = $this->input->post('tanggal_lahir');
		$alamat        = $this->input->post('alamat');

		$object = array(
			'jamaah_nik'           => $nik , 
			'jamaah_nama'          => $nama , 
			'jamaah_jk'            => $jk , 
			'jamaah_tempat_lahir'  => $tempat_lahir , 
			'jamaah_tanggal_lahir' => $tanggal_lahir , 
			'jamaah_alamat'        => $alamat
		);

		if($this->db->where('jamaah_id', $this->session->userdata('ci_userid'))->update('jamaah', $object))
		{
			$this->setAlert('success','Profil berhasil diperbarui');
		}
		else
		{
			$this->setAlert('warning','Profil gagal diperbarui');
		}

		redirect( $this->input->server('HTTP_REFERER') );
	}

	public function generateOTP()
	{
		$this->have_session();
		
		$otp   = rand('1111','9999');
		$phone = $this->input->post('phone');

		$array = array(
			'ci_userotp'   => $otp,
			'ci_userphone' => $phone
		);
		
		$this->session->set_userdata( $array );

		redirect( base_url(). 'welcome/getOTP?otp='.$otp.'&phone='.$phone.'' );
	}

	public function generateOTP_again()
	{
		$this->have_session();
		
		$otp   = rand('1111','9999');
		$phone = $this->session->userdata('ci_userphone');

		$array = array(
			'ci_userotp'   => $otp,
			'ci_userphone' => $phone
		);
		
		$this->session->set_userdata( $array );

		redirect( base_url(). 'welcome/getOTP?otp='.$otp.'&phone='.$phone.'' );
	}

	public function getOTP()
	{
		$this->have_session();
		
		$data['title'] = 'Kode OTP';
		$data['init']  = $this->load->view('jamaah/get_otp', $data, true);
		$this->load->view('jamaah/init', $data, false);
	}

	public function updateKontak()
	{
		$this->have_session();
		
		$otp   = $this->input->post('otp');
		$phone = $this->session->userdata('ci_userphone');

		if ( $otp == $this->session->userdata('ci_userotp') ) 
		{
			$object = array(
				'jamaah_hp'            => $phone ,
				'jamaah_status' => 'lengkap'
			);

			if($this->db->where('jamaah_id', $this->session->userdata('ci_userid'))->update('jamaah', $object))
			{
				$this->setAlert('success','No HP berhasil diperbarui');
			}
			else
			{
				$this->setAlert('success','No HP gagal diperbarui');
			}

			redirect( base_url(). 'welcome/profil' );
		}
		else
		{
			$this->setAlert('warning','Kode OTP tidak sesuai');

			redirect( $this->input->server('HTTP_REFERER') );
		}
	}

	// =============================================================
	// UMROH
	// =============================================================
	public function umroh()
	{
		$this->db->where('paket.paket_kategori', 'umroh');
		$this->db->join('paket', 'paket.paket_id = periode.paket_id', 'both');
		$this->db->order_by('periode.periode_tanggal_berangkat', 'desc');
		$data['query_umroh'] = $this->db->get('periode');

		$data['title'] = 'Paket Umroh';
		$data['init']  = $this->load->view('jamaah/umroh', $data, true);
		$this->load->view('jamaah/init', $data, false);
	}



	// =============================================================
	// HAJI
	// =============================================================
	public function haji()
	{
		$this->db->where('paket.paket_kategori', 'haji');
		$this->db->join('paket', 'paket.paket_id = periode.paket_id', 'both');
		$this->db->order_by('periode.periode_tanggal_berangkat', 'desc');
		$data['query_haji'] = $this->db->get('periode');

		$data['title'] = 'Paket Haji';
		$data['init']  = $this->load->view('jamaah/haji', $data, true);
		$this->load->view('jamaah/init', $data, false);
	}

	// ==============================================================
	// DAFTAR PERIODE
	// ==============================================================
	public function daftar_periode( $id )
	{
		$this->have_session();
		
		$no = date('dmyHis');

		$object = array(
			'pendaftaran_no'                 =>  $no, 
			'pendaftaran_status'             => 'menunggu' , 
			'pendaftaran_tanggal_tambah'     => date('Y-m-d H:i:s') , 
			'pendaftaran_tanggal_kadaluarsa' => date('Y-m-d H:i:s', strtotime(date('Y-m-d H:i:s')) + (3*3600)) , 
			'periode_id' => $id,
			'jamaah_id'  => $this->session->userdata('ci_userid')
		);

		if( $this->db->insert('pendaftaran', $object) )
		{
			$this->setAlert('success','Berhasil mendaftar silahkan konfirmasi pembayaran anda sebelum jatuh tempo');

			redirect( base_url().'welcome/konfirmasi_pembayaran/'.$no.'' );
		}
		else{
			$this->setAlert('warning','Gagal mendaftar silahkan mencoba kembali');

			redirect( $this->input->server('HTTP_REFERER') );
		}

	}

	public function konfirmasi_pembayaran($no)
	{
		$this->have_session();
		
		$this->db->where('pendaftaran.pendaftaran_no', $no);
		$this->db->join('paket', 'paket.paket_id = periode.paket_id', 'both');
		$this->db->join('pendaftaran', 'pendaftaran.periode_id = periode.periode_id', 'both');
		$this->db->order_by('periode.periode_tanggal_berangkat', 'desc');
		$data['query_pendaftaran'] = $this->db->get('periode');

		$data['title'] = 'Konfirmasi Pembayaran';
		$data['init']  = $this->load->view('jamaah/konfirmasi_pembayaran', $data, true);
		$this->load->view('jamaah/init', $data, false);
	}

	public function status_pendaftaran()
	{		
		$no = $this->input->get('no');

		$this->db->where('pendaftaran.pendaftaran_no', $no);
		$this->db->join('paket', 'paket.paket_id = periode.paket_id', 'both');
		$this->db->join('pendaftaran', 'pendaftaran.periode_id = periode.periode_id', 'both');
		$this->db->join('jamaah', 'jamaah.jamaah_id = pendaftaran.jamaah_id', 'both');
		$this->db->order_by('periode.periode_tanggal_berangkat', 'desc');
		$data['query_pendaftaran'] = $this->db->get('periode');

		$data['title'] = 'Status Pendaftaran';
		$data['init']  = $this->load->view('jamaah/status_pendaftaran', $data, true);
		$this->load->view('jamaah/init', $data, false);
	}


	// ================================================================
	// 	KEBIJAKAN
	// ================================================================
	public function kebijakan()
	{

		$data['title'] = 'Peraturan dan Kebijakan';
		$data['init']  = $this->load->view('jamaah/kebijakan', $data, true);
		$this->load->view('jamaah/init', $data, false);
	}

	// ================================================================
	// 	SYARAT DAN KETENTUAN
	// ================================================================
public function syarat_dan_ketentuan()

	{
		$this->db->where('paket.paket_kategori', 'umroh');
		$this->db->select('paket.paket_deskripsi', 'umroh');
		$this->db->order_by('paket.p_tanggal_berangkat', 'desc');
		$data['query_umroh'] = $this->db->get('periode');

		$data['title'] = 'Paket Umroh';
		$data['init']  = $this->load->view('jamaah/syarat_dan_ketentuan', $data, true);
		$this->load->view('jamaah/init', $data, false);
	}

}

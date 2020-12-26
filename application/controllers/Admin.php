<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		//Do your magic here

		date_default_timezone_set('Asia/Jakarta');
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
		if ( ! $this->session->userdata('ci_adminid') ) {
			redirect( base_url().'admin' );
		}
	}

	public function index()
	{
		$this->load->view('admin/login', $data='', FALSE);
	}

	public function checking()
	{
		$username = $this->input->post('username');
		$password = $this->input->post('password');

		$object = array(
			'admin_username' => $username , 
			'admin_password' => md5($password)
		);

		$sql = $this->db->where($object)->get('admin');

		if ($sql->num_rows() == 1 ) 
		{
			$row = $sql->row();

			$array = array(
				'ci_adminid'   => $row->admin_id,
				'ci_adminname' => $row->admin_nama
			);
			
			$this->session->set_userdata( $array );

			redirect( base_url() . 'admin/dashboard' );
		}
		else
		{
			$this->setAlert('warning','Login Gagal');

			redirect( base_url().'admin' );
		}
	}

	public function dashboard()
	{
		$this->have_session();

		$data['total_jamaah']  = $this->db->get('jamaah')->num_rows();
		$data['total_paket']   = $this->db->get('paket')->num_rows();
		$data['total_periode'] = $this->db->get('periode')->num_rows();

		$data['total_income']  = $this->db->select_sum('periode.periode_biaya')->where('pendaftaran.pendaftaran_status','selesai')->join('periode','periode.periode_id = pendaftaran.periode_id','both')->get('pendaftaran')->row()->periode_biaya;


		$this->db->select('paket.*');
		$this->db->join('paket', 'paket.paket_id = periode.paket_id', 'both');
		$kategori = $this->db->get('periode')->result_array();

		for( $i=0; $i<count($kategori); $i++ )
		{
			$paket = $kategori[$i];
			
			$this->db->where('periode.periode_tahun', '2019');
			$this->db->where('paket.paket_id', $paket['paket_id'] );
			$this->db->join('periode', 'periode.periode_id = pendaftaran.periode_id', 'both');
			$this->db->join('paket', 'paket.paket_id = periode.paket_id', 'both');
			$data['bar_periode'][] = $this->db->get('pendaftaran')->num_rows();

			$data['bar_kategori'][] = $paket['paket_nama'];
		}



		$this->db->join('jamaah', 'jamaah.jamaah_id = pendaftaran.jamaah_id', 'both');
		$this->db->join('periode', 'periode.periode_id = pendaftaran.periode_id', 'both');
		$this->db->join('paket', 'paket.paket_id = periode.paket_id', 'both');
		$this->db->order_by('pendaftaran.pendaftaran_tanggal_tambah', 'desc');
		$data['query_pendaftaran'] = $this->db->get('pendaftaran');




		$data['title'] = 'Dashboard';

		$data['init'] = $this->load->view('admin/home', $data, TRUE);

		$this->load->view('admin/init', $data, FALSE);
	}

	public function jamaah()
	{
		$this->have_session();

		$data['query_jamaah'] = $this->db->get('jamaah');

		$data['title'] = 'Jamaah';

		$data['init'] = $this->load->view('admin/jamaah', $data, TRUE);

		$this->load->view('admin/init', $data, FALSE);
	}

	// ===============================================================
	// PAKET
	// ===============================================================

	public function paket()
	{
		$this->have_session();

		$data['kategori'] = ( is_null($this->input->get('filter_by_kategori') ) )? null : $this->input->get('filter_by_kategori') ;

		
		if( $data['kategori'] )
		{
			$this->db->where('paket_kategori', $data['kategori'] );
		}
		$data['query_paket'] = $this->db->get('paket');
		

		$data['title'] = 'Paket';

		$data['init'] = $this->load->view('admin/paket', $data, TRUE);

		$this->load->view('admin/init', $data, FALSE);
	}

	public function tambah_paket()
	{
		$this->have_session();

		$no        = $this->input->post('no');
		$nama      = $this->input->post('nama');
		$deskripsi = $this->input->post('deskripsi');
		$kategori  = $this->input->post('kategori');
		$status    = $this->input->post('status');

		if( $this->db->where('paket_no', $no)->get('paket')->num_rows() != 0 )
		{
			$this->setAlert('warning','Kode Paket sudah ada');

			redirect($this->input->server('HTTP_REFERER'));

			die();
		}

		$object = array(
			'paket_no'        => $no , 
			'paket_nama'      => $nama, 
			'paket_deskripsi' => $deskripsi ,
			'paket_kategori'  => $kategori ,
			'paket_status'    => $status 
		);

		if( $this->db->insert('paket', $object) )
		{
			$this->setAlert('success','Berhasil menambah paket baru');
		}
		else
		{
			$this->setAlert('warning','Gagal menambah paket baru');
		}

		redirect($this->input->server('HTTP_REFERER'));
	}

	public function ubah_status_paket()
	{
		$this->have_session();

		$id     = $this->input->get('id');
		$status = $this->input->get('status');

		$object = array('paket_status' => $status );

		if( $this->db->where('paket_id', $id )->update('paket', $object) )
		{
			$this->setAlert('success','Berhasil menambah paket baru');
		}
		else
		{
			$this->setAlert('warning','Gagal menambah paket baru');
		}

		redirect($this->input->server('HTTP_REFERER'));
	}

	public function ajax_edit_paket( $id )
	{
		$data['query_paket'] = $this->db->where('paket_id', $id )->get('paket');

		$this->load->view('admin/ajax/ajax_edit_paket', $data, FALSE);
	}

	public function update_paket($id)
	{
		$this->have_session();

		$no        = $this->input->post('no');
		$nama      = $this->input->post('nama');
		$deskripsi = $this->input->post('deskripsi');
		$kategori  = $this->input->post('kategori');
		$status    = $this->input->post('status');


		$object = array(
			'paket_no'        => $no , 
			'paket_nama'      => $nama, 
			'paket_deskripsi' => $deskripsi ,
			'paket_kategori'  => $kategori ,
			'paket_status'    => $status 
		);

		if( $this->db->where('paket_id', $id)->update('paket', $object) )
		{
			$this->setAlert('success','Berhasil mengubah paket');
		}
		else
		{
			$this->setAlert('warning','Gagal mengubah paket');
		}

		redirect($this->input->server('HTTP_REFERER'));
	}

	public function hapus_paket( $id )
	{
		$this->have_session();

		if( $this->db->where('paket_id', $id )->delete('paket') )
		{
			$this->setAlert('success','Berhasil menghapus paket');
		}
		else
		{
			$this->setAlert('warning','Gagal menghapus paket');
		}

		redirect($this->input->server('HTTP_REFERER'));
	}

	// =============================================================
	// PERIODE
	// =============================================================

	public function periode()
	{
		$this->have_session();

		$data['kategori'] = ( is_null($this->input->get('filter_by_kategori') ) )? null : $this->input->get('filter_by_kategori') ;

		if( $data['kategori'] )
		{
			$this->db->where('paket.paket_kategori', $data['kategori'] );
		}
		$this->db->join('paket','paket.paket_id = periode.paket_id','both' );
		$data['query_periode'] = $this->db->get('periode');
		
		$data['query_paket']   = $this->db->where('paket_status','buka')->get('paket');

		$data['title'] = 'Periode';

		$data['init'] = $this->load->view('admin/periode', $data, TRUE);

		$this->load->view('admin/init', $data, FALSE);
	}

	public function tambah_periode()
	{
		$this->have_session();

		$bulan  = $this->input->post('bulan');
		$tahun  = $this->input->post('tahun');
		$berangkat  = $this->input->post('berangkat');
		$biaya  = $this->input->post('biaya');
		$status = $this->input->post('status');
		$paket  = $this->input->post('paket');

		$object = array(
			'periode_bulan'          => $bulan , 
			'periode_tahun'          => $tahun, 
			'periode_biaya'          => $biaya ,
			'periode_tanggal_berangkat'          => $berangkat ,
			'periode_tanggal_tambah' => date('Y-m-d H:i:s') ,
			'periode_status'         => $status ,
			'paket_id'               => $paket 
		);

		if( $this->db->insert('periode', $object) )
		{
			$this->setAlert('success','Berhasil menambah periode baru');
		}
		else
		{
			$this->setAlert('warning','Gagal menambah periode baru');
		}

		redirect($this->input->server('HTTP_REFERER'));
	}

	public function ubah_status_periode()
	{
		$this->have_session();

		$id     = $this->input->get('id');
		$status = $this->input->get('status');

		$object = array('periode_status' => $status );

		if( $this->db->where('periode_id', $id )->update('periode', $object) )
		{
			$this->setAlert('success','Berhasil diperbarui');
		}
		else
		{
			$this->setAlert('warning','Gagal diperbarui');
		}

		redirect($this->input->server('HTTP_REFERER'));
	}

	public function ajax_edit_periode( $id )
	{
		$data['query_periode'] = $this->db->where('periode_id', $id )->get('periode');

		$data['query_paket']   = $this->db->where('paket_status','buka')->get('paket');

		$this->load->view('admin/ajax/ajax_edit_periode', $data, FALSE);
	}

	public function update_periode($id)
	{
		$this->have_session();

		$bulan  = $this->input->post('bulan');
		$tahun  = $this->input->post('tahun');
		$berangkat  = $this->input->post('berangkat');
		$biaya  = $this->input->post('biaya');
		$status = $this->input->post('status');
		$paket  = $this->input->post('paket');

		$object = array(
			'periode_bulan'          => $bulan , 
			'periode_tahun'          => $tahun, 
			'periode_biaya'          => $biaya ,
			'periode_tanggal_berangkat'          => $berangkat ,
			'periode_tanggal_tambah' => date('Y-m-d H:i:s') ,
			'periode_status'         => $status ,
			'paket_id'               => $paket 
		);

		if( $this->db->where('periode_id', $id)->update('periode', $object) )
		{
			$this->setAlert('success','Berhasil mengubah periode');
		}
		else
		{
			$this->setAlert('warning','Gagal mengubah periode');
		}

		redirect($this->input->server('HTTP_REFERER'));
	}

	public function hapus_periode( $id )
	{
		$this->have_session();

		if( $this->db->where('periode_id', $id )->delete('periode') )
		{
			$this->setAlert('success','Berhasil menghapus periode');
		}
		else
		{
			$this->setAlert('warning','Gagal menghapus periode');
		}

		redirect($this->input->server('HTTP_REFERER'));
	}

	// =================================================================
	// PENDAFTARAN
	// =================================================================

	public function pendaftaran()
	{
		$this->have_session();

		$data['kategori'] = ( is_null($this->input->get('filter_by_kategori') ) )? 'umroh' : $this->input->get('filter_by_kategori') ;
		$data['status'] = ( is_null($this->input->get('filter_by_status') ) )? 'menunggu' : $this->input->get('filter_by_status') ;

		if( $data['kategori'] )
		{
			$this->db->where('paket.paket_kategori', $data['kategori'] );
		}

		if( $data['status'] )
		{
			$this->db->where('pendaftaran.pendaftaran_status', $data['status'] );
		}

		$this->db->join('jamaah', 'jamaah.jamaah_id = pendaftaran.jamaah_id', 'both');
		$this->db->join('periode', 'periode.periode_id = pendaftaran.periode_id', 'both');
		$this->db->join('paket', 'paket.paket_id = periode.paket_id', 'both');
		$data['query_pendaftaran'] = $this->db->get('pendaftaran');

		$data['title'] = 'Pendaftaran';

		$data['init'] = $this->load->view('admin/pendaftaran', $data, TRUE);

		$this->load->view('admin/init', $data, FALSE);
	}

	public function detail_pendaftaran($id)
	{
		$this->have_session();

		$this->db->where('pendaftaran.pendaftaran_id', $id);
		$this->db->join('jamaah', 'jamaah.jamaah_id = pendaftaran.jamaah_id', 'both');
		$this->db->join('periode', 'periode.periode_id = pendaftaran.periode_id', 'both');
		$this->db->join('paket', 'paket.paket_id = periode.paket_id', 'both');
		$data['query_pendaftaran'] = $this->db->get('pendaftaran');

		$data['title'] = 'Detail Pendaftaran';

		$data['init'] = $this->load->view('admin/detail_pendaftaran', $data, TRUE);

		$this->load->view('admin/init', $data, FALSE);
	}

	public function update_status_pendaftaran($id)
	{
		$this->have_session();
		
		$object = array('pendaftaran_status' => $this->input->get('status')  );
		if( $this->db->where('pendaftaran_id', $id )->update('pendaftaran', $object) )
		{
			$this->setAlert('success','Berhasil memperbarui status pendaftaran');
		}
		else
		{
			$this->setAlert('warning','Gagal memperbarui status pendaftaran');
		}

		redirect($this->input->server('HTTP_REFERER'));
	}

	

	public function keluar()
	{
		$this->session->sess_destroy();

		redirect( base_url().'admin' );
	}

}

/* End of file Admin.php */
/* Location: ./application/controllers/Admin.php */
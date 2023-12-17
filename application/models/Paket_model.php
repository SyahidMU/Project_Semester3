<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Paket_model extends CI_Model
{
  public $table = 'paket';
  public $id    = 'id_paket';
  public $order = 'DESC';

	function count_all()
	{
		$this->db->from($this->table);
		return $this->db->count_all_results();
	}

  function get_all()
  {
    $this->db->order_by('nama_paket','ASC');
    return $this->db->get($this->table)->result();
  }

  function get_all_home()
  {
    $this->db->order_by('nama_paket', 'ASC');
    return $this->db->get($this->table)->result();
  }

  function ambil_paket()
  {
    $this->db->order_by('nama_paket', 'ASC');
  	$data=$this->db->get('paket');
  	if($data->num_rows()>0)
    {
  		foreach ($data->result_array() as $row)
			{
				$result['']= '- Pilih Paket -';
				$result[$row['id_paket']]= ucwords(strtolower($row['nama_paket']));
			}
			return $result;
		}
	}

  function ambil_subkat($kat)
  {
    $this->db->where('id_kat',$kat);
  	// $this->db->order_by('judul_subkat','asc');
  	$sql_subkat=$this->db->get('subpaket');
  	if($sql_subkat->num_rows()>0)
    {
  		foreach ($sql_subkat->result_array() as $row)
      {
        $result[$row['id_subpaket']]= ucwords(strtolower($row['judul_subpaket']));
      }
      return $result;
    }
    // else
    // {
		//   $result['-']= '- Belum Ada Sub Paket -';
		// }
    // return $result;
	}

  function ambil_subpaket($kat_id)
  {
  	$this->db->where('id_kat',$kat_id);
  	$this->db->order_by('judul_subpaket','asc');
  	$sql=$this->db->get('subpaket');
  	if($sql->num_rows()>0)
    {
  		foreach ($sql->result_array() as $row)
      {
        $result[$row['id_subpaket']]= ucwords(strtolower($row['judul_subpaket']));
      }
    }
    else
    {
		  $result['-']= '- Belum Ada SubPaket -';
		}
    return $result;
	}

  function ambil_supersubkat($subkat_id)
  {
  	$this->db->where('id_subkat',$subkat_id);

  	$sql=$this->db->get('supersubpaket');
  	if($sql->num_rows()>0)
    {
  		foreach ($sql->result_array() as $row)
      {
        $result[$row['id_supersubpaket']]= ucwords(strtolower($row['judul_supersubpaket']));
      }
    }
    else
    {
		  $result['-']= '- Belum Ada SuperSubPaket -';
		}
    return $result;
	}

  function ambil_supersubpaket($subkat_id)
  {
  	$this->db->where('id_subkat',$subkat_id);

  	$sql=$this->db->get('supersubpaket');
  	if($sql->num_rows()>0)
    {
  		foreach ($sql->result_array() as $row)
      {
        $result[$row['id_supersubpaket']]= ucwords(strtolower($row['judul_supersubpaket']));
      }
    }
    else
    {
		  $result['-']= '- Belum Ada SuperSubPaket -';
		}
    return $result;
	}

  function get_list_by_paket($slug, $limit=null, $offset=null)
  {
    $this->db->join('paket', 'produk.kat_id=paket.id_paket');
    $this->db->where('paket.slug_kat', $slug);
    $this->db->limit($limit, $offset);

    return $this->db->get('produk');
  }

  function get_by_paket_nr($slug)
  {
    $this->db->join('paket', 'produk.kat_id=paket.id_paket');
    $this->db->where('paket.slug_kat', $slug);

    return $this->db->get('produk')->num_rows();
  }

  function get_list_by_subpaket($slug, $limit=null, $offset=null)
  {
    $this->db->join('subpaket', 'produk.subkat_id=subpaket.id_subpaket');
    $this->db->where('subpaket.slug_subkat', $slug);
    $this->db->limit($limit, $offset);

    return $this->db->get('produk');
  }

  function get_by_subpaket_nr($slug)
  {
    $this->db->join('subpaket', 'produk.subkat_id=subpaket.id_subpaket');
    $this->db->where('subpaket.slug_subkat', $slug);

    return $this->db->get('produk')->num_rows();
  }

  function get_list_by_superspaket($slug, $limit=null, $offset=null)
  {
    $this->db->join('supersubpaket', 'produk.supersubkat_id=supersubpaket.id_supersubpaket');
    $this->db->where('supersubpaket.slug_supersubkat', $slug);
    $this->db->limit($limit, $offset);

    return $this->db->get('produk');
  }

  function get_by_superspaket_nr($slug)
  {
    $this->db->join('supersubpaket', 'produk.supersubkat_id=supersubpaket.id_supersubpaket');
    $this->db->where('supersubpaket.slug_supersubkat', $slug);

    return $this->db->get('produk')->num_rows();
  }

  function get_all_new_home()
  {
    $this->db->limit(4);
    $this->db->order_by($this->id, $this->order);
    return $this->db->get($this->table)->result();
  }

  function get_all_paket_sidebar()
  {
    $this->db->order_by('judul_paket', 'asc');
    return $this->db->get($this->table)->result();
  }

  function get_total_row_paket()
  {
    return $this->db->get($this->table)->count_all_results();
  }

  function get_by_id($id)
  {
    $this->db->where($this->id, $id);
    return $this->db->get($this->table)->row();
  }

  function get_by_id_front($id)
  {
    $this->db->from('produk');
    $this->db->where('slug_subkat', $id);
    $this->db->join('subpaket', 'produk.subkat_id = subpaket.id_subpaket');
    $this->db->order_by('id_produk','desc');
    return $this->db->get();
  }

  // get total rows
  function total_rows()
  {
    return $this->db->get($this->table)->num_rows();
  }

  function insert($data)
  {
    $this->db->insert($this->table, $data);
  }

  function update($id, $data)
  {
    $this->db->where($this->id,$id);
    $this->db->update($this->table, $data);
  }

  function delete($id)
  {
    $this->db->where($this->id, $id);
    $this->db->delete($this->table);
  }

  function del_by_id($id)
  {
    $this->db->select("foto");
    $this->db->where($this->id,$id);
    return $this->db->get($this->table)->row();
  }

}

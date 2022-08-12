<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pelayanan extends CI_Controller {

	public function __construct() {
        parent::__construct();       
    }

    public function room($id_registrasi){
        if(!$this->session->userdata('is_login')){
            redirect(base_url('Login'));
        }
        $valid = $this->db->query('SELECT id_user_kategori FROM master_user WHERE id = '.$this->session->userdata('id_user'))->row();
        if($valid->id_user_kategori != 2){
            if($valid->id_user_kategori == 0){
                redirect(base_url('pasien/Pasien'));
            }
            else{
                redirect(base_url('admin/Admin'));
            }
        }
        $data['view'] = 'dokter/homecare/pelayanan';
	    $data['user'] = $this->db->query('SELECT master_user.*, master_provinsi.id as id_provinsi, master_provinsi.name as nama_provinsi, master_kota.id as id_kota, master_kota.name as nama_kota, master_kecamatan.id as id_kecamatan, master_kecamatan.name as nama_kecamatan, master_kelurahan.id as id_kelurahan, master_kelurahan.name as nama_kelurahan FROM master_user LEFT JOIN master_provinsi ON master_user.alamat_provinsi = master_provinsi.id LEFT JOIN master_kota ON master_user.alamat_kota = master_kota.id LEFT JOIN master_kecamatan ON master_user.alamat_kecamatan = master_kecamatan.id LEFT JOIN master_kelurahan ON master_user.alamat_kelurahan = master_kelurahan.id WHERE master_user.id = '.$this->session->userdata('id_user'))->row();
        $data['title'] = 'Pelayanan Homecare';
        $data['list_notifikasi'] = $this->db->query('SELECT * FROM data_notifikasi WHERE find_in_set("'.$this->session->userdata('id_user').'", id_user) <> 0 AND status = 0 ORDER BY tanggal DESC')->result();
        $data['css_addons'] = '';
        $data['js_addons'] = '
            <script>
                function delete_resep(e){
                    const id_resep = $(e).data("id-resep");
                    $.ajax({
                        url: baseUrl+"dokter/homecare/pelayanan/delete_resep/"+id_resep,
                        method: "GET",
                        success: function(data){
                            e.parentNode.parentNode.remove();
                            console.log("berhasil");
                        },
                        error: function(err){
                            console.log("GAGAL");
                        }
                    });
                }
                function delete_kegiatan(e){
                    const id_kegiatan = $(e).data("id-kegiatan");
                    $.ajax({
                        url: baseUrl+"dokter/homecare/pelayanan/delete_kegiatan/"+id_kegiatan,
                        method: "GET",
                        success: function(data){
                            e.parentNode.parentNode.remove();
                            console.log("berhasil");
                        },
                        error: function(err){
                            console.log("GAGAL");
                        }
                    });
                }
                $(document).ready(function(){
                    $("#file_upload").change(function() {
                        var file = $("#file_upload")[0].files[0].name;
                        var file_substr = file.length > 40 ? file.substr(0, 60)+"...":file;
                        $("#filename").html("<span title=\'" + file + "\'>" + file_substr + "</span>");
                    }); 

                    checkRemove();
                    $("#add").click(function() {
                        $("div.resep-dokter:last").after($("div.resep-dokter:first").clone());
                        $("div.resep-dokter:last").find("input").val("");
                        checkRemove();
                
                    });
                    $("#remove").click(function() {
                        $("div.resep-dokter:last").remove();
                        checkRemove();
                    });

                    $("#formKegiatan").submit(function(e){
                        e.preventDefault();
                        formData = new FormData();
                        formData.append("nama", $(this).find("textarea[name=nama]").val());
                        formData.append("foto", $(this).find("input[name=foto]")[0].files[0]);
                        $.ajax({
                            url: baseUrl+"dokter/homecare/pelayanan/simpan_kegiatan/'.$id_registrasi.'",
                            method: "POST",
                            data: formData,
                            contentType: false,
                            processData: false,
                            success: function(data){
                                data = JSON.parse(data);
                                list_kegiatan = $("#listKegiatan");
                                list_kegiatan_template = "<tr><td>"+$("#formKegiatan").find("textarea[name=nama]").val()+"</td><td style=\"max-width: 200px\"><img class=\"kegiatan-"+data.id_kegiatan+"\" src=\""+baseUrl+"assets/images/kegiatan_homecare/"+data.foto+"\" height=\"200px\"/></td><td><button class=\"btn btn-secondary\" onclick=\"return delete_kegiatan(this);\" type=\"button\" data-id-kegiatan=\""+data.id_kegiatan+"\"><i class=\"fas fa-trash-alt\"></i></button></td></tr>";
                                list_kegiatan.append(list_kegiatan_template);

                                $("#formKegiatan").trigger("reset");
                                $("#formKegiatan").find("#filename").html("Upload Foto");
                                $("#ModalKegiatan").modal("hide");
                                alert("Kegiatan berhasil ditambahkan!");
                            },
                            error: function(xhr, status, error){
                                console.log(error.Message);
                            }
                        });
                    });

                    $("#formAssesment").submit(function(e){
                        e.preventDefault();
                        const data_assesment = $(this).serialize();

                        $.ajax({
                            url: baseUrl+"dokter/homecare/pelayanan/simpan_assesment/'.$id_registrasi.'",
                            method: "POST",
                            data: data_assesment,
                            success: function(data){
                                alert("Assesment berhasil disimpan");
                            },
                            error: function(err){
                                console.log("GAGAL");
                            }
                        });
                    });
                
                    $("#formResepDokter").submit(function(e){
                        e.preventDefault();
                        var dataResep = $(this).serializeArray();
                        const id_obat = dataResep[1];
                        const jumlah_obat = dataResep[2];
                        const keterangan = dataResep[3];
                        const satuan_obat = dataResep[4];
                        var namaObat = $("select[name=id_obat] option:selected").text();
                        var listResep = $("#listResep");
                        var countTr = $("#listResep tr");
                        countTr = countTr.length;
                        if(countTr == null){
                            countTr = 0;
                        }
                        countTr+=1;

                        const data_resep = `id_obat=${id_obat.value}&jumlah_obat=${jumlah_obat.value}&keterangan=${keterangan.value}`;
                        $.ajax({
                            url: baseUrl+"dokter/homecare/pelayanan/add_resep/'.$id_registrasi.'",
                            method: "POST",
                            data: data_resep,
                            success: function(data){
                                data = JSON.parse(data);
                                var templateListResep = "<tr><td>"+namaObat+"</td><td>"+jumlah_obat.value+" "+satuan_obat.value+"</td><td>"+keterangan.value+"</td><td><button class=\"btn btn-secondary delete-resep\" data-id-resep=\""+data.id_resep+"\" onclick=\"return delete_resep(this)\" type=\"button\"><i class=\"fas fa-trash-alt\"></i></button></td></tr>";
                                listResep.append(templateListResep);
                                $("#ModalResep").modal("hide");
                                alert("Resep telah ditambahkan!");
                            },
                            error: function(err){
                                alert("Dalam perbaikan!");
                            }
                        });
                        $(this)[0].reset();
                    });

                    $("#start-button").click(function(){
                        $("#start-button").removeClass("d-block");
                        $("#start-button").addClass("d-none");

                        $("#start-desc").removeClass("d-none");
                        $("#start-desc").addClass("d-block");

                        $(".input-dokter").removeClass("d-none");
                        $(".input-dokter").addClass("d-block");

                        $.ajax({
                            url: baseUrl+"dokter/homecare/pelayanan/mulai_pelayanan/'.$id_registrasi.'",
                            method: "GET",
                            success: function(data){
                                let dimulai_pada = new Date();
                                dimulai_pada = dimulai_pada.getDate() + "-"
                                + (dimulai_pada.getMonth()+1)  + "-" 
                                + dimulai_pada.getFullYear() + " "  
                                + dimulai_pada.getHours() + ":"  
                                + (dimulai_pada.getMinutes()<10?"0":"")+dimulai_pada.getMinutes();
        
                                $(".dimulai-pada").html(dimulai_pada);
                            }
                        });
                    });

                    $("#end-button").click(function(){
                        $.ajax({
                            url: baseUrl+"dokter/homecare/pelayanan/akhiri_pelayanan/'.$id_registrasi.'",
                            method: "GET",
                            success: function(data){
                                location.href = baseUrl+"dokter/homecare/JadwalPelayanan";
                            },
                            error: function(data){
                                console.log("ERROR");
                            }
                        });
                    });
                });

                function checkRemove() {
                    if ($("div.resep-dokter").length == 1) {
                        $("#remove").hide();
                    } else {
                        $("#remove").show();
                    }
                };
            </script>
        ';

        $data['pelayanan'] = $this->db->query('SELECT 
                                                    p.name as nama_pasien, 
                                                    p.lahir_tanggal as pasien_tgl_lahir, 
                                                    p.foto as foto_pasien,
                                                    drh.kebutuhan, 
                                                    drh.id as id_registrasi,
                                                    drh.dimulai_pada, 
                                                    GROUP_CONCAT(mph.nama SEPARATOR ",") as list_nama_pelayanan 
                                                    FROM data_registrasi_homecare drh 
                                                        INNER JOIN detail_data_registrasi_homecare ddrh ON drh.id = ddrh.id_registrasi 
                                                        INNER JOIN master_pelayanan_homecare mph ON mph.id = ddrh.id_pelayanan 
                                                        INNER JOIN master_user p ON p.id = drh.id_pasien WHERE drh.id = ? 
                                                            GROUP BY ddrh.id_registrasi', $id_registrasi)->row();
        $data['pelayanan']->umur_pasien = $data['pelayanan']->pasien_tgl_lahir ? (new DateTime($data['pelayanan']->pasien_tgl_lahir))->diff((new DateTime('now')))->y:'-';
        $data['pelayanan']->kebutuhan = $data['pelayanan']->kebutuhan ? $data['pelayanan']->kebutuhan:'-';
        $data['pelayanan']->sudah_dimulai = $data['pelayanan']->dimulai_pada ? true:false;
        $data['pelayanan']->dimulai_pada = $data['pelayanan']->sudah_dimulai ? (new DateTime($data['pelayanan']->dimulai_pada))->format('d-m-Y H:i'):null;
        $data['pelayanan']->foto_pasien = $data['pelayanan']->foto_pasien ? base_url("assets/images/users/".$data['pelayanan']->foto_pasien):base_url("assets/telemedicine/img/default.png");

        $data['list_obat'] = $this->db->query('SELECT id, name, unit FROM master_obat WHERE active = 1 ORDER BY name')->result();

        $data['resep_dokter'] = $this->db->query('SELECT rdh.id, rdh.keterangan, rdh.jumlah_obat, master_obat.name, master_obat.unit FROM resep_dokter_homecare rdh INNER JOIN master_obat ON rdh.id_obat = master_obat.id WHERE rdh.id_registrasi = ?', $id_registrasi)->result();
        $data['assesment'] = $this->db->query('SELECT id, tinggi_badan, berat_badan, suhu, tekanan_darah, merokok, alkohol, kecelakaan, operasi FROM assesment_homecare WHERE id_registrasi = ?',$id_registrasi)->row();
        $data['assesment_exists'] = $data['assesment'] ? true:false;
        $data['list_kegiatan'] = $this->db->query('SELECT id,nama,foto FROM kegiatan_homecare WHERE id_registrasi = ?', $id_registrasi)->result();

        $this->load->view('template', $data);
    }

    public function akhiri_pelayanan($id_registrasi){
        if(!$this->session->userdata('is_login')){
            redirect(base_url('Login'));
        }
        $valid = $this->db->query('SELECT id_user_kategori FROM master_user WHERE id = '.$this->session->userdata('id_user'))->row();
        if($valid->id_user_kategori != 2){
            if($valid->id_user_kategori == 0){
                redirect(base_url('pasien/Pasien'));
            }
            else{
                redirect(base_url('admin/Admin'));
            }
        }
        $data_registrasi_update = [
            'diakhiri_pada'=>(new DateTime('now'))->format('Y-m-d H:i:s'),
            'selesai' => 1
        ];
        $this->db->set($data_registrasi_update);
        $this->db->where('id', $id_registrasi);
        $this->db->update('data_registrasi_homecare');

        $this->db->delete('jadwal_layanan_homecare', array('id_registrasi' => $id_registrasi));

        echo "OK";
    }

    public function mulai_pelayanan($id_registrasi){
        if(!$this->session->userdata('is_login')){
            redirect(base_url('Login'));
        }
        $valid = $this->db->query('SELECT id_user_kategori FROM master_user WHERE id = '.$this->session->userdata('id_user'))->row();
        if($valid->id_user_kategori != 2){
            if($valid->id_user_kategori == 0){
                redirect(base_url('pasien/Pasien'));
            }
            else{
                redirect(base_url('admin/Admin'));
            }
        }
        $data_registrasi_update = [
            'dimulai_pada'=>(new DateTime('now'))->format('Y-m-d H:i:s')
        ];

        $this->db->set($data_registrasi_update);
        $this->db->where('id', $id_registrasi);
        $this->db->update('data_registrasi_homecare');

        echo "OK";
    }

    public function simpan_kegiatan($id_registrasi){
        if(!$this->session->userdata('is_login')){
            redirect(base_url('Login'));
        }
        $valid = $this->db->query('SELECT id_user_kategori FROM master_user WHERE id = '.$this->session->userdata('id_user'))->row();
        if($valid->id_user_kategori != 2){
            if($valid->id_user_kategori == 0){
                redirect(base_url('pasien/Pasien'));
            }
            else{
                redirect(base_url('admin/Admin'));
            }
        }
        $data = $this->input->post();
        $nama = $data['nama'];

        $config['upload_path']          = './assets/images/kegiatan_homecare';
        $config['allowed_types']        = 'gif|jpg|png|jpeg|jfif';
        $config['max_size']             = 10024;
        $config['file_name']            = $id_registrasi.'-'.random_int(1, 9999);

        $this->load->library('upload', $config);
        $this->upload->initialize($config);

        if ($this->upload->do_upload('foto')) {
            $foto = $this->upload->data('file_name');
            $data_kegiatan = [
                'id_registrasi' => $id_registrasi,
                'nama' => $nama,
                'foto' => $foto
            ];

            $this->db->insert('kegiatan_homecare', $data_kegiatan);

            echo json_encode(array(
                'id_kegiatan'=>$this->db->insert_id(),
                'foto' => $foto
            ));
        }else{
            $this->db->delete('kegiatan_homecare', array('id_registrasi'=>$id_registrasi));
            echo "GAGAL";
        }
    }

    public function simpan_assesment($id_registrasi){
        if(!$this->session->userdata('is_login')){
            redirect(base_url('Login'));
        }
        $valid = $this->db->query('SELECT id_user_kategori FROM master_user WHERE id = '.$this->session->userdata('id_user'))->row();
        if($valid->id_user_kategori != 2){
            if($valid->id_user_kategori == 0){
                redirect(base_url('pasien/Pasien'));
            }
            else{
                redirect(base_url('admin/Admin'));
            }
        }
        $data = $this->input->post();

        $berat_badan = $data['berat_badan'];
        $tinggi_badan = $data['tinggi_badan'];
        $suhu = $data['suhu'];
        $tekanan_darah = $data['tekanan_darah'];
        $merokok = $data['merokok'];
        $alkohol = $data['alkohol'];
        $kecelakaan = $data['kecelakaan'];
        $operasi = $data['operasi'];

        $data_assesment = [
            'id_registrasi' => $id_registrasi,
            'berat_badan' => $berat_badan,
            'tinggi_badan' => $tinggi_badan,
            'suhu' => $suhu,
            'tekanan_darah' => $tekanan_darah,
            'merokok' => $merokok,
            'alkohol'=> $alkohol,
            'kecelakaan' => $kecelakaan,
            'operasi' => $operasi
        ];
        $assesment = $this->db->query('SELECT id FROM assesment_homecare WHERE id_registrasi = ?', $id_registrasi)->row();
        if($assesment){
            $this->db->set($data_assesment);
            $this->db->update('assesment_homecare', $data_assesment);
        }else{
            $this->db->insert('assesment_homecare', $data_assesment);
        }

        echo "OK";
    }

    public function add_resep($id_registrasi){
        if(!$this->session->userdata('is_login')){
            redirect(base_url('Login'));
        }
        $valid = $this->db->query('SELECT id_user_kategori FROM master_user WHERE id = '.$this->session->userdata('id_user'))->row();
        if($valid->id_user_kategori != 2){
            if($valid->id_user_kategori == 0){
                redirect(base_url('pasien/Pasien'));
            }
            else{
                redirect(base_url('admin/Admin'));
            }
        }
        $data = $this->input->post();
        $id_obat = $data['id_obat'];
        $jumlah_obat = $data['jumlah_obat'];
        $keterangan = $data['keterangan'];

        $obat = $this->db->query('SELECT harga_per_n_unit, harga FROM master_obat WHERE id = ?', $id_obat)->row();
        $data_resep = array(
            "id_registrasi" => $id_registrasi,
            "id_obat" => $id_obat,
            "jumlah_obat" => $jumlah_obat,
            "harga_per_n_unit" => $obat->harga_per_n_unit,
            "harga" => $obat->harga,
            "keterangan" => $keterangan,
        );
        $this->db->insert('resep_dokter_homecare', $data_resep);

        echo json_encode(array('id_resep'=>$this->db->insert_id()));
    }

    public function delete_resep($id_resep){
        if(!$this->session->userdata('is_login')){
            redirect(base_url('Login'));
        }
        $valid = $this->db->query('SELECT id_user_kategori FROM master_user WHERE id = '.$this->session->userdata('id_user'))->row();
        if($valid->id_user_kategori != 2){
            if($valid->id_user_kategori == 0){
                redirect(base_url('pasien/Pasien'));
            }
            else{
                redirect(base_url('admin/Admin'));
            }
        }
        
        $this->db->delete('resep_dokter_homecare', array('id'=>$id_resep));

        echo "OK";
    }

    public function delete_kegiatan($id_kegiatan){
        if(!$this->session->userdata('is_login')){
            redirect(base_url('Login'));
        }
        $valid = $this->db->query('SELECT id_user_kategori FROM master_user WHERE id = '.$this->session->userdata('id_user'))->row();
        if($valid->id_user_kategori != 2){
            if($valid->id_user_kategori == 0){
                redirect(base_url('pasien/Pasien'));
            }
            else{
                redirect(base_url('admin/Admin'));
            }
        }
        
        $this->db->delete('kegiatan_homecare', array('id'=>$id_kegiatan));

        echo "OK";
    }
}
            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2>Disposisi Surat</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="?p=home">Home</a>
                        </li>
                        <li>
                            <a href="?p=disposition.read">Disposisi Masuk</a>
                        </li>
                        <li class="active">
                            <strong>Informasi Dispo Surat</strong>
                        </li>
                    </ol>
                </div>
                <div class="col-lg-2">

                </div>
            </div>

        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
            <div class="col-lg-12">
            
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Informasi Dispo Surat</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                            <a class="close-link">
                                <i class="fa fa-times"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">
                    <div class="table-responsive">
                    <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>Surat dari</th>
                        <th>Tanggal Surat</th>
                        <th>Nomor Surat</th>
                        <th>Tanggal diterima</th>
                        <th>Nomer Agenda</th>   
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                        $getId  = $_GET['q']; 
                        $sql    = "SELECT tb_suratmasuk.id_sm, tb_suratmasuk.tglaccept, tb_suratmasuk.nosurat, tb_suratmasuk.tglsurat, tb_suratmasuk.perihal, tb_suratmasuk.pengirim, tb_suratmasuk.file, tb_suratmasuk.lamp, tb_agenda.jabatan, tb_user.nama, tb_sifat.sifat, tb_dispo.dispo, tb_dispo.isidispo, tb_dispo.isi_tindakan, tb_bagian.bagian, tb_dispo.ket
                            FROM `tb_suratmasuk` 
                            INNER JOIN `tb_sifat` ON (`tb_suratmasuk`.`id_sifat` = `tb_sifat`.`id_sifat`)
                            INNER JOIN `tb_agenda` ON (`tb_suratmasuk`.`id_ag` = `tb_agenda`.`id_ag`)
                            INNER JOIN `tb_dispo` ON (`tb_suratmasuk`.`id_sm` = `tb_dispo`.`id_dispo`)
                            INNER JOIN `tb_bagian` ON (`tb_dispo`.`dispo` = `tb_bagian`.`uac`)
                            INNER JOIN `tb_user` ON (`tb_suratmasuk`.`uac` = `tb_user`.`uac`)
                                WHERE `tb_suratmasuk`.`id_sm` = '{$getId}'";

                        $res = $conn->query($sql);

                        foreach ($res as $row) {
                    
                        $ket = $row['ket'];

                        if ($ket == "0"){
                            $ket = '<span class="label label-warning">Belum ditindaklanjuti</span>';
                        }else{
                            $ket = '<span class="label label-primary">Sudah ditindaklanjuti</span>';
                        }
                    }
                    ?>
                    <tr>
                        <td><?php echo $row['pengirim']; ?></td>
                        <td><?php echo DateIndo($row['tglsurat']); ?></td>
                        <td><?php echo $row['nosurat']; ?></td>
                        <td><?php echo DateIndo($row['tglaccept']); ?></td>
                        <td><?php echo $row['id_sm']; ?></td>
                    </tr>
                    </tbody>
                    </table>

                    <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>Berkas Surat</th>
                        <th>Disposisi dari</th>
                    </tr>
                    </thead>
                    <tbody>     
                    <tr>
                        <td style="width: 40%;"><?php echo $row['lamp']; ?> <a href="files/incoming/<?php echo $row['file']; ?>" target="_blank" ><?php echo $row['file']; ?></a></td>
                        <td><?php echo $row['nama']." - ".$row['jabatan']; ?></td>
                    </tr>
                    </tbody>   
                    </table>

                    <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>Dispo kepada</th>
                        <th>Isi disposisi</th>
                    </tr>
                    </thead>
                    <tbody rowspan="20px">     
                    <tr>
                        <td style="width: 40%;"><?php echo $_SESSION['bgn']." ".$ket; ?></td>
                        <td><?php echo $row['isidispo']; ?>
                        </td>
                    </tr>
                    </tbody>
                    </table>

                    <form action="?p=disposition.confirm" method="post" class="form-horizontal" enctype="multipart/form-data">
                    <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>Pesan tindakan</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>
                        <input type="hidden" name="q" value="<?php echo $getId ?>"/>
                            <textarea type="text" name="isi_tindakan" class="form-control" required="" placeholder="Tulis pesan disini.."><?php echo $row['isi_tindakan']; ?></textarea>
                        </td>
                    </tr>
                    </tbody>
                    </table>
                        <button class="btn btn-primary" type="submit" name="proses">Tindaklanjuti</button>
                        <a class="btn btn-primary" title="Lihat Dipsosisi" href="print.php?s=disposition.ketua&q=<?php echo $row['id_sm']; ?>" target='_blank'>Cetak Disposisi</a>
                    </form>
                </div>
            </div>
        </div>
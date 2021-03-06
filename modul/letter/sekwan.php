            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2>Informasi Surat Sekretaris</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="?p=home">Home</a>
                        </li>
                        <li>
                            <a href="?p=incoming.sekwan">Surat Sekretaris</a>
                        </li>
                        <li class="active">
                            <strong>Informasi Surat Sekretaris</strong>
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
                        <h5>Informasi Surat Sekretaris</h5>
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
                        <th>Tanggal Diterima</th>
                        <th>Nomor Surat</th>
                        <th>Tanggal Surat</th>
                        <th>Perihal</th>
                        <th>Pengirim</th>
                        <th>Sifat Surat</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                        $getId  = $_GET['q']; 
                        $sql    = "SELECT tb_suratmasuk.id_sm, tb_suratmasuk.tglaccept, tb_suratmasuk.nosurat, tb_suratmasuk.tglsurat, tb_suratmasuk.perihal, tb_suratmasuk.pengirim, tb_suratmasuk.file, tb_suratmasuk.lamp, tb_agenda.jabatan, tb_sifat.sifat, tb_dispo.dispo, tb_dispo.isidispo, tb_dispo.isi_tindakan, tb_suratmasuk.status, tb_bagian.bagian, tb_user.bgn, tb_dispo.ket
                            FROM `tb_suratmasuk` 
                            INNER JOIN `tb_sifat` ON (`tb_suratmasuk`.`id_sifat` = `tb_sifat`.`id_sifat`)
                            INNER JOIN `tb_agenda` ON (`tb_suratmasuk`.`id_ag` = `tb_agenda`.`id_ag`)
                            INNER JOIN `tb_dispo` ON (`tb_suratmasuk`.`id_sm` = `tb_dispo`.`id_dispo`)
                            INNER JOIN `tb_user` ON (`tb_dispo`.`dispo` = `tb_user`.`uac`)
                            INNER JOIN `tb_bagian` ON (`tb_dispo`.`tembusan` = `tb_bagian`.`uac`)
                        WHERE `tb_suratmasuk`.`id_sm` = '{$getId}'";

                        $res    = $conn->query($sql);
                        $row    = $res->fetch_assoc();

                        $status = $row['status'];
                        if ($status == "0"){
                            $status = '<span class="label label-warning">Belum dibaca</span>';
                        }else{
                            $status = '<span class="label label-primary">Sudah dibaca</span>';
                        }

                        $ket = $row['ket'];
                        if ($ket == "0"){
                            $ket = '<span class="label label-warning">Belum ditindaklanjuti</span>';
                        }else{
                            $ket = '<span class="label label-primary">Sudah ditindaklanjuti</span>';
                        }
                    ?>
                    <tr>
                        <td><?php echo DateIndo($row['tglaccept']); ?></td>
                        <td><?php echo $row['nosurat']; ?></td>
                        <td><?php echo DateIndo($row['tglsurat']); ?></td>
                        <td><?php echo $row['perihal']; ?></td>
                        <td><?php echo $row['pengirim']; ?></td>
                        <td><?php echo $row['sifat']; ?></td>
                    </tr>
                    </tbody>
                    </table>

                    <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>Berkas Surat</th>
                        <th>Agenda Surat</th>
                    </tr>
                    </thead>
                    <tbody>     
                    <tr>
                        <td style="width: 40%;"><?php echo $row['lamp']; ?> <a href="files/incoming/<?php echo $row['file']; ?>" target="_blank" ><?php echo $row['file']; ?></a></td>
                        <td><?php echo $row['jabatan']." ".$status; ?></td>      
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
                    <tbody>
                    <tr>
                        <td style="width: 40%;"><?php echo $row['bgn']." ".$ket; ?></td>
                        <td><?php echo $row['isidispo']; ?></td>
                    </tr>
                    </tbody>
                    </table>

                    <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>Diteruskan ke</th>
                        <th>Isi tindakan</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td style="width: 40%;"><?php echo $row['bagian']; ?></td>
                        <td><?php echo $row['isi_tindakan']; ?></td>
                    </tr>
                    </tbody>
                    </table>
                        <a class="btn btn-white" href="?p=incoming.sekwan">Back</a>
                        <a class="btn btn-primary" title="Lihat Dipsosisi" href="print.php?s=disposition.sekwan&q=<?php echo $row['id_sm']; ?>" target='_blank'>Disposisi</a>
                </div>
            </div>
        </div>
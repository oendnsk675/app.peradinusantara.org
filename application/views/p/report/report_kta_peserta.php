<!-- Begin Page Content -->
<style type="text/css">
    th, td {
      padding: 1px 10px;
      border: 1px solid #ddd;
      text-align: left;
      white-space: nowrap; /* Prevents text from wrapping */
      text-overflow: ellipsis; /* Adds ellipsis (...) to truncated text */
    }
</style>
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div id="filterData" class="collapse mt-4 container-fluid" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <form class="user" method="post" action="<?= base_url('P/Admin/report_kta_peserta')?>">
                <input type="hidden" name="<?= $this->security->get_csrf_token_name();?>" value="<?= $this->security->get_csrf_hash();?>">
                <div class="form-group row">
                    <div class="col-sm-3 mb-3 mb-sm-0">
                        <input type="text" class="form-control" name="nama_lengkap"
                            placeholder="Nama Peserta" value="<?= $nama_lengkap;?>">
                    </div>
                    <div class="col-sm-3 mb-3 mb-sm-0">
                        <input type="text" class="form-control" name="pic"
                            placeholder="PIC" value="<?= $pic;?>">
                    </div>
                    <div class="col-sm-3 mb-3 mb-sm-0">
                        <select class="form-control" name="angkatan">
                                <option value="<?= $angkatan; ?>" disabled selected>--Pilih Angkatan--</option>
                                <?php for ($i= $startAngkatan; $i <= $endAngkatan; $i++) {?>
                                    <option value="Angkatan Ke - <?=$i;?>">Angkatan Ke - <?=$i;?></option>
                                <?php } ?>
                        </select>
                    </div>
                     <div class="col-sm-3 mb-3 mb-sm-0">
                        <select class="form-control" required name="jenis_kta">
                                <option value="" disabled selected>--Jenis KTA--</option>
                                    <option value="4">PAJAK</option>
                                    <option value="2">PARALEGAL</option>
                                    <option value="1">ADVOKAT</option>
                        </select>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Cari Data</button>
            </form>
        </div>
        <div id="importData" class="collapse mt-4 container-fluid" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <form class="user" method="post" enctype="multipart/form-data" action="<?= base_url('P/Admin/importDataPeserta')?>">
                <input type="hidden" name="<?= $this->security->get_csrf_token_name();?>" value="<?= $this->security->get_csrf_hash();?>">
                <div class="form-group row">
                    <div class="col-sm-3 mb-3 mb-sm-0">
                        <input type="file" class="form-control" name="file_excel"
                            placeholder="Nama Peserta" value="">
                        <p class="mt-2">Download Template <a href="<?= base_url('assets/p/format_file/Format_Import_Data_Peserta.xlsx')?>">Download</a></p>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Proses Import</button>
            </form>
        </div>
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <a class="btn btn-danger" href="#" data-toggle="collapse" data-target="#filterData"
                aria-expanded="true" aria-controls="collapsePages">
                <i class="fas fa-fw fa-search"></i>
                <span>Filter Data</span>
            </a>

            <div class="dropdown no-arrow">
                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-ellipsis-v fa-sm fa-fw"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                    aria-labelledby="dropdownMenuLink">
                    <div class="dropdown-header">Export Data:</div>
                    <button class="dropdown-item" onclick="exportTableToExcel('tableData', 'Report_detail_perserta')">Excel</button>
                    <button class="dropdown-item" onclick="exportTableToCSV('report_data.csv')">CSV</button>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive" style="font-size: 10px;
            color: black ; 
            max-height: calc(80vh - 120px);
            overflow-y: auto;">
                <table class="" border="1px" id="tableData" cellpadding="0px" cellspacing="0">
                    <thead>
                        <tr style="background-color: silver">
                            <th>NIK</th>
                            <th>Email</th>
                            <th>Nama</th>
                            <th>Handphone</th>
                            <th>Usia</th>
                            <th>Asal Kampus</th>
                            <th>PIC</th>
                            <th>Angkatan</th>
                            <th>NO KTA</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php 
                        foreach ($list_report as $lr) { 
                        ?>
                        <tr>
                            <td><?= $lr['nik'];?></td>
                            <td><?= $lr['email'];?></td>
                            <td><?= $lr['nama_lengkap'];?></td>  
                            <td><?= $lr['handphone'];?></td>
                            <td><?= $lr['usia'];?></td>
                            <td><?= $lr['asal_kampus'];?></td>
                            <td><?= $lr['pic'];?></td>
                            <td><?= $lr['angkatan'];?></td>
                            <td><h4><?= $lr['number_certificate'];?></h4></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

<script>
  function exportTableToExcel(tableID, filename = ''){
      var downloadLink;
      var dataType = 'application/vnd.ms-excel';
      var tableSelect = document.getElementById(tableID);
      var tableHTML = tableSelect.outerHTML.replace(/ /g, '%20');

      // Specify file name
      filename = filename ? filename + '.xlsx' : '_excel_data.xlsx';

      // Create download link element
      downloadLink = document.createElement("a");

      document.body.appendChild(downloadLink);

      if(navigator.msSaveOrOpenBlob){
          var blob = new Blob(['\ufeff', tableHTML], {
              type: dataType
          });
          navigator.msSaveOrOpenBlob( blob, filename);
      } else {
          // Create a link to the file
          downloadLink.href = 'data:' + dataType + ', ' + tableHTML;

          // Setting the file name
          downloadLink.download = filename;

          //triggering the function
          downloadLink.click();
      }
  }

  function downloadCSV(csv, filename) {
    var csvFile;
    var downloadLink;

    // Create a CSV file
    csvFile = new Blob([csv], {type: "text/csv"});

    // Create a download link
    downloadLink = document.createElement("a");

    // Set the file name
    downloadLink.download = filename;

    // Link the file to the download link
    downloadLink.href = window.URL.createObjectURL(csvFile);

    // Hide the link
    downloadLink.style.display = "none";

    // Append the link to the document
    document.body.appendChild(downloadLink);

    // Trigger a click event to download the file
    downloadLink.click();
  }

  function exportTableToCSV(filename) {
    var csv = [];
    var rows = document.querySelectorAll("#tableData tr");

    // Loop through each row
    for (var i = 0; i < rows.length; i++) {
      var row = [], cols = rows[i].querySelectorAll("td, th");

      // Loop through each cell (td or th)
      for (var j = 0; j < cols.length; j++) {
        row.push(cols[j].innerText);
      }

      // Join each row with a comma and push it to the CSV array
      csv.push(row.join(";"));
    }

    // Join the rows with new lines to create the CSV content
    downloadCSV(csv.join("\n"), filename);
  }
</script>

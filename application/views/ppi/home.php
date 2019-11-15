<style>
.table { width: 100%; }

/*thead, tbody, tfoot{display: block;}

tbody{
  height: 100px;
  overflow-y: auto;
  overflow-x:hidden; 
  }*/
</style>

<section class="content-header">
  <label class="text"> <?php echo $title; ?></label>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active"><a href="#">PPI</a></li>
  </ol>
</section>
<section class="content">
  <div class="box">
    <span id="tester"></span>
    <div class="box-header with-border">
      <form class="form-inline">
        <select id="Bulan" class="form-control col-sm-2" name="bulan">
          <option value="1">Januari</option>
          <option value="2">Februari</option>
          <option value="3">Maret</option>
          <option value="4">April</option>
          <option value="5">Mei</option>
          <option value="6">Juni</option>
          <option value="7">Juli</option>
          <option value="8">Agustus</option>
          <option value="9">September</option>
          <option value="10">Oktober</option>
          <option value="11">November</option>
          <option value="12">Desember</option>
        </select>
        <!-- <label for="tahun">Tahun</label> -->
        <input type="number" id="tahun" class="form-control col-sm-1" name="tahun"> 
        <a href="javascript::void()" onclick="showAllData()" class="btn btn-primary">Submit</a>
      </form>
    </div>
    <div class="box-body">
      <table id="tbPpi" class="table table-border table-striped table-hover table-responsive">
        <thead>
          <tr>
            <th rowspan="2" class="align-middle">Tanggal</th>
            <th rowspan="2">Jumlah Pasien</th>
            <th colspan="5">Jenis Alat yang Terpasang/Tindakan</th>
            <th colspan="6">Jenis Infekasi yang Terjadi</th>
          </tr>
          <tr>
            <th>LVL</th>
            <th>DC</th>
            <th>NGT/Ventilator/CPAP</th>
            <th>BEDAH</th>
            <th>IRAH BARING</th>
            <th>PHLEBITIS</th>
            <th>ISK</th>
            <th>ILO</th>
            <th>PNEUMONIA</th>
            <th>DEKUBITUS</th>
            <th>SEPSIS</th>
          </tr>
        </thead>
        <tbody id="showdata">
        </tbody>
        <tfoot>
          <tr class="bg-success">
            <td class="text text-bold text-center">TOTAL</td>
            <td id="totPasien_jml" class="text text-bold text-center"></td>
            <td id="totLvl" class="text text-bold text-center"></td>
            <td id="totDc" class="text text-bold text-center"></td>
            <td id="totNgt" class="text text-bold text-center"></td>
            <td id="totBedah" class="text text-bold text-center"></td>
            <td id="totIrahBaring" class="text text-bold text-center"></td>
            <td id="totPhlebitis" class="text text-bold text-center"></td>
            <td id="totIsk" class="text text-bold text-center"></td>
            <td id="totIlo" class="text text-bold text-center"></td>
            <td id="totPneumonia" class="text text-bold text-center"></td>
            <td id="totDekubitus" class="text text-bold text-center"></td>
            <td id="totSepsis" class="text text-bold text-center"></td>
          </tr>
        </tfoot>
      </table>
    </div>
    <div class="box-footer clearfix">
    </div>
  </div>
</section>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>assets/bower_components/bootstrap-notify-master/bootstrap-notify.min.js"></script>
<script>
  $(document).ready(function () {
    var d = new Date();
    var n = d.getFullYear();
    var m = d.getMonth()+1;
    $("#Bulan").val(m);
    document.getElementById("tahun").max = n; 
    document.getElementById("tahun").min = n-1; 
    document.getElementById("tahun").value = n; 
    $(".angka").keypress(function(e){
     if (isNaN(String.fromCharCode(e.which))) e.preventDefault();
   })
  });

  function number_only(event){
    if(event.keyCode < 48 || event.keyCode > 57){return false;}
  }

  function saveUpdate(editableObj,column,id) {
    $(editableObj).css("background","#FFF url(<?php echo base_url('assets/loaderIcon.gif');?>) no-repeat right");
    $.ajax({
      url: "<?php echo site_url('ppi/update');?>",
      type: "POST",
      data:'column='+column+'&editval='+editableObj.innerHTML+'&id='+id,
      success: function(data){
        $(editableObj).css("background","#FDFDFD");
        showAllData();
      }
    });
  }

  function showAllData() {
   var d = new Date();
   var n = d.getFullYear();
   var m = d.getMonth()+1;
   var ai = document.getElementById("Bulan");
   var mt = ai.options[ai.selectedIndex].value;
   var yr = $("#tahun").val();
   if(yr >= n){
    if(mt > m){
      alert('Tanggal yang anda inputkan tidak diijinkan!');
      $('#Bulan').focus();
    }else if(mt < (m-1)){
      alert('Tanggal yang anda inputkan tidak diijinkan!');
    }
  }else if(yr < n){
    if(mt < (m-1)){
      alert('Tanggal yang anda inputkan tidak diijinkan!');
      $('#Bulan').focus();
    }
  }
  $.ajax({
    type: 'ajax',
    url: "<?php echo site_url('ppi/showAlldata/');?>" + mt + "/" + yr,
    async: false,
    dataType: 'json',
    success: function (data) {
      console.log(data);
      var html = '';
      var i;
      var totPasien_jml=0;
      var totLvl=0;
      var totDc=0;
      var totNgt=0;
      var totBedah=0;
      var totIrahBaring=0;
      var totPhlebitis=0;
      var totIsk=0;
      var totIlo=0;
      var totPneumonia=0;
      var totDekubitus=0;
      var totSepsis=0;
      for (i = 0; i < data.length; i++) {
        totPasien_jml = totPasien_jml + parseInt(data[i].pasien_qty);
        totLvl = totLvl + parseInt(data[i].lvl);
        totDc = totDc + parseInt(data[i].dc);
        totNgt = totNgt + parseInt(data[i].ngt);
        totBedah = totBedah + parseInt(data[i].bedah);
        totIrahBaring = totIrahBaring + parseInt(data[i].irah_baring);
        totPhlebitis = totPhlebitis + parseInt(data[i].phlebitis);
        totIsk = totIsk + parseInt(data[i].isk);
        totIlo = totIlo + parseInt(data[i].ilo);
        totPneumonia = totPneumonia + parseInt(data[i].pneumonia);
        totDekubitus = totDekubitus + parseInt(data[i].dekubitus);
        totSepsis = totSepsis + parseInt(data[i].sepsis);
        html += '<tr>' +
        '<td class="text-center">' + data[i].tanggal + '</td>' +
        '<td class="text-center" contenteditable="true" onKeypress="if(event.keyCode < 48 || event.keyCode > 57){return false;}" onBlur="saveUpdate(this,'+ "'pasien_qty'" + ','+ data[i].ppi_cd  +', this);">' + data[i].pasien_qty + '</td>' +
        '<td class="text-center" contenteditable="true" onKeypress="if(event.keyCode < 48 || event.keyCode > 57){return false;}" onBlur="saveUpdate(this,'+ "'lvl'" + ','+ data[i].ppi_cd  +', this);">' + data[i].lvl + '</td>' +
        '<td class="text-center" contenteditable="true" onKeypress="if(event.keyCode < 48 || event.keyCode > 57){return false;}" onBlur="saveUpdate(this,'+ "'dc'" + ','+ data[i].ppi_cd  +', this);">' + data[i].dc + '</td>' +
        '<td class="text-center" contenteditable="true" onKeypress="if(event.keyCode < 48 || event.keyCode > 57){return false;}" onBlur="saveUpdate(this,'+ "'ngt'" + ','+ data[i].ppi_cd  +', this);">' + data[i].ngt + '</td>' +
        '<td class="text-center" contenteditable="true" onKeypress="if(event.keyCode < 48 || event.keyCode > 57){return false;}" onBlur="saveUpdate(this,'+ "'bedah'" + ','+ data[i].ppi_cd  +', this);">' + data[i].bedah + '</td>' +
        '<td class="text-center" contenteditable="true" onKeypress="if(event.keyCode < 48 || event.keyCode > 57){return false;}" onBlur="saveUpdate(this,'+ "'irah_baring'" + ','+ data[i].ppi_cd  +', this);">' + data[i].irah_baring + '</td>' +
        '<td class="text-center" contenteditable="true" onKeypress="if(event.keyCode < 48 || event.keyCode > 57){return false;}" onBlur="saveUpdate(this,'+ "'phlebitis'" + ','+ data[i].ppi_cd  +', this);">' + data[i].phlebitis + '</td>' +
        '<td class="text-center" contenteditable="true" onKeypress="if(event.keyCode < 48 || event.keyCode > 57){return false;}" onBlur="saveUpdate(this,'+ "'isk'" + ','+ data[i].ppi_cd  +', this);">' + data[i].isk + '</td>' +
        '<td class="text-center" contenteditable="true" onKeypress="if(event.keyCode < 48 || event.keyCode > 57){return false;}" onBlur="saveUpdate(this,'+ "'ilo'" + ','+ data[i].ppi_cd  +', this);">' + data[i].ilo + '</td>' +
        '<td class="text-center" contenteditable="true" onKeypress="if(event.keyCode < 48 || event.keyCode > 57){return false;}" onBlur="saveUpdate(this,'+ "'pneumonia'" + ','+ data[i].ppi_cd  +', this);">' + data[i].pneumonia + '</td>' +
        '<td class="text-center" contenteditable="true" onKeypress="if(event.keyCode < 48 || event.keyCode > 57){return false;}" onBlur="saveUpdate(this,'+ "'dekubitus'" + ','+ data[i].ppi_cd  +', this);">' + data[i].dekubitus + '</td>' +
        '<td class="text-center" contenteditable="true" onKeypress="if(event.keyCode < 48 || event.keyCode > 57){return false;}" onBlur="saveUpdate(this,'+ "'sepsis'" + ','+ data[i].ppi_cd  +', this);">' + data[i].sepsis + '</td>' +
        '</tr>';
      }
      $('#showdata').html(html);
      $('#totPasien_jml').text(totPasien_jml);
      $('#totLvl').text(totLvl);
      $('#totDc').text(totDc);
      $('#totNgt').text(totNgt);
      $('#totBedah').text(totBedah);
      $('#totIrahBaring').text(totIrahBaring);
      $('#totPhlebitis').text(totPhlebitis);
      $('#totIsk').text(totIsk);
      $('#totIlo').text(totIlo);
      $('#totPneumonia').text(totPneumonia);
      $('#totDekubitus').text(totDekubitus);
      $('#totSepsis').text(totSepsis);
    },
    error: function () {
      alert('Terjadi masalah mengakses server.');
    }
  });
}

</script>

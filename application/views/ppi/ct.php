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
        <input type="number" id="tahun" class="form-control col-sm-1" name="tahun"> 
        <a href="javascript::void()" onclick="showAllData()" class="btn btn-primary">Submit</a>
      </form>
    </div>
    <div class="box-body">
      <table id="tbPpi" class="table">
        <thead>
          <tr class="bg-success">
            <th class="text-center">NO</th>
            <th class="text-center">UNIT</th>
            <th class="text-center">PERSENTASE %</th>
          </tr>
        </thead>
        <tbody id="showdata">
        </tbody>
        <tfoot>
          <tr class="bg-success">
            <td class="text-center text-bold" colspan="2">TOTAL</td>
            <td class="text-center text-bold total_ct"></td>
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
      url: "<?php echo site_url('ppi/update_ct');?>",
      type: "POST",
      data:'column='+column+'&editval='+editableObj.innerHTML+'&id='+id,
      success: function(data){
        $(editableObj).css("background","#FDFDFD");
        showAllData();
      }
    });
    // alert(editableObj.innerHTML + column + id);
  }

  function showAllData() 
  {
    var ai = document.getElementById("Bulan");
    var mt = ai.options[ai.selectedIndex].value;
    var yr = $("#tahun").val();
    var url= "<?php echo base_url('ppi/get_ajax_ct/');?>" + mt + "/" + yr;

    $.ajax({
      type: 'ajax',
      url: "<?php echo site_url('ppi/showAlldata_ct/');?>" + mt + "/" + yr,
      async: false,
      dataType: 'json',
      success: function (data) {
        console.log(data);
        var html = '';
        var i;
        var no=1;
        var total_ct=0;
        for (i = 0; i < data.length; i++) {
          html += '<tr>' + 
          '<td class="text-center">' + no + '</td>' +
          '<td class="text-center">' + data[i].unit_nm + '</td>' +
          '<td class="text-center text-blue" contenteditable="true" onKeypress="if(event.keyCode < 48 || event.keyCode > 57 || this.val > 100){return false;}" onBlur="saveUpdate(this,'+ "'rate'" + ','+ data[i].id_ct +');">' + data[i].rate + '</td>' +
          '</tr>';
        no=no+1;
        total_ct=total_ct+parseInt(data[i].rate);
        }
      $('#showdata').html(html);
      $('.total_ct').text(total_ct);
    },
    error: function () {
      alert('Terjadi masalah untuk mengakses data kategori.');
    }
  });
  }

</script>

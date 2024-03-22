
<script>
  $(function () {
    $('#details_table').DataTable({
      "paging": false,
      "order": [[ 0, "desc" ]]
    });
  });
</script>

<script>
  function myFunction0(){
    var x0 = document.getElementById("lot0").value;
    base_url = "<?php  echo base_url();?>";
    sku_code = "<?php echo $rtv->sku_code;?>";
    if(x0==''){
      x0 = 'nonevalue';

    }else{
      x0=x0;
    }
    
    $.ajax({
        type: 'GET',
        url: base_url+"index.php/monitoring/ajax_row/"+sku_code+"/"+x0
    }).then(function (row) {
        console.log(row);
        var obj = jQuery.parseJSON( row);
        console.log(obj.id);
      
        if(obj.id=="NONE"){
           
          document.getElementById('qty0').disabled=true;
          document.getElementById('notexist0').style.display='block';
          document.getElementById('exist0').style.display='none';
        }else{
          console.log(row);
          document.getElementById('qty0').disabled=false;
          document.getElementById('notexist0').style.display='none';
          document.getElementById('exist0').style.display='block';
        }
    });
  }

  function myFunction1(){
    var x1 = document.getElementById("lot1").value;
    base_url = "<?php  echo base_url();?>";
    sku_code = "<?php echo $rtv->sku_code;?>";
    if(x1==''){
      x1 = 'nonevalue';

    }else{
      x1=x1;
    }
    
    $.ajax({
        type: 'GET',
        url: base_url+"index.php/monitoring/ajax_row/"+sku_code+"/"+x1
    }).then(function (row) {
        console.log(row);
        var obj = jQuery.parseJSON( row);
        console.log(obj.id);
      
        if(obj.id=="NONE"){
           
          document.getElementById('qty1').disabled=true;
          document.getElementById('notexist1').style.display='block';
          document.getElementById('exist1').style.display='none';
        }else{
          console.log(row);
          document.getElementById('qty1').disabled=false;
          document.getElementById('notexist1').style.display='none';
          document.getElementById('exist1').style.display='block';
        }
    });
  }

  function myFunction2(){
    var x2 = document.getElementById("lot2").value;
    base_url = "<?php  echo base_url();?>";
    sku_code = "<?php echo $rtv->sku_code;?>";
    if(x2==''){
      x2 = 'nonevalue';

    }else{
      x2=x2;
    }
    
    $.ajax({
        type: 'GET',
        url: base_url+"index.php/monitoring/ajax_row/"+sku_code+"/"+x2
    }).then(function (row) {
        console.log(row);
        var obj = jQuery.parseJSON( row);
        console.log(obj.id);
      
        if(obj.id=="NONE"){
           
          document.getElementById('qty2').disabled=true;
          document.getElementById('notexist2').style.display='block';
          document.getElementById('exist2').style.display='none';
        }else{
          console.log(row);
          document.getElementById('qty2').disabled=false;
          document.getElementById('notexist2').style.display='none';
          document.getElementById('exist2').style.display='block';
        }
    });
  }

  function myFunction3(){
    var x3 = document.getElementById("lot3").value;
    base_url = "<?php  echo base_url();?>";
    sku_code = "<?php echo $rtv->sku_code;?>";
    if(x3==''){
      x3 = 'nonevalue';

    }else{
      x3=x3;
    }
    
    $.ajax({
        type: 'GET',
        url: base_url+"index.php/monitoring/ajax_row/"+sku_code+"/"+x3
    }).then(function (row) {
        console.log(row);
        var obj = jQuery.parseJSON( row);
        console.log(obj.id);
      
        if(obj.id=="NONE"){
           
          document.getElementById('qty3').disabled=true;
          document.getElementById('notexist3').style.display='block';
          document.getElementById('exist3').style.display='none';
        }else{
          console.log(row);
          document.getElementById('qty3').disabled=false;
          document.getElementById('notexist3').style.display='none';
          document.getElementById('exist3').style.display='block';
        }
    });
  }

  function myFunction4(){
    var x4 = document.getElementById("lot4").value;
    base_url = "<?php  echo base_url();?>";
    sku_code = "<?php echo $rtv->sku_code;?>";
    if(x4==''){
      x4 = 'nonevalue';

    }else{
      x4=x4;
    }
    
    $.ajax({
        type: 'GET',
        url: base_url+"index.php/monitoring/ajax_row/"+sku_code+"/"+x4
    }).then(function (row) {
        console.log(row);
        var obj = jQuery.parseJSON( row);
        console.log(obj.id);
      
        if(obj.id=="NONE"){
           
          document.getElementById('qty4').disabled=true;
          document.getElementById('notexist4').style.display='block';
          document.getElementById('exist4').style.display='none';
        }else{
          console.log(row);
          document.getElementById('qty4').disabled=false;
          document.getElementById('notexist4').style.display='none';
          document.getElementById('exist4').style.display='block';
        }
    });
  }

  function myFunction5(){
    var x5 = document.getElementById("lot5").value;
    base_url = "<?php  echo base_url();?>";
    sku_code = "<?php echo $rtv->sku_code;?>";
    if(x5==''){
      x5 = 'nonevalue';

    }else{
      x5=x5;
    }
    
    $.ajax({
        type: 'GET',
        url: base_url+"index.php/monitoring/ajax_row/"+sku_code+"/"+x5
    }).then(function (row) {
        console.log(row);
        var obj = jQuery.parseJSON( row);
        console.log(obj.id);
      
        if(obj.id=="NONE"){
           
          document.getElementById('qty5').disabled=true;
          document.getElementById('notexist5').style.display='block';
          document.getElementById('exist5').style.display='none';
        }else{
          console.log(row);
          document.getElementById('qty5').disabled=false;
          document.getElementById('notexist5').style.display='none';
          document.getElementById('exist5').style.display='block';
        }
    });
  }

  function myFunction6(){
    var x6 = document.getElementById("lot6").value;
    base_url = "<?php  echo base_url();?>";
    sku_code = "<?php echo $rtv->sku_code;?>";
    if(x6==''){
      x6 = 'nonevalue';

    }else{
      x6=x6;
    }
    
    $.ajax({
        type: 'GET',
        url: base_url+"index.php/monitoring/ajax_row/"+sku_code+"/"+x6
    }).then(function (row) {
        console.log(row);
        var obj = jQuery.parseJSON( row);
        console.log(obj.id);
      
        if(obj.id=="NONE"){
           
          document.getElementById('qty6').disabled=true;
          document.getElementById('notexist6').style.display='block';
          document.getElementById('exist6').style.display='none';
        }else{
          console.log(row);
          document.getElementById('qty6').disabled=false;
          document.getElementById('notexist6').style.display='none';
          document.getElementById('exist6').style.display='block';
        }
    });
  }

  function myFunction7(){
    var x7 = document.getElementById("lot7").value;
    base_url = "<?php  echo base_url();?>";
    sku_code = "<?php echo $rtv->sku_code;?>";
    if(x7==''){
      x7 = 'nonevalue';

    }else{
      x7=x7;
    }
    
    $.ajax({
        type: 'GET',
        url: base_url+"index.php/monitoring/ajax_row/"+sku_code+"/"+x7
    }).then(function (row) {
        console.log(row);
        var obj = jQuery.parseJSON( row);
        console.log(obj.id);
      
        if(obj.id=="NONE"){
           
          document.getElementById('qty7').disabled=true;
          document.getElementById('notexist7').style.display='block';
          document.getElementById('exist7').style.display='none';
        }else{
          console.log(row);
          document.getElementById('qty7').disabled=false;
          document.getElementById('notexist7').style.display='none';
          document.getElementById('exist7').style.display='block';
        }
    });
  }

  function myFunction8(){
    var x8 = document.getElementById("lot8").value;
    base_url = "<?php  echo base_url();?>";
    sku_code = "<?php echo $rtv->sku_code;?>";
    if(x8==''){
      x8 = 'nonevalue';

    }else{
      x8=x8;
    }
    
    $.ajax({
        type: 'GET',
        url: base_url+"index.php/monitoring/ajax_row/"+sku_code+"/"+x8
    }).then(function (row) {
        console.log(row);
        var obj = jQuery.parseJSON( row);
        console.log(obj.id);
      
        if(obj.id=="NONE"){
           
          document.getElementById('qty8').disabled=true;
          document.getElementById('notexist8').style.display='block';
          document.getElementById('exist8').style.display='none';
        }else{
          console.log(row);
          document.getElementById('qty8').disabled=false;
          document.getElementById('notexist8').style.display='none';
          document.getElementById('exist8').style.display='block';
        }
    });
  }

  function myFunction9(){
    var x9 = document.getElementById("lot9").value;
    base_url = "<?php  echo base_url();?>";
    sku_code = "<?php echo $rtv->sku_code;?>";
    if(x9==''){
      x9 = 'nonevalue';

    }else{
      x9=x9;
    }
    
    $.ajax({
        type: 'GET',
        url: base_url+"index.php/monitoring/ajax_row/"+sku_code+"/"+x9
    }).then(function (row) {
        console.log(row);
        var obj = jQuery.parseJSON( row);
        console.log(obj.id);
      
        if(obj.id=="NONE"){
           
          document.getElementById('qty9').disabled=true;
          document.getElementById('notexist9').style.display='block';
          document.getElementById('exist9').style.display='none';
        }else{
          console.log(row);
          document.getElementById('qty9').disabled=false;
          document.getElementById('notexist9').style.display='none';
          document.getElementById('exist9').style.display='block';
        }
    });
  }

  function myFunction10(){
    var x10 = document.getElementById("lot10").value;
    base_url = "<?php  echo base_url();?>";
    sku_code = "<?php echo $rtv->sku_code;?>";
    if(x10==''){
      x10 = 'nonevalue';

    }else{
      x10=x10;
    }
    
    $.ajax({
        type: 'GET',
        url: base_url+"index.php/monitoring/ajax_row/"+sku_code+"/"+x10
    }).then(function (row) {
        console.log(row);
        var obj = jQuery.parseJSON( row);
        console.log(obj.id);
      
        if(obj.id=="NONE"){
           
          document.getElementById('qty10').disabled=true;
          document.getElementById('notexist10').style.display='block';
          document.getElementById('exist10').style.display='none';
        }else{
          console.log(row);
          document.getElementById('qty10').disabled=false;
          document.getElementById('notexist10').style.display='none';
          document.getElementById('exist10').style.display='block';
        }
    });
  }

  function myFunction11(){
    var x11 = document.getElementById("lot11").value;
    base_url = "<?php  echo base_url();?>";
    sku_code = "<?php echo $rtv->sku_code;?>";
    if(x11==''){
      x11 = 'nonevalue';

    }else{
      x11=x11;
    }
    
    $.ajax({
        type: 'GET',
        url: base_url+"index.php/monitoring/ajax_row/"+sku_code+"/"+x11
    }).then(function (row) {
        console.log(row);
        var obj = jQuery.parseJSON( row);
        console.log(obj.id);
      
        if(obj.id=="NONE"){
           
          document.getElementById('qty11').disabled=true;
          document.getElementById('notexist11').style.display='block';
          document.getElementById('exist11').style.display='none';
        }else{
          console.log(row);
          document.getElementById('qty11').disabled=false;
          document.getElementById('notexist11').style.display='none';
          document.getElementById('exist11').style.display='block';
        }
    });
  }
</script>

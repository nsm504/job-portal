<?php
include 'header.php';  
include 'nav.php';
include 'data.php';
?>

 <body>
  <div class="container">
   <br />
   <h2 align="center">Ajax Live Data Search using Jquery PHP MySql</h2><br />
   <div class="form-group">
    <div class="input-group">
     <span class="input-group-addon">Search</span>
     <input type="text" name="search_text" id="search_text" placeholder="Search by Customer Details" class="form-control" />
    </div>
   </div>
   <div id="result"></div>
    <?php 
          $res=mysqli_query($conn,"SELECT * FROM user ORDER BY user_id DESC");
          $count=mysqli_num_rows($res);
          $ceil=ceil($count/5);

          $middle = (($page+4>$ceil)?$ceil-4:(($page-4<1)?5:$page));
          $pglink='';
        ?>

      <nav align="center" aria-label="Page navigation example">
            <ul class="pagination justify-content-center">
          <?php

              if($page>=2)
              {
                  echo '<li class="page-item"><a class="page-link first" href="?pg=1">First Page</a></li>'; 
                  echo '<li class="page-item"><a class="page-link prev" href="?pg='.($page-1).'">Previous</a></li>';
              }
              if($ceil<9)
          {
            for($i=1;$i<=$ceil;$i++)
            {
              if($i=='')
              {
                if($i==1)
                { 
                  echo '<li class="page-item active"><a class="page-link" href="?pg='.$i.'">'.$i.'</a></li>';
                }
                else
                {
                  echo '<li class="page-item"><a class="page-link" href="?pg='.$i.'">'.$i.'</a></li>';
                }
              }
              else if($page==$i)
              {
                echo '<li class="page-item active"><a class="page-link" href="?pg='.$i.'">'.$i.'</a></li>';
              }
              else
              {
                echo '<li class="page-item"><a class="page-link" href="?pg='.$i.'">'.$i.'</a></li>';
              }
            }
          }
          else
          {
                  for($i=-4;$i<=4;$i++)
                  {
                    if($middle+$i==$page)
                        $pglink .='<li class="page-item active"><a class="page-link" href="?pg='.($middle+$i).'">'.($middle+$i).'</a></li>';
                    else
                      $pglink .='<li class="page-item"><a class="page-link" href="?pg='.($middle+$i).'">'.($middle+$i).'</a></li>';
                }
                    echo $pglink;
              }
              if($page<$ceil)
              {
                  echo '<li class="page-item"><a class="page-link next" href="?pg='.($page+1).'">Next</a></li>'; 
                  echo '<li class="page-item success"><a class="page-link last" href="?pg='.$ceil.'">Last Page</a></li>';
              }   

          ?>  
            </ul>
          </nav>    
  </div>
 </body>
</html>


<script>
$(document).ready(function(){

 load_data();

 function load_data(query)
 {
  $.ajax({
   url:"fetch.php",
   method:"POST",
   data:{query:query},
   success:function(data)
   {
    $('#result').html(data);
   }
  });
 }
 $('#search_text').keyup(function(){
  var search = $(this).val();
  if(search != '')
  {
   load_data(search);
  }
  else
  {
   load_data();
  }
 });
});
</script>

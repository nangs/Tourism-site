<?php
session_start();
$comment_id=$_GET['id_no'];
$value=$_SESSION['place'];
$con=mysql_connect("localhost","root","");
mysql_select_db("pial",$con);
if(!$con){
    echo "error".mysql_error();
}
$sql="DELETE FROM comment WHERE (comment_id='$comment_id')";
$result=mysql_query($sql) or die(mysql_error());
?>
        <?php
    $s="SELECT * FROM comment WHERE (id=$value) ORDER BY comment_id DESC";
    $r=mysql_query($s) or die(mysql_error());
    while ($rows=mysql_fetch_array($r)) {
      $id= $rows['comment_id'];
    ?>
    <div class="back">
    <div id="user"><span id="u"><?php echo $rows['username']; ?></span>says</div>
    <?php
    $user =$_SESSION['username'];
    $check="SELECT * FROM datatable WHERE username='$user'";
    $p=mysql_query($check) or die(mysql_error());
    $admin_row=mysql_fetch_array($p);
    if($admin_row['admin']==1){
    ?>
    <div id="delete_comment"><input type="button"  id="<?php echo $rows['comment_id']; ?>" onclick="delete_comment(this.id)">
    </div>
    <?php
    }
    ?>
    <div id="date"> <?php echo $rows['date_time']; ?></div>
    <div id="comm"><p id="<?php echo $rows['comment_id'] ?>"><?php echo $rows['comment']; ?></p></div>
    <div id="like_show">
      <?php
      $i=0;
      $query="SELECT * FROM like_record WHERE(comment_id='$id') AND (username='$user')";
      $array=mysql_query($query);
      while($array_row=mysql_fetch_array($array)){
        $i=1;
       }
      ?>
      <?php
      if($i==0){
      ?>
      <div id="like"><input type="button" name="like" id="<?php echo $rows['comment_id']; ?>" onclick="like_count(this.id)"></div>
      <div id="like_amount"><?php echo $rows['likes']; ?> people like this</div>
      <?php
      }
      else
      {
      ?>
      <input type="button" id="liked" value="&#8730; Liked">
      <div id="like_amount"><?php echo $rows['likes']; ?> people including <b>You</b> like this</div>
      <?php
      }
      ?>  
    </div>
  </div>
    <?php
    } 
    ?>
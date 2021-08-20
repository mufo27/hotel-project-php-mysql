<?php
     require_once '../../database/con_db.php';

     if(isset($_GET['type_img'])){
 
        $t_id = $_GET['type_img'];

        $select_img = $conn->prepare("SELECT * FROM images WHERE t_id = :t_id ORDER BY i_id DESC");
        $select_img->bindParam(':t_id' ,  $t_id);
        $select_img->execute();        
 
     }
?>

    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item">ประเภทห้องพัก</li>
              <li class="breadcrumb-item active">รูปภาพเพิ่มเติม</li>
            </ol>
          </div>
        </div>
      </div>
    </div>


    <section class="content">
      <div class="container-fluid">
        <div class="row">
 
          <div class="col-md-12">

            <div class="card">
              <div class="card-header">
                <a href="index.php?type_img_add=<?= $t_id; ?>" class="btn btn-success btn-sm"><i class="fas fa-plus-square"></i> เพิ่มรูปภาพ</a>
              </div>

                <div class="card-body">

                    <div class="row">
                        
                        <?php
                              while($row_img = $select_img->fetch(PDO::FETCH_ASSOC))
                              {   
                        ?>
                              <div class="col-3 mt-5 text-center">
                                  <?php echo '<img src="data:image/jpeg;base64,'.base64_encode($row_img['img']).'
                                            " width="300" height="200"/>'; 
                                  ?>
                                  <div class="mt-3">
                                      <a href="index.php?type_img_edit=<?= $row_img['i_id']; ?>&t_id=<?= $row_img['t_id'];?>" class="btn btn-info btn-sm"><i class="fas fa-pencil-alt"> </i></a>    
                                      <a href="index.php?type_img_del=<?= $row_img['i_id']; ?>&t_id=<?= $row_img['t_id'];?>" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>

                                  </div>
                              </div>
              
                          <?php
                                }
                          ?>
                    </div>

                </div>

            </div>

          </div>

        </div>

            <div class="row mt-2">
				<div class="col-10"></div>
				<div class="col-2">
					<div class="row">
						<a type="submit" class="btn btn-danger" name="back" href="index.php?type"><i class="fas fa-arrow-circle-left"></i> ย้อนกลับ</a>
					</div>
				</div>
			</div>

      </div>
    </section>

    <div class="row mt-5"></div>


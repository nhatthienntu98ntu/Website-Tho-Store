<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/mau.php';?>
<?php
	$mau = new mau();
	if($_SERVER['REQUEST_METHOD'] === 'POST'){
		$name = $_POST['name'];
		$insertmau = $mau->insert_mau($name);
	}
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Thêm Màu</h2>
               <div class="block copyblock"> 
               
               <?php
                    if (isset($insertmau)) {
                        echo $insertmau;
                    }
                ?>
                 <form action="coloradd.php" method="post">
                    <table class="form" >					
                        <tr>
                            <td>
                                <input type="text" name="name" placeholder="Thêm màu..." class="medium" />
                            </td>
                        </tr>
						<tr> 
                            <td>
                                <input type="submit" name="submit" Value="Lưu" />
                            </td>
                        </tr>
                    </table>
                    </form>
                </div>
            </div>
        </div>
<?php include 'inc/footer.php';?>
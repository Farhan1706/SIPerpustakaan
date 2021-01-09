<?php
include '../../../database/koneksi.php';
	$no     = 1;
    $query  = "SELECT * FROM pengumuman ORDER BY id ASC";
    $data   = $koneksi->prepare($query);
    $data->execute();
	$result = $data->get_result();
	if ($result->num_rows > 0) {
		if ($result->num_rows <= 10) {
        	while ($row = $result->fetch_assoc()) {
				echo '<li>';
				echo '<div class="form-check">';
				echo '<label class="form-check-label">';
				echo '<input class="checkbox" type="hidden">';
				echo $row['keterangan'];
				echo '<i class="input-helper"></i></label>';
				echo '</div>';
				echo "<button type='button' id='".$row['id']."' class='btn btn-rounded btn-icon remove' style='float:right;'><i class='mdi mdi-close-circle-outline text-primary'></i></button>";
				echo '</li>';
			}
		}
	}else{
		echo "
		<p class='text-center'>
		Belum Ada Pengumuman yang Ditambahkan!
		</p>
		";
	}
?>

<script>
$( document ).ready(function(){
	todoListItem.on('change', '.checkbox', function() {
		  if ($(this).attr('checked')) {
			$.ajax({
			  url: "proses_pengumuman.php",
			  type: "POST",
			  data: {
				item:item	
			  },
			  cache: false,
			  success: function(dataResult){
				var dataResult = JSON.parse(dataResult);
				$('.todo-list-input').each(function(){
				  $('input').val('')
				});
			  }
			});
			$(this).removeAttr('checked');
		  } else {
			$(this).attr('checked', 'checked');
		  }
	
		  $(this).closest("li").toggleClass('completed');
	
		});
});
</script>
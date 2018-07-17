<table id="datatables" class="display">
			<thead>
				<tr>
					<th>ID</h3></th>
					<?php  
						if($_GET['page']=='peta'){
							echo "<th>Jaringan Pipa</th>";
						}elseif ($_GET['page']=='petaoffline') {
							echo "<th>Sumber Air</th>";
							echo "<th>Jaringan Pipa</th>";
							
						}
					?>
					<th>Diameter Pipa</th>
					<th>Jenis Pipa</th>
					<th>Panjang Pipa</th>
					<th>Debit Air/dtk</th>
					<th>Koordinat</th>
					<th>Tahun Pemasangan</th>
					<th>Kondisi Pipa</th>
					<th>Kondisi Bangunan</th>
				</tr>
			</thead>
			<tbody>
				<?php				
				
					$result=mysql_query($info);					
					while($row=mysql_fetch_assoc($result)){
					?>
					<tr>
						<td><?php echo $row['id_info'];?></td>
						<?php  
							if($_GET['page']=='peta'){
								echo "<td><a href='?page=detail_data&id_info=$row[id_info]' style='text-decoration:none;' target='_blank'>$row[jaringan_pipa]</a></td>";								
							}elseif($_GET['page']=='petaoffline'){
								echo "<td><a href='?page=petaoffline&idsumb=$row[id_sumber]'>$row[nama_sumber]</a></td>";
								echo "<td><a href='?page=detail_data&id_info=$row[id_info]' style='text-decoration:none;' target='_blank'>$row[jaringan_pipa]</a></td>";								
							}
						?>
						
						<td><strong>&empty; </strong><?php echo $row['diameter_pipa'];?><strong>&quot;</strong></td>
						<td><?php echo $row['jenis_pipa'];?></td>
						<td><?php echo $row['panjang_pipa'];?> <strong>M&prime;</strong></td>
						<td><?php echo $row['debit_air'];?> <strong>l/dtk</strong></td>
						<td>Lat:<?php echo $row['lat'];?>, Lng:<?php echo $row['lng'];?> </td>
						<td><?php echo $row['thn_pemasangan'];?></td>
						<td><?php echo $row['kondisi_pipa'];?></td>
						<td><?php echo $row['kondisi_bangunan'];?></td>
					</tr>
					<?php
                    }
				?>
			</tbody>
		</table>
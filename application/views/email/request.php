<?php $this->load->view('email/header'); ?>
<td align="left" valign="top">
	<table style="position:relative; width: 100%; background-color:white">
		<tr>
			<td>
				<p>
					<p class="resize-header" style="padding-left: 80px; font-family:Arial, sans-serif; font-size: 18px; color:#898989;">
						New Move Request
					</p>
					<p style="padding-left: 100px; font-family:Helvetica, Arial, sans-serif; font-size: 16px; color:#898989;">
						<table>
							<tr>
								<td>Email</td>
								<td>
								<?php 
								if(isset($request['email_address']) && !empty($request['email_address']))
								{
									echo $request['email_address']; 
								} else {
									echo "N/A";
								}
								?>	
								</td>
							</tr>
							<tr>
								<td>Phone</td>
								<td><?php echo $request['phone_number']; ?></td>
							</tr>
							<tr>
								<td>Request Date</td>
								<td><?php echo date('M-d-Y H:i:s', $request['created']); ?></td>
							</tr>

							<tr>
								<td>Moving From</td>
								<td><?php echo $request['moving_from'];; ?></td>
							</tr>
							<tr>
								<td>Moving To</td>
								<td><?php echo $request['moving_to']; ?></td>
							</tr>
							<tr>
								<td>Distance</td>
								<td><?php echo $request['distance'] ." Km"; ?></td>
							</tr>
							<tr>
								<td>House Type</td>
								<td>
								<?php
								if($request['house_size'] == '0')
								{
									echo "Bedsitter";
								} else if ($request['house_size'] == '1') {
									echo "1 BDR";
								} else if($request['house_size'] == '2'){
									echo "2 BDR +";
								}
								?>
								</td>
							</tr>
							
							<tr></tr>
							<tr>
								<td><strong>Total Cost</strong></td>
								<td><strong><?php echo "KES. ".number_format($request['total_cost']); ?></strong></td>
							</tr>
						</table>
					</p>
				</p>
			</td>
		</tr>
	</table>
<?php $this->load->view('email/footer'); ?>
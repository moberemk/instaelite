<h2>Revenue</h2>

<h3>Grand Total</h3>
<div class="content-block">
	<table class="table table-hover table-bordered table-striped">
		<thead>
			<tr>
				<th>Type</th>
				<th>Amount</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<th>Posts</th>
				<td>$<?php echo $totals['postTotal']; ?></td>
			</tr>
			<tr>
				<th>Comission</th>
				<td>$<?php echo $totals['revenueReportTotal'] / 2; ?></td>
			</tr>
			<tr>
				<th>Payments</th>
				<td>$<?php echo $totals['paymentTotal']; ?></td>
			</tr>
		</tbody>
		<tfoot>
			<th>Account Balance</th>
			<td>$<?php echo $totals['overallTotal']; ?></td>
		</tfoot>
	</table>
</div>
<div class="row">
	<div class="col-md-6">
		<h3>Posts</h3>
		<div>
			<ul id="totalTabs" class="nav nav-tabs">
		        <li class="active"><a href="#overall_posts" data-toggle="tab">Overall</a></li>
		        <li><a href="#month_posts" data-toggle="tab">By Month</a></li>
		        <!--<li><a href="#week" data-toggle="tab">By Week</a></li>-->
			</ul>
			<div id="totalTabsContent" class="tab-content">
				<div class="tab-pane fade in active" id="overall_posts">
			    	<table class="table table-hover table-bordered table-striped">
			    		<thead>
			    			<tr>
			    				<th>Campaign</th>
			    				<th>Sent</th>
			    				<th>Confirmed</th>
			    				<th>Amount</th>
			    			</tr>
			    		</thead>
			    		<tbody>
			    			<?php foreach($offers as $offer) { ?>
			    			<tr>
			    				<?php
			    				echo '<td></td>';
			    				echo '<td>'.$this->Time->format('F jS, Y', $offer['Offer']['created']).'</td>';
			    				echo '<td>'.$this->Time->format('F jS, Y', $offer['Offer']['posted']).'</td>';
			    				echo '<td>$'.$offer['Offer']['offer'].'</td>';
			    				?>
			    			</tr>
			    			<?php } ?>
			    		</tbody>
			    	</table>
			    	<div class="text-right">
			    	<?php echo $this->Html->link('More...', array('controller'=>'users','action'=>'revenue','posts', $user['id'])); ?>
			    	</div>
				</div>
				<div class="tab-pane fade" id="month_posts">
					<table class="table table-hover table-striped total-revenue">
						<thead>
							<tr>
								<th>Month</th>
								<th>Year</th>
								<th>Total Commission</th>
							</tr>
						</thead>
						<tbody>
						<?php foreach ($postreport_monthly as $key => $month_income) {
							echo '<tr>';
							echo '<td>'.date("F", mktime(0, 0, 0, $month_income[0][0]['month'], 10)).'</td>';
							echo '<td>'.$month_income[0][0]['year'].'</td>';
							echo '<td>$'.round($month_income[0][0]['total_offers'], 3).'</td>';
							echo '</tr>';
						} ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-6">
		<h3>Commission</h3>
		<div>
			<?php echo $this->Html->link('<i class="icon-refresh"></i> Update', array('action'=>'refreshReports', 'admin'=>false), array('class' => 'btn btn-info pull-right', 'escape'=>false)); ?>
			<ul id="totalTabs" class="nav nav-tabs">
		        <li class="active"><a href="#overall_revenue" data-toggle="tab">Overall</a></li>
		        <li><a href="#month_revenue" data-toggle="tab">By Month</a></li>
		        <!--<li><a href="#week" data-toggle="tab">By Week</a></li>-->
			</ul>
			<div id="totalTabsContent" class="tab-content">
				<div class="tab-pane fade in active" id="overall_revenue">
			    	<table class="table table-hover table-bordered table-striped">
			    		<thead>
			    			<tr>
			    				<th>Processed</th>
			    				<th>Advertiser</th>
			    				<th>SKU</th>
			    				<th>Quantity</th>
			    				<th>Sales</th>
			    				<th>Commission</th>
			    			</tr>
			    		</thead>
			    		<tbody>
			    			<?php foreach($revenue as $report) { ?>
			    			<tr>
			    				<?php
			    				echo '<td>'.$this->Time->format('F jS, Y', $report['RevenueReport']['process_datetime']).'</td>';
			    				echo '<td>'.$report['RevenueReport']['advertiser_name'].'</td>';
			    				echo '<td>'.$report['RevenueReport']['sku'].'</td>';
			    				echo '<td>'.$report['RevenueReport']['quantity'].'</td>';
			    				echo '<td>'.$report['RevenueReport']['sales'].'</td>';
			    				echo '<td>$'.$report['RevenueReport']['commission'].'</td>';
			    				?>
			    			</tr>
			    			<?php } ?>
			    		</tbody>
			    	</table>
			    	<div class="text-right">
			    	<?php echo $this->Html->link('More...', array('controller'=>'users','action'=>'revenue','commission', $user['id'])); ?>
			    	</div>
				</div>
				<div class="tab-pane fade" id="month_revenue">
					<table class="table table-hover table-striped total-revenue">
						<thead>
							<tr>
								<th>Month</th>
								<th>Year</th>
								<th>Total Commission</th>
							</tr>
						</thead>
						<tbody>
						<?php foreach ($revenuereport_monthly as $key => $month_revenue) {
							echo '<tr>';
							echo '<td>'.date("F", mktime(0, 0, 0, $month_revenue[0][0]['month'], 10)).'</td>';
							echo '<td>'.$month_revenue[0][0]['year'].'</td>';
							echo '<td>$'.round($month_revenue[0][0]['total_commission'], 3).'</td>';
							echo '</tr>';
						} ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
<h2>Commission
<?php
if($admin_view) {
	echo ' for '.$this->Html->link($user['username'], array('admin'=>true,'controller'=>'users','action'=>'view',$user['id']));
}
?>
</h2>
<div>
	<?php echo $this->Html->link('<i class="icon-refresh"></i> Update', array('action'=>'refreshReports', 'admin'=>false), array('class' => 'btn btn-info pull-right', 'escape'=>false)); ?>
	<ul id="totalTabs" class="nav nav-tabs">
        <li class="active"><a href="#overall" data-toggle="tab">Overall</a></li>
        <li><a href="#month" data-toggle="tab">By Month</a></li>
        <!--<li><a href="#week" data-toggle="tab">By Week</a></li>-->
	</ul>
	<div id="totalTabsContent" class="tab-content">
		<div class="tab-pane fade in active" id="overall">
		    <ul class="pagination">
		        <?php
		            echo $this->Paginator->prev(__('prev'), array('tag' => 'li'), null, array('tag' => 'li','class' => 'disabled','disabledTag' => 'a'));
		            echo $this->Paginator->numbers(array('separator' => '','currentTag' => 'a', 'currentClass' => 'active','tag' => 'li','first' => 1));
		            echo $this->Paginator->next(__('next'), array('tag' => 'li','currentClass' => 'disabled'), null, array('tag' => 'li','class' => 'disabled','disabledTag' => 'a'));
		        ?>
		    </ul>
	    	<table class="table table-hover table-bordered table-striped">
	    		<thead>
	    			<tr>
	    				<th><?php echo $this->Paginator->sort('process_datetime', 'Processed'); ?></th>
	    				<th><?php echo $this->Paginator->sort('advertiser_name', 'Advertiser'); ?></th>
	    				<th><?php echo $this->Paginator->sort('sku', 'SKU'); ?></th>
	    				<th><?php echo $this->Paginator->sort('quantity'); ?></th>
	    				<th><?php echo $this->Paginator->sort('sales'); ?></th>
	    				<th><?php echo $this->Paginator->sort('commission'); ?></th>
	    			</tr>
	    		</thead>
	    		<tbody>
	    			<?php foreach($revenueReports as $report) { ?>
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
	        <ul class="pagination">
	            <?php
	                echo $this->Paginator->prev(__('prev'), array('tag' => 'li'), null, array('tag' => 'li','class' => 'disabled','disabledTag' => 'a'));
	                echo $this->Paginator->numbers(array('separator' => '','currentTag' => 'a', 'currentClass' => 'active','tag' => 'li','first' => 1));
	                echo $this->Paginator->next(__('next'), array('tag' => 'li','currentClass' => 'disabled'), null, array('tag' => 'li','class' => 'disabled','disabledTag' => 'a'));
	            ?>
	        </ul>
		</div>
		<div class="tab-pane fade" id="month">
			<table class="table table-hover table-striped total-revenue">
				<thead>
					<tr>
						<th>Month</th>
						<th>Year</th>
						<th>Total Commission</th>
					</tr>
				</thead>
				<tbody>
				<?php foreach ($monthly as $key => $month) {
					echo '<tr>';
					echo '<td>'.date("F", mktime(0, 0, 0, $month[0][0]['month'], 10)).'</td>';
					echo '<td>'.$month[0][0]['year'].'</td>';
					echo '<td>$'.round($month[0][0]['total_commission'], 3).'</td>';
					echo '</tr>';
				} ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
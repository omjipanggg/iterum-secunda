<div class="container-fluid m-0 p-0">
	<div class="row row-child m-0 p-0">
		<div class="col m-0 px-2">
			<div class="table-responsive m-0 p-0">
				<table class="table table-sm table-bordered score-details m-0 p-0">
					<thead>
						<tr>
							<th>P1</th>
							<th>P2</th>
							<th>P3</th>
							<th>P4</th>
							<th>P5</th>
							<th>P6</th>
							<th>AVG(P)</th>
							<th>Q1</th>
							<th>Q2</th>
							<th>Q3</th>
							<th>Q4</th>
							<th>AVG(Q)</th>
							<th>X</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>{{ $schedule->score->personality ?? 0 }}</td>
							<td>{{ $schedule->score->teamwork ?? 0 }}</td>
							<td>{{ $schedule->score->leadership ?? 0 }}</td>
							<td>{{ $schedule->score->comperhension ?? 0 }}</td>
							<td>{{ $schedule->score->work_motivation ?? 0 }}</td>
							<td>{{ $schedule->score->interest_in_work ?? 0 }}</td>
							<td>{{ $avg_p = number_format((($schedule->score->personality ?? 0) + ($schedule->score->comperhension ?? 0) + ($schedule->score->teamwork ?? 0) + ($schedule->score->leadership ?? 0) + ($schedule->score->work_motivation ?? 0) + ($schedule->score->interest_in_work ?? 0))/6, 2, '.', '') ?? 0 }}</td>
							<td>{{ $schedule->score->computer_basic ?? 0 }}</td>
							<td>{{ $schedule->score->computer_advance ?? 0 }}</td>
							<td>{{ $schedule->score->linguistics ?? 0 }}</td>
							<td>{{ $schedule->score->work_knowledge ?? 0 }}</td>
							<td>{{ $avg_q = number_format((($schedule->score->computer_basic ?? 0) + ($schedule->score->computer_advance ?? 0) + ($schedule->score->linguistics ?? 0) + ($schedule->score->work_knowledge ?? 0))/4, 2, '.', '') ?? 0 }}</td>
							<td>{{ $schedule->score->suitability ?? 0 }}</td>
						</tr>
					</tbody>
					<tfoot>
						<tr>
							<th>P1</th>
							<th>P2</th>
							<th>P3</th>
							<th>P4</th>
							<th>P5</th>
							<th>P6</th>
							<th>AVG(P)</th>
							<th>Q1</th>
							<th>Q2</th>
							<th>Q3</th>
							<th>Q4</th>
							<th>AVG(Q)</th>
							<th>X</th>
						</tr>
					</tfoot>
				</table>
			</div>
		</div>
	</div>
</div>
<?php 
	
	$json = file_get_contents('settings.json');
	$es = json_decode($json,true);

 ?>
 <div class="container">
	<a href="index.php">Home</a> > Vote <br><br>
	<br>
	<p class="alert-primary alert">
		INSTRUCTIONS: Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
		tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
		quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
		consequat.
	</p>
	<br>





 	<h5>President</h5>
 	<p>Please vote only one</p>
 	<div class="container">
 		<table class="table">
 			<thead>
 				<tr>
 					<th>#</th>
 					<th>Candidate</th>
 					<th>Party</th>			
 				</tr>
 			</thead>
 			<tbody>
 				<tr>
 					<td>1</td>
 					<td>
                        <div class="checkbox">
                            <input id="checkbox2" type="checkbox">
                            <label for="checkbox2">
                                Hans Filomeno Olano
                            </label>
                        </div>
 					</td>
 					<td>Random Party</td>
 				</tr>
 				<tr>
 					<td>2</td>
 					<td>
                        <div class="checkbox">
                            <input id="checkbox1" type="checkbox">
                            <label for="checkbox1">
                                Rhunzted Cyrus Completo
                            </label>
                        </div>
 					</td>
 					<td>Random Party</td>
 				</tr>
 			</tbody>
 		</table>
 	</div>
 	<hr>
 	<br><br>


 	<h5>Vice President</h5>
 	<p>Please vote only one</p>
 	<div class="container">
 		<table class="table">
 			<thead>
 				<tr>
 					<th>#</th>
 					<th>Candidate</th>
 					<th>Party</th>			
 				</tr>
 			</thead>
 			<tbody>
 				<tr>
 					<td>1</td>
 					<td>
                        <div class="checkbox">
                            <input id="checkbox4" type="checkbox">
                            <label for="checkbox4">
                                Hans Filomeno Olano
                            </label>
                        </div>
 					</td>
 					<td>Random Party</td>
 				</tr>
 				<tr>
 					<td>2</td>
 					<td>
                        <div class="checkbox">
                            <input id="checkbox5" type="checkbox">
                            <label for="checkbox5">
                                Rhunzted Cyrus Completo
                            </label>
                        </div>
 					</td>
 					<td>Random Party</td>
 				</tr>
 			</tbody>
 		</table>
 	</div>
 		<hr>
 	<br><br>

 	<div class="container text-center">

	 	<button class="btn btn-primary btn-lg">Submit Vote</button>
 	</div>










 </div>
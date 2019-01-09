<?php
$etc=$salary=$raise="";
$salary = preg_replace("/[^0-9\-\.]/", "", $_POST["salary"]);
$desired = preg_replace("/[^0-9\-\.]/", "", $_POST["desired"]);
$raise = preg_replace("/[^0-9\-\.]/", "", $_POST["raise"])/100;

if ($salary>0) {
	$raiseWithoutTaxesInflate = '$' . number_format($salary*$raise,2);
	$raiseWithoutTaxes = '$' . number_format($salary*($raise-.0207),2);
	$raiseAmount = '$' . number_format(($salary*($raise-.0207))-($salary*($raise-.0207)*.21),2);
	$raiseAmountWeek = '$' . number_format((($salary*($raise-.0207))-($salary*($raise-.0207)*.21))/52,2);

	$hourly = (($salary*$raise)+$salary)/2000;
	$desiredHourly = $desired/2000;

	$rate = 8- ($hourly/$desiredHourly * 8);

	$etc = "Before taxes and inflation, you would make $raiseWithoutTaxesInflate more a year. In the real world, inflation is 2.07% for 2016, making your " . ($raise*100) . "% raise actually " . (($raise*100)-2.07) . "%, or only $raiseWithoutTaxes.<br><br>But, being a red-blooded American, you also pay around 21% in taxes, healthcare, etc. So, $raiseAmount is what you're seeing a year -- or $raiseAmountWeek each week.";

	if ($desired>$salary) {
		$etc2 = "Well, you don't think you're paid enough! Ok... If you work 40 hours a week, and have two weeks vacation a year, you work 2,000 hours a year. This means you make around $" . number_format($hourly,2) . " an hour. You want to make $" . number_format($desired/2000,2) . " an hour. To be paid that amount at your current rate, you must poop for " . number_format($rate,2) . " hours a day.";
	}
} else {
	$salary = $desired = $raise = "";
}
?>
<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

		<title>Raise Calculator v.2.91</title>
	</head>
	<body>
		<div class="container">
			<div class="row">
				<div class="col-sm-6 col-sm-offset-3">
					<h1>Raise Calculator</h1>
					Calculate how much you have to poop to get the raise you deserve!<hr>
					<form action="raise.php" method="post">
						<?=(date("m")>2&&date("m")<12?"<div class=\"alert alert-danger\">IT IS " . strtoupper(date("F")) . "!! HOW ARE YOU ONLY GETTING A RAISE NOW?!</div>":"")?>
						<?=($etc!=""?"<div class=\"alert alert-danger\">$etc</div>":"")?>
						<?=($etc2!=""?"<div class=\"alert alert-success\">$etc2</div>":"")?>
						<table>
							<tr>
								<td>Your Salary (yearly)</td>
								<td><input type="text" name="salary" placeholder="$50,000" value="<?=number_format($salary,2)?>" class="form-control"></td>
							</tr>
							<tr>
								<td>Your Raise</td>
								<td><input type="text" name="raise" placeholder="2.91%" value="<?=number_format($raise*100,2)?>" class="form-control"></td>
							</tr>
							<tr>
								<td>Desired Salary</td>
								<td><input type="text" name="desired" placeholder="$9,001" value="<?=number_format($desired,2)?>" class="form-control"></td>
							</tr>
							<tr>
								<td colspan="2">
									<input type="submit" value="Do Math!" class="btn btn-primary">
								</td>
							</tr>
						</table>
					</form>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-6 col-sm-offset-3">
					<a href="http://www.usinflationcalculator.com/inflation/current-inflation-rates/" target="_blank">Inflation Calculator</a> |
					<a href="https://github.com/rlerner/RaiseCalculator/" target="_blank">Github</a>
				</div>
			</div>
		</div>
	</body>
</html>

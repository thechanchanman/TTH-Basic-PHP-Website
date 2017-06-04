<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$name = trim(filter_input(INPUT_POST, "name", FILTER_SANITIZE_STRING));
	$email = trim(filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL));
	$details = trim(filter_input(INPUT_POST, "details", FILTER_SANITIZE_SPECIAL_CHARS));

	if ($name == "" OR $email == "" OR $details == "") {
		echo "Please fill in the required fields: Name, Email and Details";
		exit;
	}
	if ($_POST["address"] != "") {
		echo "Bad form input";
		exit;
	}

	echo "<pre>";
	$email_body = "";
	$email_body .= "Name " . $name . "\n";
	$email_body .= "Email " . $email . "\n";
	$email_body .= "Details " . $details . "\n";
	echo $email_body;
	echo "</pre>";

	// To Do: Send email
	header("location:" . basename(__FILE__) . "?status=thanks");
}

$pageTitle = "Suggest a Media Item";
$section = "suggest";

include("inc/header.php");
?>

<div class="section page">
	<div class="wrapper">
		<h1>Suggest a Media Item</h1>
		<?php if (isset($_GET["status"]) && $_GET["status"] == "thanks") : ?>
		<p>Thanks for the email! I&rsquo;ll check out your suggestion shortly!</p>
		<?php else: ?>
		<p>If you think there is something I&rsquo;m missing, let me know! Complete the form to send me an email.</p>
		<form action="<?php echo basename(__FILE__); ?>" method="post">
			<table>
				<tr>
					<th><label for="name">Name</label></th>
					<td><input type="text" id="name" name="name"></td>
				</tr>
				<tr>
					<th><label for="email">Email</label></th>
					<td><input type="text" id="email" name="email"></td>
				</tr>
				<tr>
					<th><label for="details">Details</label></th>
					<td><textarea id="details" name="details"></textarea></td>
				</tr>
				<tr style="display: none;">
					<th><label for="address">Address</label></th>
					<td>
						<input type="text" id="address" name="address">
						<p>Please leave this field blank</p>
					</td>
				</tr>
			</table>
			<input type="submit" value="Send">
		</form>
	<?php endif; ?>
	</div>
</div>

<?php include("inc/footer.php"); ?>

<?php
// Including the file containing the database connection
require 'dbconnection.php';

// Start session
session_start();

// Select existing categories
$adminCategory = $Connection->prepare('SELECT * FROM categories');
$adminCategory->execute();

// Check if user is logged in
if(isset($_SESSION['email'])) {
    $loggedIn = true;
    $email = $_SESSION['email'];
} else {
    $loggedIn = false;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Carbuy Auctions</title>
    <link rel="stylesheet" href="carbuy.css" /> <!-- Include your CSS file -->
</head>

<body>
<header>
    <!-- Website header -->
    <h1>
        <span class="C">C</span>
        <span class="a">a</span>
        <span class="r">r</span>
        <span class="b">b</span>
        <span class="u">u</span>
        <span class="y">y</span>
    </h1>

    <!-- Search form -->
    <form action="#">
        <input type="text" name="search" placeholder="Search for a car" />
        <input type="submit" name="submit" value="Search" />
    </form>

    <!-- User info and login/logout links -->
    <?php if($loggedIn) { ?>
        <div class="user-info">
            Welcome, <?php echo $email; ?>!
        </div>
        <a href="logout.php">Log Out</a>
    <?php } else { ?>
        <a href="login.php">Login/Sign Up</a>
    <?php } ?>

</header>

<nav>
    <!-- Navigation menu -->
    <ul>
        <!-- Dynamic category links -->
        <?php foreach ($adminCategory as $category): ?>
            <li><a class="categoryLink" href="#"><?php echo $category['categorieName']; ?></a></li>
        <?php endforeach; ?>

       <!-- Dropdown menu to select additional options -->
		<li>
    		<select id="moreOptions">
        		<option value="#">More</option>
        		<?php if($loggedIn && $_SESSION['role'] === 'admin') { ?>
            		<option value="adminCategories.php">Add Category</option>
        		<?php } ?>
        		<?php if($loggedIn) { ?>
           	 		<option value="addAuction.php">Add Auction</option>
        		<?php } ?>
    		</select>
		</li>
		<!--https://www.youtube.com/watch?v=KTeuJxbopnU-->
		<!-- JavaScript for dropdown menu redirection -->
		<script>
    		// Event listener for dropdown menu change
    		document.getElementById('moreOptions').addEventListener('change', function() {
        		// Get selected option value
        		var selectedOption = this.value;
        		// Redirect if option is not placeholder
        		if (selectedOption !== '#') {
            		window.location.href = selectedOption;
        		}
    		});
		</script>

    </ul>
</nav>


<img src="../banners/1.jpg" alt="Banner" />

<main>
		<h1>Latest Car Listings / Search Results / Category listing</h1>
		<ul class="carList">
			<li>
				<img src="../images/car.png" alt="car name">
				<article>
					<h2>Car model and make</h2>
					<h3>Car category</h3>
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. In sodales ornare purus, non laoreet dolor sagittis id. Vestibulum lobortis laoreet nibh, eu luctus purus volutpat sit amet. Proin nec iaculis nulla. Vivamus nec tempus quam, sed dapibus massa. Etiam metus nunc, cursus vitae ex nec, scelerisque dapibus eros. Donec ac diam a ipsum accumsan aliquet non quis orci. Etiam in sapien non erat dapibus rhoncus porta at lorem. Suspendisse est urna, egestas ut purus quis, facilisis porta tellus. Pellentesque luctus dolor ut quam luctus, nec porttitor risus dictum. Aliquam sed arcu vehicula, tempor velit consectetur, feugiat mauris. Sed non pellentesque quam. Integer in tempus enim.</p>

					<p class="price">Current bid: £1234.00</p>
					<a href="#" class="more auctionLink">More &gt;&gt;</a>
				</article>
			</li>
			<li>
				<img src="../images/car.png" alt="car name">
				<article>
					<h2>Car model and make</h2>
					<h3>Car category</h3>
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. In sodales ornare purus, non laoreet dolor sagittis id. Vestibulum lobortis laoreet nibh, eu luctus purus volutpat sit amet. Proin nec iaculis nulla. Vivamus nec tempus quam, sed dapibus massa. Etiam metus nunc, cursus vitae ex nec, scelerisque dapibus eros. Donec ac diam a ipsum accumsan aliquet non quis orci. Etiam in sapien non erat dapibus rhoncus porta at lorem. Suspendisse est urna, egestas ut purus quis, facilisis porta tellus. Pellentesque luctus dolor ut quam luctus, nec porttitor risus dictum. Aliquam sed arcu vehicula, tempor velit consectetur, feugiat mauris. Sed non pellentesque quam. Integer in tempus enim.</p>

					<p class="price">Current bid: £2000</p>
					<a href="#" class="more auctionLink">More &gt;&gt;</a>
				</article>
			</li>
			<li>
				<img src="../images/car.png" alt="car name">
				<article>
					<h2>Car model and make</h2>
					<h3>Car category</h3>
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. In sodales ornare purus, non laoreet dolor sagittis id. Vestibulum lobortis laoreet nibh, eu luctus purus volutpat sit amet. Proin nec iaculis nulla. Vivamus nec tempus quam, sed dapibus massa. Etiam metus nunc, cursus vitae ex nec, scelerisque dapibus eros. Donec ac diam a ipsum accumsan aliquet non quis orci. Etiam in sapien non erat dapibus rhoncus porta at lorem. Suspendisse est urna, egestas ut purus quis, facilisis porta tellus. Pellentesque luctus dolor ut quam luctus, nec porttitor risus dictum. Aliquam sed arcu vehicula, tempor velit consectetur, feugiat mauris. Sed non pellentesque quam. Integer in tempus enim.</p>

					<p class="price">Current bid: £3000</p>
					<a href="#" class="more auctionLink">More &gt;&gt;</a>
				</article>
			</li>
		</ul>

		<hr />

		<h1>Car Page</h1>
		<article class="car">

				<img src="../images/car.png" alt="car name">
				<section class="details">
					<h2>Car model and make</h2>
					<h3>Car category</h3>
					<p>Auction created by <a href="#">User.Name</a></p>
					<p class="price">Current bid: £4000</p>
					<time>Time left: 8 hours 3 minutes</time>
					<form action="#" class="bid">
						<input type="text" name="bid" placeholder="Enter bid amount" />
						<input type="submit" value="Place bid" />
					</form>
				</section>
				<section class="description">
				<p>
					Lorem ipsum dolor sit amet, consectetur adipiscing elit. In sodales ornare purus, non laoreet dolor sagittis id. Vestibulum lobortis laoreet nibh, eu luctus purus volutpat sit amet. Proin nec iaculis nulla. Vivamus nec tempus quam, sed dapibus massa. Etiam metus nunc, cursus vitae ex nec, scelerisque dapibus eros. Donec ac diam a ipsum accumsan aliquet non quis orci. Etiam in sapien non erat dapibus rhoncus porta at lorem. Suspendisse est urna, egestas ut purus quis, facilisis porta tellus. Pellentesque luctus dolor ut quam luctus, nec porttitor risus dictum. Aliquam sed arcu vehicula, tempor velit consectetur, feugiat mauris. Sed non pellentesque quam. Integer in tempus enim.</p>


				</section>

				<section class="reviews">
					<h2>Reviews of User.Name </h2>
					<ul>
						<li><strong>John said </strong> great car seller! Car was as advertised and delivery was quick <em>29/01/2024</em></li>
						<li><strong>Dave said </strong> disappointing, Car was slightly damaged and arrived slowly.<em>22/12/2023</em></li>
						<li><strong>Susan said </strong> great value but the delivery was slow <em>22/07/2023</em></li>

					</ul>

					<form>
						<label>Add your review</label> <textarea name="reviewtext"></textarea>

						<input type="submit" name="submit" value="Add Review" />
					</form>
				</section>
				</article>

				<hr />
				<h1>Sample Form</h1>

				<form action="#">
					<label>Text box</label> <input type="text" />
					<label>Another Text box</label> <input type="text" />
					<input type="checkbox" /> <label>Checkbox</label>
					<input type="radio" /> <label>Radio</label>
					<input type="submit" value="Submit" />

				</form>



		<footer>
			&copy; Carbuy 2024
		</footer>
	</main>
</body>
</html>
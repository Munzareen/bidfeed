<header>
	<div class="container header-container">
		<div class="header-row">
			<div class="header-logo">
				<a href="landing-user.php"><img src="assets/images/header-logo.png" alt="icon" class="img-fluid"></a>
			</div>
			<form class="header-search">
				<div class="cat-dropdown">
					<span class="cat-icon"><img src="assets/images/category-icon.svg" alt="icon" class="img-fluid"></span>
					<select>
						<option>Category 1</option>
						<option>Category 2</option>
						<option>Category 3</option>
						<option>Category 4</option>
					</select>
					<!-- <div class="dropdown">
						<button class="btn dropdown-toggle" type="button" id="search-category-dropdown" data-bs-toggle="dropdown" aria-expanded="false">
							<span><img src="assets/images/category-icon.svg" alt="icon" class="img-fluid"></span>
							Category
							<span><img src="assets/images/chevron-down.svg" alt="icon" class="img-fluid"></span>
						</button>
						<ul class="dropdown-menu" aria-labelledby="search-category-dropdown">
							<li><a class="dropdown-item" href="#">Category 1</a></li>
							<li><a class="dropdown-item" href="#">Category 2</a></li>
							<li><a class="dropdown-item" href="#">Category 3</a></li>
						</ul>
					</div> -->
				</div>
				<div class="sreach-bar">
					<span><img src="assets/images/search-icon.svg" alt="icon" class="img-fluid"></span>
					<input type="text" placeholder="Search products">
				</div>
			</form>
			<div class="header-right">
				<div class="add-post">
					<button class="add-post-btn" type="button" data-bs-toggle="modal" data-bs-target="#new-post-modal"><img src="assets/images/plus-icon.svg" alt="icon" class="img-fluid">Add new post</button>
				</div>
				<button class="resp-sidenav-toggle"><i class="fa-solid fa-bars"></i></button>
				<div class="resp-sidenav-wrap">
					<button class="close-sidebar"><img src="assets/images/icon-cross.png" alt="icon" class="img-fluid"></button>
					<div class="btns-list">
						<ul>
							<li>
								<a href="#!" id="noti-box-btn"><img src="assets/images/notification-icon.svg" alt="icon" class="img-fluid">
									<span class="noti-count">2</span>
								</a>
								<div class="cartbox-dropdown" id="notification-dropdown">
									<div class="cartbox-inner">
										<div>
											<div class="cartbox-top">
												<p>Notifications</p>
												<button class="close-cart"><img src="assets/images/icon-cross.png" alt="icon" class="img-fluid"></button>
											</div>
											<div class="cart-item-wrap">
												<div class="comments-wrap">
													<div class="old-comments">
														<div class="user-comment">
															<div class="img">
																<img src="assets/images/user-comment-img.png" alt="img" class="img-fluid">
															</div>
															<div class="comment-info">
																<div class="comment-top">
																	<p class="comment-name">Cameron Williamson</p>
																	<p class="comment-time">10h</p>
																</div>
																<p class="comment-text">Lorem ispum dolar sit</p>
															</div>
														</div>
														<div class="user-comment">
															<div class="img">
																<img src="assets/images/user-comment-img.png" alt="img" class="img-fluid">
															</div>
															<div class="comment-info">
																<div class="comment-top">
																	<p class="comment-name">Cameron Williamson</p>
																	<p class="comment-time">10h</p>
																</div>
																<p class="comment-text">Lorem ispum dolar sit</p>
															</div>
														</div>
														<div class="user-comment">
															<div class="img">
																<img src="assets/images/user-comment-img.png" alt="img" class="img-fluid">
															</div>
															<div class="comment-info">
																<div class="comment-top">
																	<p class="comment-name">Cameron Williamson</p>
																	<p class="comment-time">10h</p>
																</div>
																<p class="comment-text">Lorem ispum dolar sit</p>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="btn-box">
											<a href="#!" class="outline">Clear All</a>
										</div>
									</div>
								</div>
							</li>
							<li>
								<a href="chat.php"><img src="assets/images/chat-icon.svg" alt="icon" class="img-fluid"></a>
							</li>
							<li>
								<a href="#!" id="cart-box-btn"><img src="assets/images/cart-icon.svg" alt="icon" class="img-fluid">
									<span class="noti-count">2</span></a>
									<div class="cartbox-dropdown" id="cartbox-dropdown-only">
										<div class="cartbox-inner">
											<div>
												<div class="cartbox-top">
													<p>Your Cart</p>
													<button class="close-cart"><img src="assets/images/icon-cross.png" alt="icon" class="img-fluid"></button>
												</div>
												<div class="cart-item-wrap">
													<div class="cart-item">
														<div class="img">
															<img src="assets/images/gallery-card-img-1.png" alt="img" class="img-fluid">
														</div>
														<div class="text">
															<p class="name">Tracksuit Men African Clothing Print Shirt Suit.</p>
															<div class="size-wrap">
																<div class="size-box">42</div>
															</div>
															<p class="price">$390</p>
															<div class="item-action">
																<div class="quantity-wrap">
																	<div class="quaitity-box mt-0">
																		<div class="plus-minus">
																			<span class="minus"><i class="fa-solid fa-minus"></i></span>
																			<input type="number" class="count" name="qty" value="1">
																			<span class="plus"><i class="fa-solid fa-plus"></i></span>
																		</div>
																	</div>
																</div>
																<div class="action">
																	<a href="#!"><i class="fa-solid fa-trash pe-1"></i>Delete</a>
																</div>
															</div>
														</div>
													</div>
													<div class="cart-item">
														<div class="img">
															<img src="assets/images/gallery-card-img-2.png" alt="img" class="img-fluid">
														</div>
														<div class="text">
															<p class="name">Tracksuit Men African Clothing Print Shirt Suit.</p>
															<div class="size-wrap">
																<div class="size-box">43</div>
															</div>
															<p class="price">$390</p>
															<div class="item-action">
																<div class="quantity-wrap">
																	<div class="quaitity-box mt-0">
																		<div class="plus-minus">
																			<span class="minus"><i class="fa-solid fa-minus"></i></span>
																			<input type="number" class="count" name="qty" value="1">
																			<span class="plus"><i class="fa-solid fa-plus"></i></span>
																		</div>
																	</div>
																</div>
																<div class="action">
																	<a href="#!"><i class="fa-solid fa-trash pe-1"></i>Delete</a>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
											<div>
												<div class="amount-wrap">
													<ul>
														<li>
															<span>Tax Total</span>
															<span>$ 0.00</span>
														</li>
														<li>
															<span><strong>Total</strong></span>
															<span><strong>$ 2210</strong></span>
														</li>
													</ul>
												</div>
												<div class="btn-box">
													<a href="cart.php" class="outline">View Cart</a>
												</div>
											</div>
										</div>
									</div>	
								</li>
							</ul>
						</div>
						<a class="user-info" href="profile.php">
							<div class="user-img">
								<img src="assets/images/user-avatar.png" alt="icon" class="img-fluid">
							</div>
							<div class="user-det">
								<p class="name">Barly Vallendito</p>
								<p class="email">barly@wagevest.com</p>
							</div>
						</a>
					</div>
				</div>
			</div>
		</div>			
	</header>

	<script>
	// RESPONSIVE NAV TOGGLE
	let respNavToggle = document.querySelector(".resp-sidenav-toggle");
	let sideBarNav = document.querySelector(".resp-sidenav-wrap");
	let closeSideBarNav = document.querySelector(".resp-sidenav-wrap .close-sidebar");
	let bodySelector = document.querySelector("body");
	respNavToggle.addEventListener('click', () => {
		sideBarNav.classList.toggle("active");
		bodySelector.classList.toggle("bg-overlay");
	});
	closeSideBarNav.addEventListener('click', () => {
		sideBarNav.classList.remove("active");
		bodySelector.classList.remove("bg-overlay");
	});
	window.addEventListener('resize', function(event) {
		sideBarNav.classList.remove("active");
		bodySelector.classList.remove("bg-overlay");
	}, true);

</script>
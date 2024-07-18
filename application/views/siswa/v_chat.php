<?php
$this->load->view('siswa/head');
?>

<!--tambahkan custom css disini-->

<?php
$this->load->view('siswa/topbar');
$this->load->view('siswa/sidebar');
?>

<!-- Content Header (Page header) -->


<!-- Main content -->
<section class="content">
	<div class="container">
		<h3 class=" text-center">Chat dengan AI</h3>
		<div class="messaging">
			<div class="inbox_msg">
				<div class="mesgs" style="width: 100%;background-color: white">
					<div class="msg_history messageHistory">

					</div>
					<div class="type_msg">
						<div class="input_msg_write">
							<input type="text" class="write_msg message" placeholder="Type a message"/>
							<button class="msg_send_btn sendMessage" type="button"><i class="fa fa-paper-plane-o" aria-hidden="true"></i></button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

</section><!-- /.content -->

<script>
	window.addEventListener('load', (event) => {

		document.querySelector(".sendMessage").addEventListener('click', (event) => {

			// event.currentTarget.classList.add('is-loading');
			// event.currentTarget.disabled = true;

			// document.querySelector(".result").parentElement.classList.add("is-hidden");
			// document.querySelector(".error").parentElement.classList.add("is-hidden");

			let currHour = new Date();

			const userMsgTemplate = `
						<div class="outgoing_msg">
							<div class="sent_msg">
								<p>${document.querySelector(".message").value}</p>
								<span class="time_date"> ${currHour.getHours() + ":" + currHour.getMinutes()}</span>
							</div>
						</div>`


			let chatBox = document.querySelector(".messageHistory");

			chatBox.innerHTML += userMsgTemplate;
			chatBox.scrollIntoView(false);

			const payload = JSON.stringify({
				"message": document.querySelector(".message").value
			});

			document.querySelector(".message").value = "";

			fetch("<?php echo base_url('chat/request') ?>", {
				method: 'POST',
				headers: {
					'Content-Type': 'application/json',
				},
				body: payload,
			}).then(response => response.json())
				.then(data => {

					let currHour = new Date();

					data.responseMessage = data.responseMessage.replace("\n", "<br>");

					let aiMsgTemplate = `
					 <div class="incoming_msg">
						  <div class="incoming_msg_img"> <img src="https://ptetutorials.com/images/user-profile.png" alt="sunil"> </div>
						  <div class="received_msg">
							<div class="received_withd_msg">
							  <p>${data.responseMessage}</p>
							  <span class="time_date"> ${currHour.getHours() + ":" + currHour.getMinutes()}</span></div>
						  </div>
						</div>
					`

					chatBox.innerHTML += aiMsgTemplate;
					chatBox.scrollIntoView(false);

				})
				.catch((error) => {
					console.error('Error:', error);
				}).finally(() => {
				// document.querySelector(".sendMessage").classList.remove('is-loading');
				// document.querySelector(".sendMessage").disabled = false;
			});
		});

	});
</script>
<?php
$this->load->view('admin/foot');
?>


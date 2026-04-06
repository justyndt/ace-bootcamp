const countdown = {
	// Set the date we're counting down to
	countDownDate: new Date('Mar 20, 2025 09:00:00 EST').getTime(),

	// Start the countdown
	start: function () {
		// Update the countdown every 1 second
		const x = setInterval(() => {
			// Get today's date and time
			const now = new Date().getTime();

			// Find the distance between now and the countdown date
			const distance = this.countDownDate - now;

			// Time calculations for days, hours, minutes, and seconds
			const days = Math.floor(distance / (1000 * 60 * 60 * 24));
			const hours = Math.floor(
				(distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60)
			);
			const minutes = Math.floor(
				(distance % (1000 * 60 * 60)) / (1000 * 60)
			);
			const seconds = Math.floor((distance % (1000 * 60)) / 1000);

			// Display the result in the appropriate elements
			document.getElementById('days').innerHTML =
				`<span>${days}</span><em>Days</em>`;
			document.getElementById('hours').innerHTML =
				`<span>${hours}</span><em>Hours</em>`;
			document.getElementById('minutes').innerHTML =
				`<span>${minutes}</span><em>Minutes</em>`;
			document.getElementById('seconds').innerHTML =
				`<span>${seconds}</span><em>Seconds</em>`;

			// If the countdown is finished, display "EXPIRED"
			if (distance < 0) {
				clearInterval(x);
				const countdownDiv =
					document.getElementById('countdown-parent');
				countdownDiv.style.display = 'none';
				document.getElementById('countdown').innerHTML =
					'<div class="expired-clock"><span>Happy Homecoming!</span></div>';
			}
		}, 1000);
	},
};
export default countdown;
